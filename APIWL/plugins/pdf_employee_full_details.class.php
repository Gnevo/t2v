<?php

require_once('./plugins/F_pdf.class.php');
require_once('./plugins/fpdi/fpdi.php');

//FPDF
class PDF_emp_full_details extends FPDI {

    var $emp_details = array();
    var $team_customers = array();
    var $smarty;
    
    function __construct() {

        parent::__construct();
        $this->smarty = new smartySetup(array("reports.xml", "user.xml", "messages.xml", "button.xml", "month.xml", "tooltip.xml", 'company.xml'), FALSE);
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
        
        $this->SetFillColor(255, 255, 255);
//        $this->SetFillColor(241, 241, 241);
        $this->SetTextColor(0, 50, 50);
        
        $this->SetXY(10, 20);
        $this->SetFont('Arial', 'B', 24);
        $this->Cell(190, 6, utf8_decode($company_details['name']), 0, 1, 'R');
        $this->Ln(0.5);
        $this->SetFont('Arial', 'I', 9);
        $this->Cell(190, 6, utf8_decode($preference['app_version']), 0, 1, 'R');
            
        $this->SetXY(10, 40);
        $this->SetFont('Arial', 'B', 18);
        $this->Cell(190, 6, utf8_decode($this->smarty->translate['employee_profile']), '', 1, 'C');
        $this->Ln();
    }
    
    function set_font_label(){
        $this->SetFont('Arial', '', 8);
    }
    
    function set_font_value(){
        $this->SetFont('Arial', 'B', 10);
    }
    
