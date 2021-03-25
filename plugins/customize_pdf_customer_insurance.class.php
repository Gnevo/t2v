<?php

require_once('./plugins/F_pdf.class.php');
require_once('./plugins/fpdi/fpdi.php');

class PDF_Customer_insurance extends FPDI {

    var $smarty;
    var $no_of_days = NULL;
    var $monthly_hrs = NULL;
    var $weekly_hrs = NULL;
    var $remaining_hrs = NULL;
    var $hrs = NULL;
    function __construct() {

        parent::__construct();
        //$this->k=2;
        $this->smarty = new smartySetup(array("reports.xml", "user.xml", "messages.xml", "button.xml", "billing.xml","privilege.xml"), FALSE);
    }
    
    function Header(){
        $this->AliasNbPages();
        $this->SetXY(10,1);
        $this->SetFont('Arial', '', 9);
        $this->Cell(195, 10, $this->PageNo() . ' ({nb})', 0, 0, 'R');
        $this->SetXY(10,15);
    }
    
    function report_header($company_details, $fkkn){
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
        $rpt_title = $this->smarty->translate['insurance'];
        switch ($fkkn){
            case 'kn': $rpt_title = $this->smarty->translate['municipality'];break;
            case 'te': $rpt_title = $this->smarty->translate['insurance_te'];break;
            case 'fk': 
            default : 
                $rpt_title = $this->smarty->translate['insurance'];break;
        }
        $this->Cell(190, 6, utf8_decode($rpt_title), '', 1, 'C');
        $this->Ln(7);
        
        //
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

    function customer_admin_decision($ful_details_contract, $fkkn) {
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(60, 6, utf8_decode($this->smarty->translate['administrator_decision']), 'LTB', 0, 'L');
        $this->Cell(65, 6, '', 'TB', 0, 'L');
        $this->Cell(65, 6, '', 'TRB', 1, 'L');

        $this->SetFont('Arial', '', 9);
        $this->Cell(60, 4, utf8_decode($this->smarty->translate['first_name']), 'L', 0, 'L');
        $this->Cell(65, 4, utf8_decode($this->smarty->translate['last_name']), 'L', 0, 'L');
        $this->Cell(65, 4, utf8_decode($this->smarty->translate['mobile']), 'LR', 1, 'L');

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(60, 4, utf8_decode($ful_details_contract[0]['first']), 'BL', 0, 'L');
        $this->Cell(65, 4, utf8_decode($ful_details_contract[0]['last']), 'BL', 0, 'L');
        $this->Cell(65, 4, utf8_decode($ful_details_contract[0]['mob']), 'LBR', 1, 'L');

        $this->SetFont('Arial', '', 9);
        $this->Cell(60, 4, utf8_decode($this->smarty->translate['email']), 'L', 0, 'L');
        $this->Cell(65, 4, utf8_decode($this->smarty->translate['location']), 'L', 0, 'L');
        $this->Cell(65, 4, utf8_decode($this->smarty->translate['granded_hours']), 'LR', 1, 'L');

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(60, 4, utf8_decode($ful_details_contract[0]['mail']), 'BL', 0, 'L');
        $this->Cell(65, 4, utf8_decode($ful_details_contract[0]['cities']), 'BL', 0, 'L');
        $this->Cell(65, 4, utf8_decode($ful_details_contract[0]['hour']), 'LBR', 1, 'L');

        $this->SetFont('Arial', '', 9);
        $this->Cell(60, 4, utf8_decode($this->smarty->translate['date_from']), 'L', 0, 'L');
        $this->Cell(130, 4, utf8_decode($this->smarty->translate['date_to']), 'LR', 1, 'L');

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(60, 4, utf8_decode($ful_details_contract[0]['date_from']), 'BL', 0, 'L');
        $this->Cell(130, 4, utf8_decode($ful_details_contract[0]['date_to']), 'BRL', 1, 'L');

        $this->Ln(7);
        
        //------------------- Handläggare räkning---------------------------
        
        $block_title = NULL;
        switch ($fkkn){
            case 'kn': 
            case 'te': $block_title = $this->smarty->translate['kn_form_administrator_behalf'];break;
            case 'fk': 
            default :
                $block_title = $this->smarty->translate['administrator_behalf'];break;
        }
        
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(190, 6, utf8_decode($block_title), 1, 1, 'L');

        
        if($fkkn == 'fk'){
            $this->SetFont('Arial', '', 9);
            $this->Cell(60, 4, utf8_decode($this->smarty->translate['first_name']), 'L', 0, 'L');
            $this->Cell(65, 4, utf8_decode($this->smarty->translate['last_name']), 'L', 0, 'L');
            $this->Cell(65, 4, utf8_decode($this->smarty->translate['mobile']), 'LR', 1, 'L');

            $this->SetFont('Arial', 'B', 10);
            $this->Cell(60, 4, utf8_decode($ful_details_contract[0]['first_name']), 'BL', 0, 'L');
            $this->Cell(65, 4, utf8_decode($ful_details_contract[0]['last_name']), 'BL', 0, 'L');
            $this->Cell(65, 4, utf8_decode($ful_details_contract[0]['mobile']), 'LBR', 1, 'L');

            $this->SetFont('Arial', '', 9);
            $this->Cell(60, 4, utf8_decode($this->smarty->translate['email']), 'L', 0, 'L');
            $this->Cell(130, 4, utf8_decode($this->smarty->translate['location']), 'LR', 1, 'L');

            $this->SetFont('Arial', 'B', 10);
            $this->Cell(60, 4, utf8_decode($ful_details_contract[0]['email']), 'BL', 0, 'L');
            $this->Cell(130, 4, utf8_decode($ful_details_contract[0]['city']), 'BRL', 1, 'L');
        }
        else if($fkkn == 'kn' || $fkkn == 'te'){
            $this->SetFont('Arial', '', 9);
            $this->Cell(60, 4, utf8_decode($this->smarty->translate['kn_form_name']), 'L', 0, 'L');
            $this->Cell(65, 4, utf8_decode($this->smarty->translate['kn_form_reference_no']), 'L', 0, 'L');
            $this->Cell(65, 4, utf8_decode($this->smarty->translate['kn_box']), 'LR', 1, 'L');

            $this->SetFont('Arial', 'B', 10);
            $this->Cell(60, 4, utf8_decode($ful_details_contract[0]['kn_name']), 'BL', 0, 'L');
            $this->Cell(65, 4, utf8_decode($ful_details_contract[0]['kn_reference_no']), 'BL', 0, 'L');
            $this->Cell(65, 4, utf8_decode($ful_details_contract[0]['kn_box']), 'LBR', 1, 'L');

            $this->SetFont('Arial', '', 9);
            $this->Cell(60, 4, utf8_decode($this->smarty->translate['kn_form_address']), 'L', 0, 'L');
            $this->Cell(65, 4, utf8_decode($this->smarty->translate['kn_form_postno']), 'L', 0, 'L');
            $this->Cell(65, 4, utf8_decode($this->smarty->translate['kn_form_city']), 'LR', 1, 'L');

            $this->SetFont('Arial', 'B', 10);
            $this->Cell(60, 4, utf8_decode($ful_details_contract[0]['kn_address']), 'BL', 0, 'L');
            $this->Cell(65, 4, utf8_decode($ful_details_contract[0]['kn_postno']), 'BL', 0, 'L');
            $this->Cell(65, 4, utf8_decode($ful_details_contract[0]['city']), 'LBR', 1, 'L');
        }

        $this->SetFont('Arial', '', 9);
        $this->Cell(190, 4, utf8_decode($this->smarty->translate['night']), 'LR', 1, 'L');
        
        $this->SetFont('Arial', 'B', 10);
        $text = "";
        if ($ful_details_contract[0]['oncall'] == "1")
            $text .= '  '.  $this->smarty->translate['emergency'];

        if ($ful_details_contract[0]['awake'] == "1")
            $text .= ' '.  $this->smarty->translate['alert'];

        if ($ful_details_contract[0]['oncall2'] == "1")
            $text .= ' '.  $this->smarty->translate['preparedness'];

        if ($ful_details_contract[0]['something'] == "1")
            $text .= ' '.  $this->smarty->translate['other'];

        $this->Cell(190, 4, utf8_decode($text), 'LBR', 1, 'L');

        //------------------- Contract values---------------------------
        $this->Ln(7);
        
        $this->SetFont('Arial', '', 9);
        $this->Cell(38, 4, utf8_decode($this->smarty->translate['days']), 'LT', 0, 'L');
        $this->Cell(38, 4, utf8_decode($this->smarty->translate['monthly']), 'LT', 0, 'L');
        $this->Cell(38, 4, utf8_decode($this->smarty->translate['weekly']), 'LT', 0, 'L');
        $this->Cell(38, 4, utf8_decode($this->smarty->translate['granded_hours']), 'LT', 0, 'L');
        $this->Cell(38, 4, utf8_decode($this->smarty->translate['remaining_hours']), 'LTR', 1, 'L');

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(38, 4, $this->no_of_days, 'BL', 0, 'L');
        $this->Cell(38, 4, $this->monthly_hrs, 'BL', 0, 'L');
        $this->Cell(38, 4, $this->weekly_hrs, 'LB', 0, 'L');
        $this->Cell(38, 4, $this->hrs, 'BL', 0, 'L');
        $this->Cell(38, 4, $this->remaining_hrs, 'BRL', 1, 'L');
        
        //------------------------------- comment block---------------------------
        $this->Ln(7);

        $this->SetFont('Arial', '', 9);
        $this->Cell(190, 6, utf8_decode($this->smarty->translate['comment_decision_hour']), 'LTR', 1, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->MultiCell(190, 4, utf8_decode($ful_details_contract[0]['comments_time']), 'LRB', 1, 'L');

        $this->SetFont('Arial', '', 9);
        $this->Cell(190, 6, utf8_decode($this->smarty->translate['comment_decision_management_others']), 'LR', 1, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->MultiCell(190, 4, utf8_decode($ful_details_contract[0]['comments_other']), 'LRB', 1, 'L');
        
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