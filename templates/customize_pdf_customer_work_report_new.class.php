<?php
/**
* Author: Shamsudheen <shamsu@arioninfotech.com>
* for: FKKN customer work report
*/

require_once('./plugins/F_pdf.class.php');
require_once('./plugins/fpdi/fpdi.php');
require_once('./class/general.php');

class PDF_customer extends FPDI {
    
    var $summery_data = array();
    var $tot_normal = 0;
    var $tot_oncall = 0;
    var $tot_beredskap = 0;
    CONST PDF_TPL_VERSION = 'FK3059_015_F_001';
    var $obj_general = NULL;
//    var $current_customer_employee_total_normal_hours = 0;  //this variable used for section 7 (now not used)
//    var $current_customer_employee_total_oncall_hours = 0;  //this variable used for section 7 (now not used)
    
    function __construct() {
        parent::__construct();
        $this->SetAuthor('Shamsudheen');
        $this->SetCreator('Shamsudheen');
        $this->SetTitle('FK/KN/TU Report');
        $this->SetAutoPageBreak(FALSE);
        
        $this->obj_general = new general();
    }

    function report_top($month, $year, $fkkn, $kn_headings = array(), $company_data = array()) {
        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0, 50, 50);
        
       // $this->SetFont('Times', '', 11);
       // $this->SetXY(13, 23);
       // $this->Cell(45, 4, utf8_decode('www.forsakringskassan.se'), 0, 1, 'L', FALSE);    //Company Name
            
        
        if(!empty($kn_headings) && ($fkkn == 2 || $fkkn == 3)){
            $this->SetXY(10, 8);
            $this->Cell(70, 30, '', 0, 0, 'L', TRUE);      // hide backround header image
            
            $this->SetFont('Times', 'B', 16);
            $this->SetXY(13, 11);
            $this->Cell(10, 8, utf8_decode($company_data['name']), 0, 1, 'L', FALSE);    //Company Name
            $this->SetFont('Times', 'B', 10);
            if($company_data['box'] != ''){
                $this->SetX(13);
                $this->Cell(10, 6, utf8_decode($company_data['box']), 0, 1, 'L', FALSE);    //Company box number
            }
            $this->SetX(13);
            $this->Cell(10, 6, utf8_decode($company_data['zipcode'] . ' ' . $company_data['city']), 0, 1, 'L', FALSE);    //Company zipcode and city
            $this->SetX(13);
            $comp_phone = (trim($company_data['phone']) != '' ? trim($company_data['phone']) : trim($company_data['mobile']));
            $this->Cell(10, 5, utf8_decode($comp_phone), 0, 1, 'L', FALSE);    //company mobile/phone
            
            
            
            $this->SetXY(105, 33);
            $this->Cell(70, 15, '', 0, 0, 'L', TRUE);      // hide backround information (below the year-month)
            $this->SetFont('Times', 'B', 10);
            $this->SetXY(111, 33);
            $this->Cell(10, 7, utf8_decode($kn_headings['kn_name']), 0, 1, 'L', FALSE);    //Name
            
            if(trim($kn_headings['kn_box']) != ''){
                $this->SetX(111);
                $this->Cell(10, 5, utf8_decode('Box '.$kn_headings['kn_box']), 0, 1, 'L', FALSE);    //PO box
            }else if(trim($kn_headings['kn_address']) != ''){
                $this->SetX(111);
                $this->Cell(10, 5, utf8_decode($kn_headings['kn_address']), 0, 1, 'L', FALSE);    //PO box
            }
            if(trim($kn_headings['kn_reference_no']) != ''){
                $this->SetX(111);
                $this->Cell(10, 5, utf8_decode('Ref nr '.$kn_headings['kn_reference_no']), 0, 1, 'L', FALSE);    //Reference number
            }
            
            $zip_n_city = trim($kn_headings['kn_postno']);
            $zip_n_city = ($zip_n_city != '' ? substr($zip_n_city, 0, 3) .' '.  substr($zip_n_city, 3) : '');
            $zip_n_city .= ($zip_n_city != '' ?  ' '.$kn_headings['city'] : $kn_headings['city']);
            if(trim($zip_n_city) != ''){
                $this->SetX(111);
                $this->Cell(10, 5, utf8_decode($zip_n_city), 0, 1, 'L', FALSE);    //zip city
            }
        }
        
        /*$this->SetX(10);
        if ($fkkn == 1) {
            $this->Image('./images/fk2.gif', 11, $this->GetY(), 8, 8);
            $this->SetXY(19, $this->GetY() + 2);
            $this->SetFont('Times', 'B', 14);
            $this->Cell(10, 9, utf8_decode('Försäkringskassan'), 0, 0, 'L', FALSE);    //emblem
        } else {
            $this->SetFont('Times', '', 14);
            $this->Cell(10, 9, utf8_decode('Kommun'), 0, 0, 'L', FALSE);    //emblem
            $this->SetY($this->GetY() + 2);
        }

        if ($fkkn == 1) {
            $this->SetFont('Times', '', 8);
            $this->SetXY(10, 17);
            $this->Cell(10, 9, '0771-524 524', 0, 0, 'L', FALSE);      // phone number
            $this->SetXY(10, $this->GetY() + 2.8);
            $this->Cell(10, 9, 'www.forsakringskassan.se', 0, 0, 'L', FALSE);    //site
        } else {
            $this->SetY(19.8);
        }*/

