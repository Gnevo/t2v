<?php

require_once('./plugins/F_pdf.class.php');
require_once('./plugins/fpdi/fpdi.php');
require_once('class/dona.php');
require_once('class/contract.php');

class PDF_EMP_Certificate extends FPDI{
    
    var $work_hour = array(); 
    var $leave_hours = array();
    var $over_time = array();
    var $filling_hours = array();

    function __construct() {

        parent::__construct();
        //$this->k=2;
    }

    function P1_SubPart1($employee_Details) {
        //row 1
        $this->SetFont('Arial', '', 9);                                      //     Arbetstagarens efternamn 
        $this->SetXY(19, $this->GetY() + 24);
        $this->Cell(50, 4, utf8_decode($employee_Details['last_name']), 0, 0, 'L', FALSE);


        $this->SetFont('Arial', '', 9);                                      //  Förnamn
        $this->SetXY(78, $this->GetY());
        $this->Cell(50, 4, utf8_decode($employee_Details['first_name']), 0, 0, 'L', FALSE);

        $this->SetFont('Arial', '', 9);                                      //  Personnummer (10 siffror) 
        $this->SetXY(137, $this->GetY());
        // $employee_Details['century']
        $this->Cell(50, 4, $this->format_SSN($employee_Details['social_security']), 0, 0, 'L', FALSE);

        //$this->Ln(15);
    }

    function P1_SubPart2($employment_period_from = Null, $employment_period_to = Null, $still_employed = Null, $post_held = Null, $leave_effective_from = Null, $leave_effective_to = Null, $coverage_in = Null) {
        //row 1
        $this->SetFont('Arial', '', 9);                                      //Anställningstid Fr o m
        $this->SetXY(53, 52);
        $this->Cell(40, 4, utf8_decode($employment_period_from), 0, 0, 'L', FALSE);

        $this->SetFont('Arial', '', 9);                                      //Anställningstid T o m
        $this->SetXY(110, $this->GetY());
        $this->Cell(40, 4, utf8_decode($employment_period_to), 0, 0, 'L', FALSE);

        $this->SetY($this->GetY() - 1.5);
        if ($still_employed == 1) {
            $x_ord = 160;
            $this->Line($x_ord, $this->GetY() + 2.4, $x_ord + 3, $this->GetY() + 5.3);    //drew lines      //fortfarande anställd 
            $this->Line($x_ord, $this->GetY() + 5.3, $x_ord + 3, $this->GetY() + 2.4);    //drew lines
        }




        //row 2

        $this->SetFont('Arial', '', 9);                                      //Befattning (anställd som)
        $this->SetXY(53, $this->GetY() + 9);
        $this->Cell(40, 4, utf8_decode($post_held), 0, 0, 'L', FALSE);



        //row 3

        $this->SetFont('Arial', '', 9);                                      //Tjänsteledig Fr om
        $this->SetXY(53, $this->GetY() + 8);
        $this->Cell(40, 4, utf8_decode($leave_effective_from), 0, 0, 'L', FALSE);

        $this->SetFont('Arial', '', 9);                                      //Tjänsteledig T o m
        $this->SetXY(110, $this->GetY());
        $this->Cell(40, 4, utf8_decode($leave_effective_to), 0, 0, 'L', FALSE);

        $this->SetFont('Arial', '', 9);                                      //Omfattning i %
        $this->SetXY(179, $this->GetY());
        $this->Cell(10, 4, utf8_decode($coverage_in), 0, 0, 'L', FALSE);

        $this->Ln(16);
    }

    function P1_SubPart3($open_ended = Null, $probationary_to = Null, $temporary_employement = Null, $Intermittent_employement = Null) {
        //row 1
//        echo "<pre>".print_r(func_get_args(), 1)."</pre>";
        $this->SetY($this->GetY() + 0.1);
        if ($open_ended == 1) {
            $x_ord = 19.7;
            $this->Line($x_ord, $this->GetY() + 2.4, $x_ord + 3, $this->GetY() + 5.3);    //drew lines       Tillsvidareanställning 
            $this->Line($x_ord, $this->GetY() + 5.3, $x_ord + 3, $this->GetY() + 2.4);    //drew lines
        }

        if ($probationary_to != "") {
            $x_ord = 55.5;
            $this->Line($x_ord, $this->GetY() + 2.4, $x_ord + 3, $this->GetY() + 5.3);    //drew lines       Provanställning  t o m
            $this->Line($x_ord, $this->GetY() + 5.3, $x_ord + 3, $this->GetY() + 2.4);    //drew lines
        }

        $this->SetFont('Arial', '', 9);
        $this->SetXY(90, $this->GetY() + 2);
        $this->Cell(40, 4, utf8_decode($probationary_to), 0, 0, 'L', FALSE);   //Provanställning  t o m
        //row 2
        $this->SetY($this->GetY() + 7);
        if ($temporary_employement != "") {
            $x_ord = 19.7;
            $this->Line($x_ord, $this->GetY() + 2.4, $x_ord + 3, $this->GetY() + 5.3);    //drew lines       Tidsbegränsad anställning
            $this->Line($x_ord, $this->GetY() + 5.3, $x_ord + 3, $this->GetY() + 2.4);    //drew lines
        }

        $this->SetFont('Arial', '', 9);
        $this->SetXY(90, $this->GetY() + 2);
        $this->Cell(40, 4, utf8_decode($temporary_employement), 0, 0, 'L', FALSE);   // Tidsbegränsad anställning  - Avtalat slutdatum
        //row 3
        $this->SetY($this->GetY() + 6.2);
        if ($Intermittent_employement == 1) {
            $x_ord = 19.7;
            $this->Line($x_ord, $this->GetY() + 2.4, $x_ord + 3, $this->GetY() + 5.3);    //drew lines        Intermittent anställning (”behovsanställning”)
            $this->Line($x_ord, $this->GetY() + 5.3, $x_ord + 3, $this->GetY() + 2.4);    //drew lines
        }

        $this->Ln(16);
    }

