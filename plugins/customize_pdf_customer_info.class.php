<?php

require_once('./plugins/F_pdf.class.php');
require_once('./plugins/fpdi/fpdi.php');

class PDF_Customer_info extends FPDI {

    var $smarty;
    function __construct() {

        parent::__construct();
        //$this->k=2;
        $this->SetFillColor(241, 241, 241);
        $this->SetTextColor(0, 50, 50);
        $this->smarty = new smartySetup(array("reports.xml", 'company.xml', "user.xml", "messages.xml", "button.xml","privilege.xml", "customer.xml", "tooltip.xml", 'month.xml'), FALSE);
    }
    
    function Header(){
        $this->AliasNbPages();
        $this->SetXY(10,1);
        $this->SetFont('Arial', '', 9);
        $this->Cell(195, 10, $this->PageNo() . ' ({nb})', 0, 0, 'R');
//        $this->Cell(190, 10, $this->PageNo(), 0, 0, 'R');
        $this->SetXY(10,15);
    }
    
    function report_header($company_details){
        global $preference;
        
        if($company_details['logo'] != ''){
            $this->Image($preference['url'].'company_logo/'.$company_details['logo'], 10, 10, 30);
//            $this->Ln();
        }
        
        $this->SetXY(10, 20);
        $this->SetFont('Arial', 'B', 24);
        $this->Cell(190, 6, utf8_decode($company_details['name']), 0, 1, 'R');
        $this->Ln(0.5);
        $this->SetFont('Arial', 'I', 9);
        $this->Cell(190, 6, utf8_decode($preference['app_version']), 0, 1, 'R');
            
        $this->SetXY(10, 40);
        $this->SetFont('Arial', 'B', 18);
        $this->Cell(190, 6, utf8_decode($this->smarty->translate['customer']), '', 1, 'C'); //'Information om Kund'
        $this->Ln(7);
    }

