<?php
/**
* Author: Shamsudheen <shamsu@arioninfotech.com>
* for: FKKN customer work report
*/

require_once('./plugins/F_pdf.class.php');
require_once('./plugins/fpdi/fpdi.php');

class PDF_customer extends FPDI {
    
    var $summery_data = array();
    var $tot_normal = 0;
    var $tot_oncall = 0;
    var $tot_beredskap = 0;
    CONST PDF_TPL_VERSION = 'FK3059_013_F_002';
//    var $current_customer_employee_total_normal_hours = 0;  //this variable used for section 7 (now not used)
//    var $current_customer_employee_total_oncall_hours = 0;  //this variable used for section 7 (now not used)
    
    function __construct() {
        parent::__construct();
        $this->SetAuthor('Shamsudheen');
        $this->SetCreator('Shamsudheen');
        $this->SetTitle('FK/KN/TU Report');
        $this->SetAutoPageBreak(FALSE);
    }

    function report_top($month, $year, $fkkn, $kn_headings = array(), $company_data = array()) {
        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0, 50, 50);
        
        $this->SetFont('Times', '', 11);
        $this->SetXY(13, 23);
        $this->Cell(45, 4, utf8_decode('www.forsakringskassan.se'), 0, 1, 'L', FALSE);    //Company Name
            
        
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
            
            
            