    function P1_SubPart4($Arbetstid_open_ended = Null, $parttime = Null, $hours_per_week = Null, $full_time_position_in_perc = Null, $working_hours = Null) {
        //row 1
        $this->SetY($this->GetY() + 0.9);
        if ($Arbetstid_open_ended != "") {
            $x_ord = 19.7;
            $this->Line($x_ord, $this->GetY() + 2.4, $x_ord + 3, $this->GetY() + 5.3);    //drew lines       Heltid
            $this->Line($x_ord, $this->GetY() + 5.3, $x_ord + 3, $this->GetY() + 2.4);    //drew lines
        }


        $this->SetFont('Arial', '', 9);
        $this->SetXY(62, $this->GetY() + 2);
        $this->Cell(13, 4, utf8_decode($Arbetstid_open_ended), 0, 0, 'L', FALSE);   // Heltid ange timmar per vecka

        $this->SetY($this->GetY() - 2.5);
        if ($parttime == 1) {
            $x_ord = 78.1;
            $this->Line($x_ord, $this->GetY() + 2.4, $x_ord + 3, $this->GetY() + 5.3);    //drew lines       Deltid
            $this->Line($x_ord, $this->GetY() + 5.3, $x_ord + 3, $this->GetY() + 2.4);    //drew lines
        }

        $this->SetFont('Arial', '', 9);
        $this->SetXY(120, $this->GetY() + 2.5);
        $this->Cell(13, 4, utf8_decode($hours_per_week), 0, 0, 'L', FALSE);   //Deltid, ange timmar per vecka

        $this->SetFont('Arial', '', 9);
        $this->SetXY(149, $this->GetY());
        $this->Cell(9, 4, utf8_decode($full_time_position_in_perc), 0, 0, 'L', FALSE);   //Vilket utgör
//    $this->SetFont('Arial','',9);
//    $this->SetXY(181.5,  $this->GetY());
//    $this->Cell(9,4, utf8_decode('15'),0,0,'L',FALSE);   //% av heltidstjänst
        // row 2


        $this->SetY($this->GetY() + 4.9);
        if ($working_hours == 1) {
            $x_ord = 19.7;
            $this->Line($x_ord, $this->GetY() + 2.4, $x_ord + 3, $this->GetY() + 5.3);    //drew lines      Varierande arbetstid
            $this->Line($x_ord, $this->GetY() + 5.3, $x_ord + 3, $this->GetY() + 2.4);    //drew lines
        }

        $this->Ln(16);
    }

    function P1_SubPart5($employed_by_agency = Null) {

        $this->SetY($this->GetY() + 1);
        if ($employed_by_agency == 1) {
            $x_ord = 75;
            $this->Line($x_ord, $this->GetY() + 2.4, $x_ord + 3, $this->GetY() + 5.3);    //drew lines      ja
            $this->Line($x_ord, $this->GetY() + 5.3, $x_ord + 3, $this->GetY() + 2.4);    //drew lines
        }


        $this->SetY($this->GetY());
        if ($employed_by_agency == 0) {
            $x_ord = 85.1;
            $this->Line($x_ord, $this->GetY() + 2.4, $x_ord + 3, $this->GetY() + 5.3);    //drew lines      Nej
            $this->Line($x_ord, $this->GetY() + 5.3, $x_ord + 3, $this->GetY() + 2.4);    //drew lines
        }

        $this->Ln(16);
    }

    function P1_SubPart6($employment_termination = Null, $temporary_employment_closed = Null, $own_request = Null, $other_reason = Null) {

        //row 1
        $this->SetY($this->GetY() + 1.4);
        if ($employment_termination != "") {
            $x_ord = 19.8;
            $this->Line($x_ord, $this->GetY() + 2.4, $x_ord + 3, $this->GetY() + 5.3);    //drew lines      Uppsägning p.g.a. arbetsbrist
            $this->Line($x_ord, $this->GetY() + 5.3, $x_ord + 3, $this->GetY() + 2.4);    //drew lines
        }

        $this->SetFont('Arial', '', 9);
        $this->SetXY(148, $this->GetY() + 1.5);
        $this->Cell(20, 4, utf8_decode($employment_termination), 0, 0, 'L', FALSE);




        //row 2
        $this->SetY($this->GetY() + 7.5);
        if ($temporary_employment_closed != "") {
            $x_ord = 19.8;
            $this->Line($x_ord, $this->GetY() + 2.4, $x_ord + 3, $this->GetY() + 5.3);    //drew lines      Avslutad tidsbegränsad anställning
            $this->Line($x_ord, $this->GetY() + 5.3, $x_ord + 3, $this->GetY() + 2.4);    //drew lines
        }

        $this->SetFont('Arial', '', 9);
        $this->SetXY(148, $this->GetY() + 1.5);
        $this->Cell(20, 4, utf8_decode($temporary_employment_closed), 0, 0, 'L', FALSE);




        //row 3
        $this->SetY($this->GetY() + 6.7);
        if ($own_request == 1) {
            $x_ord = 19.8;
            $this->Line($x_ord, $this->GetY() + 2.4, $x_ord + 3, $this->GetY() + 5.3);    //drew lines      Den anställdes egen begäran 
            $this->Line($x_ord, $this->GetY() + 5.3, $x_ord + 3, $this->GetY() + 2.4);    //drew lines
        }



        //row 4
        $this->SetY($this->GetY() + 8);
        if ($other_reason != "") {
            $x_ord = 19.8;
            $this->Line($x_ord, $this->GetY() + 2.4, $x_ord + 3, $this->GetY() + 5.3);    //drew lines      Annan orsak
            $this->Line($x_ord, $this->GetY() + 5.3, $x_ord + 3, $this->GetY() + 2.4);    //drew lines
        }

        $this->SetFont('Arial', '', 9);
        $this->SetXY(58, $this->GetY() + 2);
        $this->Cell(20, 4, utf8_decode($other_reason), 0, 0, 'L', FALSE);


        $this->Ln(16);
    }