    function personal_information($emp_details) {

        $this->SetFillColor(241, 241, 241);
        $this->SetXY(10, $this->GetY() + 1);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(190, 6, utf8_decode($this->smarty->translate['personal_information']), 1, 1, 'L');
        $this->SetFillColor(255, 255, 255);
        
        $this->SetX(10);
        $this->set_font_label();
        $this->Cell(63.33, 4, utf8_decode($this->smarty->translate['social_security']), 'TLR', 0, 'L', FALSE);
        $this->Cell(63.33, 4, utf8_decode($this->smarty->translate['code']), 'TLR', 0, 'L', FALSE);
        $this->Cell(63.33, 4, utf8_decode($this->smarty->translate['color_code']), 'TLR', 1, 'L', FALSE);

        $this->set_font_value();
        $this->Cell(63.33, 6, utf8_decode($this->emp_details['century'].$this->emp_details['social_security']), 'BLR', 0, 'L', FALSE);
        $this->Cell(63.33, 6, utf8_decode($this->emp_details['code']), 'BLR', 0, 'L', FALSE);
        $this->SetFillColor($this->emp_details['color_params']['r'], $this->emp_details['color_params']['g'], $this->emp_details['color_params']['b']);
        $this->Cell(63.33, 6, '', 'BLR', 1, 'L', TRUE);
        $this->SetFillColor(255,255,255);
        //--------------------------------------
        
        $this->SetX(10);
        $this->set_font_label();
        $this->Cell(63.33, 4, utf8_decode($this->smarty->translate['first_name']), 'TLR', 0, 'L', FALSE);
        $this->Cell(63.33, 4, utf8_decode($this->smarty->translate['last_name']), 'TLR', 0, 'L', FALSE);
        $this->Cell(63.33, 4, utf8_decode($this->smarty->translate['gender']), 'TLR', 1, 'L', FALSE);

        $this->set_font_value();
        $this->Cell(63.33, 6, utf8_decode($this->emp_details['first_name']), 'BLR', 0, 'L', FALSE);
        $this->Cell(63.33, 6, utf8_decode($this->emp_details['last_name']), 'BLR', 0, 'L', FALSE);
        $this->Cell(63.33, 6, utf8_decode(($this->emp_details['gender'] == 1 ? $this->smarty->translate['male'] : ($this->emp_details['gender'] == 2 ? $this->smarty->translate['female'] : ''))), 'BLR', 1, 'L', FALSE);
        //--------------------------------------
        
        $this->SetX(10);
        $this->set_font_label();
        $this->Cell(190, 4, utf8_decode($this->smarty->translate['address']), 'TLR', 1, 'L', FALSE);

        $this->set_font_value();
        $this->Cell(190, 6, utf8_decode($this->emp_details['address']), 'BLR', 1, 'L', FALSE);
        //--------------------------------------
        
        $this->SetX(10);
        $this->set_font_label();
        $this->Cell(63.33, 4, utf8_decode($this->smarty->translate['post']), 'TLR', 0, 'L', FALSE);
        $this->Cell(63.33, 4, utf8_decode($this->smarty->translate['city']), 'TLR', 0, 'L', FALSE);
        $this->Cell(63.33, 4, utf8_decode($this->smarty->translate['care_off']), 'TLR', 1, 'L', FALSE);

        $this->set_font_value();
        $this->Cell(63.33, 6, utf8_decode($this->emp_details['post']), 'BLR', 0, 'L', FALSE);
        $this->Cell(63.33, 6, utf8_decode($this->emp_details['city']), 'BLR', 0, 'L', FALSE);
        $this->Cell(63.33, 6, utf8_decode($this->emp_details['care_of']), 'BLR', 1, 'L', FALSE);
        //--------------------------------------
        
        $this->SetX(10);
        $this->set_font_label();
        $this->Cell(63.33, 4, utf8_decode($this->smarty->translate['phone']), 'TLR', 0, 'L', FALSE);
        $this->Cell(63.33, 4, utf8_decode($this->smarty->translate['mobile']), 'TLR', 0, 'L', FALSE);
        $this->Cell(63.33, 4, utf8_decode($this->smarty->translate['email']), 'TLR', 1, 'L', FALSE);

        $this->set_font_value();
        $this->Cell(63.33, 6, utf8_decode($this->emp_details['phone']), 'BLR', 0, 'L', FALSE);
        $this->Cell(63.33, 6, utf8_decode($this->emp_details['mobile']), 'BLR', 0, 'L', FALSE);
        $this->Cell(63.33, 6, utf8_decode($this->emp_details['email']), 'BLR', 1, 'L', FALSE);
        //--------------------------------------
        
        $this->SetX(10);
        $this->set_font_label();
        $this->Cell(95, 4, utf8_decode($this->smarty->translate['date']), 'TLR', 0, 'L', FALSE);
        $this->Cell(95, 4, utf8_decode($this->smarty->translate['date_inactive']), 'TLR', 1, 'L', FALSE);

        $this->set_font_value();
        $this->Cell(95, 6, utf8_decode($this->emp_details['date']), 'BLR', 0, 'L', FALSE);
        $this->Cell(95, 6, utf8_decode($this->emp_details['date_inactive']), 'BLR', 1, 'L', FALSE);
        //--------------------------------------
        
        $start_day_name = NULL;
        switch($this->emp_details['start_day_val']){
            case 1 : $start_day_name = $this->smarty->translate['monday']; break;
            case 2 : $start_day_name = $this->smarty->translate['tuesday']; break;
            case 3 : $start_day_name = $this->smarty->translate['wednesday']; break;
            case 4 : $start_day_name = $this->smarty->translate['thursday']; break;
            case 5 : $start_day_name = $this->smarty->translate['friday']; break;
            case 6 : $start_day_name = $this->smarty->translate['saturday']; break;
            case 7 : $start_day_name = $this->smarty->translate['sunday']; break;
        }
        $this->SetX(10);
        $this->set_font_label();
        $this->Cell(95, 4, utf8_decode($this->smarty->translate['start_day']), 'TLR', 0, 'L', FALSE);
        $this->Cell(95, 4, utf8_decode($this->smarty->translate['start_time']), 'TLR', 1, 'L', FALSE);

        $this->set_font_value();
        $this->Cell(95, 6, utf8_decode($start_day_name), 'BLR', 0, 'L', FALSE);
        $this->Cell(95, 6, utf8_decode($this->emp_details['start_time_val']), 'BLR', 1, 'L', FALSE);

        $this->Ln(7);
    }
    
    function account_information() {
        $this->SetFillColor(241, 241, 241);
        $this->SetX(10);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(190, 6, utf8_decode($this->smarty->translate['account_information']), 1, 1, 'L', TRUE);
        
        $user_role_name = NULL;
        switch($this->emp_details['user_role']){
            case 1 : $user_role_name = $this->smarty->translate['admin']; break;
            case 2 : $user_role_name = $this->smarty->translate['tl']; break;
            case 3 : $user_role_name = $this->smarty->translate['employee']; break;
            case 6 : $user_role_name = $this->smarty->translate['economy']; break;
            case 7 : $user_role_name = $this->smarty->translate['super_tl']; break;
        }
        
        $this->SetX(10);
        $this->set_font_label();
        $this->Cell(63.33, 4, utf8_decode($this->smarty->translate['username']), 'TLR', 0, 'L', FALSE);
        $this->Cell(63.33, 4, utf8_decode($this->smarty->translate['role']), 'TLR', 0, 'L', FALSE);
        $this->Cell(63.33, 4, utf8_decode($this->smarty->translate['status']), 'TLR', 1, 'L', FALSE);

        $this->set_font_value();
        $this->Cell(63.33, 6, utf8_decode($this->emp_details['username']), 'BLR', 0, 'L', FALSE);
        $this->Cell(63.33, 6, utf8_decode($user_role_name), 'BLR', 0, 'L', FALSE);
        $this->Cell(63.33, 6, utf8_decode($this->emp_details['status'] == 1 ? $this->smarty->translate['active'] : $this->smarty->translate['inactive']), 'BLR', 1, 'L', FALSE);
        //--------------------------------------
        
        $this->SetX(10);
        $this->set_font_label();
        $this->Cell(63.33, 4, utf8_decode($this->smarty->translate['substitute']), 'TLR', 0, 'L', FALSE);
        $this->Cell(126.66, 4, utf8_decode($this->smarty->translate['use_inconvenient']), 'TLR', 1, 'L', FALSE);

        $this->set_font_value();
        $this->Cell(63.33, 6, utf8_decode($this->emp_details['substitute'] != 1 ? $this->smarty->translate['off'] : $this->smarty->translate['on']), 'BLR', 0, 'L', FALSE);
        $this->Cell(126.66, 6, utf8_decode($this->emp_details['inconvenient_on'] == 1 || $this->emp_details['inconvenient_on'] == '' ? $this->smarty->translate['on'] : $this->smarty->translate['off']), 'BLR', 1, 'L', FALSE);
        //--------------------------------------
        
        $this->Ln(7);
    }
    