        $this->SetFont('Times', 'B', 12);
        $this->SetXY(110, 22);
        $this->Cell(29, 7, $year . ' - ' . sprintf("%02d",$month), 0, 0, 'L', FALSE);      // month and year figure
        /*$this->SetFont('Arial', 'B', 9);
        $this->SetXY(-40, $this->GetY());
        $this->Ln(7);
        if ($fkkn == 1) {
            $this->SetFont('Arial', '', 9);
            $this->SetXY(10, $this->GetY() + 1);
            $this->Cell(10, 9, utf8_decode('Skicka tidsredovisningen i original tillsammans'), 0, 0, 'L', FALSE);      // --------------
            $this->SetXY(10, $this->GetY() + 4);
            $this->Cell(10, 9, utf8_decode('med Räkning Assistansersättning (3057) '), 0, 0, 'L', FALSE);    //-------------------

            $this->SetFont('Arial', '', 9);
            $this->SetXY(105, $this->GetY() - 3);
            $this->Cell(10, 9, utf8_decode('Skicka blanketten till '), 0, 0, 'L', FALSE);      // --------------
            $this->SetFont('Arial', '', 9);
            $this->SetXY(105, $this->GetY() + 4);
            $this->Cell(10, 9, utf8_decode('Försäkringskassan inläsningscentral '), 0, 0, 'L', FALSE);    //-------------------
            $this->SetXY(105, $this->GetY() + 4);
            $this->Cell(10, 9, utf8_decode('839 88 Östersund '), 0, 0, 'L', FALSE);    //-------------------
        } else {
            $this->SetY($this->GetY() + 10);
        }*/
    }

    function SubPart1($cust_details) {
        $this->SetFont('Arial', 'B', 9);
        $this->SetXY(21, 64);
        $this->Cell(10, 9, utf8_decode($cust_details[0]['fullname']), 0, 0, 'L', FALSE);    //Customer full name
        $this->SetX(144);
        $this->Cell(10, 9, $cust_details[0]['century'] . $this->format_SSN($cust_details[0]['social_security']), 0, 0, 'L', FALSE);    // Personal number

       // $this->Ln(14);
    }

    function SubPart2($emp_details) {
        $this->SetFont('Arial', 'B', 9);
        $this->SetXY(21, 97);
        $this->Cell(10, 9, utf8_decode($emp_details[0]['fullname']), 0, 0, 'L', FALSE);    //Employee Full Name
        $this->SetX(144);
        $this->Cell(10, 9, $emp_details[0]['century'] . $this->format_SSN($emp_details[0]['social_security']), 0, 0, 'L', FALSE);    // personel number
        
    }
    
    function SubPart3($this_bargaining) {
        if($this_bargaining == 1){
            $this->make_check_enabled(23, 116.2);
        }else if($this_bargaining == 2){
            $this->make_check_enabled(43.6, 116.2);
        }
    }

    function SubPart7_table($work_details) {
        $obj_equipment = new equipment();
        $w = array(7.6, 30, 17.5, 17.5, 17.5);
        $col_h = 8.27;
        $init_y = 34.1;
        $this->SetY($init_y);
        $this->SetFont('Arial', 'B', 9);
        $total_Tid = 0;
        $toal_Jourtid = 0;
        $toal_beredskap = 0;
        $total_content_rows = count($work_details);
       // echo "<pre>".print_r($work_details, 1)."</pre>";
        
        /*$last_count = 5;
        $work_details[0]['type'] = 15;
        for ($i = 0; $i < 35; $i++) {
            $work_details[$last_count+$i] = $work_details[0];
        }
        $total_content_rows = count($work_details);*/
        
        for ($i = 0; $i < 40; $i++) {
            if ($i > 19){
                $this->SetX(105);
                $position = 'RIGHT';
            }else{
                $this->SetX(20.5);
                $position = 'LEFT';
            }
            
            if ($i <= $total_content_rows - 1) {
                /*$intpart = floor( $work_details[$i]['time_from'] ); 
                $fraction = $work_details[$i]['time_from'] - $intpart;
                $start_fraction = $fraction * 100 /60;
                $start_from = $start_fraction + $intpart;

                $intpart = floor( $work_details[$i]['time_to'] );
                $fraction = $work_details[$i]['time_to'] - $intpart;
                $end_fraction = $fraction * 100 /60;
                $end_to = $end_fraction + $intpart;
                $total_time = $end_to - $start_from;   // results in 3
                */
                // echo $total_time.'||'.$obj_equipment->time_difference($work_details[$i]['time_to'], $work_details[$i]['time_from']).'=='.$obj_equipment->time_user_format($obj_equipment->time_difference($work_details[$i]['time_to'], $work_details[$i]['time_from']), 100, FALSE).'<br/>';

                $total_time = $obj_equipment->time_user_format($obj_equipment->time_difference($work_details[$i]['time_to'], $work_details[$i]['time_from']), 100, FALSE);
            
                $this->Cell($w[0], $col_h, date('d', strtotime($work_details[$i]['date'])), 0, 0, 'C', FALSE);   //table cell 1
                $this->Cell($w[1], $col_h, sprintf('%05.02f', $work_details[$i]['time_from']) . '  -  ' . sprintf('%05.02f', $work_details[$i]['time_to']), 0, 0, 'C', FALSE);   //table cell 2
                
                if (in_array($work_details[$i]['type'], array(0,1,2,4,5,6,7,12))) {
                   // $this->Cell($w[2], $col_h, sprintf('%.02f', round($total_time, 2)), 0, 0, 'C', FALSE);   //table cell 3
                    if($position == 'LEFT')
                        $this->make_check_enabled(64.3, $this->GetY()+1.7);
                    else
                        $this->make_check_enabled(149.7, $this->GetY()+1.7);
                    $total_Tid = $total_Tid + $total_time;
                }

                if (in_array($work_details[$i]['type'], array(3,13,14))) {
                   // $this->Cell($w[3], $col_h, sprintf('%.02f', round($total_time, 2)), 0, 0, 'C', FALSE);   //table cell 4
                    if($position == 'LEFT')
                        $this->make_check_enabled(79, $this->GetY()+1.7);
                    else
                        $this->make_check_enabled(162.7, $this->GetY()+1.7);
                    $toal_Jourtid = $toal_Jourtid + $total_time;
                }
				
                if (in_array($work_details[$i]['type'], array(15))) {
                   // $this->Cell($w[4], $col_h, sprintf('%.02f', round($total_time, 2)), 0, 0, 'C', FALSE);   //table cell 5
                    if($position == 'LEFT')
                        $this->make_check_enabled(91.9, $this->GetY()+1.7);
                    else
                        $this->make_check_enabled(177.2, $this->GetY()+1.7);
                    $toal_beredskap += $total_time;
                }
            }

            $this->SetY($this->GetY() + $col_h);

            if ($i == 19)
                $this->SetY($init_y);
        }
        $total_Tid_formatted        = explode('.', sprintf('%.02f', round($obj_equipment->time_user_format($total_Tid, 60), 2))) ;
        $toal_Jourtid_formatted     = explode('.', sprintf('%.02f', round($obj_equipment->time_user_format($toal_Jourtid, 60), 2)));
        $toal_beredskap_formatted   = explode('.', sprintf('%.02f', round($obj_equipment->time_user_format($toal_beredskap, 60), 2)));
        
        $this->SetFont('Arial', 'B', 9);
        $this->SetXY(116.5, 207);
        $this->Cell(11.5, 7, $total_Tid_formatted[0], 0, 0, 'C', FALSE);   //table summery cell
        $this->Cell(11.5, 7, $total_Tid_formatted[1], 0, 0, 'C', FALSE);   //table summery cell
        $this->Cell(11.5, 7, $toal_Jourtid_formatted[0], 0, 0, 'C', FALSE);   //table summery cell
        $this->Cell(11.5, 7, $toal_Jourtid_formatted[1], 0, 0, 'C', FALSE);   //table summery cell
        $this->Cell(11.5, 7, $toal_beredskap_formatted[0], 0, 0, 'C', FALSE);   //table summery cell
        $this->Cell(11.5, 7, $toal_beredskap_formatted[1], 0, 0, 'C', FALSE);   //table summery cell
        
       // $this->current_customer_employee_total_normal_hours += round($total_Tid, 2);
       // $this->current_customer_employee_total_oncall_hours += round($toal_Jourtid, 2);
        
        $this->tot_normal += $total_Tid;
        $this->tot_oncall += $toal_Jourtid;
        $this->tot_beredskap += $toal_beredskap;
    }
    
    function SubPart4($month_start_date, $month_end_date, $employee_period_actual_hours = array(), $special_calculation_array = array()) {
        $this->SetFont('Arial', 'B', 10);
        $this->SetXY(21, 151);
        $this->Cell(70, 8, $month_start_date, 0, 0, 'L', FALSE);    //This month start date
        $this->SetX(48);
        $this->Cell(30, 8, $month_end_date, 0, 0, 'L', FALSE);    //This month end date
        
        
        
        /*if(!empty($employee_period_actual_hours)){
            $this->SetXY(13, 150);
            $total_employee_period_actual_hours = round($employee_period_actual_hours['TOTAL_NORMAL'] + $employee_period_actual_hours['TOTAL_ONCALL'] + $employee_period_actual_hours['TOTAL_BEREDSKAP'], 2);
            $this->Cell(30, 8, sprintf('%.02f', $total_employee_period_actual_hours), 0, 0, 'L', FALSE);    //Total work hours
        }*/
        
        if(!empty($special_calculation_array)){
            $this->SetX(77);
            $this->Cell(70, 8, $special_calculation_array['calculation_period_start_date'], 0, 0, 'L', FALSE);    //This month start date
            $this->SetX(104);
            $this->Cell(30, 8, $special_calculation_array['calculation_period_end_date'], 0, 0, 'L', FALSE);    //This month end date
            
           // $this->SetXY(90, 150);
           // $special_calculation_output = utf8_decode('Från: '). $special_calculation_array['calculation_period_start_date'] . utf8_decode(' Till: ') . $special_calculation_array['calculation_period_end_date'] . '   ' . sprintf('%.02f', $special_calculation_array['total_actual_hours']);
           // $this->Cell(103, 8, $special_calculation_output, 0, 0, 'R', FALSE);   //Total work hours
        }
    }

    function SubPart8($emp_details, $sign_details = NULL) {
       // echo "<pre>".print_r($sign_details, 1)."</pre>";
        if (!empty($sign_details) && $sign_details[0]['signin_employee'] == $emp_details[0]['username']) {
            $this->SetFont('Arial', '', 10);
            $this->SetXY(21, 234);
            $this->Cell(41, 9, date("Y-m-d", strtotime($sign_details[0]['signin_date'])) . ", kl. ".date("H.i", strtotime($sign_details[0]['signin_date'])), 0, 0, 'L', FALSE);    //sign date
            
            $this->SetFont('Arial', 'I', 10);
            $this->Cell(90, 9, utf8_decode($emp_details[0]['fullname']), 0, 0, 'L', FALSE);    //sign employee name
            
            $this->SetFont('Arial', 'I', 7.5);
            $this->SetX(114);
            $this->Cell(30, 9, utf8_decode('e-signering via Time2View'), 0, 0, 'R', FALSE);    //side water mark
            
            $this->SetFont('Arial', '', 10);
            $phno = (trim($emp_details[0]['mobile']) != '' ? ($this->obj_general->format_mobile($emp_details[0]['mobile'])) : $this->obj_general->format_phone($emp_details[0]['phone']));
            $this->SetX(144.5);
            $this->Cell(40, 9, $phno, 0, 0, 'L', FALSE);    // sign employee tel number
            
            if($sign_details[0]['employee_sign'] != '' && $sign_details[0]['employee_ocs'] != '')
                $this->Image('./images/bank-id-logo.jpg', 106, 235.5, 5, 5);
        }
    }
    
    function SubPart5($company_data, $this_agreement, $provider_of_pa = NULL) {
        
        if($provider_of_pa == 1){
            $this->make_check_enabled(23, 178);
        }
        else if($provider_of_pa == 2){
            $this->make_check_enabled(23, 186.2);
            
            $this->SetFont('Arial', 'B', 10);
            $this->SetXY(55, 186);
            $this->Cell(70, 8, utf8_decode($company_data['name']), 0, 0, 'L', FALSE);    //Company name
            $this->SetX(144.6);
            $company_data['org_no'] = str_replace(array("-", " ", ",", ".", "_"), "", strip_tags($company_data['org_no']));
            $company_data['org_no'] = substr($company_data['org_no'], 0, 6) . "-" . substr($company_data['org_no'], 6);
            $this->Cell(30, 8, utf8_decode($company_data['org_no']), 0, 0, 'L', FALSE);    // Organization number

            $contact_person_name = trim($this_agreement['company_cp_name']) != '' ? trim($this_agreement['company_cp_name']) : (trim($company_data['contact_person1']) != '' ? trim($company_data['contact_person1']) : trim($company_data['contact_person2']));
            $phone = trim($this_agreement['company_cp_phone']) != '' ? trim($this_agreement['company_cp_phone']) : (trim($company_data['phone']) != '' ? trim($company_data['phone']) : trim($company_data['mobile']));
            $this->SetXY(55, 194);
            $this->Cell(70, 8, utf8_decode($contact_person_name), 0, 0, 'L', FALSE);    //Contact Person 1 or 2
            $this->SetX(144.6);
            $this->Cell(30, 8, utf8_decode($phone), 0, 0, 'L', FALSE);    // Phone number
            
            if(!empty($this_agreement)){
                if($this_agreement['type'] == 1){
                    $this->make_check_enabled(57.4, 204.7);
                }
                else if($this_agreement['type'] == 2){
                    $this->make_check_enabled(57.4, 217.2);

                    $this->SetXY(94, 217);
                    $this->Cell(60, 7, utf8_decode($this_agreement['type2_company']), 0, 0, 'L', FALSE);    //Arbetsgivarens namn (Company name)
                    $this->SetX(145);
                    $this->Cell(30, 7, utf8_decode($this_agreement['type2_orgno']), 0, 0, 'L', FALSE);    // Company Organization number

                }
                else if($this_agreement['type'] == 3){
                    $this->make_check_enabled(57.4, 229.5);
                }
            }
        }
    }
    
    function SubPart6($employer_sign_details){
       // echo "<pre>".print_r($employer_sign_details, 1)."</pre>";
        if(!empty($employer_sign_details) && !empty($employer_sign_details[0]['employee_data'])){
            $this->SetXY(21, 256);
            $this->SetFont('Arial', '', 9);
            $this->Cell(28, 9, date("Y-m-d H.i", strtotime($employer_sign_details[0]['employee_data'][0]['signing_date'])), 0, 0, 'L', FALSE);    //employer sign date
            
            $this->SetFont('Arial', 'I', 10);
            $this->Cell(95, 9, utf8_decode($employer_sign_details[0]['employee_data'][0]['employer_name']), 0, 0, 'L', FALSE);    //signed employer name
            
            
            $this->SetFont('Arial', 'I', 7.5);
            $this->SetX(111);
            $this->Cell(33, 9, utf8_decode('e-signering via Time2View'), 0, 0, 'R', FALSE);    //side water mark
            
            $this->SetFont('Arial', '', 10);
           // $this->Cell(45, 9, utf8_decode($employer_sign_details[0]['employee_data'][0]['employer_role']), 0, 0, 'L', FALSE);    // signed employer roll
            if($employer_sign_details[0]['employee_data'][0]['employer_mobile'] != '')
                $this->Cell(45, 9, $this->obj_general->format_mobile ($employer_sign_details[0]['employee_data'][0]['employer_mobile']), 0, 0, 'L', FALSE);
            else if($employer_sign_details[0]['employee_data'][0]['employer_phone'] != '')
                $this->Cell(45, 9, $this->obj_general->format_phone ($employer_sign_details[0]['employee_data'][0]['employer_phone']), 0, 0, 'L', FALSE);
            
            if($employer_sign_details[0]['employee_data'][0]['employer_sign'] != '' && $employer_sign_details[0]['employee_data'][0]['employer_ocs'] != '')
                $this->Image('./images/bank-id-logo.jpg', 106, 257.5, 5, 5);
        }
    }
    
    function SubPart7_new($month_start_date, $month_end_date, $employee_period_actual_hours = array(), $special_calculation_array = array()) {
        $this->SetFont('Arial', 'B', 10);
        $this->SetXY(13, 141);
        $this->Cell(70, 8, $month_start_date, 0, 0, 'L', FALSE);    //This month start date
        $this->SetXY(103.5, $this->GetY());
        $this->Cell(30, 8, $month_end_date, 0, 0, 'L', FALSE);    //This month end date
        
        if(!empty($employee_period_actual_hours)){
           // $total_work_hours = $this->current_customer_employee_total_normal_hours + ($this->current_customer_employee_total_oncall_hours / 4);
            $this->SetXY(13, 150);
           // $this->Cell(30, 8, sprintf('%.02f', round($total_work_hours, 2)), 0, 0, 'L', FALSE);    //Total work hours
           // $this->Cell(30, 8, sprintf('%.02f', round($employee_period_contract_hours['contract_hours'], 2)), 0, 0, 'L', FALSE);    //Total work hours
            
            $total_employee_period_actual_hours = round($employee_period_actual_hours['TOTAL_NORMAL'] + $employee_period_actual_hours['TOTAL_ONCALL'] + $employee_period_actual_hours['TOTAL_BEREDSKAP'], 2);
            $this->Cell(30, 8, sprintf('%.02f', $total_employee_period_actual_hours), 0, 0, 'L', FALSE);    //Total work hours
        }
        
        if(!empty($special_calculation_array)){
            $this->SetXY(90, 150);
            $special_calculation_output = utf8_decode('Från: '). $special_calculation_array['calculation_period_start_date'] . utf8_decode(' Till: ') . $special_calculation_array['calculation_period_end_date'] . '   ' . sprintf('%.02f', $special_calculation_array['total_actual_hours']);
            $this->Cell(103, 8, $special_calculation_output, 0, 0, 'R', FALSE);   //Total work hours
        }
    }
    
    function page2_3059_header($month, $year, $cust_details, $emp_details) {
        $this->SetFont('Times', 'B', 10);
        $this->SetXY(82, 12);
        $this->Cell(25, 5, $year . ' - ' . sprintf("%02d",$month), 0, 0, 'L', FALSE);      // personal number
        $this->SetX(103);
        $this->Cell(25, 5, $emp_details[0]['century'] . $this->format_SSN($emp_details[0]['social_security']), 0, 0, 'L', FALSE);      // personal number
        $this->SetX(144);
        $this->Cell(25, 5, $cust_details[0]['century'] . $this->format_SSN($cust_details[0]['social_security']), 0, 0, 'L', FALSE);      // personal number
    }
    
    function Sidelabel() {
       // $this->SetFont('Arial', '', 9);
       // $this->Rotate(90, 60, 60);
       // $this->Text(-54.5, 9, '30591101');
       // $this->Rotate(0);

        /*$this->SetFont('Arial', '', 8);
        $this->Rotate(90, 60, 60);
        //$this->Cell(100,8,'F K 3059 (009 F 004) Fastställd av Försäkringskassan',0,0,'L',true);   //table summery cell
        //$this->Text(-163, 10.5, utf8_decode('F K 3059 (009 F 004) Fastställd av Försäkringskassan'));
        $this->Text(-163, 10.5, utf8_decode('F K 3059 (013 F 002) Fastställd av Försäkringskassan'));
        
        $this->Rotate(90, 60, 60);
        $this->SetFont('Arial', '', 10);
        $this->Text(-58, 10, utf8_decode('30591104'));*/
        
        $this->Rotate(0);
    }

    function Sidelabel_remove_for_new_kn() {
       // $this->SetFont('Arial', '', 9);
       // $this->Rotate(90, 60, 60);
       // $this->Text(-54.5, 9, '30591101');
       // $this->Rotate(0);

        /*$this->SetFont('Arial', '', 8);
        $this->Rotate(90, 60, 60);
        //$this->Cell(100,8,'F K 3059 (009 F 004) Fastställd av Försäkringskassan',0,0,'L',true);   //table summery cell
        //$this->Text(-163, 10.5, utf8_decode('F K 3059 (009 F 004) Fastställd av Försäkringskassan'));
        $this->Text(-163, 10.5, utf8_decode('F K 3059 (013 F 002) Fastställd av Försäkringskassan'));
        
        $this->Rotate(90, 60, 60);
        $this->SetFont('Arial', '', 10);
        $this->Text(-58, 10, utf8_decode('30591104'));*/
        
        $this->SetXY(10,143);
        $this->Cell(10,125,'',0,0,'L', TRUE); 
    }

    /*function Footer() {
        $this->AliasNbPages();
        $this->SetY(-15);
        $this->SetFont('Arial', '', 6);
        //$this->SetTextColor(128);
        //$this->Cell(30,10,date("F d, Y h:i:s A"),0,0,'C');
        $this->SetX(-25);
        $this->Cell(10, 10, $this->PageNo() . '/{nb}', 0, 0, 'C');
    }*/
    
    function Header(){
        $this->AliasNbPages();
        $this->SetXY(-15,8);
        $this->SetFont('Arial', '', 9);
        $this->Cell(10, 10, $this->PageNo() . ' ({nb})', 0, 0, 'C');
    }

    function SetCol($col) {
        // Set position at a given column
        $this->col = $col;
        $x = 10 + $col * 65;
        $this->SetLeftMargin($x);
        $this->SetX($x);
    }

    
    /* **********Report Summery starts here********************** */
    
    function summery_report_top($month, $year, $fkkn, $kn_headings = array(), $company_data = array()) {
        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0, 50, 50);
        if(!empty($kn_headings) && ($fkkn == 2 || $fkkn == 3)){
            $this->SetX(10);
            $this->Cell(70, 30, '', 0, 0, 'L', TRUE);      // hide backround header image
            
            $this->SetFont('Times', 'B', 16);
            $this->SetXY(13, 11);
            $this->Cell(10, 8, utf8_decode($company_data['name']), 0, 1, 'L', FALSE);    //Company Name
            $this->SetFont('Times', 'B', 10);
            if($company_data['box'] != ''){
                $this->SetX(13);
                $this->Cell(10, 6, utf8_decode($company_data['box']), 0, 1, 'L', FALSE);    //Company box number
            }
            $this->SetX(13);
            $this->Cell(10, 6, utf8_decode($company_data['zipcode'] . ' ' . $company_data['city']), 0, 1, 'L', FALSE);    //Company zipcode and city
            $this->SetX(13);
            $comp_phone = (trim($company_data['phone']) != '' ? trim($company_data['phone']) : trim($company_data['mobile']));
            $this->Cell(10, 5, utf8_decode($comp_phone), 0, 1, 'L', FALSE);    //company mobile/phone
            
            
            
            $this->SetXY(105, 36);
            $this->Cell(70, 25, '', 0, 0, 'L', TRUE);      // hide backround information (below the year-month)
            $this->SetFont('Times', 'B', 10);
            $this->SetXY(111, 36);
            $this->Cell(10, 7, utf8_decode($kn_headings['kn_name']), 0, 1, 'L', FALSE);    //Name
            
            if(trim($kn_headings['kn_box']) != ''){
                $this->SetX(111);
                $this->Cell(10, 5, utf8_decode('Box '.$kn_headings['kn_box']), 0, 1, 'L', FALSE);    //PO box
            }else if(trim($kn_headings['kn_address']) != ''){
                $this->SetX(111);
                $this->Cell(10, 5, utf8_decode($kn_headings['kn_address']), 0, 1, 'L', FALSE);    //PO box
            }
            
            if(trim($kn_headings['kn_reference_no']) != ''){
                $this->SetX(111);
                $this->Cell(10, 5, utf8_decode('Ref nr '.$kn_headings['kn_reference_no']), 0, 1, 'L', FALSE);    //Reference number
            }
            
            $zip_n_city = trim($kn_headings['kn_postno']);
            $zip_n_city = ($zip_n_city != '' ? substr($zip_n_city, 0, 3) .' '.  substr($zip_n_city, 3) : '');
            $zip_n_city .= ($zip_n_city != '' ?  ' '.$kn_headings['city'] : $kn_headings['city']);
            if(trim($zip_n_city) != ''){
                $this->SetX(111);
                $this->Cell(10, 5, utf8_decode($zip_n_city), 0, 1, 'L', FALSE);    //zip city
            }
        }
        
        /*$this->SetX(10);
        if ($fkkn == 1) {
            $this->Image('./images/fk2.gif', 11, $this->GetY(), 8, 8);
            $this->SetXY(19, $this->GetY() + 2);
            $this->SetFont('Times', 'B', 14);
            $this->Cell(10, 9, utf8_decode('Försäkringskassan'), 0, 0, 'L', FALSE);    //emblem
        } else {
            $this->SetFont('Times', '', 14);
            $this->Cell(10, 9, utf8_decode('Kommun'), 0, 0, 'L', FALSE);    //emblem
            $this->SetY($this->GetY() + 2);
        }

        if ($fkkn == 1) {
            $this->SetFont('Times', '', 8);
            $this->SetXY(10, 17);
            $this->Cell(10, 9, '0771-524 524', 0, 0, 'L', FALSE);      // phone number
            $this->SetXY(10, $this->GetY() + 2.8);
            $this->Cell(10, 9, 'www.forsakringskassan.se', 0, 0, 'L', FALSE);    //site
        } else {
            $this->SetY(19.8);
        }*/
        $this->SetFont('Times', 'B', 12);
        $this->SetXY(110, 24);
        $this->Cell(29, 7, $year . ' - ' . sprintf("%02d",$month), 0, 0, 'L', FALSE);      // month and year figure
    }
    
    function summery_report_top_new_kn($month, $year, $fkkn, $kn_headings = array(), $company_data = array()) {
        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0, 50, 50);
        if(!empty($kn_headings) && ($fkkn == 2 || $fkkn == 3)){
            $this->SetX(10);
            $this->Cell(70, 30, '', 0, 0, 'L', TRUE);      // hide backround header image
            
            $this->SetFont('Times', 'B', 16);
            $this->SetXY(13, 16);
            $this->Cell(10, 8, utf8_decode($company_data['name']), 0, 1, 'L', FALSE);    //Company Name
            $this->SetFont('Times', 'B', 10);
            if($company_data['box'] != ''){
                $this->SetX(13);
                $this->Cell(10, 6, utf8_decode($company_data['box']), 0, 1, 'L', FALSE);    //Company box number
            }
            $this->SetX(13);
            $this->Cell(10, 6, utf8_decode($company_data['zipcode'] . ' ' . $company_data['city']), 0, 1, 'L', FALSE);    //Company zipcode and city
            $this->SetX(13);
            $comp_phone = (trim($company_data['phone']) != '' ? trim($company_data['phone']) : trim($company_data['mobile']));
            $this->Cell(10, 5, utf8_decode($comp_phone), 0, 1, 'L', FALSE);    //company mobile/phone
            
            $this->SetFont('Times', '', 9);
            $this->SetXY(13, 41);
            $header_static_text = 'Blanketten ska skickas in varje månad i efterskott, 
senast den 10.e dagen i månaden, tillsammans med en 
kopia av tidsredovisningen för antal utförda timmar. 
Tidsredovisningen ska undertecknas av den enskilde/ 
legal ställföreträdare samt assistenter eller assistans - 
anordnare. Uppgifterna utgör underlag för kommunens 
utbetalning. Inga fakt 
uror tas emot';
            $this->MultiCell(100, 4, utf8_decode($header_static_text), 0, 'L', FALSE);
            
            
            // $this->SetXY(125, 46);
            // $this->Cell(70, 25, '', 0, 0, 'L', TRUE);      // hide backround information (below the year-month)
            $this->SetFont('Times', 'B', 10);
            $this->SetXY(131, 51);
            $this->Cell(10, 7, utf8_decode($kn_headings['kn_name']), 0, 1, 'L', FALSE);    //Name
            
            if(trim($kn_headings['kn_box']) != ''){
                $this->SetX(131);
                $this->Cell(10, 5, utf8_decode('Box '.$kn_headings['kn_box']), 0, 1, 'L', FALSE);    //PO box
            }else if(trim($kn_headings['kn_address']) != ''){
                $this->SetX(131);
                $this->Cell(10, 5, utf8_decode($kn_headings['kn_address']), 0, 1, 'L', FALSE);    //PO box
            }
            
            $zip_n_city = trim($kn_headings['kn_postno']);
            $zip_n_city = ($zip_n_city != '' ? substr($zip_n_city, 0, 3) .' '.  substr($zip_n_city, 3) : '');
            $zip_n_city .= ($zip_n_city != '' ?  ' '.$kn_headings['city'] : $kn_headings['city']);
            if(trim($zip_n_city) != ''){
                $this->SetX(131);
                $this->Cell(10, 5, utf8_decode($zip_n_city), 0, 1, 'L', FALSE);    //zip city
            }
            
            if(trim($kn_headings['kn_reference_no']) != ''){
                $this->SetXY(148, 76);
                // $this->Cell(10, 5, utf8_decode('Ref nr '.$kn_headings['kn_reference_no']), 0, 1, 'L', FALSE);    //Reference number
                $this->Cell(10, 5, utf8_decode($kn_headings['kn_reference_no']), 0, 1, 'L', FALSE);    //Reference number
            }
        }
        
        $this->SetFont('Times', 'B', 12);
        $this->SetXY(145, 33);
        $this->Cell(29, 7, $year . ' - ' . sprintf("%02d",$month), 0, 0, 'L', FALSE);      // month and year figure
    }

    function summery_SubPart1($cust_details) {
        $this->SetFont('Arial', 'B', 9);
        $this->SetXY(14, 77.5);
        $this->Cell(10, 9, utf8_decode($cust_details[0]['fullname']), 0, 0, 'L', FALSE);    //Customer Full name
        $this->SetX(148);
        $this->Cell(10, 9, $cust_details[0]['century'] . $this->format_SSN($cust_details[0]['social_security']), 0, 0, 'L', FALSE);    // Customer SSN
    }

    function summery_SubPart1_kn($cust_details) {
        $this->SetFont('Arial', 'B', 9);
        $this->SetXY(16, 92);
        $this->Cell(10, 9, utf8_decode($cust_details[0]['fullname']), 0, 0, 'L', FALSE);    //Customer Full name
        $this->SetX(141);
        $this->Cell(10, 9, $cust_details[0]['century'] . $this->format_SSN($cust_details[0]['social_security']), 0, 0, 'L', FALSE);    // Customer SSN
    }

    function summery_SubPart2($no_of_employees_have_slots) {
        $obj_equipment = new equipment();
        $this->SetFont('Arial', 'B', 9);
        $quarter = ($this->tot_oncall) / 4;
        $one_seventh = ($this->tot_beredskap) / 7;
        // echo "<pre>".print_r(array($this->tot_normal, $this->tot_oncall, $this->tot_beredskap, $no_of_employees_have_slots), 1)."<pre>";

        $total_normal_parts = explode('.', sprintf('%.02f', round($obj_equipment->time_user_format($this->tot_normal, 60), 2)));
        $this->SetXY(15.5, 102.5);
        $this->Cell(10, 9, $total_normal_parts[0], 0, 0, 'L', FALSE);    //total Normal hours
        $this->SetX(37);
        $this->Cell(10, 9, $total_normal_parts[1], 0, 0, 'L', FALSE);    //total Normal hours
        
        $total_oncall_parts = explode('.', sprintf('%.02f', round($obj_equipment->time_user_format($this->tot_oncall, 60), 2)));
        $this->SetX(70);
        $this->Cell(10, 9, $total_oncall_parts[0], 0, 0, 'L', FALSE);    //total oncall hours
        $this->SetX(92.5);
        $this->Cell(10, 9, $total_oncall_parts[1], 0, 0, 'L', FALSE);    //total oncall hours
        
        $total_beredskap_parts = explode('.', sprintf('%.02f', round($obj_equipment->time_user_format($this->tot_beredskap, 60), 2)));
        $this->SetX(135);
        $this->Cell(10, 9, $total_beredskap_parts[0], 0, 0, 'L', FALSE);    //total standby hours
        $this->SetX(157.5);
        $this->Cell(10, 9, $total_beredskap_parts[1], 0, 0, 'L', FALSE);    //total standby hours
        
        
        // $this->SetX(145);
        // $total_summery = $this->tot_normal + $quarter + $one_seventh;
        // $this->Cell(10, 9, round($obj_equipment->time_user_format(round($total_summery), 60)), 0, 0, 'L', FALSE);   //normal + quarter hours

        // $this->SetXY(45, 105);
        // $this->Cell(10, 6, $no_of_employees_have_slots, 0, 0, 'C', FALSE);    //total No. of employees who have slots
    }

    function summery_SubPart2_new_kn($cust_contract_in_this_year_month) {
        $this->SetFont('Arial', 'B', 9);;

        if(count($cust_contract_in_this_year_month) == 1)
            $this->SetXY(17, 109.5);
        else if(count($cust_contract_in_this_year_month) > 1)
            $this->SetXY(17, 106.5);

        $counter = 1;
        if(!empty($cust_contract_in_this_year_month)){
            foreach($cust_contract_in_this_year_month as $cc){
                // $this->Cell(10, 9, $cc['hour'], 0, 0, 'L', FALSE);    //total Normal hours
                $this->Cell(10, 9, $cc['weekly_hours'], 0, 0, 'L', FALSE);    //total Normal hours
                $this->SetX(108);
                $this->Cell(10, 9, $cc['date_from'] . ' -- ' . $cc['date_to'], 0, 0, 'L', FALSE);    //total Normal hours

                $this->SetXY(17, $this->getY() + 4);
                $counter++;
                if($counter > 2) break; // show limited to first 2 entries
            }
        }
        
    }

    function summery_SubPart3_new() {

        if ($this->summery_data[0]['has_assistance_in_other_activities'] == 1) {
            $this->make_check_enabled(15.8, 123);
        } else if ($this->summery_data[0]['has_assistance_in_other_activities'] === '0') {
            $this->make_check_enabled(38.3, 123);
        }
    }

    function summery_SubPart3_new_kn($no_of_employees_have_slots) {

        $obj_equipment = new equipment();
        $this->SetFont('Arial', 'B', 9);
        $quarter = ($this->tot_oncall) / 4;
        $one_seventh = ($this->tot_beredskap) / 7;
        // echo "<pre>".print_r(array($this->tot_normal, $this->tot_oncall, $this->tot_beredskap, $no_of_employees_have_slots), 1)."<pre>";

        $total_normal_parts = explode('.', sprintf('%.02f', round($obj_equipment->time_user_format($this->tot_normal, 60), 2)));
        $this->SetXY(34, 132);
        $this->Cell(10, 9, $total_normal_parts[0], 0, 0, 'C', FALSE);    //total Normal hours
        $this->SetX(48);
        $this->Cell(10, 9, $total_normal_parts[1], 0, 0, 'C', FALSE);    //total Normal hours
        
        $total_oncall_parts = explode('.', sprintf('%.02f', round($obj_equipment->time_user_format($this->tot_oncall, 60), 2)));
        $this->SetX(94.5);
        $this->Cell(10, 9, $total_oncall_parts[0], 0, 0, 'C', FALSE);    //total oncall hours
        $this->SetX(107.5);
        $this->Cell(10, 9, $total_oncall_parts[1], 0, 0, 'C', FALSE);    //total oncall hours
        
        $total_beredskap_parts = explode('.', sprintf('%.02f', round($obj_equipment->time_user_format($this->tot_beredskap, 60), 2)));
        $this->SetX(155.5);
        $this->Cell(10, 9, $total_beredskap_parts[0], 0, 0, 'C', FALSE);    //total standby hours
        $this->SetX(168.5);
        $this->Cell(10, 9, $total_beredskap_parts[1], 0, 0, 'C', FALSE);    //total standby hours
        
        
        // $this->SetX(145);
        // $total_summery = $this->tot_normal + $quarter + $one_seventh;
        // $this->Cell(10, 9, round($obj_equipment->time_user_format(round($total_summery), 60)), 0, 0, 'L', FALSE);   //normal + quarter hours

        $this->SetXY(62, 148);
        $this->Cell(10, 6, $no_of_employees_have_slots, 0, 0, 'C', FALSE);    //total No. of employees who have slots
    }

    function summery_SubPart3() {
        
        //row 1
        if ($this->summery_data[0]['did_u_hostpilized_this_month'] === '0') {
            $this->make_check_enabled(15.8, 143.1);
        }
        
        //row 2
        if ($this->summery_data[0]['did_u_hostpilized_this_month'] == 1) {
            $this->make_check_enabled(15.8, 152);
            
            $this->SetXY(30, 153);
            if($this->summery_data[0]['hostpilized_date_from'] != '' && $this->summery_data[0]['hostpilized_date_from'] != '0000-00-00')
                $this->Cell(35, 7, $this->summery_data[0]['hostpilized_date_from'], 0, 0, 'L', FALSE);    //date-from
            $this->SetX(75);
            if($this->summery_data[0]['hostpilized_time_from'] !== '' && $this->summery_data[0]['hostpilized_time_from'] !== NULL)
                $this->Cell(35, 7, $this->format_time($this->summery_data[0]['hostpilized_time_from']), 0, 0, 'L', FALSE);    //time-from
            $this->SetX(105);
            if($this->summery_data[0]['hostpilized_date_to'] != '' && $this->summery_data[0]['hostpilized_date_to'] != '0000-00-00')
                $this->Cell(35, 7, $this->summery_data[0]['hostpilized_date_to'], 0, 0, 'L', FALSE);    //date-to
            $this->SetX(150);
            if($this->summery_data[0]['hostpilized_time_to'] !== '' && $this->summery_data[0]['hostpilized_time_to'] !== NULL)
                $this->Cell(35, 7, $this->format_time($this->summery_data[0]['hostpilized_time_to']), 0, 0, 'L', FALSE);    //time-to
            
            $this->SetXY(30, 162);
            if($this->summery_data[0]['hostpilized_date_from2'] != '' && $this->summery_data[0]['hostpilized_date_from2'] != '0000-00-00')
                $this->Cell(35, 7, $this->summery_data[0]['hostpilized_date_from2'], 0, 0, 'L', FALSE);    //date-from
            $this->SetX(75);
            if($this->summery_data[0]['hostpilized_time_from2'] !== '' && $this->summery_data[0]['hostpilized_time_from2'] !== NULL)
                $this->Cell(35, 7, $this->format_time($this->summery_data[0]['hostpilized_time_from2']), 0, 0, 'L', FALSE);    //time-from
            $this->SetX(105);
            if($this->summery_data[0]['hostpilized_date_to2'] != '' && $this->summery_data[0]['hostpilized_date_to2'] != '0000-00-00')
                $this->Cell(35, 7, $this->summery_data[0]['hostpilized_date_to2'], 0, 0, 'L', FALSE);    //date-to
            $this->SetX(150);
            if($this->summery_data[0]['hostpilized_time_to2'] !== '' && $this->summery_data[0]['hostpilized_time_to2'] !== NULL)
                $this->Cell(35, 7, $this->format_time($this->summery_data[0]['hostpilized_time_to2']), 0, 0, 'L', FALSE);    //time-to
            
            $this->SetXY(30, 171);
            if($this->summery_data[0]['hostpilized_date_from3'] != '' && $this->summery_data[0]['hostpilized_date_from3'] != '0000-00-00')
                $this->Cell(35, 7, $this->summery_data[0]['hostpilized_date_from3'], 0, 0, 'L', FALSE);    //date-from
            $this->SetX(75);
            if($this->summery_data[0]['hostpilized_time_from3'] !== '' && $this->summery_data[0]['hostpilized_time_from3'] !== NULL)
                $this->Cell(35, 7, $this->format_time($this->summery_data[0]['hostpilized_time_from3']), 0, 0, 'L', FALSE);    //time-from
            $this->SetX(105);
            if($this->summery_data[0]['hostpilized_date_to3'] != '' && $this->summery_data[0]['hostpilized_date_to3'] != '0000-00-00')
                $this->Cell(35, 7, $this->summery_data[0]['hostpilized_date_to3'], 0, 0, 'L', FALSE);    //date-to
            $this->SetX(150);
            if($this->summery_data[0]['hostpilized_time_to3'] !== '' && $this->summery_data[0]['hostpilized_time_to3'] !== NULL)
                $this->Cell(35, 7, $this->format_time($this->summery_data[0]['hostpilized_time_to3']), 0, 0, 'L', FALSE);    //time-to
            
            //row 3
            /*if ($this->summery_data[0]['did_u_included_hospitalized_hours'] == 1) {
                $this->make_check_enabled(23, 139);
                $this->SetY(143.5);

                if($this->summery_data[0]['hostpitalized_hours'] != NULL && $this->summery_data[0]['hostpitalized_hours'] != 0){
                    $tmp_time_seperation = explode('.', $this->summery_data[0]['hostpitalized_hours']);
                    $pdf_reports['hostpitalized_hours_norm_hr'] = $tmp_time_seperation[0];
                    $pdf_reports['hostpitalized_hours_norm_min'] = $tmp_time_seperation[1];
                    $this->SetX(90);
                    $this->Cell(18, 7, $tmp_time_seperation[0], 0, 0, 'L', FALSE);
                    $this->SetX(101.2);
                    $this->Cell(18, 7, $tmp_time_seperation[1], 0, 0, 'L', FALSE);
                }
                if($this->summery_data[0]['hostpitalized_hours_oncall'] != NULL && $this->summery_data[0]['hostpitalized_hours_oncall'] != 0){
                    $tmp_time_seperation = explode('.', $this->summery_data[0]['hostpitalized_hours_oncall']);
                    $this->SetX(115);
                    $this->Cell(18, 7, $tmp_time_seperation[0], 0, 0, 'L', FALSE);
                    $this->SetX(126.4);
                    $this->Cell(18, 7, $tmp_time_seperation[1], 0, 0, 'L', FALSE);
                }
                if($this->summery_data[0]['hostpitalized_hours_standby'] != NULL && $this->summery_data[0]['hostpitalized_hours_standby'] != 0){
                    $tmp_time_seperation = explode('.', $this->summery_data[0]['hostpitalized_hours_standby']);
                    $this->SetX(147);
                    $this->Cell(18, 7, $tmp_time_seperation[0], 0, 0, 'L', FALSE);
                    $this->SetX(158.7);
                    $this->Cell(18, 7, $tmp_time_seperation[1], 0, 0, 'L', FALSE);
                }
                
            }*/
        }
    }

    function summery_SubPart4() {
        
        $check_values = explode('||', $this->summery_data[0]['how_is_asst_provided']);
        //row 4
        if ($check_values[3] == 1) {
            $this->make_check_enabled(15.8, 190);
        }
    }

    function summery_SubPart4_new_kn($hospital_hours_time_summary = array()) {
        
        //row 1
        if ($this->summery_data[0]['did_u_hostpilized_this_month'] === '0') {
            $this->make_check_enabled_new_kn(18.4, 164.2);
        }
        
        //row 2
        if ($this->summery_data[0]['did_u_hostpilized_this_month'] == 1) {
            $this->make_check_enabled_new_kn(18.4, 173.5);

            $first_day = $last_day = NULL;

            if($this->summery_data[0]['hostpilized_date_from'] != '' && $this->summery_data[0]['hostpilized_date_from'] != '0000-00-00')
                $first_day = $this->summery_data[0]['hostpilized_date_from'] . ' ' . ($this->summery_data[0]['hostpilized_time_from'] !== '' && $this->summery_data[0]['hostpilized_time_from'] !== NULL ? $this->format_time($this->summery_data[0]['hostpilized_time_from']) : '00.00');
            else if($this->summery_data[0]['hostpilized_date_from2'] != '' && $this->summery_data[0]['hostpilized_date_from2'] != '0000-00-00')
                $first_day = $this->summery_data[0]['hostpilized_date_from2'] . ' ' . ($this->summery_data[0]['hostpilized_time_from2'] !== '' && $this->summery_data[0]['hostpilized_time_from2'] !== NULL ? $this->format_time($this->summery_data[0]['hostpilized_time_from2']) : '00.00');
            else if($this->summery_data[0]['hostpilized_date_from3'] != '' && $this->summery_data[0]['hostpilized_date_from3'] != '0000-00-00')
                $first_day = $this->summery_data[0]['hostpilized_date_from3'] . ' ' . ($this->summery_data[0]['hostpilized_time_from3'] !== '' && $this->summery_data[0]['hostpilized_time_from3'] !== NULL ? $this->format_time($this->summery_data[0]['hostpilized_time_from3']) : '00.00');

            if($this->summery_data[0]['hostpilized_date_to3'] != '' && $this->summery_data[0]['hostpilized_date_to3'] != '0000-00-00')
                $last_day = $this->summery_data[0]['hostpilized_date_to3'] . ' ' . ($this->summery_data[0]['hostpilized_time_to3'] !== '' && $this->summery_data[0]['hostpilized_time_to3'] !== NULL ? $this->format_time($this->summery_data[0]['hostpilized_time_to3']) : '24.00');
            else if($this->summery_data[0]['hostpilized_date_to2'] != '' && $this->summery_data[0]['hostpilized_date_to2'] != '0000-00-00')
                $last_day = $this->summery_data[0]['hostpilized_date_to2'] . ' ' . ($this->summery_data[0]['hostpilized_time_to2'] !== '' && $this->summery_data[0]['hostpilized_time_to2'] !== NULL ? $this->format_time($this->summery_data[0]['hostpilized_time_to2']) : '24.00');
            else if($this->summery_data[0]['hostpilized_date_to'] != '' && $this->summery_data[0]['hostpilized_date_to'] != '0000-00-00')
                $last_day = $this->summery_data[0]['hostpilized_date_to'] . ' ' . ($this->summery_data[0]['hostpilized_time_to'] !== '' && $this->summery_data[0]['hostpilized_time_to'] !== NULL ? $this->format_time($this->summery_data[0]['hostpilized_time_to']) : '24.00');

            $this->SetXY(35, 174);
            $this->Cell(35, 7, $first_day, 0, 0, 'L', FALSE);    //date-from
            $this->SetX(114.5 );
            $this->Cell(35, 7, $last_day, 0, 0, 'L', FALSE);    //date-to
            


            //row 3
            if ($this->summery_data[0]['have_received_personal_assistance'] == 1)
                $this->make_check_enabled_new_kn(18.4, 188.6);
            if ($this->summery_data[0]['have_received_personal_assistance'] == 2)
                $this->make_check_enabled_new_kn(68, 188.6);

            //row 4
            if ($this->summery_data[0]['have_u_contact_with_assistant_counselors'] == 1){
                $this->make_check_enabled_new_kn(18.4, 197.7);

                if(!empty($hospital_hours_time_summary)){
                    $obj_equipment = new equipment();
                    $tmp_tot_normal = sprintf('%.02f', round($obj_equipment->time_user_format($hospital_hours_time_summary['tot_Normal'], 60), 2));
                    $tmp_tot_onCall = sprintf('%.02f', round($obj_equipment->time_user_format($hospital_hours_time_summary['tot_onCall'], 60), 2));
                    $tmp_tot_beredskap = sprintf('%.02f', round($obj_equipment->time_user_format($hospital_hours_time_summary['tot_beredskap'], 60), 2));

                    $tmp_tot_normal_exploded = explode('.', $tmp_tot_normal);
                    $tmp_tot_onCall_exploded = explode('.', $tmp_tot_onCall);
                    $tmp_tot_beredskap_exploded = explode('.', $tmp_tot_beredskap);

                    $this->SetXY(83, 200);
                    $this->Cell(10, 7, $tmp_tot_normal_exploded[0], 0, 0, 'C', FALSE);    //normal hours
                    $this->SetX(96 );
                    $this->Cell(10, 7, $tmp_tot_normal_exploded[1], 0, 0, 'C', FALSE);    //normal minutes

                    $this->SetX(119.4);
                    $this->Cell(10, 7, $tmp_tot_onCall_exploded[0], 0, 0, 'C', FALSE);    //oncall hours
                    $this->SetX(132.4 );
                    $this->Cell(10, 7, $tmp_tot_onCall_exploded[1], 0, 0, 'C', FALSE);    //oncall minutes

                    $this->SetX(163.2);
                    $this->Cell(10, 7, $tmp_tot_beredskap_exploded[0], 0, 0, 'C', FALSE);    //standby hours
                    $this->SetX(176.2 );
                    $this->Cell(10, 7, $tmp_tot_beredskap_exploded[1], 0, 0, 'C', FALSE);    //standby minutes
                }
            }
        }
    }

    function summery_SubPart5() {
        if ($this->summery_data[0]['have_money_left_not_to_purchase1'] == 1) {
            $this->make_check_enabled(15.8, 212.8);
        }
        else if ($this->summery_data[0]['have_money_left_not_to_purchase1'] === 0 || $this->summery_data[0]['have_money_left_not_to_purchase1'] === '0') {
            $this->make_check_enabled(38.3, 212.8);
            
            $this->SetFont('Arial', 'B', 9);
            $this->SetXY(64, 211.5);
            $this->Cell(17, 7, utf8_decode($this->summery_data[0]['money_left1']), 0, 0, 'C', FALSE);    //money_left1
        }
    }

    function summery_SubPart5_new_kn() {
        $check_values = explode('||', $this->summery_data[0]['how_is_asst_provided']);
        //row 4
        if ($check_values[3] == 1) {
            // $obj_equipment = new equipment();
            $this->make_check_enabled_new_kn(18.4, 220.2);

            $this->SetY(232);
            if($this->summery_data[0]['hired_assistant_date_from'] != '' && $this->summery_data[0]['hired_assistant_date_from'] != '0000-00-00' && $this->summery_data[0]['hired_assistant_date_to'] != '' && $this->summery_data[0]['hired_assistant_date_to'] != '0000-00-00'){
                $this->SetX(33);
                $this->Cell(10, 9, $this->summery_data[0]['hired_assistant_date_from']  .'  --  ' . $this->summery_data[0]['hired_assistant_date_to'], 0, 0, 'C', FALSE);    //dates
            }

            if($this->summery_data[0]['hired_assistant_normal_hours'] != NULL){
                // $total_normal_parts = explode('.', sprintf('%.02f', round($obj_equipment->time_user_format((float) $this->summery_data[0]['hired_assistant_normal_hours'], 60), 2)));
                $total_normal_parts = explode('.', sprintf('%.02f', round((float) $this->summery_data[0]['hired_assistant_normal_hours'], 2)));
                $this->SetX(73);
                $this->Cell(10, 9, $total_normal_parts[0], 0, 0, 'C', FALSE);    //total Normal hours
                $this->SetX(86);
                $this->Cell(10, 9, $total_normal_parts[1], 0, 0, 'C', FALSE);    //total Normal hours
            }
            
            if($this->summery_data[0]['hired_assistant_oncall_hours'] != NULL){
                // $total_oncall_parts = explode('.', sprintf('%.02f', round($obj_equipment->time_user_format($this->summery_data[0]['hired_assistant_oncall_hours'], 60), 2)));
                $total_oncall_parts = explode('.', sprintf('%.02f', round($this->summery_data[0]['hired_assistant_oncall_hours'], 2)));
                $this->SetX(118.5);
                $this->Cell(10, 9, $total_oncall_parts[0], 0, 0, 'C', FALSE);    //total oncall hours
                $this->SetX(131.5);
                $this->Cell(10, 9, $total_oncall_parts[1], 0, 0, 'C', FALSE);    //total oncall hours
            }
            
            if($this->summery_data[0]['hired_assistant_standby_hours'] != NULL){
                // $total_beredskap_parts = explode('.', sprintf('%.02f', round($obj_equipment->time_user_format($this->summery_data[0]['hired_assistant_standby_hours'], 60), 2)));
                $total_beredskap_parts = explode('.', sprintf('%.02f', round($this->summery_data[0]['hired_assistant_standby_hours'], 2)));
                $this->SetX(164);
                $this->Cell(10, 9, $total_beredskap_parts[0], 0, 0, 'C', FALSE);    //total standby hours
                $this->SetX(177);
                $this->Cell(10, 9, $total_beredskap_parts[1], 0, 0, 'C', FALSE);    //total standby hours
            }
        }
    }
    
    function summery_SubPart6() {
        
        if ($this->summery_data[0]['signature_options'] == 1 || $this->summery_data[0]['signature_options'] == 2 || $this->summery_data[0]['signature_options'] == 3) {
            //$customer_mobile = (trim($cust_details[0]['phone']) != '') ? trim($cust_details[0]['phone']) : trim($cust_details[0]['mobile']);
            $this->SetXY(14, 249.5);
            $this->Cell(45, 7, utf8_decode($this->summery_data[0]['sign_date']), 0, 0, 'L', FALSE);    //sign date
            
            $this->SetX(149);
            $this->Cell(45, 7, utf8_decode($this->summery_data[0]['signed_customer_phno']), 0, 0, 'L', FALSE);    //Customer telephone
        }
    }
    
    function summery_SubPart6_new_kn($company_data = array()) {
        // $company_data['bank_account'] $company_data['phone']
        $this->SetXY(17, 255.5);
        $this->Cell(45, 7, utf8_decode($company_data['name']), 0, 0, 'L', FALSE); 
        
        $this->SetX(127);
        $this->Cell(45, 7, $this->formatting_phone($company_data['phone']), 0, 0, 'L', FALSE);
        
        $this->SetXY(17, 266.5);
        $this->Cell(45, 7, utf8_decode($company_data['email']), 0, 0, 'L', FALSE);
        
        $this->SetX(137.5);
        $this->Cell(45, 7, utf8_decode($company_data['bank_account']), 0, 0, 'L', FALSE);
    }
    
    function summery_SubPart6_part2_new_kn($company_data = array()) {
        //row 1
        if ($this->summery_data[0]['permission_from_care_inspectorate'] == 1)
            $this->make_check_enabled_new_kn(111.6, 19);
        if ($this->summery_data[0]['permission_from_care_inspectorate'] == 2)
            $this->make_check_enabled_new_kn(142.4, 19);
    }

    function summery_Sidelabel() {
        $this->SetFont('Arial', '', 8);
        $this->Rotate(90, 60, 60);
        //$this->Text(-147.5, 9, utf8_decode('F K 3057 (012 F 002) Fastställd av Försäkringskassan'));
        //$this->Text(-168, 10, utf8_decode('FK 3057 (013 F 001)'));
        $this->Text(-168, 10, utf8_decode('FK 3057 (013 F 005) Fastställd av Försäkringskassan'));
        
        $this->Rotate(90, 60, 60);
        $this->SetFont('Arial', '', 10);
        $this->Text(-58, 10, utf8_decode('30571102'));
        
        $this->Rotate(0);
    }

    function summery_report_top_2($cust_details, $month, $year) {
        $this->SetFont('Times', 'B', 10);
        $this->SetXY(126, 13.5);
        $this->Cell(25, 5, $year . ' - ' . sprintf("%02d",$month), 0, 0, 'L', FALSE);      // personal number
        $this->SetX(148);
        $this->Cell(25, 5, $cust_details[0]['century'] . $this->format_SSN($cust_details[0]['social_security']), 0, 0, 'L', FALSE);      // personal number
    }

    function summery_SubPart7() {
        //choice 1
        if ($this->summery_data[0]['signature_options'] == 1) {
            $this->make_check_enabled(28.3, 271);
        }
        
        //choice 2
        if ($this->summery_data[0]['signature_options'] == 2) {
            $this->make_check_enabled(73.3, 271);
        }
        
        //choice 3
        if ($this->summery_data[0]['signature_options'] == 3) {
            $this->make_check_enabled(118.3, 271);
        }
        
        $this->SetXY(14, 282);
        $this->Cell(135, 7, utf8_decode($this->summery_data[0]['signed_employer_name']), 0, 0, 'L', FALSE);    //Signed employer name
        $this->SetX(149);
        $this->Cell(45, 7, utf8_decode($this->summery_data[0]['signed_employer_ssn']), 0, 0, 'L', FALSE);    //telephone
        
    }
    
    function summery_SubPart7_new_kn() {

        $this->SetFont('Arial', 'B', 9);
        if ($this->summery_data[0]['signature_options'] == 1 || $this->summery_data[0]['signature_options'] == 2 || $this->summery_data[0]['signature_options'] == 3) {
            //$customer_mobile = (trim($cust_details[0]['phone']) != '') ? trim($cust_details[0]['phone']) : trim($cust_details[0]['mobile']);
            $this->SetXY(14, 67);
            $this->Cell(45, 7, utf8_decode($this->summery_data[0]['sign_date']), 0, 0, 'L', FALSE);    //sign date
            
            $this->SetX(129);
            $this->Cell(45, 7, utf8_decode($this->summery_data[0]['signed_customer_phno']), 0, 0, 'L', FALSE);    //Customer telephone
        }
    }

    function summery_SubPart8($total_no_of_hours) {
        
        //table body starts
        $column_x = array(84, 139.5);                 //column x array
        $col_height = 9;

        //row 1
        $this->SetXY($column_x[0], 86);
        $this->Cell(39, $col_height, ($this->summery_data[0]['salary_excl_OB_cost'] != 0 ? $this->format_Currency($this->summery_data[0]['salary_excl_OB_cost']) : ''), 0, 0, 'R', FALSE);
        $this->SetX($column_x[1]);
        $this->Cell(39, $col_height, ($this->summery_data[0]['salary_excl_OB_period'] != 0 ?$this->format_Currency($this->summery_data[0]['salary_excl_OB_period']) : ''), 0, 0, 'R', FALSE);

        //row 2
        $this->SetY($this->GetY()+$col_height);
        $this->SetX($column_x[0]);
        $this->Cell(39, $col_height, ($this->summery_data[0]['salary_OB_cost'] != 0 ? $this->format_Currency($this->summery_data[0]['salary_OB_cost']) : ''), 0, 0, 'R', FALSE);
        $this->SetX($column_x[1]);
        $this->Cell(39, $col_height, ($this->summery_data[0]['salary_OB_period'] != 0 ? $this->format_Currency($this->summery_data[0]['salary_OB_period']) : ''), 0, 0, 'R', FALSE);

        //row 3
        $this->SetY($this->GetY()+$col_height);
        $this->SetX($column_x[0]);
        $this->Cell(39, $col_height, ($this->summery_data[0]['assist_expenses_cost'] != 0 ? $this->format_Currency($this->summery_data[0]['assist_expenses_cost']) : ''), 0, 0, 'R', FALSE);
        $this->SetX($column_x[1]);
        $this->Cell(39, $col_height, ($this->summery_data[0]['assist_expenses_period'] != 0 ? $this->format_Currency($this->summery_data[0]['assist_expenses_period']) : ''), 0, 0, 'R', FALSE);

        //row 4
        $this->SetY($this->GetY()+$col_height);
        $this->SetX($column_x[0]);
        $this->Cell(39, $col_height, ($this->summery_data[0]['training_cost'] != 0 ? $this->format_Currency($this->summery_data[0]['training_cost']) : ''), 0, 0, 'R', FALSE);
        $this->SetX($column_x[1]);
        $this->Cell(39, $col_height, ($this->summery_data[0]['training_period'] != 0 ? $this->format_Currency($this->summery_data[0]['training_period']) : ''), 0, 0, 'R', FALSE);

        //row 5
        $this->SetY($this->GetY()+$col_height);
        $this->SetX($column_x[0]);
        $this->Cell(39, $col_height, ($this->summery_data[0]['staff_expense_cost'] != 0 ? $this->format_Currency($this->summery_data[0]['staff_expense_cost']) : ''), 0, 0, 'R', FALSE);
        $this->SetX($column_x[1]);
        $this->Cell(39, $col_height, ($this->summery_data[0]['staff_expense_period'] != 0 ? $this->format_Currency($this->summery_data[0]['staff_expense_period']) : ''), 0, 0, 'R', FALSE);

        //row 6
        $this->SetY($this->GetY()+$col_height);
        $this->SetX($column_x[0]);
        $this->Cell(39, $col_height, ($this->summery_data[0]['administration_cost'] != 0 ? $this->format_Currency($this->summery_data[0]['administration_cost']) : ''), 0, 0, 'R', FALSE);
        $this->SetX($column_x[1]);
        $this->Cell(39, $col_height, ($this->summery_data[0]['administration_period'] != 0 ? $this->format_Currency($this->summery_data[0]['administration_period']) : ''), 0, 0, 'R', FALSE);

        $total_cost_per_hour = $this->summery_data[0]['salary_excl_OB_cost'] +
                        $this->summery_data[0]['salary_OB_cost'] +
                        $this->summery_data[0]['assist_expenses_cost'] +
                        $this->summery_data[0]['training_cost'] +
                        $this->summery_data[0]['staff_expense_cost'] +
                        $this->summery_data[0]['administration_cost'];
        
        $total_cost_for_period = $this->summery_data[0]['salary_excl_OB_period'] +
                        $this->summery_data[0]['salary_OB_period'] +
                        $this->summery_data[0]['assist_expenses_period'] +
                        $this->summery_data[0]['training_period'] +
                        $this->summery_data[0]['staff_expense_period'] +
                        $this->summery_data[0]['administration_period'];
        //row 7 - Total
        $this->SetY($this->GetY()+$col_height);
        $this->SetX($column_x[0]);
        $this->Cell(39, $col_height, ($total_cost_per_hour != 0 ? $this->format_Currency(sprintf('%.02f', round($total_cost_per_hour, 2))) : ''), 0, 0, 'R', FALSE);
        $this->SetX($column_x[1]);
        $this->Cell(39, $col_height, ($total_cost_for_period != 0 ? $this->format_Currency(sprintf('%.02f', round($total_cost_for_period, 2))) : ''), 0, 0, 'R', FALSE);

        //row 8 - Total work hours
        $this->SetY($this->GetY()+$col_height);
        $this->SetX($column_x[0]);
        $this->Cell(39, $col_height, ($total_no_of_hours != 0 ? $total_no_of_hours : ''), 0, 0, 'R', FALSE);   //total hours in 60
        
    }

    function summery_SubPart8_new_kn() {
        //choice 1
        if ($this->summery_data[0]['signature_options'] == 1) {
            $this->make_check_enabled_new_kn(31.3, 86.6);
        }
        
        //choice 2
        if ($this->summery_data[0]['signature_options'] == 2) {
            $this->make_check_enabled_new_kn(82.3, 86.6);
        }
        
        //choice 3
        if ($this->summery_data[0]['signature_options'] == 3) {
            $this->make_check_enabled_new_kn(127.8, 86.6);
        }
        
        $this->SetXY(14, 99);
        $this->Cell(135, 7, utf8_decode($this->summery_data[0]['signed_employer_name']), 0, 0, 'L', FALSE);    //Signed employer name
        $this->SetX(126);
        $this->Cell(45, 7, utf8_decode($this->summery_data[0]['signed_employer_ssn']), 0, 0, 'L', FALSE);    //telephone
        
    }

    function summery_SubPart9() {
        
        //9A
        $this->SetXY(14, 177.3);
        $this->Cell(42, 7, ($this->summery_data[0]['accounting_date_from'] != '' && $this->summery_data[0]['accounting_date_from'] != '0000-00-00' ? $this->summery_data[0]['accounting_date_from'] : ''), 0, 0, 'L', FALSE);    //Date from
        $this->SetX(92);
        $this->Cell(42, 7, ($this->summery_data[0]['accounting_date_to'] != '' && $this->summery_data[0]['accounting_date_to'] != '0000-00-00' ? $this->summery_data[0]['accounting_date_to'] : ''), 0, 0, 'L', FALSE);    //Date to

        // echo '<pre>'.print_r($this->summery_data, 1).'</pre>';
        //9B
        if ($this->summery_data[0]['money_left_not_to_purchase2'] === 0 || $this->summery_data[0]['money_left_not_to_purchase2'] === '0') {
            $this->make_check_enabled(15.8, 199.3);
        }
        else if ($this->summery_data[0]['money_left_not_to_purchase2'] == 1) {
            $this->make_check_enabled(38.3, 199.3);
            
            $this->SetXY(64, 198);
            $this->Cell(17, 7, utf8_decode($this->summery_data[0]['money_left2']), 0, 0, 'C', FALSE);    //money_left1
        }
        
        //9C
        if ($this->summery_data[0]['compensation_payback'] == 1) {
            $this->make_check_enabled(15.8, 237.5);
        }
        else if ($this->summery_data[0]['compensation_payback'] == 2) {
            $this->make_check_enabled(15.8, 246.6);
        }
        
        
    }

    /* **********Report Summery endz here********************** */

    function formatting_phone($No = NULL) {
        $ph_no = '';
        if (isset($No)) {
            if (substr($No, 0, 1) != '0')
                $ph_no = '0' . $No;
            else
                $ph_no = $No;
        }
        return $ph_no;
    }
    
    function format_SSN($SSN) {
        $formated_SSN = substr($SSN,0,6) . "-".substr($SSN,6);
        return $formated_SSN;
    }
    
    function format_Currency($num, $decimal_symbol = ',') {
        
        //output format:  100 000 000,50
        $digitGroupSymbol = ' ';
        $numParts = explode('.', $num);
        $isPositive = ($num == abs($num));
        $hasDecimals = (count($numParts) > 1);
        $decimals = ($hasDecimals ? (string) $numParts[1] : '00');
        $num = abs($numParts[0]);
        
        for ($i = 0 ; $i < floor((strlen($num) - (1 + $i)) / 3) ; $i++) {
                $num = substr($num, 0, strlen($num) - (4 * $i + 3)) . $digitGroupSymbol . substr($num, strlen($num) - (4 * $i + 3));
        }
        
        $format = $isPositive ? '' : '-';
        $num = $format. $num. $decimal_symbol . $decimals;
        return $num;
    }
    
    function make_check_enabled($startX, $startY, $xLength = 3.9, $yLength = 4.1){
        $bottom_corner_x = $startX+$xLength;
        $bottom_corner_y = $startY+$yLength;
        $this->Line($startX, $startY, $bottom_corner_x, $bottom_corner_y);
        $this->Line($startX, $bottom_corner_y, $bottom_corner_x, $startY);
    }
    
    function make_check_enabled_new_kn($startX, $startY, $xLength = 3.4, $yLength = 3.5){
        $bottom_corner_x = $startX+$xLength;
        $bottom_corner_y = $startY+$yLength;
        $this->Line($startX, $startY, $bottom_corner_x, $bottom_corner_y);
        $this->Line($startX, $bottom_corner_y, $bottom_corner_x, $startY);
    }

    function format_time($time) {
        if(trim($time) == '') return '';

        $time = sprintf('%05.02f', trim($time));
        // echo $time.'<br>';
        // $patterns = array('/./'); //to remove space from values
        // $replaces = array(',');
        
        // $formatted_time = preg_replace($patterns, $replaces, $time);
        // $formatted_time = str_replace('.', ',', $time);
        $formatted_time = $time;

        return $formatted_time;
    }
}
?>