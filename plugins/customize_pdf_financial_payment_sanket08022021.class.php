<?php

require_once('./plugins/F_pdf.class.php');
require_once('./plugins/fpdi/fpdi.php');
require_once ('./class/equipment.php');

class PDF_Fin_Payment extends FPDI     { //FPDF

    var $ordinary_pay = "";
    var $sick_pay = "";
    var $table_sum = "";
    var $vikarie_total_table_sum = 0;
    var $company_details = array();
    var $page_ref_no = NULL;

    function __construct() {
        parent::__construct();
    }

    function P1_table_1($customer_details) {
        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0, 50, 50);

        $this->SetXY(22, $this->GetY());
        $this->Cell(80, 20, '', 0, 0, 'L', TRUE);

        //row 1
        $this->SetFont('Arial', '', 12);                           //Den assistansberättigades namn
        $this->SetXY(22, $this->GetY() + 39);
        $this->Cell(22, 5, utf8_decode($customer_details['first_name'] . " " . $customer_details['last_name']), 0, 0, 'L', FALSE);

        $this->SetFont('Arial', '', 12);                           //Personnummer
        $this->SetXY(144, $this->GetY());
        $this->Cell(22, 5, utf8_decode($customer_details['century'].$this->format_SSN($customer_details['social_security'])), 0, 0, 'L', FALSE);


        //row 2
        $this->SetFont('Arial', '', 12);                           //Adress och postadress
        $this->SetXY(22, $this->GetY() + 11);
//        echo "<pre>".print_r($customer_details, 1)."</pre>";
        $address_field = $customer_details['address'];
        if(trim($customer_details['post']) != '')
            $address_field .= ', '. trim($customer_details['post']);
        if(trim($customer_details['city']) != '')
            $address_field .= ', '. trim($customer_details['city']);
        $this->Cell(22, 5, utf8_decode($address_field), 0, 0, 'L', FALSE);

        $phno = $this->formatting_phone($customer_details['phone']);
       
        $this->SetFont('Arial', '', 12);                           //Telefonnummer
        $this->SetXY(144, $this->GetY());
        $this->Cell(22, 5, utf8_decode($phno), 0, 0, 'L', FALSE);