    function other_information() {

        $this->SetX(10);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(190, 6, utf8_decode($this->smarty->translate['other_employee_information']), 1, 1, 'L', TRUE);
        
        $this->SetX(10);
        $this->set_font_label();
        $this->Cell(63.33, 4, utf8_decode($this->smarty->translate['employee_max_hours']), 'TLR', 0, 'L', FALSE);
        $this->Cell(63.33, 4, utf8_decode($this->smarty->translate['remaining_sem_leave']), 'TLR', 0, 'L', FALSE);
        $this->Cell(63.33, 4, utf8_decode($this->smarty->translate['sem_leave_todate']), 'TLR', 1, 'L', FALSE);

        $this->set_font_value();
        $this->Cell(63.33, 6, utf8_decode($this->emp_details['max_hours'] > 0 ? $this->emp_details['max_hours'] : ''), 'BLR', 0, 'L', FALSE);
        $this->Cell(63.33, 6, utf8_decode($this->emp_details['remaining_sem_leave']), 'BLR', 0, 'L', FALSE);
        $this->Cell(63.33, 6, utf8_decode($this->emp_details['sem_leave_todate'] != '0000-00-00' ? $this->emp_details['sem_leave_todate'] : ''), 'BLR', 1, 'L', FALSE);
        //--------------------------------------
        
        $salary_type_name = NULL;
        switch($this->emp_details['salary_type']){
            case 1 : $salary_type_name = $this->smarty->translate['employee_salary_hour_saving_holiday']; break;
            case 2 : $salary_type_name = $this->smarty->translate['employee_salary_hour_paid_vacation']; break;
            case 3 : $salary_type_name = $this->smarty->translate['employee_salary_monthly']; break;
            case 4 : $salary_type_name = $this->smarty->translate['employee_salary_monthly_office']; break;
            case 5 : $salary_type_name = $this->smarty->translate['employee_salary_hour_office']; break;
        }
        
        $this->SetX(10);
        $this->set_font_label();
        $this->Cell(63.33, 4, utf8_decode($this->smarty->translate['leave_in_advance']), 'TLR', 0, 'L', FALSE);
        $this->Cell(63.33, 4, utf8_decode($this->smarty->translate['office_personal']), 'TLR', 0, 'L', FALSE);
        $this->Cell(63.33, 4, utf8_decode($this->smarty->translate['employee_salary_type']), 'TLR', 1, 'L', FALSE);

        $this->set_font_value();
        $this->Cell(63.33, 6, utf8_decode($this->emp_details['leave_in_advance'] == 1 ? $this->smarty->translate['on'] : ''), 'BLR', 0, 'L', FALSE);
        $this->Cell(63.33, 6, utf8_decode($this->emp_details['office_personal'] == 1 ? $this->smarty->translate['on'] : ''), 'BLR', 0, 'L', FALSE);
        $this->Cell(63.33, 6, utf8_decode($salary_type_name), 'BLR', 1, 'L', FALSE);
        //--------------------------------------
        
        $this->SetX(10);
        $y_top = $this->GetY();
        $this->set_font_label();
        $this->Cell(190, 4, utf8_decode($this->smarty->translate['ice']), 'TLR', 1, 'L', FALSE);
        
        $this->set_font_value();
        $this->SetXY(10, $this->GetY()+1);
        $this->MultiCell(190, 5, utf8_decode($this->emp_details['ice']));
        $this->Rect(10, $y_top, 190, $this->y - $y_top + 3);
        //--------------------------------------
        
        $this->Ln(9);
    }