    function P1_SubPart7($termination_compensation = Null) {

        $this->SetY($this->GetY());
        if ($termination_compensation == 1) {
            $x_ord = 99.8;
            $this->Line($x_ord, $this->GetY() + 2.4, $x_ord + 3, $this->GetY() + 5.3);    //drew lines      ja
            $this->Line($x_ord, $this->GetY() + 5.3, $x_ord + 3, $this->GetY() + 2.4);    //drew lines
        }


        $this->SetY($this->GetY());
        if ($termination_compensation == 0) {
            $x_ord = 109.9;
            $this->Line($x_ord, $this->GetY() + 2.4, $x_ord + 3, $this->GetY() + 5.3);    //drew lines      Nej
            $this->Line($x_ord, $this->GetY() + 5.3, $x_ord + 3, $this->GetY() + 2.4);    //drew lines
        }

        $this->Ln(16);
    }

    function P1_SubPart8($future_work_offer = Null, $future_work_From = Null, $future_work_to = Null, $to_further = Null, $full_time_per_week = Null, $part_time_per_week = Null, $full_time_position_in_perc_Erbjudande = Null, $variable_time = Null, $employer_accepted = Null, $employer_accepted_date_when_no = Null) {
        //row 1
        $this->SetY($this->GetY() + 1.8);
        if ($future_work_offer == 0) {
            $x_ord = 19.8;
            $this->Line($x_ord, $this->GetY() + 2.4, $x_ord + 3, $this->GetY() + 5.3);    //drew lines     Nej
            $this->Line($x_ord, $this->GetY() + 5.3, $x_ord + 3, $this->GetY() + 2.4);    //drew lines
        }

        if ($future_work_offer == 1) {
            $x_ord = 36.7;
            $this->Line($x_ord, $this->GetY() + 2.4, $x_ord + 3, $this->GetY() + 5.3);    //drew lines     Ja
            $this->Line($x_ord, $this->GetY() + 5.3, $x_ord + 3, $this->GetY() + 2.4);    //drew lines
        }

        $this->SetFont('Arial', '', 9);
        $this->SetXY(63, $this->GetY() + 2);
        $this->Cell(20, 4, utf8_decode($future_work_From), 0, 0, 'L', FALSE);   //From

        $this->SetFont('Arial', '', 9);
        $this->SetXY(120, $this->GetY());
        $this->Cell(20, 4, utf8_decode($future_work_to), 0, 0, 'L', FALSE);   //Tom

        $this->SetY($this->GetY() - 2);
        if ($to_further == 1) {
            $x_ord = 170;
            $this->Line($x_ord, $this->GetY() + 2.4, $x_ord + 3, $this->GetY() + 5.3);    //drew lines    tillsvidare
            $this->Line($x_ord, $this->GetY() + 5.3, $x_ord + 3, $this->GetY() + 2.4);    //drew lines
        }



        //row 2
        $this->SetY($this->GetY() + 8.2);
        if ($full_time_per_week != "") {
            $x_ord = 28.5;
            $this->Line($x_ord, $this->GetY() + 2.4, $x_ord + 3, $this->GetY() + 5.3);    //drew lines     Heltid 
            $this->Line($x_ord, $this->GetY() + 5.3, $x_ord + 3, $this->GetY() + 2.4);    //drew lines
        }

        $this->SetFont('Arial', '', 9);
        $this->SetXY(67, $this->GetY() + 2);
        $this->Cell(20, 4, utf8_decode($full_time_per_week), 0, 0, 'L', FALSE);   //Heltid   Ange timmar per vecka
        //row 3
        $this->SetY($this->GetY() + 5);
        if ($part_time_per_week != "") {
            $x_ord = 28.5;
            $this->Line($x_ord, $this->GetY() + 2.4, $x_ord + 3, $this->GetY() + 5.3);    //drew lines     Deltid
            $this->Line($x_ord, $this->GetY() + 5.3, $x_ord + 3, $this->GetY() + 2.4);    //drew lines
        }

        $this->SetFont('Arial', '', 9);
        $this->SetXY(67, $this->GetY() + 2);
        $this->Cell(20, 4, utf8_decode($part_time_per_week), 0, 0, 'L', FALSE);   //Deltid   Ange timmar per vecka

        $this->SetFont('Arial', '', 9);
        $this->SetXY(108, $this->GetY());
        $this->Cell(5, 4, utf8_decode($full_time_position_in_perc_Erbjudande), 0, 0, 'L', FALSE);   //Vilket är  % av heltidstjänst
        // row 4
        $this->SetY($this->GetY() + 5);
        if ($variable_time == 1) {
            $x_ord = 19.8;
            $this->Line($x_ord, $this->GetY() + 2.4, $x_ord + 3, $this->GetY() + 5.3);    //drew lines     Varierande arbetstid (timanställning)
            $this->Line($x_ord, $this->GetY() + 5.3, $x_ord + 3, $this->GetY() + 2.4);    //drew lines
        }



        // row 5
        $this->SetY($this->GetY() + 7.8);
        if ($employer_accepted == 1) {
            $x_ord = 58.8;
            $this->Line($x_ord, $this->GetY() + 2.4, $x_ord + 3, $this->GetY() + 5.3);    //drew lines     Ja
            $this->Line($x_ord, $this->GetY() + 5.3, $x_ord + 3, $this->GetY() + 2.4);    //drew lines
        }
        $this->SetY($this->GetY());
        if ($employer_accepted == 0) {
            $x_ord = 68.9;
            $this->Line($x_ord, $this->GetY() + 2.4, $x_ord + 3, $this->GetY() + 5.3);    //drew lines     Nej
            $this->Line($x_ord, $this->GetY() + 5.3, $x_ord + 3, $this->GetY() + 2.4);    //drew lines
        }

        $this->SetFont('Arial', '', 9);
        $this->SetXY(131, $this->GetY() + 2);
        $this->Cell(20, 4, utf8_decode($employer_accepted_date_when_no), 0, 0, 'L', FALSE);   //Ange datum då han/hon tackade nej  
    }