            $this->SetXY(105, 43);
            $this->Cell(70, 15, '', 0, 0, 'L', TRUE);      // hide backround information (below the year-month)
            $this->SetFont('Times', 'B', 10);
            $this->SetXY(111, 43);
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
        $this->SetXY(110, 25);
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
        $this->SetXY(13, 71);
        $this->Cell(10, 9, utf8_decode($cust_details[0]['fullname']), 0, 0, 'L', FALSE);    //Customer full name
        $this->SetXY(148, $this->GetY());
        $this->Cell(10, 9, $cust_details[0]['century'] . $this->format_SSN($cust_details[0]['social_security']), 0, 0, 'L', FALSE);    // Personal number

//        $this->Ln(14);
    }

    function SubPart2($emp_details) {
        $this->SetFont('Arial', 'B', 9);
        $this->SetXY(13, 89);
        $this->Cell(10, 9, utf8_decode($emp_details[0]['fullname']), 0, 0, 'L', FALSE);    //Employee Full Name
        $this->SetXY(148, $this->GetY());
        $this->Cell(10, 9, $emp_details[0]['century'] . $this->format_SSN($emp_details[0]['social_security']), 0, 0, 'L', FALSE);    // personel number
        
        $post_city = $emp_details[0]['post'];
        if(trim($emp_details[0]['city']) != '')
            $post_city .= ' '.$emp_details[0]['city'];
        $this->SetXY(13, 98);
        $this->Cell(10, 9, utf8_decode($emp_details[0]['address']), 0, 0, 'L', FALSE);    //Address
        $this->SetXY(103, $this->GetY());
        $this->Cell(10, 9, utf8_decode($post_city), 0, 0, 'L', FALSE);    // Post & city
    }

    function SubPart3_table($work_details) {
        $w = array(7.6, 30, 17.5, 17.5, 17.5);
        $col_h = 6.72;
        $init_y = 145.5;
        $this->SetY($init_y);
        $this->SetFont('Arial', 'B', 9);
        $total_Tid = 0;
        $toal_Jourtid = 0;
        $toal_beredskap = 0;
        $total_content_rows = count($work_details);
        for ($i = 0; $i < 31; $i++) {
            if ($i > 15)
                $this->SetX(103);
            else
                $this->SetX(13);
            
            if ($i <= $total_content_rows - 1) {
                $intpart = floor( $work_details[$i]['time_from'] ); 
                $fraction = $work_details[$i]['time_from'] - $intpart;
                $start_fraction = $fraction * 100 /60;
                $start_from = $start_fraction + $intpart;

                $intpart = floor( $work_details[$i]['time_to'] );
                $fraction = $work_details[$i]['time_to'] - $intpart;
                $end_fraction = $fraction * 100 /60;
                $end_to = $end_fraction + $intpart;
                $total_time = $end_to - $start_from;   // results in 3
            
                $this->Cell($w[0], $col_h, date('d', strtotime($work_details[$i]['date'])), 0, 0, 'C', FALSE);   //table cell 1
                $this->Cell($w[1], $col_h, sprintf('%.02f', $work_details[$i]['time_from']) . '      ' . $work_details[$i]['time_to'], 0, 0, 'C', FALSE);   //table cell 2
                if (in_array($work_details[$i]['type'], array(0,1,2,4,5,6,7,12))) {
                    $this->Cell($w[2], $col_h, sprintf('%.02f', round($total_time, 2)), 0, 0, 'C', FALSE);   //table cell 3
                    $total_Tid = $total_Tid + round($total_time, 2);
                }else
                    $this->Cell($w[2], $col_h, '', 0, 0, 'C', FALSE);   //table cell 3

                if (in_array($work_details[$i]['type'], array(3,13,14))) {
                    $this->Cell($w[3], $col_h, sprintf('%.02f', round($total_time, 2)), 0, 0, 'C', FALSE);   //table cell 4
                    $toal_Jourtid = $toal_Jourtid + round($total_time, 2);
                }else
                    $this->Cell($w[3], $col_h, '', 0, 0, 'C', FALSE);   //table cell 4
				
                if (in_array($work_details[$i]['type'], array(15))) {
                    $this->Cell($w[4], $col_h, sprintf('%.02f', round($total_time, 2)), 0, 0, 'C', FALSE);   //table cell 5
                    $toal_beredskap += round($total_time, 2);
                }else
                    $this->Cell($w[4], $col_h, '', 0, 0, 'C', FALSE);   //table cell 5
            }

            $this->SetY($this->GetY() + $col_h);

            if ($i == 15)
                $this->SetY($init_y);
        }
        $this->SetFont('Arial', 'B', 9);
        $this->SetXY(140.5, 247);
        $this->Cell($w[2], 11, sprintf('%.02f', round($total_Tid, 2)), 0, 0, 'C', FALSE);   //table summery cell
        $this->Cell($w[3], 11, sprintf('%.02f', round($toal_Jourtid, 2)), 0, 0, 'C', FALSE);   //table summery cell
        $this->Cell($w[4], 11, sprintf('%.02f', round($toal_beredskap, 2)), 0, 0, 'C', FALSE);   //table summery cell
        
       // $this->current_customer_employee_total_normal_hours += round($total_Tid, 2);
       // $this->current_customer_employee_total_oncall_hours += round($toal_Jourtid, 2);
        
        $this->tot_normal += $total_Tid;
        $this->tot_oncall += $toal_Jourtid;
        $this->tot_beredskap += $toal_beredskap;
    }

    function SubPart4($emp_details, $sign_details = NULL) {
//        echo "<pre>".print_r($emp_details, 1)."</pre>";
        if (!empty($sign_details) && $sign_details[0]['signin_employee'] == $emp_details[0]['username']) {
            $this->SetFont('Arial', '', 10);
            $this->SetXY(13, 277);
            $this->Cell(45, 9, date("Y-m-d", strtotime($sign_details[0]['signin_date'])) . ", kl. ".date("H.i", strtotime($sign_details[0]['signin_date'])), 0, 0, 'L', FALSE);    //sign date
            
            $this->SetFont('Arial', 'I', 10);
            $this->Cell(90, 9, utf8_decode($emp_details[0]['fullname']), 0, 0, 'L', FALSE);    //sign employee name
            
            $this->SetFont('Arial', 'I', 7.5);
            $this->SetX(118);
            $this->Cell(30, 9, utf8_decode('e-signering via Time2View'), 0, 0, 'R', FALSE);    //side water mark
            
            $this->SetFont('Arial', '', 10);
            $phno = (trim($emp_details[0]['mobile']) != '' ? ($this->formatting_phone($emp_details[0]['mobile'])) : trim($emp_details[0]['phone']));
            $this->SetX(148);
            $this->Cell(40, 9, $phno, 0, 0, 'L', FALSE);    // sign employee tel number
        }
    }

    function SubPart5($this_bargaining, $txt_other_bargaining) {
        if($this_bargaining == 1){          //KFO
            $top_corner_y = 95.7;
            $bottom_corner_y = $top_corner_y+4.1;
            $top_corner_x = 15.7;
            $bottom_corner_x = $top_corner_x+3.9;
            $this->Line($top_corner_x, $top_corner_y, $bottom_corner_x, $bottom_corner_y);
            $this->Line($top_corner_x, $bottom_corner_y, $bottom_corner_x, $top_corner_y);
            
        }else if($this_bargaining == 2){    //KFS
            $top_corner_y = 95.7;
            $bottom_corner_y = $top_corner_y+4.1;
            $top_corner_x = 40.7;
            $bottom_corner_x = $top_corner_x+3.9;
            $this->Line($top_corner_x, $top_corner_y, $bottom_corner_x, $bottom_corner_y);
            $this->Line($top_corner_x, $bottom_corner_y, $bottom_corner_x, $top_corner_y);
            
        }else if($this_bargaining == 3){    //HÖK/AB (SKL)
            $top_corner_y = 95.7;
            $bottom_corner_y = $top_corner_y+4.1;
            $top_corner_x = 65.7;
            $bottom_corner_x = $top_corner_x+3.9;
            $this->Line($top_corner_x, $top_corner_y, $bottom_corner_x, $bottom_corner_y);
            $this->Line($top_corner_x, $bottom_corner_y, $bottom_corner_x, $top_corner_y);
            
        }else if($this_bargaining == 4){    //PAN (SKL)
            $top_corner_y = 95.7;
            $bottom_corner_y = $top_corner_y+4.1;
            $top_corner_x = 103.2;
            $bottom_corner_x = $top_corner_x+3.9;
            $this->Line($top_corner_x, $top_corner_y, $bottom_corner_x, $bottom_corner_y);
            $this->Line($top_corner_x, $bottom_corner_y, $bottom_corner_x, $top_corner_y);
            
        }else if($this_bargaining == 5){    //Vårdföretagarna, bransch G
            $top_corner_y = 95.7;
            $bottom_corner_y = $top_corner_y+4.1;
            $top_corner_x = 135.7;
            $bottom_corner_x = $top_corner_x+3.9;
            $this->Line($top_corner_x, $top_corner_y, $bottom_corner_x, $bottom_corner_y);
            $this->Line($top_corner_x, $bottom_corner_y, $bottom_corner_x, $top_corner_y);
            
        }else if($this_bargaining == 6){    //Annat
            $top_corner_y = 104.7;
            $bottom_corner_y = $top_corner_y+4.1;
            $top_corner_x = 15.7;
            $bottom_corner_x = $top_corner_x+3.9;
            $this->Line($top_corner_x, $top_corner_y, $bottom_corner_x, $bottom_corner_y);
            $this->Line($top_corner_x, $bottom_corner_y, $bottom_corner_x, $top_corner_y);

            $this->SetFont('Arial', '', 11);
            $this->SetXY(33, 103.5);
            $this->Cell(80, 6, utf8_decode(trim($txt_other_bargaining)), 0, 0, 'L', FALSE);    //Annat text
            
        }else if($this_bargaining == 7){        //Assistenten omfattas inte av något kollektivavtal
            $top_corner_y = 104.7;
            $bottom_corner_y = $top_corner_y+4.1;
            $top_corner_x = 118.2;
            $bottom_corner_x = $top_corner_x+3.9;
            $this->Line($top_corner_x, $top_corner_y, $bottom_corner_x, $bottom_corner_y);
            $this->Line($top_corner_x, $bottom_corner_y, $bottom_corner_x, $top_corner_y);
        }
    }

    function SubPart5_new($health_care_agency) {
        if($health_care_agency == 1){
            $top_corner_y = 68.7;
            $bottom_corner_y = $top_corner_y+4.1;
            $top_corner_x = 15.7;
            $bottom_corner_x = $top_corner_x+3.9;
            $this->Line($top_corner_x, $top_corner_y, $bottom_corner_x, $bottom_corner_y);
            $this->Line($top_corner_x, $bottom_corner_y, $bottom_corner_x, $top_corner_y);
        }
    }
    
    function SubPart6($company_data, $employer_sign_details, $this_agreement) {
        $this->SetFont('Arial', 'B', 10);
        $this->SetXY(13, 172);
        $this->Cell(70, 8, utf8_decode($company_data['name']), 0, 0, 'L', FALSE);    //Company name
        $this->SetXY(148, $this->GetY());
        $this->Cell(30, 8, utf8_decode($company_data['org_no']), 0, 0, 'L', FALSE);    // Organization number
        
        $contact_person_name = trim($company_data['contact_person1']) != '' ? trim($company_data['contact_person1']) : trim($company_data['contact_person2']);
        $phone = trim($company_data['phone']) != '' ? trim($company_data['phone']) : trim($company_data['mobile']);
        $this->SetXY(13, 181.5);
        $this->Cell(70, 8, utf8_decode($contact_person_name), 0, 0, 'L', FALSE);    //Contact Person 1 or 2
        $this->SetXY(148, $this->GetY());
        $this->Cell(30, 8, utf8_decode($phone), 0, 0, 'L', FALSE);    // Phone number
        
        if(!empty($this_agreement)){
            if($this_agreement['type1'] == 1){      //Check box - Vi är arbetsgivare för assistenten och har avtal med personen som får personlig assistans
                $top_corner_y = 190.2;
                $bottom_corner_y = $top_corner_y+4.1;
                $top_corner_x = 15.7;
                $bottom_corner_x = $top_corner_x+3.9;
                $this->Line($top_corner_x, $top_corner_y, $bottom_corner_x, $bottom_corner_y);
                $this->Line($top_corner_x, $bottom_corner_y, $bottom_corner_x, $top_corner_y);

            }
            if($this_agreement['type2'] == 1){     //Check box - Vi är uppdragsgivare åt assistenten som är anställd av en annan arbetsgivare
                $top_corner_y = 199.2;
                $bottom_corner_y = $top_corner_y+4.1;
                $top_corner_x = 15.7;
                $bottom_corner_x = $top_corner_x+3.9;
                $this->Line($top_corner_x, $top_corner_y, $bottom_corner_x, $bottom_corner_y);
                $this->Line($top_corner_x, $bottom_corner_y, $bottom_corner_x, $top_corner_y);

                $this->SetXY(80.5, 199.2);
//                $this->Cell(60, 7, utf8_decode($company_data['name']), 0, 0, 'L', FALSE);    //Arbetsgivarens namn (Company name)
                $this->Cell(60, 7, utf8_decode($this_agreement['type2_company']), 0, 0, 'L', FALSE);    //Arbetsgivarens namn (Company name)
                $this->SetXY(148, $this->GetY());
//                $this->Cell(30, 7, utf8_decode($company_data['org_no']), 0, 0, 'L', FALSE);    // Company Organization number
                $this->Cell(30, 7, utf8_decode($this_agreement['type2_orgno']), 0, 0, 'L', FALSE);    // Company Organization number

            }
            if($this_agreement['type3'] == 1){     //Check box - Vi har tillstånd från Socialstyrelsen eller Inspektionen för vård och omsorg (gäller inte kommunen)
                $top_corner_y = 208.2;
                $bottom_corner_y = $top_corner_y+4.1;
                $top_corner_x = 15.7;
                $bottom_corner_x = $top_corner_x+3.9;
                $this->Line($top_corner_x, $top_corner_y, $bottom_corner_x, $bottom_corner_y);
                $this->Line($top_corner_x, $bottom_corner_y, $bottom_corner_x, $top_corner_y);
            }
        }
        
        if(!empty($employer_sign_details) && !empty($employer_sign_details[0]['employee_data'])){
            $this->SetXY(13, 234);
            $this->SetFont('Arial', '', 10);
            $this->Cell(30, 9, date("Y-m-d H.i", strtotime($employer_sign_details[0]['employee_data'][0]['signing_date'])), 0, 0, 'L', FALSE);    //employer sign date
            
            $this->SetFont('Arial', 'I', 10);
            $this->Cell(95, 9, utf8_decode($employer_sign_details[0]['employee_data'][0]['employer_name']), 0, 0, 'L', FALSE);    //signed employer name
            
            $this->SetFont('Arial', 'I', 7.5);
            $this->SetX(105);
            $this->Cell(33, 9, utf8_decode('e-signering via Time2View'), 0, 0, 'R', FALSE);    //side water mark
            
            $this->SetFont('Arial', '', 10);
            $this->Cell(45, 9, utf8_decode($employer_sign_details[0]['employee_data'][0]['employer_role']), 0, 0, 'L', FALSE);    // signed employer roll
            
        }
    }
    
    function SubPart7_new($month_start_date, $month_end_date, $employee_period_actual_hours = array(), $special_calculation_array = array()) {
        $this->SetFont('Arial', 'B', 10);
        $this->SetXY(13, 141);
        $this->Cell(70, 8, $month_start_date, 0, 0, 'L', FALSE);    //This month start date
        $this->SetXY(103.5, $this->GetY());
        $this->Cell(30, 8, $month_end_date, 0, 0, 'L', FALSE);    //This month end date
        
        if(!empty($employee_period_actual_hours)){
//            $total_work_hours = $this->current_customer_employee_total_normal_hours + ($this->current_customer_employee_total_oncall_hours / 4);
            $this->SetXY(13, 150);
//            $this->Cell(30, 8, sprintf('%.02f', round($total_work_hours, 2)), 0, 0, 'L', FALSE);    //Total work hours
//            $this->Cell(30, 8, sprintf('%.02f', round($employee_period_contract_hours['contract_hours'], 2)), 0, 0, 'L', FALSE);    //Total work hours
            
            $total_employee_period_actual_hours = round($employee_period_actual_hours['TOTAL_NORMAL'] + $employee_period_actual_hours['TOTAL_ONCALL'] + $employee_period_actual_hours['TOTAL_BEREDSKAP'], 2);
            $this->Cell(30, 8, sprintf('%.02f', $total_employee_period_actual_hours), 0, 0, 'L', FALSE);    //Total work hours
        }
        
        if(!empty($special_calculation_array)){
            $this->SetXY(90, 150);
            $special_calculation_output = utf8_decode('Från: '). $special_calculation_array['calculation_period_start_date'] . utf8_decode(' Till: ') . $special_calculation_array['calculation_period_end_date'] . '   ' . sprintf('%.02f', $special_calculation_array['total_actual_hours']);
            $this->Cell(103, 8, $special_calculation_output, 0, 0, 'R', FALSE);   //Total work hours
        }
    }
    
    function Sidelabel() {
//        $this->SetFont('Arial', '', 9);
//        $this->Rotate(90, 60, 60);
//        $this->Text(-54.5, 9, '30591101');
//        $this->Rotate(0);

        $this->SetFont('Arial', '', 8);
        $this->Rotate(90, 60, 60);
        //$this->Cell(100,8,'F K 3059 (009 F 004) Fastställd av Försäkringskassan',0,0,'L',true);   //table summery cell
//        $this->Text(-163, 10.5, utf8_decode('F K 3059 (009 F 004) Fastställd av Försäkringskassan'));
        $this->Text(-163, 10.5, utf8_decode('F K 3059 (013 F 002) Fastställd av Försäkringskassan'));
        
        $this->Rotate(90, 60, 60);
        $this->SetFont('Arial', '', 10);
        $this->Text(-58, 10, utf8_decode('30591104'));
        
        $this->Rotate(0);
    }

    /*function Footer() {
        $this->AliasNbPages();
        $this->SetY(-15);
        $this->SetFont('Arial', '', 6);
//        $this->SetTextColor(128);
//        $this->Cell(30,10,date("F d, Y h:i:s A"),0,0,'C');
        $this->SetX(-25);
        $this->Cell(10, 10, $this->PageNo() . '/{nb}', 0, 0, 'C');
    }*/
    
    function Header(){
        $this->AliasNbPages();
        $this->SetXY(-25,8);
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
            
            
            
            $this->SetXY(105, 43);
            $this->Cell(70, 15, '', 0, 0, 'L', TRUE);      // hide backround information (below the year-month)
            $this->SetFont('Times', 'B', 10);
            $this->SetXY(111, 43);
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
        $this->SetXY(110, 25);
        $this->Cell(29, 7, $year . ' - ' . sprintf("%02d",$month), 0, 0, 'L', FALSE);      // month and year figure
    }

    function summery_SubPart1($cust_details) {
        $this->SetFont('Arial', 'B', 9);
        $this->SetXY(13, 125);
        $this->Cell(10, 9, utf8_decode($cust_details[0]['fullname']), 0, 0, 'L', FALSE);    //Customer Full name
        $this->SetX(148);
        $this->Cell(10, 9, $cust_details[0]['century'] . $this->format_SSN($cust_details[0]['social_security']), 0, 0, 'L', FALSE);    // Customer SSN
    }

    function summery_SubPart2($no_of_employees_have_slots) {

        $this->SetFont('Arial', 'B', 9);
        $this->SetXY(41, 147.5);
        $this->Cell(10, 9, sprintf('%.02f', round($this->tot_oncall, 2)), 0, 0, 'L', FALSE);    //total oncall hours
        $this->SetX(91);
        $this->Cell(10, 9, sprintf('%.02f', round($this->tot_beredskap, 2)), 0, 0, 'L', FALSE);   //value name3
        
        $this->SetXY(43, 156);
        $quarter = ($this->tot_oncall) / 4;
        $one_seventh = ($this->tot_beredskap) / 7;
        $this->Cell(10, 9, sprintf('%.02f', round($quarter, 2)), 0, 0, 'L', FALSE);    // quarter hours of total oncall
        $this->SetX(93);
        $this->Cell(10, 9, sprintf('%.02f', round($one_seventh, 2)), 0, 0, 'L', FALSE);   //value name5

        $this->SetX(14);
        $this->Cell(10, 9, sprintf('%.02f', round($this->tot_normal, 2)), 0, 0, 'L', FALSE);    //total Normal hours
        $this->SetX(152.5);
        $total_summery = $this->tot_normal + $quarter + $one_seventh;
//        $this->Cell(10, 9, sprintf('%.02f', round($total_summery, 2)), 0, 0, 'L', FALSE);   //normal + quarter hours
        $this->Cell(10, 9, round($total_summery), 0, 0, 'L', FALSE);   //normal + quarter hours

        $this->SetXY(42, 165);
        $this->Cell(10, 9, $no_of_employees_have_slots, 0, 0, 'L', FALSE);    //total No. of employees who have slots
    }

    function summery_SubPart3() {
        
        $check_values = explode('||', $this->summery_data[0]['how_is_asst_provided']);
        //row 1
        if ($check_values[0] == 1) {
            $top_corner_y = 197;
            $bottom_corner_y = $top_corner_y+4.1;
            $top_corner_x = 15.7;
            $bottom_corner_x = $top_corner_x+3.9;
            $this->Line($top_corner_x, $top_corner_y, $bottom_corner_x, $bottom_corner_y);
            $this->Line($top_corner_x, $bottom_corner_y, $bottom_corner_x, $top_corner_y);
        }

        //row 2
        if ($check_values[1] == 1) {
            $top_corner_y = 206;
            $bottom_corner_y = $top_corner_y+4.1;
            $top_corner_x = 15.7;
            $bottom_corner_x = $top_corner_x+3.9;
            $this->Line($top_corner_x, $top_corner_y, $bottom_corner_x, $bottom_corner_y);
            $this->Line($top_corner_x, $bottom_corner_y, $bottom_corner_x, $top_corner_y);

            $this->SetXY(148, 206.5);
            if(trim($this->summery_data[0]['how_is_asst_provided_orgno']) != ''){
                $this->summery_data[0]['how_is_asst_provided_orgno'] = str_replace(array("-", " ", ",", ".", "_"), "", strip_tags($this->summery_data[0]['how_is_asst_provided_orgno']));
                $this->summery_data[0]['how_is_asst_provided_orgno'] = substr($this->summery_data[0]['how_is_asst_provided_orgno'], 0, 6) . "-" . substr($this->summery_data[0]['how_is_asst_provided_orgno'], 6);
            }
            $this->Cell(40, 7, utf8_decode($this->summery_data[0]['how_is_asst_provided_orgno']), 0, 0, 'L', FALSE);    //organization number
        }

        //row 3
        if ($check_values[2] == 1) {
            $top_corner_y = 215;
            $bottom_corner_y = $top_corner_y+4.1;
            $top_corner_x = 15.7;
            $bottom_corner_x = $top_corner_x+3.9;
            $this->Line($top_corner_x, $top_corner_y, $bottom_corner_x, $bottom_corner_y);
            $this->Line($top_corner_x, $bottom_corner_y, $bottom_corner_x, $top_corner_y);
        }

        //row 4
        if ($check_values[3] == 1) {
                $top_corner_y = 226.2;
                $bottom_corner_y = $top_corner_y+4.1;
                $top_corner_x = 15.7;
                $bottom_corner_x = $top_corner_x+3.9;
                $this->Line($top_corner_x, $top_corner_y, $bottom_corner_x, $bottom_corner_y);
                $this->Line($top_corner_x, $bottom_corner_y, $bottom_corner_x, $top_corner_y);
            }
    }

    function summery_SubPart4() {
        
        //row 1
        if ($this->summery_data[0]['did_u_hostpilized_this_month'] == 0) {
            $top_corner_y = 248.7;
            $bottom_corner_y = $top_corner_y+4.1;
            $top_corner_x = 15.7;
            $bottom_corner_x = $top_corner_x+3.9;
            $this->Line($top_corner_x, $top_corner_y, $bottom_corner_x, $bottom_corner_y);
            $this->Line($top_corner_x, $bottom_corner_y, $bottom_corner_x, $top_corner_y);
        }
        
        //row 2
        if ($this->summery_data[0]['did_u_hostpilized_this_month'] == 1) {
            $top_corner_y = 257.7;
            $bottom_corner_y = $top_corner_y+4.1;
            $top_corner_x = 15.7;
            $bottom_corner_x = $top_corner_x+3.9;
            $this->Line($top_corner_x, $top_corner_y, $bottom_corner_x, $bottom_corner_y);
            $this->Line($top_corner_x, $bottom_corner_y, $bottom_corner_x, $top_corner_y);
            
            $this->SetXY(28, 258);
            $this->Cell(35, 7, $this->summery_data[0]['hostpilized_date_from'], 0, 0, 'L', FALSE);    //date-from
            $this->SetX(65.7);
            $this->Cell(35, 7, $this->summery_data[0]['hostpilized_date_to'], 0, 0, 'L', FALSE);    //date-to
            $this->SetX(103.5);
            $this->Cell(60, 7, utf8_decode($this->summery_data[0]['hospital']), 0, 0, 'L', FALSE);    //date-to
        }
        
        //row 3
        if ($this->summery_data[0]['did_u_included_hospitalized_hours'] == 1) {
            $top_corner_y = 266.7;
            $bottom_corner_y = $top_corner_y+4.1;
            $top_corner_x = 15.7;
            $bottom_corner_x = $top_corner_x+3.9;
            $this->Line($top_corner_x, $top_corner_y, $bottom_corner_x, $bottom_corner_y);
            $this->Line($top_corner_x, $bottom_corner_y, $bottom_corner_x, $top_corner_y);
            
            $this->SetXY(103.5, 267);
            $this->Cell(18, 7, $this->summery_data[0]['hostpitalized_hours'], 0, 0, 'L', FALSE);    //date-from
        }
    }

    function summery_SubPart5() {
        $this->SetFont('Arial', 'B', 9);
        $this->SetXY(13, 27);
        $this->MultiCell(135, 3.7, utf8_decode($this->summery_data[0]['other_info']), 0, 'L');    //Other information

        if ($this->summery_data[0]['did_u_provide_info_annex'] == 1) {
            $top_corner_y = 35;
            $bottom_corner_y = $top_corner_y+4.1;
            $top_corner_x = 150.7;
            $bottom_corner_x = $top_corner_x+3.9;
            $this->Line($top_corner_x, $top_corner_y, $bottom_corner_x, $bottom_corner_y);
            $this->Line($top_corner_x, $bottom_corner_y, $bottom_corner_x, $top_corner_y);
        }
    }

    function summery_Sidelabel() {
        $this->SetFont('Arial', '', 8);
        $this->Rotate(90, 60, 60);
//        $this->Text(-147.5, 9, utf8_decode('F K 3057 (012 F 002) Fastställd av Försäkringskassan'));
//        $this->Text(-168, 10, utf8_decode('FK 3057 (013 F 001)'));
        $this->Text(-168, 10, utf8_decode('FK 3057 (013 F 005) Fastställd av Försäkringskassan'));
        
        $this->Rotate(90, 60, 60);
        $this->SetFont('Arial', '', 10);
        $this->Text(-58, 10, utf8_decode('30571102'));
        
        $this->Rotate(0);
    }

    function summery_report_top_2($cust_details) {
        $this->SetFont('Times', 'B', 10);
        $this->SetXY(148, 15);
        $this->Cell(25, 5, $cust_details[0]['century'] . $this->format_SSN($cust_details[0]['social_security']), 0, 0, 'L', FALSE);      // personal number
    }

    function summery_SubPart6() {
        
        if ($this->summery_data[0]['signature_options'] == 1 || $this->summery_data[0]['signature_options'] == 2 || $this->summery_data[0]['signature_options'] == 3) {
//            $customer_mobile = (trim($cust_details[0]['phone']) != '') ? trim($cust_details[0]['phone']) : trim($cust_details[0]['mobile']);
            $this->SetXY(13, 82);
            $this->Cell(45, 7, utf8_decode($this->summery_data[0]['sign_date']), 0, 0, 'L', FALSE);    //sign date
            
            
            $this->SetXY(148.5, 82);
            $this->Cell(45, 7, utf8_decode($this->summery_data[0]['signed_customer_phno']), 0, 0, 'L', FALSE);    //Customer telephone
        }
        //
        //choice 1
        if ($this->summery_data[0]['signature_options'] == 1) {
            $top_corner_y = 93.5;
            $bottom_corner_y = $top_corner_y+4.1;
            $top_corner_x = 15.7;
            $bottom_corner_x = $top_corner_x+3.9;
            $this->Line($top_corner_x, $top_corner_y, $bottom_corner_x, $bottom_corner_y);
            $this->Line($top_corner_x, $bottom_corner_y, $bottom_corner_x, $top_corner_y);
        }
        
        //choice 2
        if ($this->summery_data[0]['signature_options'] == 2) {
            $top_corner_y = 93.5;
            $bottom_corner_y = $top_corner_y+4.1;
            $top_corner_x = 58.2;
            $bottom_corner_x = $top_corner_x+3.9;
            $this->Line($top_corner_x, $top_corner_y, $bottom_corner_x, $bottom_corner_y);
            $this->Line($top_corner_x, $bottom_corner_y, $bottom_corner_x, $top_corner_y);
        }
        
        //choice 3
        if ($this->summery_data[0]['signature_options'] == 3) {
            $top_corner_y = 93.5;
            $bottom_corner_y = $top_corner_y+4.1;
            $top_corner_x = 103.2;
            $bottom_corner_x = $top_corner_x+3.9;
            $this->Line($top_corner_x, $top_corner_y, $bottom_corner_x, $bottom_corner_y);
            $this->Line($top_corner_x, $bottom_corner_y, $bottom_corner_x, $top_corner_y);
        }
    }

    function summery_SubPart7() {
        
        $this->SetXY(13, 121);
        $this->Cell(135, 7, utf8_decode($this->summery_data[0]['signed_employer_name']), 0, 0, 'L', FALSE);    //Signed employer name
        $this->SetX(148.5);
        $this->Cell(45, 7, utf8_decode($this->summery_data[0]['signed_employer_telephone']), 0, 0, 'L', FALSE);    //telephone
        
    }

    function summery_SubPart8() {
        
        //row 1 choice
        if ($this->summery_data[0]['do_u_hire_asst_provider'] == 1) {
            $top_corner_y = 46;
            $bottom_corner_y = $top_corner_y+4.1;
            $top_corner_x = 15.7;
            $bottom_corner_x = $top_corner_x+3.9;
            $this->Line($top_corner_x, $top_corner_y, $bottom_corner_x, $bottom_corner_y);
            $this->Line($top_corner_x, $bottom_corner_y, $bottom_corner_x, $top_corner_y);
            
            $this->SetXY(93, 46.5);
            if(trim($this->summery_data[0]['asst_provider_orgno']) != ''){
                $this->summery_data[0]['asst_provider_orgno'] = str_replace(array("-", " ", ",", ".", "_"), "", strip_tags($this->summery_data[0]['asst_provider_orgno']));
                $this->summery_data[0]['asst_provider_orgno'] = substr($this->summery_data[0]['asst_provider_orgno'], 0, 6) . "-" . substr($this->summery_data[0]['asst_provider_orgno'], 6);
            }
            $this->Cell(37, 7, utf8_decode($this->summery_data[0]['asst_provider_orgno']), 0, 0, 'L', FALSE);    //row1 organization number
        }
        
        //row 2 choice
        if ($this->summery_data[0]['have_money_left_not_to_purchase1'] == 0) {
            $top_corner_y = 55.05;
            $bottom_corner_y = $top_corner_y+4.1;
            $top_corner_x = 80.75;
            $bottom_corner_x = $top_corner_x+3.9;
            $this->Line($top_corner_x, $top_corner_ys, $bottom_corner_x, $bottom_corner_y);
            $this->Line($top_corner_x, $bottom_corner_y, $bottom_corner_x, $top_corner_y);
        }else if ($this->summery_data[0]['have_money_left_not_to_purchase1'] == 1) {
            $top_corner_y = 55.05;
            $bottom_corner_y = $top_corner_y+4.1;
            $top_corner_x = 103.3;
            $bottom_corner_x = $top_corner_x+3.9;
            $this->Line($top_corner_x, $top_corner_y, $bottom_corner_x, $bottom_corner_y);
            $this->Line($top_corner_x, $bottom_corner_y, $bottom_corner_x, $top_corner_y);
            
            $this->SetXY(127, 54);
            $this->Cell(22, 7, utf8_decode($this->summery_data[0]['money_left1']), 0, 0, 'C', FALSE);    //money_left1
        }
        
        //row 3 choice
        if ($this->summery_data[0]['is_u_r_ur_asst_provider'] == 1) {
            $top_corner_y = 66.3;
            $bottom_corner_y = $top_corner_y+4.1;
            $top_corner_x = 15.7;
            $bottom_corner_x = $top_corner_x+3.9;
            $this->Line($top_corner_x, $top_corner_y, $bottom_corner_x, $bottom_corner_y);
            $this->Line($top_corner_x, $bottom_corner_y, $bottom_corner_x, $top_corner_y);
        }
        
        //row 4 choice
        if ($this->summery_data[0]['do_u_get_himself_money'] == 1) {
            $top_corner_y = 77.6;
            $bottom_corner_y = $top_corner_y+4.1;
            $top_corner_x = 15.7;
            $bottom_corner_x = $top_corner_x+3.9;
            $this->Line($top_corner_x, $top_corner_y, $bottom_corner_x, $bottom_corner_y);
            $this->Line($top_corner_x, $bottom_corner_y, $bottom_corner_x, $top_corner_y);
        }
        
        $this->SetXY(13, 87);
        $this->Cell(130, 7, utf8_decode($this->summery_data[0]['asst_provider1']), 0, 0, 'L', FALSE);    //assistant provider 1
        $this->SetX(148);
        $this->Cell(50, 7, utf8_decode($this->summery_data[0]['asst_provider_orgno1']), 0, 0, 'L', FALSE);    //assistant provider 1 organization number
        if ($this->summery_data[0]['asst_provider_ftax1'] == 1) {    //assistant provider 1 ftax
            $top_corner_y = 86.7;
            $bottom_corner_y = $top_corner_y+4.1;
            $top_corner_x = 105.7;
            $bottom_corner_x = $top_corner_x+3.9;
            $this->Line($top_corner_x, $top_corner_y, $bottom_corner_x, $bottom_corner_y);
            $this->Line($top_corner_x, $bottom_corner_y, $bottom_corner_x, $top_corner_y);
        }
        
        $this->SetXY(13, 96);
        $this->Cell(130, 7, utf8_decode($this->summery_data[0]['asst_provider2']), 0, 0, 'L', FALSE);    //assistant provider 2
        $this->SetX(148);
        $this->Cell(50, 7, utf8_decode($this->summery_data[0]['asst_provider_orgno2']), 0, 0, 'L', FALSE);    //assistant provider 2 organization number
        if ($this->summery_data[0]['asst_provider_ftax2'] == 1) {    //assistant provider 2 ftax
            $top_corner_y = 95.7;
            $bottom_corner_y = $top_corner_y+4.1;
            $top_corner_x = 105.7;
            $bottom_corner_x = $top_corner_x+3.9;
            $this->Line($top_corner_x, $top_corner_y, $bottom_corner_x, $bottom_corner_y);
            $this->Line($top_corner_x, $bottom_corner_y, $bottom_corner_x, $top_corner_y);
        }
        
        $this->SetXY(13, 105);
        $this->Cell(130, 7, utf8_decode($this->summery_data[0]['asst_provider3']), 0, 0, 'L', FALSE);    //assistant provider 3
        $this->SetX(148);
        $this->Cell(50, 7, utf8_decode($this->summery_data[0]['asst_provider_orgno3']), 0, 0, 'L', FALSE);    //assistant provider 3 organization number
        if ($this->summery_data[0]['asst_provider_ftax3'] == 1) {    //assistant provider 3 ftax
            $top_corner_y = 104.7;
            $bottom_corner_y = $top_corner_y+4.1;
            $top_corner_x = 105.7;
            $bottom_corner_x = $top_corner_x+3.9;
            $this->Line($top_corner_x, $top_corner_y, $bottom_corner_x, $bottom_corner_y);
            $this->Line($top_corner_x, $bottom_corner_y, $bottom_corner_x, $top_corner_y);
        }
        
        //row 8 choice
        if ($this->summery_data[0]['do_u_attach_receipt'] == 1) {
            $top_corner_y = 113.5;
            $bottom_corner_y = $top_corner_y+4.1;
            $top_corner_x = 15.7;
            $bottom_corner_x = $top_corner_x+3.9;
            $this->Line($top_corner_x, $top_corner_y, $bottom_corner_x, $bottom_corner_y);
            $this->Line($top_corner_x, $bottom_corner_y, $bottom_corner_x, $top_corner_y);
        }
        
        
        //row 9 choice
        if ($this->summery_data[0]['money_left_not_to_purchase2'] == 0) {
            $top_corner_y = 122.5;
            $bottom_corner_y = $top_corner_y+4.1;
            $top_corner_x = 80.75;
            $bottom_corner_x = $top_corner_x+3.9;
            $this->Line($top_corner_x, $top_corner_y, $bottom_corner_x, $bottom_corner_y);
            $this->Line($top_corner_x, $bottom_corner_y, $bottom_corner_x, $top_corner_y);
        }else if ($this->summery_data[0]['money_left_not_to_purchase2'] == 1) {
            $top_corner_y = 122.5;
            $bottom_corner_y = $top_corner_y+4.1;
            $top_corner_x = 103.3;
            $bottom_corner_x = $top_corner_x+3.9;
            $this->Line($top_corner_x, $top_corner_y, $bottom_corner_x, $bottom_corner_y);
            $this->Line($top_corner_x, $bottom_corner_y, $bottom_corner_x, $top_corner_y);
            
            $this->SetXY(127, 121.5);
            $this->Cell(22, 7, utf8_decode($this->summery_data[0]['money_left2']), 0, 0, 'C', FALSE);    //money_left1
        }
        
        //row 10 choice
        if ($this->summery_data[0]['do_u_live_outside_EEA_country'] == 1) {
            $top_corner_y = 133.8;
            $bottom_corner_y = $top_corner_y+4.1;
            $top_corner_x = 15.7;
            $bottom_corner_x = $top_corner_x+3.9;
            $this->Line($top_corner_x, $top_corner_y, $bottom_corner_x, $bottom_corner_y);
            $this->Line($top_corner_x, $bottom_corner_y, $bottom_corner_x, $top_corner_y);
        }
    }

    function summery_SubPart9($total_no_of_hours) {
        
        $this->SetXY(13, 157);
        $this->Cell(42, 7, ($this->summery_data[0]['accounting_date_from'] != '' && $this->summery_data[0]['accounting_date_from'] != '0000-00-00' ? $this->summery_data[0]['accounting_date_from'] : ''), 0, 0, 'L', FALSE);    //Date from
        $this->SetX(55.5);
        $this->Cell(42, 7, ($this->summery_data[0]['accounting_date_to'] != '' && $this->summery_data[0]['accounting_date_to'] != '0000-00-00' ? $this->summery_data[0]['accounting_date_to'] : ''), 0, 0, 'L', FALSE);    //Date to

        //table body starts
        $column_x = array(81, 138.5);                 //column x array

        //row 1
        $this->SetXY($column_x[0], 215.5);
        $this->Cell(42, 7, ($this->summery_data[0]['salary_excl_OB_cost'] != 0 ? $this->format_Currency($this->summery_data[0]['salary_excl_OB_cost']) : ''), 0, 0, 'L', FALSE);
        $this->SetX($column_x[1]);
        $this->Cell(42, 7, ($this->summery_data[0]['salary_excl_OB_period'] != 0 ?$this->format_Currency($this->summery_data[0]['salary_excl_OB_period']) : ''), 0, 0, 'L', FALSE);

        //row 2
        $this->SetXY($column_x[0], 224.5);
        $this->Cell(42, 7, ($this->summery_data[0]['salary_OB_cost'] != 0 ? $this->format_Currency($this->summery_data[0]['salary_OB_cost']) : ''), 0, 0, 'L', FALSE);
        $this->SetX($column_x[1]);
        $this->Cell(42, 7, ($this->summery_data[0]['salary_OB_period'] != 0 ? $this->format_Currency($this->summery_data[0]['salary_OB_period']) : ''), 0, 0, 'L', FALSE);

        //row 3
        $this->SetXY($column_x[0], 233.5);
        $this->Cell(42, 7, ($this->summery_data[0]['assist_expenses_cost'] != 0 ? $this->format_Currency($this->summery_data[0]['assist_expenses_cost']) : ''), 0, 0, 'L', FALSE);
        $this->SetX($column_x[1]);
        $this->Cell(42, 7, ($this->summery_data[0]['assist_expenses_period'] != 0 ? $this->format_Currency($this->summery_data[0]['assist_expenses_period']) : ''), 0, 0, 'L', FALSE);

        //row 4
        $this->SetXY($column_x[0], 242.5);
        $this->Cell(42, 7, ($this->summery_data[0]['training_cost'] != 0 ? $this->format_Currency($this->summery_data[0]['training_cost']) : ''), 0, 0, 'L', FALSE);
        $this->SetX($column_x[1]);
        $this->Cell(42, 7, ($this->summery_data[0]['training_period'] != 0 ? $this->format_Currency($this->summery_data[0]['training_period']) : ''), 0, 0, 'L', FALSE);

        //row 5
        $this->SetXY($column_x[0], 251.5);
        $this->Cell(42, 7, ($this->summery_data[0]['staff_expense_cost'] != 0 ? $this->format_Currency($this->summery_data[0]['staff_expense_cost']) : ''), 0, 0, 'L', FALSE);
        $this->SetX($column_x[1]);
        $this->Cell(42, 7, ($this->summery_data[0]['staff_expense_period'] != 0 ? $this->format_Currency($this->summery_data[0]['staff_expense_period']) : ''), 0, 0, 'L', FALSE);

        //row 6
        $this->SetXY($column_x[0], 260.5);
        $this->Cell(42, 7, ($this->summery_data[0]['administration_cost'] != 0 ? $this->format_Currency($this->summery_data[0]['administration_cost']) : ''), 0, 0, 'L', FALSE);
        $this->SetX($column_x[1]);
        $this->Cell(42, 7, ($this->summery_data[0]['administration_period'] != 0 ? $this->format_Currency($this->summery_data[0]['administration_period']) : ''), 0, 0, 'L', FALSE);

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
        $this->SetXY($column_x[0], 269.5);
        $this->Cell(42, 7, ($total_cost_per_hour != 0 ? $this->format_Currency(sprintf('%.02f', round($total_cost_per_hour, 2))) : ''), 0, 0, 'L', FALSE);
        $this->SetX($column_x[1]);
        $this->Cell(42, 7, ($total_cost_for_period != 0 ? $this->format_Currency(sprintf('%.02f', round($total_cost_for_period, 2))) : ''), 0, 0, 'L', FALSE);

        //row 8 - Total work hours
        $this->SetXY($column_x[0], 278.5);
        $this->Cell(42, 7, ($total_no_of_hours != 0 ? $total_no_of_hours : ''), 0, 0, 'L', FALSE);   //total hours in 60
        
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
}
?>