    function customer_personal_info($customer_details) {
//        $this->SetFillColor(255, 255, 255);

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(190, 6, utf8_decode($this->smarty->translate['personal_information']), 1, 1, 'L', TRUE);

        $this->SetFont('Arial', '', 9);
        $this->Cell(60, 4, utf8_decode($this->smarty->translate['social_security']), 'L', 0, 'L');
        $this->Cell(65, 4, utf8_decode($this->smarty->translate['code']), 'L', 0, 'L');
        $this->Cell(65, 4, utf8_decode($this->smarty->translate['username']), 'LR', 1, 'L');

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(60, 4, utf8_decode($customer_details['century'] . $customer_details['social_security']), 'BL', 0, 'L');
        $this->Cell(65, 4, utf8_decode($customer_details['code']), 'BL', 0, 'L');
        $this->Cell(65, 4, utf8_decode($customer_details['username']), 'LBR', 1, 'L');

        $this->SetFont('Arial', '', 9);
        $this->Cell(60, 4, utf8_decode($this->smarty->translate['first_name']), 'L', 0, 'L');
        $this->Cell(65, 4, utf8_decode($this->smarty->translate['last_name']), 'L', 0, 'L');
        $this->Cell(65, 4, utf8_decode($this->smarty->translate['address']), 'LR', 1, 'L');
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


        $this->SetFont('Arial', '', 9);
        $this->Cell(60, 6, utf8_decode($this->smarty->translate['gender']), 'L', 0, 'L');
        $this->Cell(130, 6, utf8_decode($this->smarty->translate['fk_kn']), 'LR', 1, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(60, 6, utf8_decode(($customer_details['gender'] == 1 ? $this->smarty->translate['male'] : ($customer_details['gender'] == 2 ? $this->smarty->translate['female'] : ''))), 'LB', 0, 'L');
        $this->Cell(130, 6, utf8_decode(($customer_details['fkkn'] == 1 ? 'FK' : ($customer_details['fkkn'] == 2 ? 'KN' : ''))), 'LBR', 1, 'L');
        $this->Ln(7);
    }

    function customer_relatives_info($customer_relatives) {
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(190, 6, utf8_decode($this->smarty->translate['relatives']), 1, 1, 'L', TRUE);

        if (!empty($customer_relatives)) {
            $total_relatives = count($customer_relatives);
            foreach ($customer_relatives as $key => $relative) {
                $this->SetFont('Arial', '', 9);
                $this->Cell(60, 4, utf8_decode($this->smarty->translate['name']), 'L', 0, 'L');
                $this->Cell(65, 4, utf8_decode($this->smarty->translate['relation']), 'L', 0, 'L');
                $this->Cell(65, 4, utf8_decode($this->smarty->translate['address']), 'LR', 1, 'L');
                $this->SetFont('Arial', 'B', 10);
                $this->Cell(60, 4, utf8_decode($relative['name']), 'BL', 0, 'L');
                $this->Cell(65, 4, utf8_decode($relative['relation']), 'BL', 0, 'L');
                $this->Cell(65, 4, utf8_decode($relative['address']), 'LRB', 1, 'L');

                $this->SetFont('Arial', '', 9);
                $this->Cell(60, 4, utf8_decode($this->smarty->translate['city']), 'L', 0, 'L');
                $this->Cell(65, 4, utf8_decode($this->smarty->translate['phone']), 'L', 0, 'L');
                $this->Cell(65, 4, utf8_decode($this->smarty->translate['phone_work']), 'LR', 1, 'L');
                $this->SetFont('Arial', 'B', 10);
                $this->Cell(60, 4, utf8_decode($relative['city']), 'BL', 0, 'L');
                $this->Cell(65, 4, utf8_decode($relative['phone']), 'BL', 0, 'L');
                $this->Cell(65, 4, utf8_decode($relative['work_phone']), 'LRB', 1, 'L');


                $this->SetFont('Arial', '', 9);
                $this->Cell(60, 6, utf8_decode($this->smarty->translate['mobile']), 'L', 0, 'L');
                $this->Cell(130, 6, utf8_decode($this->smarty->translate['email']), 'LR', 1, 'L');
                $this->SetFont('Arial', 'B', 10);
                $this->Cell(60, 4, utf8_decode($relative['mobile']), 'BL', 0, 'L');
                $this->Cell(130, 4, utf8_decode($relative['email']), 'BLR', 1, 'L');

                $this->SetFont('Arial', '', 9);
                $this->Cell(190, 6, utf8_decode($this->smarty->translate['other']), 'LR', 1, 'L');
                $this->SetFont('Arial', 'B', 10);
                $this->MultiCell(190, 4, utf8_decode($relative['other']), 'LRB', 1, FALSE);
                $this->Ln(0.5);
                if($key+1 != $total_relatives)
                    $this->Line(10, $this->GetY(), 200, $this->GetY());
            }
        } else {
            $this->SetFont('Arial', '', 10);
            $this->Cell(190, 7, utf8_decode($this->smarty->translate['no_relatives']), 1, 1, 'L');
        }
        $this->Ln(7);
    }

    function customer_additional_info($customer_additional) {
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(190, 6, utf8_decode($this->smarty->translate['additional_information']), 1, 1, 'L', TRUE);

        $this->SetFont('Arial', '', 9);
        $this->Cell(190, 6, utf8_decode($this->smarty->translate['health_care']), 'LR', 1, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->MultiCell(190, 4, utf8_decode($customer_additional['health_care']), 'LRB', 1);

        $this->SetFont('Arial', '', 9);
        $this->Cell(190, 6, utf8_decode($this->smarty->translate['occupational_therapists']), 'LR', 1, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->MultiCell(190, 4, utf8_decode($customer_additional['occupational_therapists']), 'LRB', 1);


        $this->SetFont('Arial', '', 9);
        $this->Cell(190, 6, utf8_decode($this->smarty->translate['physiotherapists']), 'LR', 1, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->MultiCell(190, 4, utf8_decode($customer_additional['physiotherapists']), 'LRB', 1);


        $this->SetFont('Arial', '', 9);
        $this->Cell(190, 6, utf8_decode($this->smarty->translate['other']), 'LR', 1, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->MultiCell(190, 4, utf8_decode($customer_additional['other']), 'LRB', 1);

        $this->Ln(7);
    }

    function customer_guardian_info($customer_guardian) {
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(190, 6, utf8_decode($this->smarty->translate['guardian']), 1, 1, 'L', TRUE);

        $this->SetFont('Arial', '', 9);
        $this->Cell(60, 4, utf8_decode($this->smarty->translate['first_name']), 'L', 0, 'L');
        $this->Cell(130, 4, utf8_decode($this->smarty->translate['last_name']), 'LR', 1, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(60, 4, utf8_decode($customer_guardian['first_name']), 'BL', 0, 'L');
        $this->Cell(130, 4, utf8_decode($customer_guardian['last_name']), 'BLR', 1, 'L');

        $this->SetFont('Arial', '', 9);
        $this->Cell(60, 4, utf8_decode($this->smarty->translate['mobile']), 'L', 0, 'L');
        $this->Cell(130, 4, utf8_decode($this->smarty->translate['email']), 'LR', 1, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(60, 4, utf8_decode($customer_guardian['mobile']), 'BL', 0, 'L');
        $this->Cell(130, 4, utf8_decode($customer_guardian['email']), 'BLR', 1, 'L');
        
        $this->SetFont('Arial', '', 9);
        $this->Cell(190, 6, utf8_decode($this->smarty->translate['address']), 'LR', 1, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->MultiCell(190, 4, utf8_decode($customer_guardian['address']), 'LRB', 1, FALSE);

        $this->Ln(7);
        
        //-----------------------------------------------------------
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(190, 6, utf8_decode($this->smarty->translate['guardian2']), 1, 1, 'L', TRUE);

        $this->SetFont('Arial', '', 9);
        $this->Cell(60, 4, utf8_decode($this->smarty->translate['first_name']), 'L', 0, 'L');
        $this->Cell(130, 4, utf8_decode($this->smarty->translate['last_name']), 'LR', 1, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(60, 4, utf8_decode($customer_guardian['first_name2']), 'BL', 0, 'L');
        $this->Cell(130, 4, utf8_decode($customer_guardian['last_name2']), 'BLR', 1, 'L');

        $this->SetFont('Arial', '', 9);
        $this->Cell(60, 4, utf8_decode($this->smarty->translate['mobile']), 'L', 0, 'L');
        $this->Cell(130, 4, utf8_decode($this->smarty->translate['email']), 'LR', 1, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(60, 4, utf8_decode($customer_guardian['mobile2']), 'BL', 0, 'L');
        $this->Cell(130, 4, utf8_decode($customer_guardian['email2']), 'BLR', 1, 'L');
        
        $this->SetFont('Arial', '', 9);
        $this->Cell(190, 6, utf8_decode($this->smarty->translate['address']), 'LR', 1, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->MultiCell(190, 4, utf8_decode($customer_guardian['address2']), 'LRB', 1, FALSE);

        $this->Ln(7);
    }
    
    function team_information($team_employees) {
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(190, 6, utf8_decode($this->smarty->translate['attached_assistants']), 1, 1, 'L', TRUE);

        $w = array(100, 45, 45);
        $col_h = 4;
        
        //draw table headings----------------------------------------------------------------------
        $this->SetFont('Arial', 'B', 9);
        $this->Cell($w[0], $col_h, utf8_decode($this->smarty->translate['name']), 'LB', 0, 'L');
        $this->Cell($w[1], $col_h, utf8_decode($this->smarty->translate['emp_code']), 'LB', 0, 'L');
        $this->Cell($w[2], $col_h, utf8_decode($this->smarty->translate['role']), 'LBR', 1, 'L');

        $this->SetFont('Arial', '', 9);
        if(!empty($team_employees)){
            foreach ($team_employees as $emp) {
                $tmp_role_name = NULL;
                if($emp['user_role'] == 1) $tmp_role_name = $this->smarty->translate['admin'];
                else if($emp['user_role'] == 5) $tmp_role_name = $this->smarty->translate['trainee'];
                else if($emp['user_role'] == 6) $tmp_role_name = $this->smarty->translate['economy'];
                else if($emp['user_role'] == 7 && $emp['stl'] == 1) $tmp_role_name = $this->smarty->translate['super_tl'];
                else if($emp['substitute'] == 1) $tmp_role_name = $this->smarty->translate['substitute'];
                else if($emp['tl'] == 1) $tmp_role_name = $this->smarty->translate['team_leader'];

                $this->Cell($w[0], $col_h, utf8_decode($emp['name_ff']), 'LB', 0, 'L');
                $this->Cell($w[1], $col_h, utf8_decode($emp['code']), 'LB', 0, 'L');
                $this->Cell($w[2], $col_h, utf8_decode($tmp_role_name), 'LBR', 1, 'L');
            }
        }
        
        $this->Ln(7);
    }

    function contract_info($customer_details) {
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(190, 6, utf8_decode($this->smarty->translate['working_hours_calculation']), 1, 1, 'L', TRUE);

        $month_name = NULL;
        switch($customer_details['employee_contract_start_month']){
            case 1 : $month_name = $this->smarty->translate['january']; break;
            case 2 : $month_name = $this->smarty->translate['february']; break;
            case 3 : $month_name = $this->smarty->translate['march']; break;
            case 4 : $month_name = $this->smarty->translate['april']; break;
            case 5 : $month_name = $this->smarty->translate['may']; break;
            case 6 : $month_name = $this->smarty->translate['june']; break;
            case 7 : $month_name = $this->smarty->translate['july']; break;
            case 8 : $month_name = $this->smarty->translate['august']; break;
            case 9 : $month_name = $this->smarty->translate['september']; break;
            case 10 : $month_name = $this->smarty->translate['october']; break;
            case 11 : $month_name = $this->smarty->translate['november']; break;
            case 12 : $month_name = $this->smarty->translate['december']; break;
        }
        
        $this->SetFont('Arial', '', 9);
        $this->Cell(95, 4, utf8_decode($this->smarty->translate['employee_contract_start_month']), 'L', 0, 'L');
        $this->Cell(95, 4, utf8_decode($this->smarty->translate['employee_contract_period_length']), 'LR', 1, 'L');

        $start_month_full = $month_name . ($month_name != '' && $customer_details['employee_contract_period_date'] != '' ? ' - ' : '') . $customer_details['employee_contract_period_date'];
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(95, 4, utf8_decode($start_month_full), 'BL', 0, 'L');
        $this->Cell(95, 4, utf8_decode($customer_details['employee_contract_period_length']), 'LBR', 1, 'L');

        $this->Ln(7);
    }
    

    function customer_order_info($contracts) {
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(190, 6, utf8_decode($this->smarty->translate['the_customers_order']), 1, 1, 'L', TRUE);

        $this->SetFont('Arial', 'B', 9);
        $this->Cell(25, 4, utf8_decode($this->smarty->translate['date_from']), 'LB', 0, 'L');
        $this->Cell(25, 4, utf8_decode($this->smarty->translate['date_to']), 'LB', 0, 'L');
        $this->Cell(30, 4, utf8_decode($this->smarty->translate['granded_hours']), 'LB', 0, 'L');
        $this->Cell(20, 4, utf8_decode($this->smarty->translate['fk_kn']), 'LB', 0, 'L');
        $this->Cell(45, 4, utf8_decode($this->smarty->translate['remaining_from_grant_hours']), 'LB', 0, 'L');
        $this->Cell(45, 4, utf8_decode($this->smarty->translate['exercised_call_hour']), 'LBR', 1, 'L');

        $this->SetFont('Arial', '', 9);
        foreach ($contracts as $contract) {
            $this->Cell(25, 4, utf8_decode($contract['date_from']), 'LB', 0, 'C');
            $this->Cell(25, 4, utf8_decode($contract['date_to']), 'LB', 0, 'C');
            $this->Cell(30, 4, utf8_decode($contract['hour']), 'LB', 0, 'C');
            $this->Cell(20, 4, utf8_decode($contract['fkkn']), 'LB', 0, 'C');
            $this->Cell(45, 4, utf8_decode($contract['remaining_hour']), 'LB', 0, 'C');
            $this->Cell(45, 4, utf8_decode($contract['oncall']), 'LBR', 1, 'C');
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
}
?>