    function P1_SubPart9($logged_emp_name){
        $this->SetFont('Arial', 'I', 7.5);
        $this->SetTextColor(0,0,0,0);
        $this->SetXY(50,270);
        $this->Cell(30, 6, utf8_decode('e-signering via Time2View'), 0, 0, 'L', FALSE);

        $this->SetFont('Arial', 'I', 7.5);
        $this->SetTextColor(0,0,0);
        $this->SetXY(85,270);
        $this->Cell(30, 6, $this->timezone_set(), 0, 0, 'L', FALSE);
         // $this->Ln(2);
        $this->SetAutoPageBreak(false);
         $this->SetFont('Arial', '', 9);
        $this->SetXY(50,276.5);
        $this->Cell(30, 6, $logged_emp_name, 0, 0, 'L', FALSE);
        $this->SetAutoPageBreak(true);
        // $this->write(5, $logged_emp_name,'');
    }

    function P2_SubPart10($employee_Details) {


        $this->SetFont('Arial', '', 12);
        $this->SetXY(137, $this->GetY() + 9);
        //$employee_Details['century']
        $this->Cell(30, 6, $this->format_SSN($employee_Details['social_security']), 0, 0, 'L', FALSE);   //  Personnummer (10 siffror)

        $this->Ln(16);
    }

    function P2_SubPart11_old($employee = Null, $year1 = Null, $end_year = Null, $start_month = Null, $end_month = Null, $year2 = Null) {
//        echo "***<pre>P2_SubPart11: ".print_r(func_get_args(), 1)."</pre>"; exit();
        $this->SetFont('Arial', '', 12);
        $this->SetXY(82, $this->GetY() + 2);
        $this->Cell(30, 6, $year1, 0, 0, 'L', FALSE);   //  Fr o m

        $this->SetFont('Arial', '', 12);
        $this->SetXY(139, $this->GetY());
        if ($year2 != Null)
            $this->Cell(30, 6, $year2, 0, 0, 'L', FALSE);   //  T o m
        else
            $this->Cell(30, 6, $year1, 0, 0, 'L', FALSE);   //  T o m

//        echo "<pre>".print_r(array($employee, $year1, $year2, $start_month, $end_month, $end_year), 1)."</pre>";
        
        $left_tbl_start_month = (($year1 != $end_year ) || ($year1 == $end_year && $year2 == NULL)? $start_month : 1 );
        $left_tbl_end_month = ($year1 == $end_year ? $end_month : 12  );
        $right_tbl_start_month = ($year1 == $end_year ? $start_month : 1 );
        $right_tbl_end_month = ($year2 == NULL || $year2 == $end_year ? $end_month : 12 );
            
        $this->P2_SubPart11_Table($employee, $year1, $left_tbl_start_month, $left_tbl_end_month, 'LEFT');
        if($year2 != NULL)
            $this->P2_SubPart11_Table($employee, $year2, $right_tbl_start_month, $right_tbl_end_month, 'RIGHT');
//        echo 'A'; exit();
        $this->Ln(16);
    }

