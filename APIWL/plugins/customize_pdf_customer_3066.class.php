<?php

require_once('./plugins/F_pdf.class.php');
require_once('./plugins/fpdi/fpdi.php');

class PDF_Customer_3066 extends FPDI {

    var $smarty;
    function __construct() {

        parent::__construct();
        //$this->k=2;
        $this->SetFillColor(241, 241, 241);
        $this->SetTextColor(0, 50, 50);
//        $this->smarty = new smartySetup(array("reports.xml", 'company.xml', "user.xml", "messages.xml", "button.xml","privilege.xml", "customer.xml", "tooltip.xml", 'month.xml'), FALSE);
    }
    
    function Header(){
        /*$this->AliasNbPages();
        $this->SetXY(10,1);
        $this->SetFont('Arial', '', 9);
        $this->Cell(195, 10, $this->PageNo() . ' ({nb})', 0, 0, 'R');
//        $this->Cell(190, 10, $this->PageNo(), 0, 0, 'R');
        $this->SetXY(10,15);*/
    }
    
    function report_section_1($customer_detail){
        
        $this->SetFont('Arial', 'B', 9);
        $this->SetXY(13, 142);
        $this->Cell(10, 9, utf8_decode(($_SESSION['company_sort_by'] == 1 ? $customer_detail['first_name']. ' ' . $customer_detail['last_name'] : $customer_detail['last_name']. ' ' . $customer_detail['first_name'])), 0, 0, 'L');
        $this->SetX(148);
        $this->Cell(10, 9, utf8_decode($customer_detail['century'].$customer_detail['social_security']), 0, 1, 'L');
    }
    
    function report_section_2($employee_detail){
        
        $this->SetFont('Arial', 'B', 9);
        $this->SetXY(13, 165);
        $this->Cell(10, 9, utf8_decode(($_SESSION['company_sort_by'] == 1 ? $employee_detail['first_name']. ' ' . $employee_detail['last_name'] : $employee_detail['last_name']. ' ' . $employee_detail['first_name'])), 0, 0, 'L');
        $this->SetX(148);
        $this->Cell(10, 9, utf8_decode($employee_detail['century'].$employee_detail['social_security']), 0, 1, 'L');
        
        $this->SetXY(13, 175);
        $this->Cell(10, 9, utf8_decode($employee_detail['activation_date']), 0, 0, 'L');
        
        if($employee_detail['saved_data']['is_assi_have_pa'] == 2 || empty($employee_detail['saved_data'])){
            $top_corner_y = 176.5;
            $bottom_corner_y = $top_corner_y+4.1;
            $top_corner_x = 60.7;
            $bottom_corner_x = $top_corner_x+3.9;
            $this->Line($top_corner_x, $top_corner_y, $bottom_corner_x, $bottom_corner_y);
            $this->Line($top_corner_x, $bottom_corner_y, $bottom_corner_x, $top_corner_y);
        }
        else if($employee_detail['saved_data']['is_assi_have_pa'] == 1){
            $top_corner_y = 176.5;
            $bottom_corner_y = $top_corner_y+4.1;
            $top_corner_x = 83.3;
            $bottom_corner_x = $top_corner_x+3.9;
            $this->Line($top_corner_x, $top_corner_y, $bottom_corner_x, $bottom_corner_y);
            $this->Line($top_corner_x, $bottom_corner_y, $bottom_corner_x, $top_corner_y);
        }
        
        if($employee_detail['saved_data']['is_assi_resi_outside_ees'] == 2 || empty($employee_detail['saved_data'])){
            $top_corner_y = 188;
            $bottom_corner_y = $top_corner_y+4.1;
            $top_corner_x = 15.6;
            $bottom_corner_x = $top_corner_x+3.9;
            $this->Line($top_corner_x, $top_corner_y, $bottom_corner_x, $bottom_corner_y);
            $this->Line($top_corner_x, $bottom_corner_y, $bottom_corner_x, $top_corner_y);
        }
        else if($employee_detail['saved_data']['is_assi_resi_outside_ees'] == 1){
            $top_corner_y = 188;
            $bottom_corner_y = $top_corner_y+4.1;
            $top_corner_x = 38.3;
            $bottom_corner_x = $top_corner_x+3.9;
            $this->Line($top_corner_x, $top_corner_y, $bottom_corner_x, $bottom_corner_y);
            $this->Line($top_corner_x, $bottom_corner_y, $bottom_corner_x, $top_corner_y);
        }
        
        $this->SetXY(81, 188);
        $this->Cell(10, 9, utf8_decode($employee_detail['saved_data']['assi_resi_outside_ees']), 0, 0, 'L');
        
        $this->SetXY(13, 205);
        $this->Cell(10, 9, utf8_decode($employee_detail['saved_data']['changes_applies_from']), 0, 0, 'L');
    }
    