        //row 3
        $this->SetFont('Arial', '', 12);                           //Ev e‐post
        $this->SetXY(22, $this->GetY() + 12);
        $this->Cell(22, 5, utf8_decode($customer_details['email']), 0, 0, 'L', FALSE);
    }

    function P1_table_2($company, $customer_gardian_details, $assignment = Null, $proxies = Null, $submission = Null) {

        //row 1
        $this->SetXY(22, $this->GetY() + 15);
        if(!empty($customer_gardian_details)){
            $this->SetFont('Arial', '', 12);                           //Legal företrädare/ombud namn
            $this->Cell(22, 5, utf8_decode($customer_gardian_details['last_name']. ' '. $customer_gardian_details['first_name']), 0, 0, 'L', FALSE);
            
            $this->SetFont('Arial','',12);                           //Telefonnummer
            $this->SetXY(109, $this->GetY());
            $this->Cell(22,5,utf8_decode($customer_gardian_details['mobile']),0,0,'L',FALSE);     
        }


        $this->SetFont('Arial', '', 12);                           //Uppdrag
        $this->SetXY(144, $this->GetY());
        $this->Cell(22, 5, utf8_decode($assignment), 0, 0, 'L', FALSE);



        //row 2
        $this->SetXY(22, $this->GetY() + 12);
        if(!empty($customer_gardian_details)){
            $this->SetFont('Arial','',12);                           //Adress och postadress
            $this->Cell(22,4,utf8_decode($customer_gardian_details['address']),0,0,'L',FALSE);
        }

        $this->SetY($this->GetY() - 3);
        if ($proxies == 1) {
            $x_ord = 145.8;
            $this->Line($x_ord, $this->GetY() + 2.4, $x_ord + 3, $this->GetY() + 5.3);    //drew lines     Bifogas
            $this->Line($x_ord, $this->GetY() + 5.3, $x_ord + 3, $this->GetY() + 2.4);    //drew lines
        }

        $this->SetY($this->GetY());
        if ($submission == 1) {
            $x_ord = 162.7;
            $this->Line($x_ord, $this->GetY() + 2.4, $x_ord + 3, $this->GetY() + 5.3);    //drew lines       Tidigare insänt
            $this->Line($x_ord, $this->GetY() + 5.3, $x_ord + 3, $this->GetY() + 2.4);    //drew lines
        }


        //row 3
        $this->SetFont('Arial','',12);                           //Kontaktperson hos utförare
        $this->SetXY(22, $this->GetY() + 14);
        $this->Cell(22,5,utf8_decode($company['name']),0,0,'L',FALSE);
        
        $this->SetFont('Arial','',12);                           //E‐post utförare
        $this->SetXY(109, $this->GetY());
        $this->Cell(22,5,utf8_decode($company['email']),0,0,'L',FALSE);     
    }

    function P1_table_3($comp_paid_to_account = NULL, $reference = NULL, $ord_table_sum = NULL) {

        //row 1
        $this->SetFont('Arial', '', 12);                           
        $this->SetXY(22, $this->GetY() + 15.5);
        $this->Cell(22, 5, utf8_decode($comp_paid_to_account), 0, 0, 'L', FALSE); //Ersättning utbetalas till konto
                        
        $this->SetXY(109, $this->GetY());
        $this->Cell(22, 5, utf8_decode($reference), 0, 0, 'L', FALSE); //Referensnummer

        $last_y = $this->GetY();
        $this->SetFont('Arial', 'B', 9); 
        $this->SetXY(143.2, 119.8);
        $this->Cell(47, 5, utf8_decode('Yrkat belopp'), 'TR', 0, 'L', FALSE);
        $this->SetFont('Arial', '', 12); 
        $this->SetXY(143.2, 125);
        $this->Cell(47, 6.25, round($ord_table_sum,2), 'BR', 0, 'L', FALSE); //Ordinary table sum
        $this->SetY($last_y);
    }

    function P1_table_4($emp_details, $Q_work_dates, $date1, $date2) {

        //row 1
        $this->SetFont('Arial', '', 12);                           //Ordinarie personlig assistent (namn)
        $this->SetXY(22, $this->GetY() + 27);
        $this->Cell(22, 5, utf8_decode($emp_details['first_name'] . " " . $emp_details['last_name']), 0, 0, 'L', FALSE);

        $this->SetFont('Arial', '', 12);                           //Personnummer
        $this->SetXY(93, $this->GetY());
        $this->Cell(22, 5, utf8_decode($emp_details['century'].$this->format_SSN($emp_details['social_security'])), 0, 0, 'L', FALSE);

        $this->SetFont('Arial', '', 12);                           //Anställningsnummer
        $this->SetXY(150, $this->GetY());
        $this->Cell(22, 5, utf8_decode($emp_details['code']), 0, 0, 'L', FALSE);


        //row 2
        $this->SetFont('Arial', '', 12);                           //Sjukperiod för ordinarie assistent (datum)
        $this->SetXY(22, $this->GetY() + 11.5);
//        if (!empty($all_leave_works))
//            $this->Cell(22, 5, $all_leave_works[0]['date'] . " till " . $all_leave_works[count($all_leave_works) - 1]['date'], 0, 0, 'L', FALSE);
        if ($date1 !== NULL && $date2 !== NULL)
            $this->Cell(22, 5, $date1 . " till " . $date2, 0, 0, 'L', FALSE);
//    
        $this->SetFont('Arial', '', 12);                           //Karensdag (datum)
        $this->SetXY(93, $this->GetY());
//        echo "<pre>".print_r($Q_work_dates, 1)."</pre>";
        if (!empty($Q_work_dates)){
            $display_qw_array = array();
            foreach($Q_work_dates as $qw){
                $display_qw_array[] = date('m-d', strtotime($qw));
            }
//            echo "<pre>".print_r($display_qw_array, 1)."</pre>";
//            $this->Cell(22, 5, $Q_work_dates[0], 0, 0, 'L', FALSE);
            $this->Cell(22, 5, implode(', ', $display_qw_array), 0, 0, 'L', FALSE);
        }

        $this->Ln(20.7);
    }

    function P1_table_5($list_relations, $Hourly_times, $full_relations, $full_times) {

        $w = array(71, 38.2, 28, 15.1, 17);
        $col_h = 7.1;
        $this->SetFont('Arial', 'B', 9.5);
        
        $vikaries_timelon = 0;
        //echo count($list_relation_emp_names);

        for ($i = 0; $i < count($list_relations); $i++) {
            
            for($n=0; $n<count($full_relations); $n++){
                if($full_relations[$n]['employee_id'] == $list_relations[$i]['employee_id']){
                    $vikaries_timelon = $full_times[$n];
                    break;
                }
            }
            if($vikaries_timelon == '')
                    $vikaries_timelon = 0;
            
            $this->SetX(21);
            $this->Cell($w[0], $col_h, utf8_decode($list_relations[$i]['employee']), 0, 0, 'L', FALSE);   //table cell 1
            $this->Cell($w[1], $col_h, $list_relations[$i]['date'], 0, 0, 'L', FALSE);   //table cell 2
            $this->Cell($w[2], $col_h, $list_relations[$i]['time_from'] . " - " . $list_relations[$i]['time_to'], 0, 0, 'L', FALSE);   //table cell 3
            $this->Cell($w[3], $col_h, $list_relations[$i]['tot_time'], 0, 0, 'R', FALSE);   //table cell 4
            //$this->Cell($w[4], $col_h, $Hourly_times[$i], 0, 0, 'L', FALSE);   //table cell 5
            $this->Cell($w[4], $col_h, $vikaries_timelon, 0, 0, 'R', FALSE);   //table cell 5

            $this->SetY($this->GetY() + $col_h);
        }
    }

    function P1_Bifogas($sick_leave_reg = Null, $copy_of_payroll = Null, $time_sheet_h_service = Null, $additional_cost = Null) {
        $this->SetY(244.6);
        $x_ord = 23.9;
        if ($sick_leave_reg == 1) {
            $this->Line($x_ord, $this->GetY() + 2.4, $x_ord + 3, $this->GetY() + 5.3);    //drew lines     check 1
            $this->Line($x_ord, $this->GetY() + 5.3, $x_ord + 3, $this->GetY() + 2.4);    //drew lines
        }

        $this->SetY($this->GetY() + 4.8);
        if ($copy_of_payroll == 1) {
            $this->Line($x_ord, $this->GetY() + 2.4, $x_ord + 3, $this->GetY() + 5.3);    //drew lines     check 2
            $this->Line($x_ord, $this->GetY() + 5.3, $x_ord + 3, $this->GetY() + 2.4);    //drew lines
        }

        $this->SetY($this->GetY() + 9.5);
        if ($time_sheet_h_service == 1) {
            $this->Line($x_ord, $this->GetY() + 2.4, $x_ord + 3, $this->GetY() + 5.3);    //drew lines     check 3
            $this->Line($x_ord, $this->GetY() + 5.3, $x_ord + 3, $this->GetY() + 2.4);    //drew lines
        }

        $this->SetY($this->GetY() + 4.8);
        if ($additional_cost == 1) {
            $this->Line($x_ord, $this->GetY() + 2.4, $x_ord + 3, $this->GetY() + 5.3);    //drew lines     check 4
            $this->Line($x_ord, $this->GetY() + 5.3, $x_ord + 3, $this->GetY() + 2.4);    //drew lines
        }
    }

    function P2_top($collective = NULL) {
        //row 1
        $this->SetFont('Arial', 'B', 11);                           //Ordinarie personlig assistent (namn)
        $this->SetXY(22, $this->GetY() + 5.5);
        $this->Cell(22, 5, utf8_decode('Sammanställning - Styrkande av merkostnadens storlek'), 0, 0, 'L', FALSE);

        $this->SetFont('Arial', '', 9);                           //Personnummer
        $this->SetXY(22, $this->GetY() + 5);
        $this->Cell(22, 5, utf8_decode('För förtydligande av begärda uppgifter, se SKL cirkulär 2006:39'), 0, 0, 'L', FALSE);

        $this->SetFont('Arial', '', 9);
        $this->SetXY(138, $this->GetY() + 3.5);      //set border
        $this->Cell(55, 7, utf8_decode(' Kollektivavtal'), 'TLR', 0, 'L', FALSE);

        $this->SetFont('Arial', 'B', 11);
        $this->SetXY(138, $this->GetY() + 7);      //set border
        $this->Cell(55, 5, " " . utf8_decode($collective), 'BLR', 0, 'L', FALSE);

       // $this->SetFont('Arial','B',10);                           //Anställningsnummer
       // $this->SetXY(30,  $this->GetY()+5.2);
       // $this->Cell(55,4,utf8_decode('Ordinarie personal'),0,0,'L',FALSE);      
       // $this->Ln(4);
    }

    function P2_table1($table_f_date1, $table_to_date2, $insurance_word_person, $SS_contibution, $ord_inconv_details, $qualifying_day = array()) {
        /* ordinary person table */
        $equipment          = new equipment();
        $this->table_sum    = 0;
        $total_insurance    = 0;
        $total_contribution = 0;
        $total              = 0;
        
        //echo "<pre>".print_r($ord_inconv_details, 1)."</pre>";

        $semestersattn_jour_dag_180_onwards = $ord_inconv_details['180_onwards']['semestersattn_jour_dag_2_14_salaries'];

        $ord_inconv_details_180_onwards = $ord_inconv_details['180_onwards']['inconv_details'];


        $semestersattn_jour_dag_15_180 = $ord_inconv_details['15_180']['semestersattn_jour_dag_2_14_salaries'];

        $ord_inconv_details_15_180 = $ord_inconv_details['15_180']['inconv_details'];
        //only for hogia salary system
        //$ord_inconv_details_15_180         = $ord_inconv_details['15_180']['inconv_details'];



        $semestersattn_jour_dag_2_14= $ord_inconv_details['semestersattn_jour_dag_2_14_salaries'];
        $oncall_type_salaries       = $ord_inconv_details['oncall_type_salaries'];        //only for hogia salary system
        $ord_inconv_details         = $ord_inconv_details['inconv_details'];
        
        //echo "<pre>".print_r($ord_inconv_details, 1)."</pre>";
        //echo "<pre>Inconv: ".print_r($ord_inconv_details, 1)."</pre>";
        $qualifying_day_total_hour      = $qualifying_day['qualifying_total_time'];
        $qualifying_day_total_amount    = $qualifying_day['nomal_salary_amount'];

        $normal_2_to_14 = array();
        $oncall_2_to_14 = array();

        $normal_15_to_180 = array();
        $oncall_15_to_180 = array();

        $normal_180_onwards = array();
        $oncall_180_onwards = array();

        $lower_jour_inconv = array();
        $org_inconv = array();

        $lower_jour_inconv_15_180 = array();
        $org_inconv_15_180 = array();

        $intercept_qualify_exceed_normal = FALSE;
        $intercept_qualify_exceed_oncall = FALSE;

        if(!empty($ord_inconv_details['normal_0'])){
            foreach ($ord_inconv_details['normal_0'] as $amount => $h_value){
                $normal_2_to_14[$amount]['hour'] = $h_value['hour'];
            }
        }
        
        if(empty($normal_2_to_14))  //set default as 0
            $normal_2_to_14['0']['hour'] = 0;
        
        if(!empty($ord_inconv_details['normal_3'])){
            foreach ($ord_inconv_details['normal_3'] as $amount => $h_value){
                $oncall_2_to_14[$amount]['hour'] = $h_value['hour'];
            }
        }

        if(!empty($ord_inconv_details)){
            foreach ($ord_inconv_details as $key => $values){
                if(stripos($key, 'jour') !== FALSE){
                    foreach ($values as $amount => $h_value){
                        $lower_jour_inconv[$key]['hour'] = $h_value['hour'];
                        $lower_jour_inconv[$key]['amount'] = $amount;
                    }
                    continue;
                }else if($key == 'normal_3' || $key == 'normal_0')
                    continue;
                foreach ($values as $amount => $h_value){
                    if(!empty($org_inconv[$key][$amount]) || isset($org_inconv[$key][$amount]))
                        $org_inconv[$key][$amount]['hour'] = $equipment->time_sum($org_inconv[$key][$amount]['hour'], $h_value['hour']);
                    else
                        $org_inconv[$key][$amount]['hour'] = $h_value['hour'];
                }
            }
        }

        ////////////calculation for oncall////////////////
        if(!empty($ord_inconv_details_15_180['normal_0'])){
            foreach ($ord_inconv_details_15_180['normal_0'] as $amount => $h_value){
                $normal_15_to_180[$amount]['hour'] = $h_value['hour'];
            }
        }
        
        if(empty($normal_15_to_180))  //set default as 0
            $normal_15_to_180['0']['hour'] = 0;
        
        if(!empty($ord_inconv_details_15_180['normal_3'])){
            foreach ($ord_inconv_details_15_180['normal_3'] as $amount => $h_value){
                $oncall_15_to_180[$amount]['hour'] = $h_value['hour'];
            }
        }


        if(!empty($ord_inconv_details_180_onwards['normal_0'])){
            foreach ($ord_inconv_details_180_onwards['normal_0'] as $amount => $h_value){
                $normal_180_onwards[$amount]['hour'] = $h_value['hour'];
            }
        }
        
        if(empty($normal_180_onwards))  //set default as 0
            $normal_180_onwards['0']['hour'] = 0;
        
        if(!empty($ord_inconv_details_180_onwards['normal_3'])){
            foreach ($ord_inconv_details_180_onwards['normal_3'] as $amount => $h_value){
                $oncall_180_onwards[$amount]['hour'] = $h_value['hour'];
            }
        }

        
        ///////////////////////////////////


        //row 1     
        $this->SetFont('Arial', 'B', 10);                           //Anställningsnummer
        $this->SetXY(30, $this->GetY() + 5.2);
        $this->Cell(35, 4, utf8_decode('Ordinarie personal :'), 0, 0, 'L', FALSE);
        if($table_f_date1 != '' && $table_to_date2 != '')
            $this->Cell(30, 4, $table_f_date1 . '  till  ' . $table_to_date2, 0, 0, 'L', FALSE);

        $this->Ln(4);

        $w = array(55, 27, 28, 27.5, 27.5);
        $col_h = 4.5;
        $this->SetFont('Arial', 'B', 10);
        $this->SetXY(28.3, $this->GetY() + 0.8);

        //column headings
        $this->Cell($w[0], $col_h, '', 1, 0, 'C', FALSE);   //table cell 1
        $this->Cell($w[1], $col_h, utf8_decode('Timmar'), 1, 0, 'R', FALSE);   //table cell 2
        $this->Cell($w[2], $col_h, utf8_decode('Ord lön kr/tim'), 1, 0, 'R', FALSE);   //table cell 3
        $this->Cell($w[3], $col_h, utf8_decode('Sjuklön kr/tim'), 1, 0, 'R', FALSE);   //table cell 4
        $this->Cell($w[4], $col_h, utf8_decode('Summa'), 1, 1, 'R', FALSE);   //table cell 5
        
        //echo "<pre>normal_2_to_14".print_r($normal_2_to_14, 1)."</pre>";
        foreach($normal_2_to_14 as $amount => $hour_value){
            $time_in_100    =   $equipment->time_user_format($hour_value['hour'], 100);
            
            
            
            $col_h = 6.2;
            $this->SetFillColor(230, 230, 230);
            $this->SetX(28.3);                                      //table row1
            $this->Cell($w[0], $col_h, utf8_decode('Sjuklön dag 2-14'), 1, 0, 'L', FALSE);   //table cell 1
             $this->Cell($w[1], $col_h, number_format($time_in_100,2), 1, 0, 'R', FALSE);   //table cell 2
            $amount = round($amount, 2);
            $this->Cell($w[2], $col_h, sprintf('%.02f', $amount), 1, 0, 'R', FALSE);   //table cell 3
            $calc = ($amount * 80) / 100;
            $this->Cell($w[3], $col_h, sprintf('%.02f', round($calc, 2)), 1, 0, 'R', FALSE);   //table cell 4
            $calc = $time_in_100 * $calc;
            $this->Cell($w[4], $col_h, sprintf('%.02f', round($calc, 2)), 1, 0, 'R', FALSE);   //table cell 5
            $this->SetY($this->GetY() + $col_h);
            $this->table_sum += $calc;

            $this->SetX(28.3);                                      //table row2
            $this->Cell($w[0], $col_h, utf8_decode('Semestersättn dag 2-14'), 1, 0, 'L', FALSE);   //table cell 1
            //$this->Cell($w[1], $col_h, sprintf('%.02f', round($time_in_100, 2)), 1, 0, 'R', FALSE);   //table cell 2
            $this->Cell($w[1], $col_h, number_format($time_in_100,2), 1, 0, 'R', FALSE);   //table cell 2
            $calc = round(($amount * 12) / 100, 2);
            $this->Cell($w[2], $col_h, sprintf('%.02f', $calc), 1, 0, 'R', FALSE);   //table cell 3
            $this->Cell($w[3], $col_h, '', 1, 0, 'R', FALSE);   //table cell 4
            $calc = $time_in_100 * $calc;
            $this->Cell($w[4], $col_h, sprintf('%.02f', round($calc, 2)), 1, 0, 'R', FALSE);   //table cell 5
            $this->SetY($this->GetY() + $col_h);
            $this->table_sum += $calc;
        }
        
        //echo "<pre>".print_r($normal_15_to_180, 1)."</pre>";
        //This for calculating "Semestersättn Jour dag 2-14" row
        if($this->company_details['include_sem_2_14_oncall_salary'] == 1){
            if(!empty($semestersattn_jour_dag_2_14)){
                foreach ($semestersattn_jour_dag_2_14 as $salary => $params) {
                    //$time_in_100 = $equipment->time_user_format(round($params['hours']/4, 2), 100);
                    $time_in_100 = round($equipment->time_user_format(round($params['hours'], 2), 100) / 4, 2);
                    $this->SetX(28.3);                                      //table row2
                    $this->Cell($w[0], $col_h, utf8_decode('Semestersättn jour dag 2-14'), 1, 0, 'L', FALSE);   //table cell 1
                    $this->Cell($w[1], $col_h, sprintf('%.02f', round($time_in_100, 2)), 1, 0, 'R', FALSE);   //table cell 2
                    $calc = round(($salary * 12) / 100, 2);
                    $this->Cell($w[2], $col_h, sprintf('%.02f', $calc), 1, 0, 'R', FALSE);   //table cell 3
                    $this->Cell($w[3], $col_h, '', 1, 0, 'R', FALSE);   //table cell 4
                    $calc = $time_in_100 * $calc;
                    $this->Cell($w[4], $col_h, sprintf('%.02f', round($calc, 2)), 1, 0, 'R', FALSE);   //table cell 5
                    $this->SetY($this->GetY() + $col_h);
                    $this->table_sum += $calc;
                    
                }
            }
        }
        
        if(!empty($normal_15_to_180)){
            $amount = key($normal_15_to_180);
            $time_in_100 = $equipment->time_user_format($normal_15_to_180[$amount]['hour'], 100);
            if((float)$time_in_100){
                $this->SetX(28.3);                                      //table row3
                $this->Cell($w[0], $col_h, utf8_decode('Semestersättn dag 15-180'), 1, 0, 'L', FALSE);
                $this->Cell($w[1], $col_h, sprintf('%.02f', round($time_in_100, 2)), 1, 0, 'R', FALSE);
                $calc = round(($amount * 12) / 100, 2);
                $this->Cell($w[2], $col_h, sprintf('%.02f', $calc), 1, 0, 'R', FALSE);   //table cell 3
                $this->Cell($w[3], $col_h, '', 1, 0, 'R', FALSE);   //table cell 4
                $calc = $time_in_100 * $calc;
                $this->Cell($w[4], $col_h, sprintf('%.02f', round($calc, 2)), 1, 0, 'R', FALSE);   //table cell 5
                $this->SetY($this->GetY() + $col_h);
                $this->table_sum += $calc;
            }
        }

        if($this->company_details['include_sem_2_14_oncall_salary'] == 1){
            if(!empty($semestersattn_jour_dag_15_180)){
                
                    $amount = key($semestersattn_jour_dag_15_180);
                    $time_in_100 = round($equipment->time_user_format(round($semestersattn_jour_dag_15_180[$amount]['hours'], 2), 100) / 4, 2);
                    if((float)$time_in_100){
                        $this->SetX(28.3);                                      //table row2
                        $this->Cell($w[0], $col_h, utf8_decode('Semestersättn jour dag 15-180'), 1, 0, 'L', FALSE);   //table cell 1
                        $this->Cell($w[1], $col_h, sprintf('%.02f', round($time_in_100, 2)), 1, 0, 'R', FALSE);   //table cell 2
                        $calc = round(($amount * 12) / 100, 2);
                        $this->Cell($w[2], $col_h, sprintf('%.02f', $calc), 1, 0, 'R', FALSE);   //table cell 3
                        $this->Cell($w[3], $col_h, '', 1, 0, 'R', FALSE);   //table cell 4
                        $calc = $time_in_100 * $calc;
                        $this->Cell($w[4], $col_h, sprintf('%.02f', round($calc, 2)), 1, 0, 'R', FALSE);   //table cell 5
                        $this->SetY($this->GetY() + $col_h);
                        $this->table_sum += $calc;
                    }
            }
        }

        if(!empty($normal_180_onwards) || !empty($semestersattn_jour_dag_180_onwards)){
            $time_in_100 = 0;
            $amount = 0;
            if(!empty($normal_180_onwards)){
                $amount = key($normal_180_onwards);
                $time_in_100 = $equipment->time_user_format($normal_180_onwards[$amount]['hour'], 100);
            }
            if(!empty($semestersattn_jour_dag_180_onwards)){
                $amount = key($semestersattn_jour_dag_180_onwards);
                $time_in_100 += round($equipment->time_user_format(round($semestersattn_jour_dag_180_onwards[$amount]['hours'], 2), 100) / 4, 2);
            }
            $amount = 0;

            
            if((float)$time_in_100){
                $this->SetX(28.3);                                      //table row3
                $this->Cell($w[0], $col_h, utf8_decode('Semestersättn dag 181-'), 1, 0, 'L', FALSE);
                $this->Cell($w[1], $col_h, sprintf('%.02f', round($time_in_100, 2)), 1, 0, 'R', FALSE);
                $calc = round(($amount * 12) / 100, 2);
                $this->Cell($w[2], $col_h, sprintf('%.02f', $calc), 1, 0, 'R', FALSE);   //table cell 3
                $this->Cell($w[3], $col_h, '', 1, 0, 'R', FALSE);   //table cell 4
                $calc = $time_in_100 * $calc;
                $this->Cell($w[4], $col_h, sprintf('%.02f', round($calc, 2)), 1, 0, 'R', FALSE);   //table cell 5
                $this->SetY($this->GetY() + $col_h);
                $this->table_sum += $calc;
            }
        }

        $this->SetX(28.3);                                      //table row3
        $this->Cell($w[0], $col_h, utf8_decode('Karensdag'), 1, 0, 'L', FALSE);   //table cell 1
        $time_in_100= $equipment->time_user_format($qualifying_day_total_hour, 100);
        // if($this->company_details['apply_max_karens'] == 1 && $time_in_100 != '' && $time_in_100 != 0 && $time_in_100 < 8.00)  // updated on 2014-06-27
        //     $time_in_100 = 8.00;
        $this->Cell($w[1], $col_h, sprintf('%.02f', $time_in_100), 1, 0, 'R', FALSE);   //table cell 2
        //check to include karens salary in total
        if($this->company_details['include_karense_salary'] == 1)  {
            $calc = round(($qualifying_day_total_amount * 12) / 100, 2);
            $this->Cell($w[2], $col_h, sprintf('%.02f', $calc), 1, 0, 'R', FALSE);   //table cell 3
            $this->Cell($w[3], $col_h, '', 1, 0, 'R', FALSE);   //table cell 4
            $calc = $time_in_100 * $calc;
            $this->Cell($w[4], $col_h, sprintf('%.02f', round($calc, 2)), 1, 0, 'R', FALSE);   //table cell 5
            $this->table_sum += $calc;
        } else {
            $this->Cell($w[2], $col_h, '', 1, 0, 'R', True);   //table cell 3
            $this->Cell($w[3], $col_h, '', 1, 0, 'R', True);   //table cell 4
            $this->Cell($w[4], $col_h, '', 1, 0, 'R', True);   //table cell 5
        }
        $this->SetY($this->GetY() + $col_h);
        
        if(!empty($org_inconv)){
            foreach ($org_inconv as $key => $ord_inconv) {
                if($key != 'normal_3' && $key != 'normal_0'){
                    foreach ($ord_inconv as $amount => $h_value) {
                        $this->SetX(28.3);
                        $this->Cell($w[0], $col_h, utf8_decode($key), 1, 0, 'L', FALSE);   //table cell 1
                        $time_in_100= $equipment->time_user_format($h_value['hour'], 100);
                        $this->Cell($w[1], $col_h, $time_in_100, 1, 0, 'R', FALSE);   //table cell 2
                        $amount = round($amount, 2);
                        $this->Cell($w[2], $col_h, sprintf('%.02f', $amount), 1, 0, 'R', FALSE);   //table cell 3
                        $calc = ($amount * 80) / 100;
                        $this->Cell($w[3], $col_h, sprintf('%.02f', round($calc, 2)), 1, 0, 'R', FALSE);   //table cell 4
                        $this->Cell($w[4], $col_h, sprintf('%.02f', round($time_in_100 * $calc, 2)), 1, 0, 'R', FALSE);   //table cell 5

                        $this->SetY($this->GetY() + $col_h);
                        $this->table_sum += ($time_in_100 * $calc);
                    }
                }
            }
        }

        
        
        if(!empty($oncall_2_to_14)){
            foreach($oncall_2_to_14 as $amount => $hour_value){
                if($hour_value['hour'] == 0.00)
                    continue;
                $this->SetX(28.3);                                      //table last-3 row
                $this->Cell($w[0], $col_h, utf8_decode('Jour'), 1, 0, 'L', FALSE);   //table cell 1
                $time_in_100= $equipment->time_user_format($hour_value['hour'], 100);
                $this->Cell($w[1], $col_h, $time_in_100, 1, 0, 'R', FALSE);   //table cell 2
                $amount = round($amount, 2);
                $this->Cell($w[2], $col_h, sprintf('%.02f', $amount), 1, 0, 'R', FALSE);   //table cell 3
                $calc = ($amount * 80) / 100;
                $this->Cell($w[3], $col_h, sprintf('%.02f', round($calc, 2)), 1, 0, 'R', FALSE);   //table cell 4
                $this->Cell($w[4], $col_h, sprintf('%.02f', round($time_in_100 * $calc, 2)), 1, 0, 'R', FALSE);   //table cell 5
                $this->SetY($this->GetY() + $col_h);
                $this->table_sum += ($time_in_100 * $calc);
            }
        }
        
        //new jour block
        //echo "<pre>final -- lower_jour_inconv ".print_r($lower_jour_inconv, 1)."</pre>";
        if(!empty($lower_jour_inconv)){
            foreach($lower_jour_inconv as $jour_key => $jour_attributes){
                $this->SetX(28.3);                                      //table last-3 row
                $this->Cell($w[0], $col_h, utf8_decode($jour_key), 1, 0, 'L', FALSE);   //table cell 1
                $time_in_100= $equipment->time_user_format($jour_attributes['hour'], 100);
                $this->Cell($w[1], $col_h, $time_in_100, 1, 0, 'R', FALSE);   //table cell 2
                $amount = round($jour_attributes['amount'], 2);
                $this->Cell($w[2], $col_h, sprintf('%.02f', $amount), 1, 0, 'R', FALSE);   //table cell 3
                $calc = round(($amount * 80) / 100, 2);
                $this->Cell($w[3], $col_h, sprintf('%.02f', round($calc, 2)), 1, 0, 'R', FALSE);   //table cell 4
                $this->Cell($w[4], $col_h, sprintf('%.02f', round($time_in_100 * $calc, 2)), 1, 0, 'R', FALSE);   //table cell 5
                $this->SetY($this->GetY() + $col_h);
                $this->table_sum += round($time_in_100 * $calc, 2);
            }
        }
        
        //only for hogia salary system  -- commented on 2014-09-17
        /*if(!empty($oncall_type_salaries) && $this->company_details['salary_system'] == 3){
            foreach($oncall_type_salaries as $jour_key => $jour_attributes){
                foreach($jour_attributes as $jour_salary => $jour_hours){
                    if($jour_hours == '') continue;
                    $this->SetX(28.3);                                      //table last-3 row
                    $this->Cell($w[0], $col_h, utf8_decode($jour_key), 1, 0, 'L', FALSE);   //table cell 1
                    $time_in_100= $equipment->time_user_format($jour_hours['hour'], 100);
                    $this->Cell($w[1], $col_h, $time_in_100, 1, 0, 'R', FALSE);   //table cell 2
                    $amount = round($jour_salary, 2);
                    $this->Cell($w[2], $col_h, sprintf('%.02f', $amount), 1, 0, 'R', FALSE);   //table cell 3
                    $calc = round(($amount * 80) / 100, 2);
                    $this->Cell($w[3], $col_h, sprintf('%.02f', round($calc, 2)), 1, 0, 'R', FALSE);   //table cell 4
                    $this->Cell($w[4], $col_h, sprintf('%.02f', round($time_in_100 * $calc, 2)), 1, 0, 'R', FALSE);   //table cell 5
                    $this->SetY($this->GetY() + $col_h);
                    $this->table_sum += round($time_in_100 * $calc, 2);
                }
            }
        }*/
         
        /*
        //P1 table section A000 (Jour/beredskap natt sjukdom) - look below this function
        $this->SetX(28.3);                                      //table last-3 row
        //$this->Cell($w[0], $col_h, utf8_decode('Jour/beredskap vardag sjukdom'), 1, 0, 'L', FALSE);   //table cell 1
        $this->Cell($w[0], $col_h, utf8_decode('Jour natt'), 1, 0, 'L', FALSE);   //table cell 1
        $this->Cell($w[1], $col_h, $time_in_100_A000, 1, 0, 'R', FALSE);   //table cell 2
        $this->Cell($w[2], $col_h, $jour_natt_amount_A000, 1, 0, 'R', FALSE);   //table cell 3
        $this->Cell($w[3], $col_h, $calc_A000, 1, 0, 'R', FALSE);   //table cell 4
        $this->Cell($w[4], $col_h, $jour_sum_A000 != 0 ? sprintf('%.02f', round($jour_sum_A000, 2)) : '', 1, 0, 'R', FALSE);   //table cell 5
        $this->SetY($this->GetY() + $col_h);
        
        //P1 table section A001 (Jour/beredskap vardag sjukdom) - look below this function
        $this->SetX(28.3);                                      //table last-3 row
        //$this->Cell($w[0], $col_h, utf8_decode('Jour/beredskap vardag sjukdom'), 1, 0, 'L', FALSE);   //table cell 1
        $this->Cell($w[0], $col_h, utf8_decode('Jour vardag'), 1, 0, 'L', FALSE);   //table cell 1
        $this->Cell($w[1], $col_h, $time_in_100_A001, 1, 0, 'R', FALSE);   //table cell 2
        $this->Cell($w[2], $col_h, $jour_vardag_amount_A001, 1, 0, 'R', FALSE);   //table cell 3
        $this->Cell($w[3], $col_h, $calc_A001, 1, 0, 'R', FALSE);   //table cell 4
        $this->Cell($w[4], $col_h, $jour_sum_A001 != 0 ? sprintf('%.02f', round($jour_sum_A001, 2)) : '', 1, 0, 'R', FALSE);   //table cell 5
        $this->SetY($this->GetY() + $col_h);
        
        //P1 table section A002 (Jour/beredskap helg sjukdom)
        $this->SetX(28.3);                                      //table last-2 row
        //$this->Cell($w[0], $col_h, utf8_decode('Jour/beredskap helg sjukdom'), 1, 0, 'L', FALSE);   //table cell 1
        $this->Cell($w[0], $col_h, utf8_decode('Jour helg'), 1, 0, 'L', FALSE);   //table cell 1
        $this->Cell($w[1], $col_h, $time_in_100_A002, 1, 0, 'R', FALSE);   //table cell 2
        $this->Cell($w[2], $col_h, $jour_helg_amount_A002, 1, 0, 'R', FALSE);   //table cell 3
        $this->Cell($w[3], $col_h, $calc_A002, 1, 0, 'R', FALSE);   //table cell 4
        $this->Cell($w[4], $col_h, $jour_sum_A002 != 0 ? sprintf('%.02f', round($jour_sum_A002, 2)) : '', 1, 0, 'R', FALSE);   //table cell 5
        $this->SetY($this->GetY() + $col_h);
        */
        
        $this->SetX(28.3);                                      //table last-1 row
        $this->Cell($w[0], $col_h, utf8_decode('Pensionsförsäkring'), 1, 0, 'L', FALSE);   //Försäkring
        if ($insurance_word_person == "") $insurance_word_person = 0;
        $this->Cell($w[1], $col_h, $insurance_word_person . "%", 1, 0, 'R', FALSE);   //table cell 2
        $this->Cell($w[2], $col_h, '', 1, 0, 'R', FALSE);   //table cell 3
        $this->Cell($w[3], $col_h, '', 1, 0, 'R', FALSE);   //table cell 4
        $total_insurance = ($this->table_sum * $insurance_word_person) / 100;
        $this->Cell($w[4], $col_h, sprintf('%.02f', round($total_insurance, 2)), 1, 0, 'R', FALSE);   //table cell 5
        $this->SetY($this->GetY() + $col_h);


        $this->SetX(28.3);                                      //table last row
        $this->Cell($w[0], $col_h, utf8_decode('Sociala avgifter'), 1, 0, 'L', FALSE);   //table cell 1
        if ($SS_contibution == "") $SS_contibution = 0;
        $this->Cell($w[1], $col_h, $SS_contibution . "%", 1, 0, 'R', FALSE);   //table cell 2
        $this->Cell($w[2], $col_h, '', 1, 0, 'R', FALSE);   //table cell 3
        $this->Cell($w[3], $col_h, '', 1, 0, 'R', FALSE);   //table cell 4
        $total_contribution = ($this->table_sum * $SS_contibution) / 100;
        $this->Cell($w[4], $col_h, sprintf('%.02f', round($total_contribution, 2)), 1, 0, 'R', FALSE);   //table cell 5
        $this->SetY($this->GetY() + $col_h);

        $this->SetLineWidth(0.7);                       //sum row
        $this->SetXY(28.3, $this->GetY() + .2);
        $this->Cell($w[0], $col_h, '', 0, 0, 'C', FALSE);   //table cell 1
        $this->Cell($w[1], $col_h, '', 0, 0, 'R', FALSE);   //table cell 2
        $this->Cell($w[2], $col_h, '', 0, 0, 'R', FALSE);   //table cell 3
        $this->Cell($w[3], $col_h, utf8_decode('Summa'), 0, 0, 'C', FALSE);   //table cell 4
        $total = $this->table_sum + round($total_insurance, 2) + round($total_contribution, 2);
        $this->Cell($w[4], $col_h, sprintf('%.02f', round($total, 2)), 1, 1, 'R', FALSE);   //table cell 5
        $this->SetLineWidth();

        $this->Ln(1);
    }

    function get_P2_table1_sum_copy($table_f_date1, $table_to_date2, $insurance_word_person, $SS_contibution, $ord_inconv_details, $qualifying_day = array()) {
        /* ordinary person table */
        $equipment          = new equipment();
        $this->table_sum    = 0;
        $total_insurance    = 0;
        $total_contribution = 0;
        $total              = 0;
        
        //echo "<pre>".print_r($ord_inconv_details, 1)."</pre>";

        $semestersattn_jour_dag_180_onwards = $ord_inconv_details['180_onwards']['semestersattn_jour_dag_2_14_salaries'];

        $ord_inconv_details_180_onwards = $ord_inconv_details['180_onwards']['inconv_details'];


        $semestersattn_jour_dag_15_180 = $ord_inconv_details['15_180']['semestersattn_jour_dag_2_14_salaries'];

        $ord_inconv_details_15_180 = $ord_inconv_details['15_180']['inconv_details'];
        //only for hogia salary system
        //$ord_inconv_details_15_180         = $ord_inconv_details['15_180']['inconv_details'];



        $semestersattn_jour_dag_2_14= $ord_inconv_details['semestersattn_jour_dag_2_14_salaries'];
        $oncall_type_salaries       = $ord_inconv_details['oncall_type_salaries'];        //only for hogia salary system
        $ord_inconv_details         = $ord_inconv_details['inconv_details'];
        
        //echo "<pre>".print_r($ord_inconv_details, 1)."</pre>";
        //echo "<pre>Inconv: ".print_r($ord_inconv_details, 1)."</pre>";
        $qualifying_day_total_hour      = $qualifying_day['qualifying_total_time'];
        $qualifying_day_total_amount    = $qualifying_day['nomal_salary_amount'];

        $normal_2_to_14 = array();
        $oncall_2_to_14 = array();

        $normal_15_to_180 = array();
        $oncall_15_to_180 = array();

        $normal_180_onwards = array();
        $oncall_180_onwards = array();

        $lower_jour_inconv = array();
        $org_inconv = array();

        $lower_jour_inconv_15_180 = array();
        $org_inconv_15_180 = array();

        $intercept_qualify_exceed_normal = FALSE;
        $intercept_qualify_exceed_oncall = FALSE;

        if(!empty($ord_inconv_details['normal_0'])){
            foreach ($ord_inconv_details['normal_0'] as $amount => $h_value){
                $normal_2_to_14[$amount]['hour'] = $h_value['hour'];
            }
        }
        
        if(empty($normal_2_to_14))  //set default as 0
            $normal_2_to_14['0']['hour'] = 0;
        
        if(!empty($ord_inconv_details['normal_3'])){
            foreach ($ord_inconv_details['normal_3'] as $amount => $h_value){
                $oncall_2_to_14[$amount]['hour'] = $h_value['hour'];
            }
        }

        if(!empty($ord_inconv_details)){
            foreach ($ord_inconv_details as $key => $values){
                if(stripos($key, 'jour') !== FALSE){
                    foreach ($values as $amount => $h_value){
                        $lower_jour_inconv[$key]['hour'] = $h_value['hour'];
                        $lower_jour_inconv[$key]['amount'] = $amount;
                    }
                    continue;
                }else if($key == 'normal_3' || $key == 'normal_0')
                    continue;
                foreach ($values as $amount => $h_value){
                    if(!empty($org_inconv[$key][$amount]) || isset($org_inconv[$key][$amount]))
                        $org_inconv[$key][$amount]['hour'] = $equipment->time_sum($org_inconv[$key][$amount]['hour'], $h_value['hour']);
                    else
                        $org_inconv[$key][$amount]['hour'] = $h_value['hour'];
                }
            }
        }

        ////////////calculation for oncall////////////////
        if(!empty($ord_inconv_details_15_180['normal_0'])){
            foreach ($ord_inconv_details_15_180['normal_0'] as $amount => $h_value){
                $normal_15_to_180[$amount]['hour'] = $h_value['hour'];
            }
        }
        
        if(empty($normal_15_to_180))  //set default as 0
            $normal_15_to_180['0']['hour'] = 0;
        
        if(!empty($ord_inconv_details_15_180['normal_3'])){
            foreach ($ord_inconv_details_15_180['normal_3'] as $amount => $h_value){
                $oncall_15_to_180[$amount]['hour'] = $h_value['hour'];
            }
        }


        if(!empty($ord_inconv_details_180_onwards['normal_0'])){
            foreach ($ord_inconv_details_180_onwards['normal_0'] as $amount => $h_value){
                $normal_180_onwards[$amount]['hour'] = $h_value['hour'];
            }
        }
        
        if(empty($normal_180_onwards))  //set default as 0
            $normal_180_onwards['0']['hour'] = 0;
        
        if(!empty($ord_inconv_details_180_onwards['normal_3'])){
            foreach ($ord_inconv_details_180_onwards['normal_3'] as $amount => $h_value){
                $oncall_180_onwards[$amount]['hour'] = $h_value['hour'];
            }
        }

        
        ///////////////////////////////////


        $table_sum=0;
        foreach($normal_2_to_14 as $amount => $hour_value){
            $time_in_100 = $equipment->time_user_format($hour_value['hour'], 100);
            $amount = round($amount, 2);
            $calc = ($amount * 80) / 100;
            $calc = $time_in_100 * $calc;
            $table_sum += $calc;

            
            $calc = round(($amount * 12) / 100, 2);
            $calc = $time_in_100 * $calc;
            $table_sum += $calc;
        }
        
        //echo "<pre>".print_r($normal_15_to_180, 1)."</pre>";
        //This for calculating "Semestersättn Jour dag 2-14" row
        if($this->company_details['include_sem_2_14_oncall_salary'] == 1){
            if(!empty($semestersattn_jour_dag_2_14)){
                foreach ($semestersattn_jour_dag_2_14 as $salary => $params) {
                    $time_in_100 = round($equipment->time_user_format(round($params['hours'], 2), 100) / 4, 2);
                    $calc = round(($salary * 12) / 100, 2);
                    $calc = $time_in_100 * $calc;
                    $table_sum += $calc;
                    
                }
            }
        }
        
        if(!empty($normal_15_to_180)){
            $amount = key($normal_15_to_180);
            $time_in_100 = $equipment->time_user_format($normal_15_to_180[$amount]['hour'], 100);
            if((float)$time_in_100){                
                $calc = round(($amount * 12) / 100, 2);
                $calc = $time_in_100 * $calc;
                $table_sum += $calc;
            }
        }

        if($this->company_details['include_sem_2_14_oncall_salary'] == 1){
            if(!empty($semestersattn_jour_dag_15_180)){
                
                    $amount = key($semestersattn_jour_dag_15_180);
                    $time_in_100 = round($equipment->time_user_format(round($semestersattn_jour_dag_15_180[$amount]['hours'], 2), 100) / 4, 2);
                    if((float)$time_in_100){
                        $calc = round(($amount * 12) / 100, 2);
                        $calc = $time_in_100 * $calc;
                        $table_sum += $calc;
                    }
            }
        }

        if(!empty($normal_180_onwards) || !empty($semestersattn_jour_dag_180_onwards)){
            $time_in_100 = 0;
            $amount = 0;
            if(!empty($normal_180_onwards)){
                $amount = key($normal_180_onwards);
                $time_in_100 = $equipment->time_user_format($normal_180_onwards[$amount]['hour'], 100);
            }
            if(!empty($semestersattn_jour_dag_180_onwards)){
                $amount = key($semestersattn_jour_dag_180_onwards);
                $time_in_100 += round($equipment->time_user_format(round($semestersattn_jour_dag_180_onwards[$amount]['hours'], 2), 100) / 4, 2);
            }
            $amount = 0;

            
            if((float)$time_in_100){
                $calc = round(($amount * 12) / 100, 2);
                $calc = $time_in_100 * $calc;
                $table_sum += $calc;
            }
        }

        //echo $table_sum."--";

        $time_in_100= $equipment->time_user_format($qualifying_day_total_hour, 100);

        if($this->company_details['include_karense_salary'] == 1)  {
            $calc = round(($qualifying_day_total_amount * 12) / 100, 2);
            $calc = $time_in_100 * $calc;
            $table_sum += $calc;
        }
        //echo $this->company_details['include_karense_salary']."--".$table_sum."--";
        if(!empty($org_inconv)){
            foreach ($org_inconv as $key => $ord_inconv) {
                if($key != 'normal_3' && $key != 'normal_0'){
                    foreach ($ord_inconv as $amount => $h_value) {
                        $time_in_100= $equipment->time_user_format($h_value['hour'], 100);
                        $amount = round($amount, 2);
                        $calc = ($amount * 80) / 100;
                        $table_sum += ($time_in_100 * $calc);
                    }
                }
            }
        }

         
        
        if(!empty($oncall_2_to_14)){
            foreach($oncall_2_to_14 as $amount => $hour_value){
                if($hour_value['hour'] == 0.00)
                    continue;
                $time_in_100= $equipment->time_user_format($hour_value['hour'], 100);
                $amount = round($amount, 2);
                $calc = ($amount * 80) / 100;
                $table_sum += ($time_in_100 * $calc);
            }
        }
       
        //new jour bloc
        if(!empty($lower_jour_inconv)){
            foreach($lower_jour_inconv as $jour_key => $jour_attributes){
                $time_in_100= $equipment->time_user_format($jour_attributes['hour'], 100);
                $amount = round($jour_attributes['amount'], 2);
                $calc = round(($amount * 80) / 100, 2);
                $table_sum += round($time_in_100 * $calc, 2);
            }
        }
        
        //Försäkring
        if ($insurance_word_person == "") $insurance_word_person = 0;
        $total_insurance = ($table_sum * $insurance_word_person) / 100;

        if ($SS_contibution == "") $SS_contibution = 0;
        $total_contribution = ($table_sum * $SS_contibution) / 100;
        $total = $table_sum + round($total_insurance, 2) + round($total_contribution, 2);
        return round($total,2);
    }



    function get_P2_table2_sum_copy($ename = NULL, $vikaries_normal_salary = NULL, $insurance_substitute = NULL, $incov_details = array(), $incov_details_15_180 = array(), $incov_details_181 = array(), $qualifying_day = array(), $vikarie_sociala = 0) {
        /* vikarie table */
        $equipment = new equipment();
        //echo "<pre>incov_details".print_r($incov_details, 1)."</pre>";
        //echo "<pre>qualifying_day".print_r($incov_details_181, 1)."</pre>";
        $semestersattn_jour_dag_2_14 = array();
        $oncall_type_salaries = array();
        $semestersattn_jour_dag_15_180 = array();
        $semestersattn_jour_dag_181 = array();

        if(!empty($incov_details)){
            $semestersattn_jour_dag_2_14= $incov_details['semestersattn_jour_dag_2_14_salaries'];
            $oncall_type_salaries       = $incov_details['oncall_type_salaries'];        //only for hogia salary system
            $incov_details              = $incov_details['inconv_details'];
        }
        if($incov_details_15_180){
            $semestersattn_jour_dag_15_180 = $incov_details_15_180['semestersattn_jour_dag_2_14_salaries'];
            $incov_details_15_180 = $incov_details_15_180['inconv_details'];
        }
        if($incov_details_181){    
            $semestersattn_jour_dag_181 = $incov_details_181['semestersattn_jour_dag_2_14_salaries'];
            $incov_details_181 = $incov_details_181['inconv_details'];
        }


        
        //row 1
        if(!isset($qualifying_day['qualifying_group']) || empty($qualifying_day['qualifying_group'])){
            $qualifying_day['qualifying_group']['0'] = 0.00;
        }

        $oncall_keys = array('jour', 'call_training');
        $normal_keys = array('Ord. tid', 'overtime', 'qual_overtime', 'more_time', 'some_other_time', 'training', 'personal_meeting');
                
        $normal_2_to_14 = array();
        $oncall_2_to_14 = array();
        $org_inconv     = array();
        
        if(!empty($incov_details)){
            foreach ($incov_details as $key => $values){
                if($key == 'normal_3' || $key == 'normal_0') continue;
                foreach ($values as $amount => $h_value){
                    if(in_array($key, $normal_keys)){
                        if(!empty($normal_2_to_14[$key][$amount]))
                            $normal_2_to_14[$key][$amount]['hour'] = $equipment->time_sum($normal_2_to_14[$key][$amount]['hour'], $h_value['hour']);
                        else
                            $normal_2_to_14[$key][$amount]['hour'] = $h_value['hour'];
                    }
                    else if(in_array($key, $oncall_keys)){
                        if(!empty($oncall_2_to_14[$key][$amount]))
                            $oncall_2_to_14[$key][$amount]['hour'] = $equipment->time_sum($oncall_2_to_14[$key][$amount]['hour'], $h_value['hour']);
                        else
                            $oncall_2_to_14[$key][$amount]['hour'] = $h_value['hour'];
                    }
                    else{
                        if(!empty($org_inconv[$key][$amount]) || isset($org_inconv[$key][$amount]))
                            $org_inconv[$key][$amount]['hour'] = $equipment->time_sum($org_inconv[$key][$amount]['hour'], $h_value['hour']);
                        else
                            $org_inconv[$key][$amount]['hour'] = $h_value['hour'];
                    }
                }
            }
        }
        
        if(empty($normal_2_to_14))  //set default as 0
            $normal_2_to_14['Ord. tid']['0']['hour'] = 0;


        $normal_15_to_180 = array();
        $oncall_15_to_180 = array();
        $org_inconv_15_180 = array();
        ksort($incov_details_15_180);
        //echo "<pre>15_180: ".print_r($incov_details_15_180, 1)."</pre>";
        if(!empty($incov_details_15_180)){
            foreach ($incov_details_15_180 as $key => $values){
                if($key == 'normal_3' || $key == 'normal_0') continue;
                foreach ($values as $amount => $h_value){
                    if(in_array($key, $normal_keys)){
                        if(!empty($normal_15_to_180[$key][$amount]))
                            $normal_15_to_180[$key][$amount]['hour'] = $equipment->time_sum($normal_15_to_180[$key][$amount]['hour'], $h_value['hour']);
                        else
                            $normal_15_to_180[$key][$amount]['hour'] = $h_value['hour'];
                    }
                    else if(in_array($key, $oncall_keys)){
                        if(!empty($oncall_15_to_180[$key][$amount]))
                            $oncall_15_to_180[$key][$amount]['hour'] = $equipment->time_sum($oncall_15_to_180[$key][$amount]['hour'], $h_value['hour']);
                        else
                            $oncall_15_to_180[$key][$amount]['hour'] = $h_value['hour'];
                    }
                    else{
                        if(!empty($org_inconv_15_180[$key][$amount]) || isset($org_inconv_15_180[$key][$amount]))
                            $org_inconv_15_180[$key][$amount]['hour'] = $equipment->time_sum($org_inconv_15_180[$key][$amount]['hour'], $h_value['hour']);
                        else
                            $org_inconv_15_180[$key][$amount]['hour'] = $h_value['hour'];
                    }
                }
            }
        }
        
        if(empty($normal_15_to_180))  //set default as 0
            $normal_15_to_180['Ord. tid']['0']['hour'] = 0;    



        $normal_181 = array();
        $oncall_181 = array();
        $org_inconv_181 = array();
        ksort($incov_details_181);
        //echo "<pre>15_180: ".print_r($incov_details_15_180, 1)."</pre>";
        if(!empty($incov_details_181)){
            foreach ($incov_details_181 as $key => $values){
                if($key == 'normal_3' || $key == 'normal_0') continue;
                foreach ($values as $amount => $h_value){
                    if(in_array($key, $normal_keys)){
                        if(!empty($normal_15_to_180[$key][$amount]))
                            $normal_181[$key][$amount]['hour'] = $equipment->time_sum($normal_181[$key][$amount]['hour'], $h_value['hour']);
                        else
                            $normal_181[$key][$amount]['hour'] = $h_value['hour'];
                    }
                    else if(in_array($key, $oncall_keys)){
                        if(!empty($oncall_181[$key][$amount]))
                            $oncall_181[$key][$amount]['hour'] = $equipment->time_sum($oncall_181[$key][$amount]['hour'], $h_value['hour']);
                        else
                            $oncall_181[$key][$amount]['hour'] = $h_value['hour'];
                    }
                    else{
                        if(!empty($org_inconv_181[$key][$amount]) || isset($org_inconv_181[$key][$amount]))
                            $org_inconv_181[$key][$amount]['hour'] = $equipment->time_sum($org_inconv_181[$key][$amount]['hour'], $h_value['hour']);
                        else
                            $org_inconv_181[$key][$amount]['hour'] = $h_value['hour'];
                    }
                }
            }
        }
        
        if(empty($normal_181))  //set default as 0
            $normal_181['Ord. tid']['0']['hour'] = 0;        
        
       

        $col_h = 6.2;
        $karenses = array();
        if(!empty($qualifying_day['qualifying_group'])){
            foreach($qualifying_day['qualifying_group'] as $key => $values){
                if($key == '0') continue;
                if(isset($karenses[$key][$values['amount']]))
                    $karenses[$key][$values['amount']] = $equipment->time_sum($karenses[$key][$values['amount']], $values['hour']);
                else
                    $karenses[$key][$values['amount']] = $values['hour'];
            }
        }
        if(!empty($qualifying_day['additional_qualify'])){
            foreach($qualifying_day['additional_qualify'] as $key => $values){
                if(isset($karenses[$key][$values['amount']]))
                    $karenses[$key][$values['amount']] = $equipment->time_sum($karenses[$key][$values['amount']], $values['hour']);
                else
                    $karenses[$key][$values['amount']] = $values['hour'];
            }
        }
        $static_keys = array('Ord. tid', 'overtime', 'qual_overtime', 'more_time', 'some_other_time', 'training', 'personal_meeting', 'jour', 'call_training');
        if(empty($karenses)){
                
        }else{
            // echo "<pre>".print_r($karenses, 1)."</pre>";
            foreach($karenses as $key => $entries){
                foreach($entries as $amount => $hour){
                                                //table row3
                    $additional_flag = (in_array($key, $static_keys)) ? NULL : ' - '.$key;
                    $time_in_100= $equipment->time_user_format($hour, 100);
                    $amount = round($amount, 2);
                    //table cell 3
                    $calc = $time_in_100 * $amount;
                    //table cell 4
                    $vik_table_sum += $calc;
                    
                    // Semestersätt row only displayed for static keys (not displayed for inconvenience and holidays)
                    if($additional_flag == NULL){
                        
                        $vikaries_normal_salary_12 = round($vikaries_normal_salary * 12 / 100, 2);
                        
                        $calc = $time_in_100 * $vikaries_normal_salary_12;
                        
                        $vik_table_sum += $calc;
                    }
                }
            }
        }
        
        

        //2-14 total normal calculation
        $total_normal_2_to_14_hours = 0;
        $total_normal_2_to_14_salary_sum = 0;
        $count_normal_2_to_14 = 0;
        foreach($normal_2_to_14 as $key => $entries){       //to merge array
            foreach ($entries as $amount => $h_value) {
                $count_normal_2_to_14++;
                $total_normal_2_to_14_hours = $equipment->time_sum($total_normal_2_to_14_hours, $h_value['hour']);
                $time_in_100= $equipment->time_user_format($h_value['hour'], 100);
                $amount = round($amount, 2);
                $total_normal_2_to_14_salary_sum += ($time_in_100 * $amount);
            }
        }
        $time_in_100= $equipment->time_user_format($total_normal_2_to_14_hours, 100);
        $normal_2_to_14_average_salary = ($time_in_100 == 0) ? 0 : round($total_normal_2_to_14_salary_sum/ $time_in_100, 2);
        
        
        $vik_table_sum += round($total_normal_2_to_14_salary_sum*$time_in_100, 2);

        
        $vikaries_normal_salary_12 = round($vikaries_normal_salary * 12 / 100, 2);
        
        $calc = $time_in_100 * $vikaries_normal_salary_12;
        $vik_table_sum += round($calc, 2);
        
        //echo "<pre>semestersattn_jour_dag_2_14".print_r($semestersattn_jour_dag_2_14, 1)."</pre>";
        if($this->company_details['include_sem_2_14_oncall_salary'] == 1){
            if(!empty($semestersattn_jour_dag_2_14)){
                foreach ($semestersattn_jour_dag_2_14 as $salary => $params) {
                    $time_in_100 = round($equipment->time_user_format(round($params['hours'], 2), 100) / 4, 2);
                    
                    $calc = round(($salary * 12) / 100, 2);
                    $calc = round($time_in_100 * $calc, 2);
                    
                    $vik_table_sum += $calc;
                }
            }
        }


        $total_normal_15_to_180_hours = 0;
        $total_normal_15_to_180_salary_sum = 0;
        $count_normal_15_to_180 = 0;
        foreach($normal_15_to_180 as $key => $entries){       //to merge array
            foreach ($entries as $amount => $h_value) {
                $count_normal_15_to_180++;
                $total_normal_15_to_180_hours = $equipment->time_sum($total_normal_15_to_180_hours, $h_value['hour']);
                $time_in_100= $equipment->time_user_format($h_value['hour'], 100);
                $amount = round($amount, 2);
                $total_normal_15_to_180_salary_sum += ($time_in_100 * $amount);
            }
        }
        $time_in_100= $equipment->time_user_format($total_normal_15_to_180_hours, 100);
        $normal_15_to_180_average_salary = ($time_in_100 == 0) ? 0 : round($total_normal_15_to_180_salary_sum/ $time_in_100, 2);
        
        
        
        $vik_table_sum += round($normal_15_to_180_average_salary*$time_in_100, 2);

        
        $vikaries_normal_salary_12 = round($vikaries_normal_salary * 12 / 100, 2);
        $calc = $time_in_100 * $vikaries_normal_salary_12;
        $vik_table_sum += round($calc, 2);



        $total_normal_181_hours = 0;
        $total_normal_181_salary_sum = 0;
        $count_normal_181 = 0;
        //echo "<pre>".print_r($normal_181, 1)."</pre>";
        foreach($normal_181 as $key => $entries){       //to merge array
            foreach ($entries as $amount => $h_value) {
                $count_normal_181++;
                $total_normal_181_hours = $equipment->time_sum($total_normal_181_hours, $h_value['hour']);
                $time_in_100= $equipment->time_user_format($h_value['hour'], 100);
                $amount = round($amount, 2);
                $total_normal_181_salary_sum += ($time_in_100 * $amount);
            }
        }
        $time_in_100= $equipment->time_user_format($total_normal_181_hours, 100);
        $normal_181_average_salary = ($time_in_100 == 0) ? 0 : round($total_normal_181_salary_sum/ $time_in_100, 2);
        
        
        
        $vik_table_sum += round($normal_181_average_salary*$time_in_100, 2);
        
        
        if(!empty($org_inconv)){
            foreach ($org_inconv as $key => $ord_inconv) {
                if($key == 'normal_3' || $key == 'normal_0')
                    continue;
                foreach ($ord_inconv as $amount => $h_value) {
                    
                    $time_in_100= $equipment->time_user_format($h_value['hour'], 100);
                    $amount = round($amount, 2);
                    $calc = $time_in_100 * $amount;
                    $vik_table_sum += $calc;
                }
            }
        }


        if(!empty($org_inconv_15_180)){
            foreach ($org_inconv_15_180 as $key => $ord_inconv) {
                if($key == 'normal_3' || $key == 'normal_0')
                    continue;
                foreach ($ord_inconv as $amount => $h_value) {
                    $time_in_100= $equipment->time_user_format($h_value['hour'], 100);
                    $amount = round($amount, 2);
                    $calc = $time_in_100 * $amount;
                    $vik_table_sum += $calc;
                }
            }
        }


        if(!empty($org_inconv_181)){
            foreach ($org_inconv_181 as $key => $ord_inconv) {
                if($key == 'normal_3' || $key == 'normal_0')
                    continue;
                foreach ($ord_inconv as $amount => $h_value) {
                    $time_in_100= $equipment->time_user_format($h_value['hour'], 100);
                    $amount = round($amount, 2);
                    $calc = $time_in_100 * $amount;
                    $vik_table_sum += $calc;
                }
            }
        }

        


        
         //only for hogia salary system
        if(!empty($oncall_type_salaries) && $this->company_details['salary_system'] == 3){
            //echo "<pre>".print_r($oncall_type_salaries, 1)."</pre>";
            foreach($oncall_type_salaries as $jour_key => $jour_attributes){
                foreach($jour_attributes as $jour_salary => $jour_hours){
                    if($jour_hours == '') continue;                    
                    $time_in_100= $equipment->time_user_format($jour_hours['hour'], 100);
                    $amount = round($jour_salary, 2);
                    $calc = $time_in_100 * $amount;
                    $vik_table_sum += $calc;
                }
            }
        }
        
        if(!empty($oncall_2_to_14)){
            foreach($oncall_2_to_14 as $key => $entries){
                foreach ($entries as $amount => $h_value) {
                    $time_in_100= $equipment->time_user_format($h_value['hour'], 100);
                    $amount = round($amount, 2);
                    $calc = $time_in_100 * ($amount / 4);
                    $vik_table_sum += $calc;
                }
            }
        }
        
        
        if ($insurance_substitute == "") $insurance_substitute = 0;
        $insurance_sum = ($vik_table_sum * $insurance_substitute)/100;
        $sociala_sum = ($vik_table_sum * $vikarie_sociala)/100;
        $calc = $vik_table_sum + $insurance_sum + $sociala_sum; 
        
        return round($calc,2);

    }


    function P2_table2($ename = NULL, $vikaries_normal_salary = NULL, $insurance_substitute = NULL, $incov_details = array(), $incov_details_15_180 = array(), $incov_details_181 = array(), $qualifying_day = array(), $vikarie_sociala = 0) {
        /* vikarie table */
        $equipment = new equipment();
        //echo "<pre>incov_details".print_r($incov_details, 1)."</pre>";
        //echo "<pre>qualifying_day".print_r($incov_details_181, 1)."</pre>";
        $semestersattn_jour_dag_2_14 = array();
        $oncall_type_salaries = array();
        $semestersattn_jour_dag_15_180 = array();
        $semestersattn_jour_dag_181 = array();

        if(!empty($incov_details)){
            $semestersattn_jour_dag_2_14= $incov_details['semestersattn_jour_dag_2_14_salaries'];
            $oncall_type_salaries       = $incov_details['oncall_type_salaries'];        //only for hogia salary system
            $incov_details              = $incov_details['inconv_details'];
        }
        if($incov_details_15_180){
            $semestersattn_jour_dag_15_180 = $incov_details_15_180['semestersattn_jour_dag_2_14_salaries'];
            $incov_details_15_180 = $incov_details_15_180['inconv_details'];
        }
        if($incov_details_181){    
            $semestersattn_jour_dag_181 = $incov_details_181['semestersattn_jour_dag_2_14_salaries'];
            $incov_details_181 = $incov_details_181['inconv_details'];
        }


        
        //row 1
        if(!isset($qualifying_day['qualifying_group']) || empty($qualifying_day['qualifying_group'])){
            $qualifying_day['qualifying_group']['0'] = 0.00;
        }

        $oncall_keys = array('jour', 'call_training');
        $normal_keys = array('Ord. tid', 'overtime', 'qual_overtime', 'more_time', 'some_other_time', 'training', 'personal_meeting');
                
        $normal_2_to_14 = array();
        $oncall_2_to_14 = array();
        $org_inconv     = array();
        
        if(!empty($incov_details)){
            foreach ($incov_details as $key => $values){
                if($key == 'normal_3' || $key == 'normal_0') continue;
                foreach ($values as $amount => $h_value){
                    if(in_array($key, $normal_keys)){
                        if(!empty($normal_2_to_14[$key][$amount]))
                            $normal_2_to_14[$key][$amount]['hour'] = $equipment->time_sum($normal_2_to_14[$key][$amount]['hour'], $h_value['hour']);
                        else
                            $normal_2_to_14[$key][$amount]['hour'] = $h_value['hour'];
                    }
                    else if(in_array($key, $oncall_keys)){
                        if(!empty($oncall_2_to_14[$key][$amount]))
                            $oncall_2_to_14[$key][$amount]['hour'] = $equipment->time_sum($oncall_2_to_14[$key][$amount]['hour'], $h_value['hour']);
                        else
                            $oncall_2_to_14[$key][$amount]['hour'] = $h_value['hour'];
                    }
                    else{
                        if(!empty($org_inconv[$key][$amount]) || isset($org_inconv[$key][$amount]))
                            $org_inconv[$key][$amount]['hour'] = $equipment->time_sum($org_inconv[$key][$amount]['hour'], $h_value['hour']);
                        else
                            $org_inconv[$key][$amount]['hour'] = $h_value['hour'];
                    }
                }
            }
        }
        
        if(empty($normal_2_to_14))  //set default as 0
            $normal_2_to_14['Ord. tid']['0']['hour'] = 0;


        $normal_15_to_180 = array();
        $oncall_15_to_180 = array();
        $org_inconv_15_180 = array();
        ksort($incov_details_15_180);
        //echo "<pre>15_180: ".print_r($incov_details_15_180, 1)."</pre>";
        if(!empty($incov_details_15_180)){
            foreach ($incov_details_15_180 as $key => $values){
                if($key == 'normal_3' || $key == 'normal_0') continue;
                foreach ($values as $amount => $h_value){
                    if(in_array($key, $normal_keys)){
                        if(!empty($normal_15_to_180[$key][$amount]))
                            $normal_15_to_180[$key][$amount]['hour'] = $equipment->time_sum($normal_15_to_180[$key][$amount]['hour'], $h_value['hour']);
                        else
                            $normal_15_to_180[$key][$amount]['hour'] = $h_value['hour'];
                    }
                    else if(in_array($key, $oncall_keys)){
                        if(!empty($oncall_15_to_180[$key][$amount]))
                            $oncall_15_to_180[$key][$amount]['hour'] = $equipment->time_sum($oncall_15_to_180[$key][$amount]['hour'], $h_value['hour']);
                        else
                            $oncall_15_to_180[$key][$amount]['hour'] = $h_value['hour'];
                    }
                    else{
                        if(!empty($org_inconv_15_180[$key][$amount]) || isset($org_inconv_15_180[$key][$amount]))
                            $org_inconv_15_180[$key][$amount]['hour'] = $equipment->time_sum($org_inconv_15_180[$key][$amount]['hour'], $h_value['hour']);
                        else
                            $org_inconv_15_180[$key][$amount]['hour'] = $h_value['hour'];
                    }
                }
            }
        }
        
        if(empty($normal_15_to_180))  //set default as 0
            $normal_15_to_180['Ord. tid']['0']['hour'] = 0;    



        $normal_181 = array();
        $oncall_181 = array();
        $org_inconv_181 = array();
        ksort($incov_details_181);
        //echo "<pre>15_180: ".print_r($incov_details_15_180, 1)."</pre>";
        if(!empty($incov_details_181)){
            foreach ($incov_details_181 as $key => $values){
                if($key == 'normal_3' || $key == 'normal_0') continue;
                foreach ($values as $amount => $h_value){
                    if(in_array($key, $normal_keys)){
                        if(!empty($normal_15_to_180[$key][$amount]))
                            $normal_181[$key][$amount]['hour'] = $equipment->time_sum($normal_181[$key][$amount]['hour'], $h_value['hour']);
                        else
                            $normal_181[$key][$amount]['hour'] = $h_value['hour'];
                    }
                    else if(in_array($key, $oncall_keys)){
                        if(!empty($oncall_181[$key][$amount]))
                            $oncall_181[$key][$amount]['hour'] = $equipment->time_sum($oncall_181[$key][$amount]['hour'], $h_value['hour']);
                        else
                            $oncall_181[$key][$amount]['hour'] = $h_value['hour'];
                    }
                    else{
                        if(!empty($org_inconv_181[$key][$amount]) || isset($org_inconv_181[$key][$amount]))
                            $org_inconv_181[$key][$amount]['hour'] = $equipment->time_sum($org_inconv_181[$key][$amount]['hour'], $h_value['hour']);
                        else
                            $org_inconv_181[$key][$amount]['hour'] = $h_value['hour'];
                    }
                }
            }
        }
        
        if(empty($normal_181))  //set default as 0
            $normal_181['Ord. tid']['0']['hour'] = 0;        
        
        //echo "<pre>normal_2_to_14: ".print_r($normal_2_to_14, 1)."</pre>";
        //echo $total_normal_2_to_14_hours.'===='. $total_normal_2_to_14_salary_sum. '===='. $count_normal_2_to_14. '===='. $normal_2_to_14_average_salary;
        //echo "<pre>oncall_2_to_14: ".print_r($oncall_2_to_14, 1)."</pre>";
        //echo "<pre>qualifying_group : ".print_r($qualifying_day['qualifying_group'], 1)."</pre>";
        //echo "<pre>org_inconv :".print_r($org_inconv, 1)."</pre>************";
        $vik_table_sum = 0;
        
        $this->SetFont('Arial', 'B', 10);                           //Ordinarie personlig assistent (namn)
        $this->SetXY(30, $this->GetY() + 5.2);
        $this->Cell(18, 5, utf8_decode('Vikarie :'), 0, 0, 'L', FALSE);
        $this->Cell(100, 5, utf8_decode($ename), 0, 0, 'L', FALSE);   //table cell 1
        
        $w = array(82, 28, 27.5, 27.5);
        $col_h = 4.5;
        $this->SetFont('Arial', 'B', 10);
       // $this->SetXY(28.3, $this->GetY() + 4.8);
        $this->SetXY(28.3, $this->GetY() + 15.8);

        //column headings
        $this->Cell($w[0], $col_h, '', 1, 0, 'L', FALSE);   //table cell 1
        $this->Cell($w[1], $col_h, utf8_decode('Timmar'), 1, 0, 'R', FALSE);   //table cell 2
        $this->Cell($w[2], $col_h, utf8_decode('Vik  lön kr/tim'), 1, 0, 'R', FALSE);   //table cell 3
        $this->Cell($w[3], $col_h, utf8_decode('Summa'), 1, 1, 'R', FALSE);   //table cell 4

        $col_h = 6.2;
        $karenses = array();
        if(!empty($qualifying_day['qualifying_group'])){
            foreach($qualifying_day['qualifying_group'] as $key => $values){
                if($key == '0') continue;
                if(isset($karenses[$key][$values['amount']]))
                    $karenses[$key][$values['amount']] = $equipment->time_sum($karenses[$key][$values['amount']], $values['hour']);
                else
                    $karenses[$key][$values['amount']] = $values['hour'];
            }
        }
        if(!empty($qualifying_day['additional_qualify'])){
            foreach($qualifying_day['additional_qualify'] as $key => $values){
                if(isset($karenses[$key][$values['amount']]))
                    $karenses[$key][$values['amount']] = $equipment->time_sum($karenses[$key][$values['amount']], $values['hour']);
                else
                    $karenses[$key][$values['amount']] = $values['hour'];
            }
        }
        $static_keys = array('Ord. tid', 'overtime', 'qual_overtime', 'more_time', 'some_other_time', 'training', 'personal_meeting', 'jour', 'call_training');
        if(empty($karenses)){
                $this->SetX(28.3);                              //table row3
                $this->Cell($w[0], $col_h, utf8_decode('Lön karensdag'), 1, 0, 'L', FALSE);   //table cell 1
                $this->Cell($w[1], $col_h, '', 1, 0, 'R', FALSE);   //table cell 2
                $this->Cell($w[2], $col_h, '', 1, 0, 'R', FALSE);   //table cell 3
                $this->Cell($w[3], $col_h, '', 1, 0, 'R', FALSE);   //table cell 4
                $this->SetY($this->GetY() + $col_h);

                $this->SetX(28.3);                              //table row4
                $this->Cell($w[0], $col_h, utf8_decode('Semestersätt karensdag'), 1, 0, 'L', FALSE);   //table cell 1
                $this->Cell($w[1], $col_h, '', 1, 0, 'R', FALSE);   //table cell 2
                $this->Cell($w[2], $col_h, '', 1, 0, 'R', FALSE);   //table cell 3
                $this->Cell($w[3], $col_h, '', 1, 0, 'R', FALSE);   //table cell 4
                $this->SetY($this->GetY() + $col_h);
        }else{
            // echo "<pre>".print_r($karenses, 1)."</pre>";
            foreach($karenses as $key => $entries){
                foreach($entries as $amount => $hour){
                    $this->SetX(28.3);                              //table row3
                    $additional_flag = (in_array($key, $static_keys)) ? NULL : ' - '.$key;
                    $this->Cell($w[0], $col_h, utf8_decode('Lön karensdag '. $additional_flag), 1, 0, 'L', FALSE);   //table cell 1
                    $time_in_100= $equipment->time_user_format($hour, 100);
                    $this->Cell($w[1], $col_h, $time_in_100, 1, 0, 'R', FALSE);   //table cell 2
                    $amount = round($amount, 2);
                    $this->Cell($w[2], $col_h, sprintf('%.02f', $amount), 1, 0, 'R', FALSE);   //table cell 3
                    $calc = $time_in_100 * $amount;
                    $this->Cell($w[3], $col_h, sprintf('%.02f', round($calc, 2)), 1, 0, 'R', FALSE);   //table cell 4
                    $this->SetY($this->GetY() + $col_h);
                    $vik_table_sum += $calc;
                    
                    // Semestersätt row only displayed for static keys (not displayed for inconvenience and holidays)
                    if($additional_flag == NULL){
                        $this->SetX(28.3);                              //table row4
                        $this->Cell($w[0], $col_h, utf8_decode('Semestersätt karensdag'), 1, 0, 'L', FALSE);   //table cell 1
                        $this->Cell($w[1], $col_h, $time_in_100, 1, 0, 'R', FALSE);   //table cell 2
                        $vikaries_normal_salary_12 = round($vikaries_normal_salary * 12 / 100, 2);
                        $this->Cell($w[2], $col_h, sprintf('%.02f', $vikaries_normal_salary_12), 1, 0, 'R', FALSE);   //table cell 3
                        $calc = $time_in_100 * $vikaries_normal_salary_12;
                        $this->Cell($w[3], $col_h, sprintf('%.02f', round($calc, 2)), 1, 0, 'R', FALSE);   //table cell 4
                        $this->SetY($this->GetY() + $col_h);
                        $vik_table_sum += $calc;
                    }
                }
            }
        }
        
        /* foreach($normal_2_to_14 as $key => $entries){
            foreach ($entries as $amount => $h_value) {
                $this->SetX(28.3);                              //table row1
                $this->Cell($w[0], $col_h, utf8_decode('Lön dag 2-14'), 1, 0, 'L', FALSE);   //table cell 1
                $time_in_100= $equipment->time_user_format($h_value['hour'], 100);
                $this->Cell($w[1], $col_h, $time_in_100, 1, 0, 'C', FALSE);   //table cell 2
                $amount = round($amount, 2);
                $this->Cell($w[2], $col_h, $amount, 1, 0, 'C', FALSE);   //table cell 3
                $calc = $time_in_100 * $amount;
                $this->Cell($w[3], $col_h, sprintf('%.02f', round($calc, 2)) , 1, 0, 'C', FALSE);   //table cell 4
                $this->SetY($this->GetY() + $col_h);
                $vik_table_sum += $calc;
            }
        }
        */
       
        //2-14 total normal calculation
        $total_normal_2_to_14_hours = 0;
        $total_normal_2_to_14_salary_sum = 0;
        $count_normal_2_to_14 = 0;
        foreach($normal_2_to_14 as $key => $entries){       //to merge array
            foreach ($entries as $amount => $h_value) {
                $count_normal_2_to_14++;
                $total_normal_2_to_14_hours = $equipment->time_sum($total_normal_2_to_14_hours, $h_value['hour']);
                $time_in_100= $equipment->time_user_format($h_value['hour'], 100);
                $amount = round($amount, 2);
                $total_normal_2_to_14_salary_sum += ($time_in_100 * $amount);
            }
        }
        $time_in_100= $equipment->time_user_format($total_normal_2_to_14_hours, 100);
        // $normal_2_to_14_average_salary = ($count_normal_2_to_14 == 0) ? 0 : round($total_normal_2_to_14_salary_sum/ $count_normal_2_to_14, 2);
        $normal_2_to_14_average_salary = ($time_in_100 == 0) ? 0 : round($total_normal_2_to_14_salary_sum/ $time_in_100, 2);
        
        //echo "<pre>".print_r(array($total_normal_2_to_14_salary_sum, $count_normal_2_to_14), 1)."</pre>";
        $this->SetX(28.3);                              //table row1
        $this->Cell($w[0], $col_h, utf8_decode('Lön dag 2-14'), 1, 0, 'L', FALSE);   //table cell 1
        $this->Cell($w[1], $col_h, $time_in_100, 1, 0, 'R', FALSE);   //table cell 2
        $this->Cell($w[2], $col_h, sprintf('%.02f', $normal_2_to_14_average_salary), 1, 0, 'R', FALSE);   //table cell 3
        $this->Cell($w[3], $col_h, sprintf('%.02f', round($total_normal_2_to_14_salary_sum, 2)) , 1, 0, 'R', FALSE);   //table cell 4
        $this->SetY($this->GetY() + $col_h);
        $vik_table_sum += round($total_normal_2_to_14_salary_sum, 2);

        $this->SetX(28.3);                              //table row2
        $this->Cell($w[0], $col_h, utf8_decode('Semestersättn dag 2-14'), 1, 0, 'L', FALSE);   //table cell 1
        $this->Cell($w[1], $col_h, $time_in_100, 1, 0, 'R', FALSE);   //table cell 2
        $vikaries_normal_salary_12 = round($vikaries_normal_salary * 12 / 100, 2);
        $this->Cell($w[2], $col_h, sprintf('%.02f', $vikaries_normal_salary_12), 1, 0, 'R', FALSE);   //table cell 3
        $calc = $time_in_100 * $vikaries_normal_salary_12;
        $this->Cell($w[3], $col_h, sprintf('%.02f', round($calc, 2)), 1, 0, 'R', FALSE);   //table cell 4
        $this->SetY($this->GetY() + $col_h);
        $vik_table_sum += round($calc, 2);
        
        //echo "<pre>semestersattn_jour_dag_2_14".print_r($semestersattn_jour_dag_2_14, 1)."</pre>";
        if($this->company_details['include_sem_2_14_oncall_salary'] == 1){
            if(!empty($semestersattn_jour_dag_2_14)){
                foreach ($semestersattn_jour_dag_2_14 as $salary => $params) {
                    $time_in_100 = round($equipment->time_user_format(round($params['hours'], 2), 100) / 4, 2);
                    $this->SetX(28.3);                                      //table row2
                    $this->Cell($w[0], $col_h, utf8_decode('Semestersättn jour dag 2-14'), 1, 0, 'L', FALSE);   //table cell 1
                    $this->Cell($w[1], $col_h, sprintf('%.02f', $time_in_100), 1, 0, 'R', FALSE);   //table cell 2
                    $calc = round(($salary * 12) / 100, 2);
                    $this->Cell($w[2], $col_h, sprintf('%.02f', $calc), 1, 0, 'R', FALSE);   //table cell 3
                    $calc = round($time_in_100 * $calc, 2);
                    $this->Cell($w[3], $col_h, sprintf('%.02f', $calc), 1, 0, 'R', FALSE);   //table cell 5
                    $this->SetY($this->GetY() + $col_h);
                    $vik_table_sum += $calc;
                }
            }
        }


        $total_normal_15_to_180_hours = 0;
        $total_normal_15_to_180_salary_sum = 0;
        $count_normal_15_to_180 = 0;
        foreach($normal_15_to_180 as $key => $entries){       //to merge array
            foreach ($entries as $amount => $h_value) {
                $count_normal_15_to_180++;
                $total_normal_15_to_180_hours = $equipment->time_sum($total_normal_15_to_180_hours, $h_value['hour']);
                $time_in_100= $equipment->time_user_format($h_value['hour'], 100);
                $amount = round($amount, 2);
                $total_normal_15_to_180_salary_sum += ($time_in_100 * $amount);
            }
        }
        $time_in_100= $equipment->time_user_format($total_normal_15_to_180_hours, 100);
        // $normal_2_to_14_average_salary = ($count_normal_2_to_14 == 0) ? 0 : round($total_normal_2_to_14_salary_sum/ $count_normal_2_to_14, 2);
        $normal_15_to_180_average_salary = ($time_in_100 == 0) ? 0 : round($total_normal_15_to_180_salary_sum/ $time_in_100, 2);
        
        //echo "<pre>".print_r(array($total_normal_2_to_14_salary_sum, $count_normal_2_to_14), 1)."</pre>";
        $this->SetX(28.3);                              //table row1
        $this->Cell($w[0], $col_h, utf8_decode('Lön dag 15-180'), 1, 0, 'L', FALSE);   //table cell 1
        $this->Cell($w[1], $col_h, $time_in_100, 1, 0, 'R', FALSE);   //table cell 2
        $this->Cell($w[2], $col_h, sprintf('%.02f', $normal_15_to_180_average_salary), 1, 0, 'R', FALSE);   //table cell 3
        $this->Cell($w[3], $col_h, sprintf('%.02f', round($total_normal_15_to_180_salary_sum, 2)) , 1, 0, 'R', FALSE);   //table cell 4
        $this->SetY($this->GetY() + $col_h);
        $vik_table_sum += round($normal_15_to_180_average_salary*$time_in_100, 2);

        $this->SetX(28.3);                              //table row2
        $this->Cell($w[0], $col_h, utf8_decode('Semestersättn dag 15-180'), 1, 0, 'L', FALSE);   //table cell 1
        $this->Cell($w[1], $col_h, $time_in_100, 1, 0, 'R', FALSE);   //table cell 2
        $vikaries_normal_salary_12 = round($vikaries_normal_salary * 12 / 100, 2);
        $this->Cell($w[2], $col_h, sprintf('%.02f', $vikaries_normal_salary_12), 1, 0, 'R', FALSE);   //table cell 3
        $calc = $time_in_100 * $vikaries_normal_salary_12;
        $this->Cell($w[3], $col_h, sprintf('%.02f', round($calc, 2)), 1, 0, 'R', FALSE);   //table cell 4
        $this->SetY($this->GetY() + $col_h);
        $vik_table_sum += round($calc, 2);



        $total_normal_181_hours = 0;
        $total_normal_181_salary_sum = 0;
        $count_normal_181 = 0;
        //echo "<pre>".print_r($normal_181, 1)."</pre>";
        foreach($normal_181 as $key => $entries){       //to merge array
            foreach ($entries as $amount => $h_value) {
                $count_normal_181++;
                $total_normal_181_hours = $equipment->time_sum($total_normal_181_hours, $h_value['hour']);
                $time_in_100= $equipment->time_user_format($h_value['hour'], 100);
                $amount = round($amount, 2);
                $total_normal_181_salary_sum += ($time_in_100 * $amount);
            }
        }
        $time_in_100= $equipment->time_user_format($total_normal_181_hours, 100);
        // $normal_2_to_14_average_salary = ($count_normal_2_to_14 == 0) ? 0 : round($total_normal_2_to_14_salary_sum/ $count_normal_2_to_14, 2);
        $normal_181_average_salary = ($time_in_100 == 0) ? 0 : round($total_normal_181_salary_sum/ $time_in_100, 2);
        
        //echo "<pre>".print_r(array($total_normal_2_to_14_salary_sum, $count_normal_2_to_14), 1)."</pre>";
        $this->SetX(28.3);                              //table row1
        $this->Cell($w[0], $col_h, utf8_decode('Lön dag 181-'), 1, 0, 'L', FALSE);   //table cell 1
        $this->Cell($w[1], $col_h, $time_in_100, 1, 0, 'R', FALSE);   //table cell 2
        $this->Cell($w[2], $col_h, sprintf('%.02f', $normal_181_average_salary), 1, 0, 'R', FALSE);   //table cell 3
        $this->Cell($w[3], $col_h, sprintf('%.02f', round($total_normal_181_salary_sum, 2)) , 1, 0, 'R', FALSE);   //table cell 4
        $this->SetY($this->GetY() + $col_h);
        $vik_table_sum += round($normal_181_average_salary*$time_in_100, 2);
        
        //echo "<pre>".print_r($org_inconv, 1)."</pre>";
        if(!empty($org_inconv)){
            foreach ($org_inconv as $key => $ord_inconv) {
                if($key == 'normal_3' || $key == 'normal_0')
                    continue;
                foreach ($ord_inconv as $amount => $h_value) {
                    $this->SetX(28.3);
                    
                    //changing all keys with starting 'Jour' replacing to 'Jour/beredskap'
                    $changed_key_name = $key;
                    if(stripos(substr(strtolower($key), 0, 4), 'jour') !== FALSE){
                        $changed_key_name = 'Jour/beredskap '.substr($key, 4);
                    }
                    //$this->Cell($w[0], $col_h, utf8_decode($key), 1, 0, 'L', FALSE);   //table cell 1
                    $this->Cell($w[0], $col_h, utf8_decode($changed_key_name), 1, 0, 'L', FALSE);   //table cell 1
                    $time_in_100= $equipment->time_user_format($h_value['hour'], 100);
                    $this->Cell($w[1], $col_h, $time_in_100, 1, 0, 'R', FALSE);   //table cell 2
                    $amount = round($amount, 2);
                    $this->Cell($w[2], $col_h, sprintf('%.02f', $amount), 1, 0, 'R', FALSE);   //table cell 3
                    $calc = $time_in_100 * $amount;
                    $this->Cell($w[3], $col_h, sprintf('%.02f', round($calc, 2)), 1, 0, 'R', FALSE);   //table cell 4
                    $this->SetY($this->GetY() + $col_h);
                    $vik_table_sum += $calc;
                }
            }
        }

        
        //echo "<pre>".print_r($org_inconv_15_180, 1)."</pre>";

        if(!empty($org_inconv_15_180)){
            foreach ($org_inconv_15_180 as $key => $ord_inconv) {
                if($key == 'normal_3' || $key == 'normal_0')
                    continue;
                foreach ($ord_inconv as $amount => $h_value) {
                    $this->SetX(28.3);
                    
                    //changing all keys with starting 'Jour' replacing to 'Jour/beredskap'
                    $changed_key_name = $key;
                    if(stripos(substr(strtolower($key), 0, 4), 'jour') !== FALSE){
                        $changed_key_name = 'Jour/beredskap 15-180'.substr($key, 4);
                    }
                    //$this->Cell($w[0], $col_h, utf8_decode($key), 1, 0, 'L', FALSE);   //table cell 1
                    $this->Cell($w[0], $col_h, utf8_decode($changed_key_name), 1, 0, 'L', FALSE);   //table cell 1
                    $time_in_100= $equipment->time_user_format($h_value['hour'], 100);
                    $this->Cell($w[1], $col_h, $time_in_100, 1, 0, 'R', FALSE);   //table cell 2
                    $amount = round($amount, 2);
                    $this->Cell($w[2], $col_h, sprintf('%.02f', $amount), 1, 0, 'R', FALSE);   //table cell 3
                    $calc = $time_in_100 * $amount;
                    $this->Cell($w[3], $col_h, sprintf('%.02f', round($calc, 2)), 1, 0, 'R', FALSE);   //table cell 4
                    $this->SetY($this->GetY() + $col_h);
                    $vik_table_sum += $calc;
                }
            }
        }


        if(!empty($org_inconv_181)){
            foreach ($org_inconv_181 as $key => $ord_inconv) {
                if($key == 'normal_3' || $key == 'normal_0')
                    continue;
                foreach ($ord_inconv as $amount => $h_value) {
                    $this->SetX(28.3);
                    
                    //changing all keys with starting 'Jour' replacing to 'Jour/beredskap'
                    $changed_key_name = $key;
                    if(stripos(substr(strtolower($key), 0, 4), 'jour') !== FALSE){
                        $changed_key_name = 'Jour/beredskap 181-'.substr($key, 4);
                    }
                    //$this->Cell($w[0], $col_h, utf8_decode($key), 1, 0, 'L', FALSE);   //table cell 1
                    $this->Cell($w[0], $col_h, utf8_decode($changed_key_name), 1, 0, 'L', FALSE);   //table cell 1
                    $time_in_100= $equipment->time_user_format($h_value['hour'], 100);
                    $this->Cell($w[1], $col_h, $time_in_100, 1, 0, 'R', FALSE);   //table cell 2
                    $amount = round($amount, 2);
                    $this->Cell($w[2], $col_h, sprintf('%.02f', $amount), 1, 0, 'R', FALSE);   //table cell 3
                    $calc = $time_in_100 * $amount;
                    $this->Cell($w[3], $col_h, sprintf('%.02f', round($calc, 2)), 1, 0, 'R', FALSE);   //table cell 4
                    $this->SetY($this->GetY() + $col_h);
                    $vik_table_sum += $calc;
                }
            }
        }

        


        
         //only for hogia salary system
        if(!empty($oncall_type_salaries) && $this->company_details['salary_system'] == 3){
            //echo "<pre>".print_r($oncall_type_salaries, 1)."</pre>";
            foreach($oncall_type_salaries as $jour_key => $jour_attributes){
                foreach($jour_attributes as $jour_salary => $jour_hours){
                    if($jour_hours == '') continue;
                    $this->SetX(28.3);
                    $this->Cell($w[0], $col_h, utf8_decode($jour_key), 1, 0, 'L', FALSE);   //table cell 1
                    $time_in_100= $equipment->time_user_format($jour_hours['hour'], 100);
                    $this->Cell($w[1], $col_h, $time_in_100, 1, 0, 'R', FALSE);   //table cell 2
                    $amount = round($jour_salary, 2);
                    $this->Cell($w[2], $col_h, sprintf('%.02f', $amount), 1, 0, 'R', FALSE);   //table cell 3
                    $calc = $time_in_100 * $amount;
                    $this->Cell($w[3], $col_h, sprintf('%.02f', round($calc, 2)), 1, 0, 'R', FALSE);   //table cell 4
                    $this->SetY($this->GetY() + $col_h);
                    $vik_table_sum += $calc;
                }
            }
        }
        
        if(!empty($oncall_2_to_14)){
            foreach($oncall_2_to_14 as $key => $entries){
                foreach ($entries as $amount => $h_value) {
                    $this->SetX(28.3);                              //table row3
                    $this->Cell($w[0], $col_h, utf8_decode('Jour'), 1, 0, 'L', FALSE);   //table cell 1
                    $time_in_100= $equipment->time_user_format($h_value['hour'], 100);
                    $this->Cell($w[1], $col_h, $time_in_100, 1, 0, 'R', FALSE);   //table cell 2
                    $amount = round($amount, 2);
                    $this->Cell($w[2], $col_h, sprintf('%.02f', round(($amount / 4), 2)), 1, 0, 'R', FALSE);   //table cell 3
                    $calc = $time_in_100 * ($amount / 4);
                    $this->Cell($w[3], $col_h, sprintf('%.02f', round($calc, 2)), 1, 0, 'R', FALSE);   //table cell 4
                    $this->SetY($this->GetY() + $col_h);
                    $vik_table_sum += $calc;
                }
            }
        }
        
        /*$jour_vardag_hour = 0;
        $jour_vardag_amount = 0;
        $this->SetX(28.3);                              //table row3
        $this->Cell($w[0], $col_h, utf8_decode('Jour/beredskap vardag'), 1, 0, 'L', FALSE);   //table cell 1
        //$time_in_100= $equipment->time_user_format($jour_vardag_hour, 100);
        $this->Cell($w[1], $col_h, '', 1, 0, 'R', FALSE);   //table cell 2
        //$this->Cell($w[2], $col_h, ($jour_vardag_amount / 4), 1, 0, 'R', FALSE);   //table cell 3
        $this->Cell($w[2], $col_h, '', 1, 0, 'R', FALSE);   //table cell 3
        $this->Cell($w[3], $col_h, '', 1, 0, 'R', FALSE);   //table cell 4
        $this->SetY($this->GetY() + $col_h);
        //$vik_table_sum += $calc;

        $this->SetX(28.3);                             //table row4
        $this->Cell($w[0], $col_h, utf8_decode('Jour/beredskap helg'), 1, 0, 'L', FALSE);   //table cell 1
        $this->Cell($w[1], $col_h, '', 1, 0, 'R', FALSE);   //table cell 2
        //$this->Cell($w[2], $col_h, ($jour_vardag_amount / 4), 1, 0, 'R', FALSE);   //table cell 3
        $this->Cell($w[2], $col_h, '', 1, 0, 'R', FALSE);   //table cell 3
        $this->Cell($w[3], $col_h, '', 1, 0, 'R', FALSE);   //table cell 4
        $this->SetY($this->GetY() + $col_h);*/
        $this->SetX(28.3);                                      //table last-1 row
        $this->Cell($w[0], $col_h, utf8_decode('Pensionsförsäkring'), 1, 0, 'L', FALSE);   //Försäkring
        $this->Cell($w[1], $col_h, '', 1, 0, 'R', FALSE);   //table cell 2
        if ($insurance_substitute == "") $insurance_substitute = 0;
        $this->Cell($w[2], $col_h, $insurance_substitute . "%", 1, 0, 'R', FALSE);   //table cell 3
        $insurance_sum = ($vik_table_sum * $insurance_substitute)/100;
        $this->Cell($w[3], $col_h, sprintf('%.02f', round($insurance_sum, 2)), 1, 0, 'R', FALSE);   //table cell 4
        $this->SetY($this->GetY() + $col_h);

        $this->SetX(28.3);                                      //table last row
        $this->Cell($w[0], $col_h, utf8_decode('Sociala avgifter'), 1, 0, 'L', FALSE);   //table cell 1
        $this->Cell($w[1], $col_h, '', 1, 0, 'R', FALSE);  //table cell 2
        $this->Cell($w[2], $col_h, $vikarie_sociala . '%', 1, 0, 'R', FALSE);   //table cell 3
        $sociala_sum = ($vik_table_sum * $vikarie_sociala)/100;
        $this->Cell($w[3], $col_h, sprintf('%.02f', round($sociala_sum, 2)), 1, 0, 'R', FALSE);   //table cell 4
        $this->SetY($this->GetY() + $col_h);

        $calc = $vik_table_sum + $insurance_sum + $sociala_sum;
        $this->SetLineWidth(0.7);
        $this->SetXY(28.3, $this->GetY() + .2);          //table sum row
        $this->Cell($w[0], $col_h, '', 0, 0, 'R', FALSE);   //table cell 1
        $this->Cell($w[1], $col_h, '', 0, 0, 'R', FALSE);   //table cell 2
        $this->Cell($w[2], $col_h, utf8_decode('Summa'), 0, 0, 'C', FALSE);   //table cell 3
        $this->Cell($w[3], $col_h, sprintf('%.02f', round($calc, 2)), 1, 1, 'R', FALSE);   //table cell 4
        $this->vikarie_total_table_sum += round($calc,2);
        $this->SetLineWidth();

        $this->Ln(1);
    }

    function P2_table3($total_ordinarie_time) {
        $this->sick_pay = round($this->sick_pay, 2);
        $equipment = new equipment();
        // $total_ordinarie_time = round($total_ordinarie_time, 2);
        $total_ordinarie_time= $equipment->time_user_format(round($total_ordinarie_time, 2), 100);

        $w = array(82, 28, 27.5, 27.5);
        $col_h = 4.5;
        $this->SetFont('Arial', '', 10);
        $this->SetXY(28.3, $this->GetY() + 4.8);

        //column headings
        $this->Cell($w[0], $col_h, utf8_decode('Redovisade timmar till FK för utförd '), 'TLR', 0, 'L', FALSE);   //table cell 1
        $this->Cell($w[1], $col_h, utf8_decode('Kr/tim'), 'TLR', 0, 'R', FALSE);   //table cell 2
        $this->Cell($w[2], $col_h, utf8_decode('Timmar'), 'TLR', 0, 'R', FALSE);   //table cell 3
        $this->Cell($w[3], $col_h, utf8_decode('Summa'), 'TLR', 0, 'R', FALSE);   //table cell 4

        $this->SetXY(28.3, $this->GetY() + $col_h);
        $col_h = 5.5;
        $this->Cell($w[0], $col_h, utf8_decode('assistans under sjukperioden'), 'BLR', 0, 'L', FALSE);   //table cell 1
        $this->SetFont('Arial', 'B', 12);
        $this->Cell($w[1], $col_h, $this->sick_pay, 'BLR', 0, 'R', FALSE);   //table cell 2
        $this->Cell($w[2], $col_h, $total_ordinarie_time, 'BLR', 0, 'R', FALSE);   //table cell 3
        $calc = $this->sick_pay * $total_ordinarie_time ;
        $this->Cell($w[3], $col_h, sprintf('%.02f', $calc), 'BLR', 1, 'R', FALSE);   //table cell 4
        //$this->Cell($w[3], $col_h, $this->vikarie_total_table_sum, 'BLR', 1, 'L', FALSE);   //table cell 4

        $this->Ln(1);
    }

    function P2_bottom() {
        $this->SetFont('Arial', 'B', 10);                           //Ordinarie personlig assistent (namn)
        $this->SetXY(27, $this->GetY() + 5.2);
        $this->MultiCell(160, 4, utf8_decode('Att ovanstående uppgifter är riktiga intygas härmed samt att jag godkänner registrering av personuppgifter:'));

        $this->Ln(5);
        $w = array(82, 28, 27.5, 27.5);
        $col_h = 4.5;
        $this->SetFont('Arial', '', 9);
        $this->SetXY(28.3, $this->GetY());

        $this->Cell(33, $col_h, utf8_decode('Datum'), 'TLR', 0, 'L', FALSE);   //table cell 1
        $this->Cell(4.7, $col_h, '', 0, 0, 'L', FALSE);   //table cell 1
        $this->Cell(127.3, $col_h, utf8_decode('Underskrift av den assistansberättigade eller ombud och namnförtydligande'), 'TLR', 1, 'L', FALSE);   //table cell 2

        $col_h = 9.5;
        $this->SetX(28.3);
        $this->Cell(33, $col_h, '', 'BLR', 0, 'L', FALSE);   //table cell 1
        $this->Cell(4.7, $col_h, '', 0, 0, 'L', FALSE);   //table cell 1
        $this->Cell(127.3, $col_h, '', 'BLR', 0, 'L', FALSE);   //table cell 2

       // $this->Ln(6);
       // $this->SetFont('Arial', '', 9.5);
       // $this->SetXY(40, $this->GetY() + 4.5);
       // $this->Cell(40, 4, utf8_decode('Ansökan skickas till: Behovsbedömare LSS, Borlänge kommun, 781 81 BORLÄNGE'), 0, 0, 'L', FALSE);

        $this->Ln(1);
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
    
    function Footer() {
        // Go to 1.5 cm from bottom
        $this->SetY(-15);
        // Select Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Print current and total page numbers
       // $this->page = 1;
       // $this->Cell(0, 10, $this->PageNo() . ' '. ($this->page_ref_no != NULL ? $this->page_ref_no : ''), 0, 0, 'C');
        $this->Cell(0, 10, $this->page_ref_no, 0, 0, 'L', FALSE);
        $this->Cell(0, 10, $this->PageNo(), 0, 0, 'R', FALSE);
    }

}
?>