    function P2_SubPart11_Table_old($employee, $year, $start_month, $end_month, $table = 'LEFT') {
//        echo "<pre>P2_SubPart11_Table: ".print_r(func_get_args(), 1)."</pre>"; exit();
        $dona = new dona();
        $obj_contract = new contract();
//        if ($table == 'RIGHT'){echo "<pre>" . print_r(array($employee, $year, $start_month, $end_month), 1) . "</pre>"; exit();}
        $works = $dona->get_work_details_For_certification($employee, $year, $start_month, $end_month); //, $this->Certification_period_to);
//        if ($table == 'RIGHT'){echo "<pre>" . print_r($works, 1) . "</pre>"; exit();}
        $w = array(23, 17.2, 17, 17);
        $col_h = 7;
        $this->SetFont('Arial', '', 9);                           //Förnamn
        $this->SetY(52.5);
        for ($i = 1; $i <= 12; $i++) {
            if($table == 'LEFT')
                $this->SetX(30.4);
            else
                $this->SetX(120.4);
            if(!empty($works)){
                foreach ($works as $w1) {
                    if ($i == $w1['month']) {
                        /*$cont_hour = $dona->employee_contract_month($employee, $year, $w1['month']);
                        $hour_sum = 0;
                        if ($cont_hour) {
                            foreach ($cont_hour as $entry)
                                $hour_sum = $hour_sum + $entry['hour'];
                        }*/
                        $this_month_start_date = date('Y-m-01', strtotime($year . "-" . $w1['month'] . "-01"));
                        $this_month_end_date = date('Y-m-t', strtotime($year . "-" . $w1['month'] . "-01"));;
                        $cont_hour = $obj_contract->get_employee_contract_between_dates($employee, $this_month_start_date, $this_month_end_date);
//                        echo "<pre>Edited" . print_r($cont_hour, 1) . "</pre>******";
//                        echo "<pre>".print_r($w1, 1)."</pre>";
                        $hour_sum = isset($cont_hour['contract_hours']) && $cont_hour['contract_hours'] > 0 ? $cont_hour['contract_hours'] : 0;
                        $w_hour = ($hour_sum == 0  || $hour_sum >= $w1['work_hours']) ? $w1['work_hours'] : $hour_sum;
                        $ot_hour = ($hour_sum == 0 || $hour_sum >= $w1['work_hours']) ? 0 : ($w1['work_hours'] - $hour_sum);

                        $this->Cell($w[0], $col_h, $w_hour, 0, 0, 'C', FALSE);   //table cell 1
                        $this->Cell($w[1], $col_h, $w1['leave_hours'], 0, 0, 'C', FALSE);   //table cell 2
                        $this->Cell($w[2], $col_h, ($ot_hour != 0 ? $ot_hour : ''), 0, 0, 'C', FALSE);   //table cell 3
                        $this->Cell($w[3], $col_h, $w1['filling_hours'], 0, 0, 'C', FALSE);   //table cell 4   
                        break;
                    }
                }
            }
            $this->SetY($this->GetY() + $col_h);
        }
//        echo 'A'; exit();
        $this->Ln(13);
    }

 function P2_SubPart11($employee = Null, $year1 = Null, $end_year = Null, $start_month = Null, $end_month = Null, $year2 = Null) {
       // echo "***<pre>P2_SubPart11: ".print_r(func_get_args(), 1)."</pre>"; exit();
        // if(is_array($year2)){
        //     $year2 = $year1+1;
        // }
        // echo 'year1 = '.$year1.'       ';
        // echo '<pre>'.print_r($year2).'</pre>';


        $this->SetFont('Arial', '', 12);
        $this->SetXY(82, $this->GetY() + 2);
        $this->Cell(30, 6, $year1, 0, 0, 'L', FALSE);   //  Fr o m

        $this->SetFont('Arial', '', 12);
        $this->SetXY(139, $this->GetY());
        if ($year2 != Null)
            $this->Cell(30, 6, $year2, 0, 0, 'L', FALSE);   //  T o m
        else
            $this->Cell(30, 6, $year1, 0, 0, 'L', FALSE);   //  T o m

       // echo "<pre>".print_r(array($employee, $year1, $year2, $start_month, $end_month, $end_year), 1)."</pre>";
        
        $left_tbl_start_month = (($year1 != $end_year ) || ($year1 == $end_year && $year2 == NULL)? $start_month : 1 );
        $left_tbl_end_month = ($year1 == $end_year ? $end_month : 12  );
        $right_tbl_start_month = ($year1 == $end_year ? $start_month : 1 );
        $right_tbl_end_month = ($year2 == NULL || $year2 == $end_year ? $end_month : 12 );
         
        $this->P2_SubPart11_Table($employee, $year1, $left_tbl_start_month, $left_tbl_end_month, 'LEFT');
        if($year2 != NULL)
            $this->P2_SubPart11_Table($employee, $year2, $right_tbl_start_month, $right_tbl_end_month, 'RIGHT');
       // echo 'A'; exit()
        $this->Ln(16);
    }

    function P2_SubPart11_Table($employee, $year, $start_month, $end_month, $table = 'LEFT') {
        // echo $year;
        // echo '<pre>'.print_r(count($work_hour)).'</pre>';
        // if(count($work_hour)>0||count($leave_hours)>0||count($over_time)>0||count($filling_hours)>0){
            $work_hour = $this->work_hour[$year];
            $leave_hours = $this->leave_hours[$year];
            $over_time = $this->over_time[$year];
            $filling_hours = $this->filling_hours[$year];
            // echo '</pre>'.print_r($work_hour).'</pre>';
            $dona = new dona();
            $obj_contract = new contract();
            $w = array(23, 17.2, 17, 17);
            $col_h = 7;
            $this->SetFont('Arial', '', 9);                           //Förnamn
            $this->SetY(52.5);
            for ($i = 1; $i <= 12; $i++) {
                if($table == 'LEFT')
                    $this->SetX(30.4);
                else
                    $this->SetX(120.4);
                            $this->Cell($w[0], $col_h, $work_hour[$i], 0, 0, 'C', FALSE);   //table cell 1
                            $this->Cell($w[1], $col_h, $leave_hours[$i], 0, 0, 'C', FALSE);   //table cell 2
                            $this->Cell($w[2], $col_h, $over_time[$i], 0, 0, 'C', FALSE);   //table cell 3
                            $this->Cell($w[3], $col_h, $filling_hours[$i], 0, 0, 'C', FALSE);   //table cell 4   
                            // break;
                $this->SetY($this->GetY() + $col_h);
            }
    //        echo 'A'; exit();
            $this->Ln(13);
    // }
}

