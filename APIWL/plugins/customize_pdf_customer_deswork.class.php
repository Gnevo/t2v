<?php

require_once('./plugins/F_pdf.class.php');
require_once('./plugins/fpdi/fpdi.php');

class PDF_Customer_insurance extends FPDI {

    var $smarty;
    function __construct() {

        parent::__construct();
        $this->smarty = new smartySetup(array("reports.xml", "user.xml", "messages.xml", "button.xml","month.xml","privilege.xml","common.xml"), FALSE);
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
        $this->Cell(190, 6, utf8_decode($this->smarty->translate['description_of_work']), '', 1, 'C');
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

    function customer_des_work($data, $dt, $created_by_name, $field_names ,$new_work_details) {
        
        $this->SetFont('Arial', '', 9);
        $this->Cell(190, 6, utf8_decode($this->smarty->translate['date_self']), 'LTR', 1, 'L');
        $this->SetFont('Arial', 'B', 10);
//        $this->Cell(190, 4, utf8_decode($dt), 'LRB', 1, 'L');
        $this->Cell(190, 4, utf8_decode($data[0]['date']), 'LRB', 1, 'L');

        $this->SetFont('Arial', '', 9);
        $this->Cell(190, 6, utf8_decode($field_names['work']), 'LR', 1, 'L');
        $this->SetFont('Arial', 'B', 10);
//        $this->MultiCell(190,4,utf8_decode($data[0]['work']),'LRB',1,'L'); 
        $this->MultiCell(190, 4, utf8_decode(strip_tags($this->html_convert($data[0]['work']))), 'LBR', 1, 'L');

        $this->SetFont('Arial', '', 9);
        $this->Cell(190, 6, utf8_decode($field_names['history']), 'LR', 1, 'L');
        $this->SetFont('Arial', 'B', 10);
//        $this->MultiCell(190,4,utf8_decode($data[0]['history']),'LRB',1,'L'); 
        $this->MultiCell(190, 4, utf8_decode(strip_tags($this->html_convert($data[0]['history']))), 'LBR', 1, 'L');

        $this->SetFont('Arial', '', 9);
        $this->Cell(190, 6, utf8_decode($field_names['clinical_picture']), 'LR', 1, 'L');
        $this->SetFont('Arial', 'B', 10);
//        $this->MultiCell(190,4,utf8_decode($data[0]['clinical_picture']),'LRB',1,'L'); 
        $this->MultiCell(190, 4, utf8_decode(strip_tags($this->html_convert($data[0]['clinical_picture']))), 'LBR', 1, 'L');

        $this->SetFont('Arial', '', 9);
        $this->Cell(190, 6, utf8_decode($field_names['medications']), 'LR', 1, 'L');
        if($data[0]['devolution'] != '')
            $this->Cell(190, 6, ($data[0]['devolution'] == 'ja' ? utf8_decode($this->smarty->translate['yes']) : $this->smarty->translate['no']), 'LBR', 1, 'L');
        $this->SetFont('Arial', 'B', 10);
//        $this->MultiCell(190,4,utf8_decode($data[0]['medications']),'LRB',1,'L'); 
        $this->MultiCell(190, 4, utf8_decode(strip_tags($this->html_convert($data[0]['medications']))), 'LBR', 1, 'L');

        $this->SetFont('Arial', '', 9);
        $this->Cell(190, 6, utf8_decode($field_names['special_diet']), 'LR', 1, 'L');
        $this->SetFont('Arial', 'B', 10);
//        $this->MultiCell(190,4,utf8_decode($data[0]['special_diet']),'LRB',1,'L'); 
        $this->MultiCell(190, 4, utf8_decode(strip_tags($this->html_convert($data[0]['special_diet']))), 'LBR', 1, 'L');

        $this->Ln(7);

        foreach ($new_work_details as $key => $value) {

            $this->SetFont('Arial', '', 9);
            $this->Cell(190, 6, utf8_decode($value['name']), 'LTR', 1, 'L');
            $this->SetFont('Arial', 'B', 10);
    //        $this->MultiCell(190,4,utf8_decode($data[0]['special_diet']),'LRB',1,'L'); 
            $this->MultiCell(190, 4, utf8_decode(strip_tags($this->html_convert($value['description']))), 'LBR', 1, 'L');
        }
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

    function html_convert($html){
        $converted = str_replace(array('<br>', '<br/>', '<br >', '<br />', '</p>', '</span>', '</li>', '</ul>', '</ol>', '</div>'), "\n", $html);
        $converted = str_replace('&nbsp;', " ", $converted);
        $converted = strip_tags($converted);
        return $converted;
    }

}

?>