    function report_section_3($employee_detail, $company_detail){
        
        if($employee_detail['saved_data']['i_own_employer'] == 1){
            $top_corner_y = 28;
            $bottom_corner_y = $top_corner_y+4.1;
            $top_corner_x = 15.7;
            $bottom_corner_x = $top_corner_x+3.9;
            $this->Line($top_corner_x, $top_corner_y, $bottom_corner_x, $bottom_corner_y);
            $this->Line($top_corner_x, $bottom_corner_y, $bottom_corner_x, $top_corner_y);
        }
        
        if($employee_detail['saved_data']['hire_assi_provider'] == 1 || empty($employee_detail['saved_data'])){
            $top_corner_y = 37;
            $bottom_corner_y = $top_corner_y+4.1;
            $top_corner_x = 15.7;
            $bottom_corner_x = $top_corner_x+3.9;
            $this->Line($top_corner_x, $top_corner_y, $bottom_corner_x, $bottom_corner_y);
            $this->Line($top_corner_x, $bottom_corner_y, $bottom_corner_x, $top_corner_y);
        }

        $this->SetFont('Arial', 'B', 9);
        $this->SetXY(51, 37);
        $this->Cell(10, 9, utf8_decode($company_detail['name']), 0, 0, 'L');
        $this->SetX(148);
        $this->Cell(10, 9, utf8_decode($company_detail['org_no']), 0, 1, 'L');
        
        $this->SetXY(51, 46);
        $this->Cell(10, 9, utf8_decode((!empty($employee_detail['saved_data']) ? $employee_detail['saved_data']['company_cp_name'] : $company_detail['cp_name'])), 0, 0, 'L');
        $this->SetX(148);
        $this->Cell(10, 9, utf8_decode((!empty($employee_detail['saved_data']) ? $employee_detail['saved_data']['company_cp_phone'] : $company_detail['contact_number'])), 0, 1, 'L');
        
        if($employee_detail['saved_data']['is_organizer_employers_assi'] == 1 || empty($employee_detail['saved_data'])){
            $top_corner_y = 57.5;
            $bottom_corner_y = $top_corner_y+4.1;
            $top_corner_x = 53.3;
            $bottom_corner_x = $top_corner_x+3.9;
            $this->Line($top_corner_x, $top_corner_y, $bottom_corner_x, $bottom_corner_y);
            $this->Line($top_corner_x, $bottom_corner_y, $bottom_corner_x, $top_corner_y);
        }
        else if($employee_detail['saved_data']['is_organizer_employers_assi'] == 2){
            $top_corner_y = 71;
            $bottom_corner_y = $top_corner_y+4.1;
            $top_corner_x = 53.3;
            $bottom_corner_x = $top_corner_x+3.9;
            $this->Line($top_corner_x, $top_corner_y, $bottom_corner_x, $bottom_corner_y);
            $this->Line($top_corner_x, $bottom_corner_y, $bottom_corner_x, $top_corner_y);
            
            $this->SetXY(93, 71);
            $this->Cell(10, 9, utf8_decode($employee_detail['saved_data']['name_of_another_employer']), 0, 0, 'L');

            $this->SetX(148);
            $this->Cell(10, 9, utf8_decode($employee_detail['saved_data']['another_employer_org_no']), 0, 0, 'L');
        }
        else if($employee_detail['saved_data']['is_organizer_employers_assi'] == 3){
            $top_corner_y = 84.5;
            $bottom_corner_y = $top_corner_y+4.1;
            $top_corner_x = 53.3;
            $bottom_corner_x = $top_corner_x+3.9;
            $this->Line($top_corner_x, $top_corner_y, $bottom_corner_x, $bottom_corner_y);
            $this->Line($top_corner_x, $bottom_corner_y, $bottom_corner_x, $top_corner_y);
        }
    }

    function report_section_4($employee_detail) {
        
        $this->SetXY(13, 110);
        $this->Cell(10, 9, utf8_decode($employee_detail['saved_data']['signing_date']), 0, 0, 'L');

        $this->SetX(58);
        $this->Cell(10, 9, utf8_decode(($_SESSION['company_sort_by'] == 1 ? $employee_detail['saved_data']['se_fname']. ' ' . $employee_detail['saved_data']['se_lname'] : $employee_detail['saved_data']['se_lname']. ' ' . $employee_detail['saved_data']['se_fname'])), 0, 0, 'L');
        
        $this->SetX(148);
        $phone = '';
        if($employee_detail['saved_data']['se_phone']) {
            $phone = $employee_detail['saved_data']['se_phone'];
        } else if($employee_detail['saved_data']['se_mobile']) {
            $phone = $employee_detail['saved_data']['se_mobile'];
        } else if($employee_detail['saved_data']['company_cp_phone']) {
            $phone = $employee_detail['saved_data']['company_cp_phone'];
        }
        $this->Cell(10, 9, utf8_decode($phone), 0, 0, 'L');
    }

    function footer(){
        /*global $preference;
        
//        $this->Ln(5);
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 9);
        $this->Cell(190, 4, utf8_decode($this->smarty->translate['printed_on'].': '.date('Y-m-d H:i:s')), 0, 0, 'L');
        $this->setX(10);
        $this->Cell(190, 4, utf8_decode($this->smarty->translate['printed_by'].': '.$_SESSION['user_name']), 0, 1, 'R');
        $this->setX(10);
//        $this->Cell(190, 4, utf8_decode('time2view.se - Cirrus'), 0, 1, 'R');
        $this->Cell(190, 4, utf8_decode($preference['url']), 0, 1, 'R');*/
    }
}
?>