    function P2_SubPart12($salary_to_year = Null, $salary_type = Null, $amount_in_sek = Null, $hourly_rate_varied = Null, $overtime_state = Null, $additional_hours = Null, $not_included_salary = Null) {
        //row 1
        $this->SetFont('Arial', '', 9);
        $this->SetXY(37, 163.5);
        $this->Cell(20, 4, utf8_decode($salary_to_year), 0, 0, 'L', FALSE);   //Lön avser år
        //row 2
        $this->SetY($this->GetY() + 4.9);
        if ($salary_type == 1) {
            $x_ord = 19.8;
            $this->Line($x_ord, $this->GetY() + 2.4, $x_ord + 3, $this->GetY() + 5.3);    //drew lines     Månadslön
            $this->Line($x_ord, $this->GetY() + 5.3, $x_ord + 3, $this->GetY() + 2.4);    //drew lines
        }

        if ($salary_type == 2) {
            $x_ord = 45.2;
            $this->Line($x_ord, $this->GetY() + 2.4, $x_ord + 3, $this->GetY() + 5.3);    //drew lines     Veckolön
            $this->Line($x_ord, $this->GetY() + 5.3, $x_ord + 3, $this->GetY() + 2.4);    //drew lines
        }

        if ($salary_type == 3) {
            $x_ord = 71.6;
            $this->Line($x_ord, $this->GetY() + 2.4, $x_ord + 3, $this->GetY() + 5.3);    //drew lines     Daglön  
            $this->Line($x_ord, $this->GetY() + 5.3, $x_ord + 3, $this->GetY() + 2.4);    //drew lines
        }

        if ($salary_type == 4) {
            $x_ord = 97.6;
            $this->Line($x_ord, $this->GetY() + 2.4, $x_ord + 3, $this->GetY() + 5.3);    //drew lines     Timlön
            $this->Line($x_ord, $this->GetY() + 5.3, $x_ord + 3, $this->GetY() + 2.4);    //drew lines
        }

        $this->SetFont('Arial', '', 9);
        $this->SetXY(145, $this->GetY() + 2);
        $this->Cell(20, 4, utf8_decode($amount_in_sek), 0, 0, 'L', FALSE);   //Belopp i kronor   
        //row 3
        $this->SetY($this->GetY() + 5);
        if ($hourly_rate_varied == 0) {
            $x_ord = 71.5;
            $this->Line($x_ord, $this->GetY() + 2.4, $x_ord + 3, $this->GetY() + 5.3);    //drew lines    Nej
            $this->Line($x_ord, $this->GetY() + 5.3, $x_ord + 3, $this->GetY() + 2.4);    //drew lines
        }
        if ($hourly_rate_varied == 1) {
            $x_ord = 124.5;
            $this->Line($x_ord, $this->GetY() + 2.4, $x_ord + 3, $this->GetY() + 5.3);    //drew lines    Ja
            $this->Line($x_ord, $this->GetY() + 5.3, $x_ord + 3, $this->GetY() + 2.4);    //drew lines
        }




        // row 4

        $this->SetFont('Arial', '', 9);
        $this->SetXY(37, $this->GetY() + 12);
        $this->Cell(15, 4, utf8_decode($overtime_state), 0, 0, 'C', FALSE);   //Övertid, ange    

        $this->SetFont('Arial', '', 9);
        $this->SetXY(103.5, $this->GetY());
        $this->Cell(15, 4, utf8_decode($additional_hours), 0, 0, 'C', FALSE);   //Mertid / Fyllnadstid, ange
        //row 5
        $this->SetY($this->GetY() + 5);
        if ($not_included_salary == 0) {
            $x_ord = 109.7;
            $this->Line($x_ord, $this->GetY() + 2.4, $x_ord + 3, $this->GetY() + 5.3);    //drew lines    Nej
            $this->Line($x_ord, $this->GetY() + 5.3, $x_ord + 3, $this->GetY() + 2.4);    //drew lines
        }
        if ($not_included_salary == 1) {
            $x_ord = 124.3;
            $this->Line($x_ord, $this->GetY() + 2.4, $x_ord + 3, $this->GetY() + 5.3);    //drew lines    Ja
            $this->Line($x_ord, $this->GetY() + 5.3, $x_ord + 3, $this->GetY() + 2.4);    //drew lines
        }

        $this->Ln(16);
    }