    function contract_info() {
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(190, 6, utf8_decode($this->smarty->translate['working_hours_calculation']), 1, 1, 'L', TRUE);

        $month_name = NULL;
        switch($this->emp_details['employee_contract_start_month']){
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

        $start_month_full = $month_name . ($month_name != '' && $this->emp_details['employee_contract_period_date'] != '' ? ' - ' : '') . $this->emp_details['employee_contract_period_date'];
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(95, 4, utf8_decode($start_month_full), 'BL', 0, 'L');
        $this->Cell(95, 4, utf8_decode($this->emp_details['employee_contract_period_length']), 'LBR', 1, 'L');

        $this->Ln(7);
    }
    
    function export_information() {

        $this->SetX(10);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(190, 6, utf8_decode($this->smarty->translate['export_information']), 1, 1, 'L', TRUE);
        
        $this->SetX(10);
        $this->set_font_label();
        $this->Cell(38, 4, utf8_decode($this->smarty->translate['SEM_in_days']), 'TLR', 0, 'L', FALSE);
        $this->Cell(38, 4, utf8_decode($this->smarty->translate['VAB_in_days']), 'TLR', 0, 'L', FALSE);
        $this->Cell(38, 4, utf8_decode($this->smarty->translate['FP_in_days']), 'TLR', 0, 'L', FALSE);
        $this->Cell(38, 4, utf8_decode($this->smarty->translate['NOPAY_in_days']), 'TLR', 0, 'L', FALSE);
        $this->Cell(38, 4, utf8_decode($this->smarty->translate['OTHER_in_days']), 'TLR', 1, 'L', FALSE);

        $this->set_font_value();
        $this->Cell(38, 6, utf8_decode($this->emp_details['sem_leave_days'] != 1 ? $this->smarty->translate['off'] : $this->smarty->translate['on']), 'BLR', 0, 'L', FALSE);
        $this->Cell(38, 6, utf8_decode($this->emp_details['vab_leave_days'] != 1 ? $this->smarty->translate['off'] : $this->smarty->translate['on']), 'BLR', 0, 'L', FALSE);
        $this->Cell(38, 6, utf8_decode($this->emp_details['fp_leave_days'] != 1 ? $this->smarty->translate['off'] : $this->smarty->translate['on']), 'BLR', 0, 'L', FALSE);
        $this->Cell(38, 6, utf8_decode($this->emp_details['nopay_leave_days'] != 1 ? $this->smarty->translate['off'] : $this->smarty->translate['on']), 'BLR', 0, 'L', FALSE);
        $this->Cell(38, 6, utf8_decode($this->emp_details['other_leave_days'] != 1 ? $this->smarty->translate['off'] : $this->smarty->translate['on']), 'BLR', 1, 'L', FALSE);
        //--------------------------------------
        
        $this->Ln(7);
    }

    function team_information() {
        $this->SetX(10);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(190, 6, utf8_decode($this->smarty->translate['attached_customers']), 1, 1, 'L', TRUE);

        $w = array(100, 45, 45);
        $col_h = 6.72;
        $dark_line_width = 0.7;
        //draw table headings----------------------------------------------------------------------
//        $this->SetLineWidth($dark_line_width);
        $this->Cell($w[0], $col_h, $this->smarty->translate['name'], 1, 0, 'L', FALSE);   //table cell 1
        $this->Cell($w[1], $col_h, $this->smarty->translate['cust_code'], 1, 0, 'L', FALSE);   //table cell 2
        $this->Cell($w[2], $col_h, $this->smarty->translate['role'], 1, 1, 'L', FALSE);   //table cell 3

//        $this->set_font_value();
        $this->SetFont('Arial', '', 9);
//        $this->SetLineWidth(0);
        $members_count = count($this->team_customers);
        for ($i = 0; $i < $members_count; $i++) {
            
            $tmp_role_name = NULL;
            switch($this->team_customers[$i]['role']){
                case 2 : $tmp_role_name = $this->smarty->translate['tl']; break;
                case 3 : $tmp_role_name = $this->smarty->translate['employee']; break;
                case 7 : $tmp_role_name = $this->smarty->translate['super_tl']; break;
            }

            $this->SetX(10);
            $this->Cell($w[0], $col_h, utf8_decode($this->team_customers[$i]['first_name'].' '.$this->team_customers[$i]['last_name']), 1, 0, 'L', FALSE);   //table cell 1
            $this->Cell($w[1], $col_h, utf8_decode($this->team_customers[$i]['code']), 1, 0, 'L', FALSE);   //table cell 2
            $this->Cell($w[2], $col_h, utf8_decode($tmp_role_name), 1, 1, 'L', FALSE);   //table cell 3
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