    function P2_SubPart13($Employed_with_uppehållslön = Null, $Set_earned_uppehållslön = Null, $Employed_with_ferielön = Null, $no_of_beta_barn_holidays = Null, $Set_earned_ferielön = Null) {
        //row 1

        $this->SetY($this->GetY() + 5.6);
        if ($Employed_with_uppehållslön == 0) {
            $x_ord = 53.5;
            $this->Line($x_ord, $this->GetY() + 2.4, $x_ord + 3, $this->GetY() + 5.3);    //drew lines     Nej
            $this->Line($x_ord, $this->GetY() + 5.3, $x_ord + 3, $this->GetY() + 2.4);    //drew lines
        }

        $this->SetY($this->GetY());
        if ($Employed_with_uppehållslön == 1) {
            $x_ord = 64.8;
            $this->Line($x_ord, $this->GetY() + 2.4, $x_ord + 3, $this->GetY() + 5.3);    //drew lines     Ja
            $this->Line($x_ord, $this->GetY() + 5.3, $x_ord + 3, $this->GetY() + 2.4);    //drew lines
        }

        $this->SetFont('Arial', '', 9);
        $this->SetXY(120, $this->GetY() + 2);
        $this->Cell(20, 4, utf8_decode($Set_earned_uppehållslön), 0, 0, 'L', FALSE);



        //row 2

        $this->SetY($this->GetY() + 4.8);
        if ($Employed_with_ferielön == 0) {
            $x_ord = 46.9;
            $this->Line($x_ord, $this->GetY() + 2.4, $x_ord + 3, $this->GetY() + 5.3);    //drew lines     Nej
            $this->Line($x_ord, $this->GetY() + 5.3, $x_ord + 3, $this->GetY() + 2.4);    //drew lines
        }

        $this->SetY($this->GetY());
        if ($Employed_with_ferielön == 1) {
            $x_ord = 58.3;
            $this->Line($x_ord, $this->GetY() + 2.4, $x_ord + 3, $this->GetY() + 5.3);    //drew lines     Ja
            $this->Line($x_ord, $this->GetY() + 5.3, $x_ord + 3, $this->GetY() + 2.4);    //drew lines
        }

        $this->SetFont('Arial', '', 9);
        $this->SetXY(118, $this->GetY() + 2);
        $this->Cell(20, 4, utf8_decode($no_of_beta_barn_holidays), 0, 0, 'L', FALSE);   //Ange antal betalda feriedagar

        $this->SetFont('Arial', '', 9);
        $this->SetXY(172, $this->GetY());
        $this->Cell(20, 4, utf8_decode($Set_earned_ferielön), 0, 0, 'L', FALSE);   //Ange intjänad ferielön i kr  

        $this->Ln(16);
    }

    function P2_SubPart14($other_information_1 = Null, $other_information_2 = Null) {


        $this->SetFont('Arial', '', 8);
        $this->SetXY(19, $this->GetY());
        $str = $other_information_1 . "\n" . $other_information_2;
        $this->MultiCell(175, 3, utf8_decode($str));   //Lön avser år
    }

    function P2_SubPart15($company,$logged_emp_name) {
        //row 1
        //echo $company_name['name'];
        $this->SetFont('Arial', '', 10);
        $this->SetXY(52, 259);
        $this->Cell(30, 6, utf8_decode($company['name']), 0, 0, 'L', FALSE);   //  Arbetsgivarens namn

        $this->SetFont('Arial', '', 10);
        $this->SetXY(141, $this->GetY());
        $this->Cell(30, 6, $this->format_SSN($company['org_no']), 0, 0, 'L', FALSE);   //  Organisationsnummer
        //row 2
        $this->SetFont('Arial', '', 9);
        $this->SetXY(52, $this->GetY() + 7.5);
        $y_old = $this->GetY();
        $this->MultiCell(53, 3, utf8_decode($company['address']));   //  Arbetsgivarens adress

        $this->SetFont('Arial', '', 9);
        $this->SetXY(141, $y_old);
        $phno = trim($company['phone']) != '' ? $this->formatting_phone(trim($company['phone'])) : trim($company['mobile']);
        $this->Cell(30, 6, utf8_decode($phno), 0, 0, 'L', FALSE);   //  Telefonnummer till  uppgiftslämnaren  

        $this->SetAutoPageBreak(false);
        $this->SetFont('Arial', '', 9);
        $this->SetXY(18, 280);
        $this->Cell(30, 6, utf8_decode(trim($company['city'])), 0, 0, 'L', FALSE);   //  city

        $this->SetX(51);
        $this->Cell(30, 6, $this->timezone_set(), 0, 0, 'L', FALSE);   //  current date

        $this->SetFont('Arial', 'I', 7.5);
        $this->SetX(85);
        $this->Cell(30, 6, utf8_decode('e-signering via Time2View'), 0, 0, 'L', FALSE);

        $this->SetFont('Arial', '', 9);
        $this->SetX(140);
        $this->Cell(30, 6, $logged_emp_name, 0, 0, 'L', FALSE);
    }

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

    function P3_SubPart1($employee_Details) {
        //row 1
        $this->SetFont('Arial', '', 9);                                      //     Arbetstagarens efternamn 
        $this->SetXY(18, 55);
        $this->Cell(50, 4, utf8_decode($employee_Details['last_name']), 0, 0, 'L', FALSE);


        $this->SetFont('Arial', '', 9);                                      //  Förnamn
        $this->SetX(78);
        $this->Cell(50, 4, utf8_decode($employee_Details['first_name']), 0, 0, 'L', FALSE);

        $this->SetFont('Arial', '', 9);                                      //  Personnummer (10 siffror) 
        $this->SetX(137);
        //$employee_Details['century']
        $this->Cell(50, 4, $this->format_SSN($employee_Details['social_security']), 0, 0, 'L', FALSE);
    }

    function P3_SubPart2($summary_data, $oncall_kr_times, $ob_kr_times,$timers,$angearts) {
        $w = array(21.2, 28.5, 24, 23.5, 57, 23.5);
        $col_h = 6;
        $this->SetFont('Arial', '', 9);
        $this->SetY(83);

        if(!empty($summary_data)){
            foreach($summary_data as $data){
                $rowcount = 1;
                if(isset($angearts[$data['year_month']]) && count($angearts[$data['year_month']]) > 1) {
                    $rowcount = count($angearts[$data['year_month']]);
                }

                $this->SetX(17.1);
                $this->Cell($w[0], $col_h, $data['year_month'], 0, 0, 'L', FALSE);   //table cell 1
                $this->Cell($w[1], $col_h, $data['working_days'], 0, 0, 'L', FALSE);   //table cell 2
                $this->Cell($w[2], $col_h, (isset($timers[$data['year_month']]) ? $timers[$data['year_month']] : ''), 0, 0, 'L', FALSE);   //table cell 3
                $this->Cell($w[3], $col_h, (isset($oncall_kr_times[$data['year_month']]) ? $oncall_kr_times[$data['year_month']] : ''), 0, 0, 'L', FALSE);   //table cell 4   
                foreach ($angearts[$data['year_month']] as $val_key => $val) {
                    $this->Cell($w[4], $col_h, utf8_decode($val), 0, 0, 'L', FALSE);   //table cell 4   
                    $this->Cell($w[5], $col_h, (isset($ob_kr_times[$data['year_month']][$val_key]) ? $ob_kr_times[$data['year_month']][$val_key] : ''), 0, 0, 'L', FALSE);
                    if($rowcount > 1 && ($val_key != $rowcount -1)) { 
                        $this->SetY($this->GetY() + $col_h);
                        $this->SetX(17.1 + $w[0] +$w[1] + $w[2] + $w[3]);
                    }
                }
                $this->SetY($this->GetY() + $col_h);
            }
        }
    }

    function P3_SubPart2Leave($summary_data, $oncall_kr_times, $ob_kr_times,$timers,$angearts) {
        $w = array(21.2, 28.5, 24, 23.5, 57, 23.5);
        $col_h = 6;
        $this->SetFont('Arial', '', 9);
        $this->SetY(83);

        if(!empty($summary_data)){
            foreach($summary_data as $data){
                $this->SetX(17.1);
                $this->Cell($w[0], $col_h, $data['year_month'], 0, 0, 'L', FALSE);   //table cell 1
                $this->Cell($w[1], $col_h, $data['leave_days'], 0, 0, 'L', FALSE);   //table cell 2
                $this->Cell($w[2], $col_h, (isset($timers[$data['year_month']]) ? $timers[$data['year_month']] : ''), 0, 0, 'L', FALSE);   //table cell 3
                $this->Cell($w[3], $col_h, (isset($oncall_kr_times[$data['year_month']]) ? $oncall_kr_times[$data['year_month']] : ''), 0, 0, 'L', FALSE);   //table cell 4   
                $this->Cell($w[4], $col_h, (isset($angearts[$data['year_month']]) ? $angearts[$data['year_month']] : ''), 0, 0, 'L', FALSE);   //table cell 4   
                $this->Cell($w[5], $col_h, (isset($ob_kr_times[$data['year_month']]) ? $ob_kr_times[$data['year_month']] : ''), 0, 0, 'L', FALSE);   //table cell 4   
                
                $this->SetY($this->GetY() + $col_h);
            }
        }
    }

    function P3_SubPart3($company,$logged_emp_name = null) {
        //row 1
        //echo $company_name['name'];
        $this->SetFont('Arial', '', 10);
        $this->SetXY(52, 252);
        $this->Cell(30, 6, utf8_decode($company['name']), 0, 0, 'L', FALSE);   //  Arbetsgivarens namn

        $this->SetFont('Arial', '', 10);
        $this->SetXY(141, $this->GetY());
        $this->Cell(30, 6, $this->format_SSN($company['org_no']), 0, 0, 'L', FALSE);   //  Organisationsnummer
        //row 2
        $this->SetFont('Arial', '', 9);
        $this->SetXY(52, $this->GetY() + 7.5);
        $y_old = $this->GetY();
        $this->MultiCell(53, 3, utf8_decode($company['address']));   //  Arbetsgivarens adress

        $this->SetFont('Arial', '', 9);
        $this->SetXY(141, $y_old);
        $phno = trim($company['phone']) != '' ? $this->formatting_phone(trim($company['phone'])) : trim($company['mobile']);
        $this->Cell(30, 6, utf8_decode($phno), 0, 0, 'L', FALSE);   //  Telefonnummer till  uppgiftslämnaren  

        $this->SetAutoPageBreak(false);
        $this->SetFont('Arial', '', 9);
        $this->SetXY(18, 273);
        $this->Cell(30, 6, utf8_decode(trim($company['city'])), 0, 0, 'L', FALSE);   //  city

        $this->SetX(51);
        $this->Cell(30, 6, $this->timezone_set(), 0, 0, 'L', FALSE);   //  current date


        $this->SetFont('Arial', 'I', 7.5);
        $this->SetX(85);
        $this->Cell(30, 6, utf8_decode('e-signering via Time2View'), 0, 0, 'L', FALSE);

        $this->SetFont('Arial', '', 9);
        $this->SetX(140);
        $this->Cell(30, 6, $logged_emp_name, 0, 0, 'L', FALSE);
    }

    function timezone_set(){
        $start_time = new DateTime;
        $start_time->setTimezone(new DateTimeZone('Europe/Stockholm'));
        $start_time->setTimestamp(time());
        $current_date_time = $start_time->format('Y-m-d G:i:s');
        return $current_date_time;
    }
}
?>