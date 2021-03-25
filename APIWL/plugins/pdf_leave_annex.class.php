<?php

require_once('./plugins/F_pdf.class.php');
require_once('./plugins/fpdi/fpdi.php');
require_once ('./class/equipment.php');

class PDF_leave_annex extends FPDI { //FPDF

    var $ordinary_pay = "";
    var $sick_pay = "";
    var $table_sum = "";
    var $table_sum_row = "";
    var $vikarie_total_table_sum = 0;
    var $company_details = array();
    var $karense_work_dates = array();

    var $smarty = array();
    
    function __construct() {
        parent::__construct();
        $this->SetAuthor('Shamsudheen');
        $this->SetCreator('Shamsudheen');
        $this->smarty = new smartySetup(array("month.xml", "reports.xml", "gdschema.xml"),FALSE);
    }

    function report_top($emp_details, $contract,$customer_details) {
        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0, 50, 50);

//        $this->SetFont('Times', '', 11);
//        $this->SetXY(10, 10);
        
        // $this->Image($this->smarty->url.'images/leave_annex_logo_img.jpg', 10, 15, 76.25, 30);
        if($this->company_details['logo'] != '')
            $this->Image($this->smarty->url.'company_logo/'.$this->company_details['logo'], 10, 5, 70, 30);
        
        $this->SetFont('Times', 'B', 16);
        $this->SetXY(110, 10);
//        $this->Cell(29, 7, utf8_decode('BILAGA TILL Sjuk'), 0, 1, 'L', FALSE); 
        $this->Cell(29, 7, utf8_decode('Underlag till sjukfaktura'), 0, 1, 'L', FALSE); 
//        $this->SetX(110);
//        $this->Cell(29, 7, utf8_decode('UNDERLAG'), 0, 1, 'L', FALSE);
        
        $this->Ln();
        $this->SetFont('Times', '', 10);
        $this->SetX(110);
        $this->Cell(29, 4, utf8_decode('Till:'), 0, 1, 'L', FALSE); 
        $this->SetFont('Times', 'B', 10);
        $this->SetX(110);
        $this->Cell(29, 5, (!empty($contract) ? utf8_decode($contract['kn_name']) : $customer_details['kn_name']), 0, 1, 'L', FALSE);
        $this->SetX(110);
        $this->Cell(29, 5, (!empty($contract) ? utf8_decode($contract['kn_box']) : $customer_details['kn_box']), 0, 1, 'L', FALSE);
        $this->SetX(110);
        $this->Cell(29, 5, (!empty($contract) ? utf8_decode($contract['kn_address']) : $customer_details['kn_address']), 0, 1, 'L', FALSE);
        $this->SetX(110);
        if(!empty($contract)) $formated_postno = substr($contract['kn_postno'],0,3) . " ".substr($contract['kn_postno'],3);
        $this->Cell(29, 5, (!empty($contract) ? utf8_decode($formated_postno. ' '. $contract['city']) :    utf8_decode(substr($customer_details['kn_postno'],0,3). " ".substr($customer_details['kn_postno'],3). ' '. $customer_details['kn_city'])), 0, 1, 'L', FALSE);
        
        $this->Ln();
        $this->SetFont('Times', '', 10);
        $this->SetX(10);
        $this->Cell(25, 5, utf8_decode('Vår referens:'), 0, 0, 'L', FALSE);
        $this->SetFont('Times', 'B', 10);
        $this->Cell(29, 5, utf8_decode($this->company_details['contact_person2']), 0, 0, 'L', FALSE);
        
        $this->SetFont('Times', '', 10);
        $this->SetX(110);
        $this->Cell(25, 5, utf8_decode('Mottagarkod:'), 0, 0, 'L', FALSE);
        $this->SetFont('Times', 'B', 10);
        $this->Cell(29, 5, (!empty($contract) ? utf8_decode($contract['kn_reference_no']) : $customer_details['kn_reference_no']), 0, 1, 'L', FALSE);
        
        $this->SetFont('Times', '', 10);
        $this->SetX(10);
        $this->Cell(25, 5, utf8_decode('Anställd:'), 0, 0, 'L', FALSE);
        $this->SetFont('Times', 'B', 10);
        $this->Cell(29, 5, utf8_decode($emp_details['first_name'] . " " . $emp_details['last_name']), 0, 1, 'L', FALSE);

        $this->Ln(3);
        $this->draw_hr();
    }
    
    function section2($customer_details, $rpt_year, $rpt_month){
        global $month;
        
        $this->Ln();
        $this->SetFont('Times', '', 10);
        $this->SetX(10);
//        $this->Cell(32, 5, utf8_decode('För brukare:'), 0, 0, 'L', FALSE);
        $this->Cell(35, 5, utf8_decode('För assistansberättigad:'), 0, 0, 'L', FALSE);
        
        $this->SetFont('Times', 'B', 11);
        $this->Cell(32, 5, utf8_decode($customer_details['first_name'] . " " . $customer_details['last_name']), 0, 0, 'L', FALSE);
        
        $this->SetFont('Times', '', 10);
        $this->SetX(110);
        $this->Cell(7.5, 5, utf8_decode('Pnr:'), 0, 0, 'L', FALSE);
        
        $this->SetFont('Times', 'B', 12);
        $this->Cell(30, 5, utf8_decode($this->format_SSN($customer_details['social_security'])), 0, 1, 'L', FALSE);
        
        $this->draw_hr();
        
        //----------------------
        
        $this->Ln();
        $this->SetFont('Times', '', 10);
        $this->SetX(10);
        $this->Cell(32, 5, utf8_decode('Avser perioden:'), 0, 0, 'L', FALSE);
        // $month_label = $month[((int) $rpt_month - 1)]['month'];
        // $this->Cell(22, 5, utf8_decode(strtolower(substr($this->smarty->translate[$month_label], 0, 3)).' '.$rpt_year), 0, 0, 'L', FALSE);
        $month_label = $month[((int) $rpt_month - 1)]['label'];
        $this->Cell(22, 5, utf8_decode($this->smarty->translate[$month_label].' '.$rpt_year), 0, 0, 'L', FALSE);

        $this->SetFont('Times', 'B', 11);
        $this->Cell(32, 5, utf8_decode('Avser vikarie kostnad vid ord assistents sjukfrånvaro.'), 0, 1, 'L', FALSE);
        
        
        $this->draw_hr();
    }
    
    function content_part($Q_work_dates){
        global $month;
        
        //-------------------header----------------------
        $width = array(20, 15, 45, 30, 35, 35);
        $this->Ln();
        $this->SetFont('Times', 'B', 11);
        $this->SetX(20);
        $this->Cell($width[0]+$width[1], 5, utf8_decode('antal timmar:'), 0, 0, 'L', FALSE);
        $this->Cell($width[2]+$width[3], 5, utf8_decode('a´pris:'), 0, 0, 'L', FALSE);
        $this->Cell($width[4], 5, utf8_decode('kostnad:'), 0, 0, 'R', FALSE);
        $this->Cell($width[5], 5, '80%', 0, 1, 'R', FALSE);
        
        $this->draw_hr();
        
        //--------------sub head------------------------
        $Q_work_date_display = '';
        if (!empty($Q_work_dates)) {
            /*$display_qw_array = array();
            foreach ($Q_work_dates as $qw) {
                $month_label = $month[((int) date('m', strtotime($qw)) - 1)]['month'];
                
                $display_qw_array[] = date('d', strtotime($qw)).'-'.strtolower(substr($this->smarty->translate[$month_label], 0, 3));
            }
            $Q_work_date_display = implode(', ', $display_qw_array);*/
            
            $month_label = $month[((int) date('m', strtotime($Q_work_dates[0])) - 1)]['month'];
            $Q_work_date_display = date('d', strtotime($Q_work_dates[0])).'-'.strtolower(substr($this->smarty->translate[$month_label], 0, 3));
        }
        
        $this->SetFont('Times', '', 11);
        $this->SetX(20);
        $this->Cell($width[0], 5, utf8_decode($Q_work_date_display), 0, 0, 'L', FALSE);
        $this->SetFont('Times', '', 8);
        $this->Cell($width[1], 5, utf8_decode('se bilaga'), 0, 0, 'L', FALSE);
        $this->SetFont('Times', '', 11);
        $this->Cell($width[2], 5, utf8_decode('karens'), 0, 0, 'L', FALSE);
        $this->Cell($width[3], 5, '7.25', 0, 0, 'C', FALSE);
        $this->Cell($width[4], 5, 'kr', 0, 0, 'R', FALSE);
        $this->Cell($width[5], 5, '', 0, 1, 'R', FALSE);
        
        //------------------detailed data---------------------
        
        
        //------------------summery-------------------------
        
        $this->Ln();
        $this->SetFont('Times', '', 11);
        $summery_padding = 20+$width[0]+$width[1]+$width[2];
        $this->SetX($summery_padding);
        $this->Cell($width[3], 5, utf8_decode('Summa:'), 0, 0, 'C', FALSE);
        $this->Cell($width[4], 5, '3,269.52 kr', 0, 0, 'R', FALSE);
        $this->Cell($width[5], 5, '2,615.61 kr', 0, 1, 'R', FALSE);
        
        $this->Ln();
        $this->SetX($summery_padding);
        $this->Cell($width[3], 5, '31.42%', 0, 0, 'C', FALSE);
        $this->Cell($width[4], 5, utf8_decode('Socialaavg'), 0, 0, 'R', FALSE);
        $this->Cell($width[5], 5, '821.83 kr', 0, 1, 'R', FALSE);
        
        $summery_padding_last = $summery_padding+$width[3];
        $this->SetX($summery_padding_last);
        $this->Cell($width[4], 5, utf8_decode('Kp avgift'), 0, 0, 'R', FALSE);
        $this->Cell($width[5], 5, '177.86 kr', 0, 1, 'R', FALSE);
        
        $this->SetX($summery_padding_last);
        $this->Cell($width[4], 5, utf8_decode('Sem ers. '), 0, 0, 'R', FALSE);
        $this->Cell($width[5], 5, '271.44 kr', 0, 1, 'R', FALSE);
        
        $this->Ln();
        $this->SetX($summery_padding_last);
        $this->Cell($width[4], 5, utf8_decode('öresavrundning:'), 0, 0, 'R', FALSE);
        $this->Cell($width[5], 5, '0.26 kr', 0, 1, 'R', FALSE);
        
        $this->SetX($summery_padding_last);
        $this->Cell($width[4], 5, utf8_decode('Att betala:'), 0, 0, 'R', FALSE);
        $this->Cell($width[5], 5, '3,887.00 kr', 0, 1, 'R', FALSE);
        
        $this->Ln();
        $this->draw_hr();
    }
    
    function footer_section(){
        if($this->GetY() < 240){
            $this->SetY(240);
            // $this->SetY(-58);
        }
        // echo $this->GetY().'<br>';
        $this->draw_hr();
        $this->Ln();
        $this->SetFont('Times', '', 11);
        $this->SetX(10);
        // $this->Cell(191, 5, utf8_decode('Optimal Assistans i Göteborg AB'), 0, 1, 'C', FALSE);
        $this->Cell(191, 5, utf8_decode($this->company_details['name']), 0, 1, 'C', FALSE);
        $this->SetX(10);
        // $this->Cell(191, 5, utf8_decode('Kungsbacka vägen 103, 431 90 Mölndal.  Vi har F-skattesedel'), 0, 1, 'C', FALSE);
        $this->Cell(191, 5, utf8_decode($this->company_details['address'].', '.$this->company_details['zipcode'] .' '. $this->company_details['city'] .'.  Vi har F-skattesedel'), 0, 1, 'C', FALSE);
        
        $this->Ln();
        $width = array(48.5, 47.5, 47.5, 47.5);
        $this->SetX(10);
        $this->Cell($width[0], 5, utf8_decode('Org.nummer'), 0, 0, 'C', FALSE);
        $this->Cell($width[1], 5, utf8_decode('Telefon'), 0, 0, 'C', FALSE);
        $this->Cell($width[2], 5, utf8_decode('Mobil'), 0, 0, 'C', FALSE);
        $this->Cell($width[3], 5, utf8_decode('Bankgiro'), 0, 1, 'C', FALSE);
        
        $this->SetX(10);
        /*$this->Cell($width[0], 5, '556674-6763', 0, 0, 'C', FALSE);
        $this->Cell($width[1], 5, '031-24 15 42', 0, 0, 'C', FALSE);
        $this->Cell($width[2], 5, '0707-33 49 33', 0, 0, 'C', FALSE);
        $this->Cell($width[3], 5, '5111-5830', 0, 1, 'C', FALSE);*/
        $this->Cell($width[0], 5, $this->format_SSN($this->company_details['org_no']), 0, 0, 'C', FALSE);
        $this->Cell($width[1], 5, $this->company_details['phone'], 0, 0, 'C', FALSE);
        $this->Cell($width[2], 5, $this->company_details['mobile'], 0, 0, 'C', FALSE);
        $this->Cell($width[3], 5, $this->company_details['bank_account'], 0, 1, 'C', FALSE);
        
        $this->SetX(10);
        $this->SetFont('Times', '', 10);
        // $this->Cell(array_sum($width), 5, utf8_decode('info@optimalassistan.org'), 0, 0, 'C', FALSE);
        $this->Cell(array_sum($width), 5, utf8_decode($this->company_details['email']), 0, 0, 'C', FALSE);
    }
    
    function P2_table1($table_f_date1, $table_to_date2, $insurance_word_person, $SS_contibution, $ord_inconv_details, $qualifying_day = array(), $normal_salary = 0.00) {
        global $month;
        /* ordinary person table */
        $equipment          = new equipment();
        $this->table_sum    = 0;
        $this->table_sum_row= 0;
        $total_insurance    = 0;
        $total_contribution = 0;
        $total              = 0;

        // echo "<pre>ord_inconv_details".print_r($ord_inconv_details, 1)."</pre>";
        $semestersattn_jour_dag_2_14= $ord_inconv_details['semestersattn_jour_dag_2_14_salaries'];
        $oncall_type_salaries       = $ord_inconv_details['oncall_type_salaries'];        //only for hogia salary system
        $ord_inconv_details         = $ord_inconv_details['inconv_details'];

        $semestersattn_jour_dag_15_180= $ord_inconv_details['15_180']['semestersattn_jour_dag_2_14_salaries'];
        $ord_inconv_details_15_180         = $ord_inconv_details['15_180']['inconv_details'];

        

        $qualifying_day_total_hour  = $qualifying_day['qualifying_total_time'];
        $qualifying_day_total_amount= $qualifying_day['nomal_salary_amount'];
        $normal_2_to_14             = array();
        $oncall_2_to_14             = array();
        $lower_jour_inconv          = array();
        $org_inconv                 = array();
        $intercept_qualify_exceed_normal = FALSE;
        $intercept_qualify_exceed_oncall = FALSE;

        $normal_15_180             = array();
        $oncall_15_180             = array();

        if (!empty($ord_inconv_details['normal_0'])) {
            foreach ($ord_inconv_details['normal_0'] as $amount => $h_value) {
                $normal_2_to_14[$amount]['hour'] = $h_value['hour'];
            }
        }

        if (empty($normal_2_to_14))  //set default as 0
            $normal_2_to_14['0']['hour'] = 0;

        if (!empty($ord_inconv_details['normal_3'])) {
            foreach ($ord_inconv_details['normal_3'] as $amount => $h_value) {
                $oncall_2_to_14[$amount]['hour'] = $h_value['hour'];
            }
        }

        if (!empty($ord_inconv_details)) {
            foreach ($ord_inconv_details as $key => $values) {
                if (stripos($key, 'jour') !== FALSE) {
                    foreach ($values as $amount => $h_value) {
                        $lower_jour_inconv[$key]['hour'] = $h_value['hour'];
                        $lower_jour_inconv[$key]['amount'] = $amount;
                    }
                    continue;
                } else if ($key == 'normal_3' || $key == 'normal_0')
                    continue;
                foreach ($values as $amount => $h_value) {
                    if (!empty($org_inconv[$key][$amount]) || isset($org_inconv[$key][$amount]))
                        $org_inconv[$key][$amount]['hour'] = $equipment->time_sum($org_inconv[$key][$amount]['hour'], $h_value['hour']);
                    else
                        $org_inconv[$key][$amount]['hour'] = $h_value['hour'];
                }
            }
        }
        //////////////////////////////////////////////

        if (!empty($ord_inconv_details_15_180['normal_0'])) {
            foreach ($ord_inconv_details_15_180['normal_0'] as $amount => $h_value) {
                $normal_15_180[$amount]['hour'] = $h_value['hour'];
            }
        }

        if (empty($normal_15_180))  //set default as 0
            $normal_15_180['0']['hour'] = 0;

        if (!empty($ord_inconv_details_15_180['normal_3'])) {
            foreach ($ord_inconv_details_15_180['normal_3'] as $amount => $h_value) {
                $oncall_15_180[$amount]['hour'] = $h_value['hour'];
            }
        }

        



        $w = array(55, 27, 28, 27.5, 27.5);
        $col_h = 4.5;

        
        //-------------------header----------------------Annex
        $width = array(20, 15, 45, 30, 35, 35);
        $this->Ln();
        $this->SetFont('Times', 'B', 11);
        $this->SetX(20);
        $this->Cell($width[0]+$width[1]+$width[2], 5, utf8_decode('Antal timmar:'), 0, 0, 'L', FALSE);
        $this->Cell($width[3], 5, utf8_decode('a´pris:'), 0, 0, 'R', FALSE);
        $this->Cell($width[4], 5, utf8_decode('kostnad:'), 0, 0, 'R', FALSE);
        $this->Cell($width[5], 5, '80%', 0, 1, 'R', FALSE);
        $this->draw_hr();
        
        
        $time_in_100 = $equipment->time_user_format($qualifying_day_total_hour, 100);
        // if ($this->company_details['apply_max_karens'] == 1 && $time_in_100 != '' && $time_in_100 != 0 && $time_in_100 < 8.00)  // updated on 2014-06-27
        //     $time_in_100 = 8.00;
        
        $Q_work_date_display = '';
        if (!empty($this->karense_work_dates)/* && in_array($table_f_date1, $this->karense_work_dates)*/) {
            // $month_label = $month[((int) date('m', strtotime($table_f_date1)) - 1)]['month'];
            // $Q_work_date_display = date('d', strtotime($table_f_date1)).'-'.strtolower(substr($this->smarty->translate[$month_label], 0, 3));
            $month_label = $month[((int) date('m', strtotime($table_f_date1)) - 1)]['label'];
            $Q_work_date_display = date('d', strtotime($table_f_date1)).'-'.$this->smarty->translate[$month_label];
        }
        
        $this->SetFont('Times', '', 11);
        $this->SetX(20);
        $total_karense_val = 0.00;
        
        if($this->company_details['sick_annex_calculation_mode'] == 1){
            $this->Cell($width[0], 5, utf8_decode($Q_work_date_display), 0, 0, 'L', FALSE);
            $this->SetFont('Times', '', 8);
            $this->Cell($width[1], 5, utf8_decode('se bilaga'), 0, 0, 'L', FALSE);
            $this->SetFont('Times', '', 11);
            $this->Cell($width[2], 5, utf8_decode('Karens'), 0, 0, 'L', FALSE);
            $this->Cell($width[3], 5, sprintf('%.02f', $time_in_100), 0, 0, 'R', FALSE);
            $this->Cell($width[4], 5, 'kr', 0, 0, 'R', FALSE);
            $this->Cell($width[5], 5, '', 0, 1, 'R', FALSE);
        }
        else {
            $this->Cell($width[0], 5, utf8_decode($Q_work_date_display), 0, 0, 'L', FALSE);
            $this->SetFont('Times', '', 8);
            $this->Cell($width[1], 5, '('.sprintf('%.02f', $time_in_100).')  '. utf8_decode('se bilaga'), 0, 0, 'R', FALSE);
            $this->SetFont('Times', '', 11);
            $this->Cell($width[2], 5, utf8_decode('Karens'), 0, 0, 'L', FALSE);
            $this->Cell($width[3], 5, sprintf('%.02f', round($normal_salary, 2)), 0, 0, 'R', FALSE);
            $row_total = round($normal_salary*$time_in_100, 2);
            $this->table_sum_row += $row_total;
            $this->Cell($width[4], 5, sprintf('%.02f', $row_total).' kr', 0, 0, 'R', FALSE);
            $this->Cell($width[5], 5, '', 0, 1, 'R', FALSE);
            $total_karense_val = sprintf('%.02f', $row_total);
        }
        
        
        $this->SetFont('Times', '', 11);
        $normal_2_to_14_total = 0;
        foreach ($normal_2_to_14 as $amount => $hour_value) {
            $time_in_100 = $equipment->time_user_format($hour_value['hour'], 100);
            $amount = round($amount, 2);
            
            $this->SetX(20);
            $this->Cell($width[0]+$width[1], 5, sprintf('%.02f', $time_in_100), 0, 0, 'L', FALSE);
            $this->Cell($width[2], 5, utf8_decode('Timpris'), 0, 0, 'L', FALSE);
            $this->Cell($width[3], 5, sprintf('%.02f', $amount), 0, 0, 'R', FALSE);
            $row_total = round($amount*$time_in_100, 2);
            $this->table_sum_row += $row_total;
            $normal_2_to_14_total += $row_total;
            $this->Cell($width[4], 5, sprintf('%.02f', $row_total).' kr', 0, 0, 'R', FALSE);
            $calc = ($row_total * 80) / 100;
            $this->Cell($width[5], 5, sprintf('%.02f', round($calc, 2)).' kr', 0, 1, 'R', FALSE);

            $this->table_sum += $calc;
        }

        //This for calculating "Semestersättn Jour dag 2-14" row
        /*if (!empty($semestersattn_jour_dag_2_14)) {
            foreach ($semestersattn_jour_dag_2_14 as $salary => $params) {
                $time_in_100 = round($equipment->time_user_format(round($params['hours'], 2), 100) / 4, 2);
                $salary = round($salary, 2);
                
                $this->SetX(20);
                $this->Cell($width[0]+$width[1], 5, sprintf('%.02f', $time_in_100), 0, 0, 'L', FALSE);
                $this->Cell($width[2], 5, utf8_decode('Timpris Sem j'), 0, 0, 'L', FALSE);
                $this->Cell($width[3], 5, $salary, 0, 0, 'C', FALSE);
                $row_total = round($salary*$time_in_100, 2);
                $this->table_sum_row += $row_total;
                $this->Cell($width[4], 5, sprintf('%.02f', $row_total).' kr', 0, 0, 'R', FALSE);
                $calc = ($row_total * 12) / 100;
                $this->Cell($width[5], 5, sprintf('%.02f', round($calc, 2)).' kr', 0, 1, 'R', FALSE);
            
                $this->table_sum += $calc;
            }
        }*/

        if (!empty($org_inconv)) {
            foreach ($org_inconv as $key => $ord_inconv) {
                if ($key != 'normal_3' && $key != 'normal_0') {
                    foreach ($ord_inconv as $amount => $h_value) {
                        $time_in_100 = $equipment->time_user_format($h_value['hour'], 100);
                        $amount = round($amount, 2);
                        
                        $this->SetX(20);
                        $this->Cell($width[0]+$width[1], 5, sprintf('%.02f', $time_in_100), 0, 0, 'L', FALSE);
                        $this->Cell($width[2], 5, utf8_decode($key), 0, 0, 'L', FALSE);
                        $this->Cell($width[3], 5, $amount, 0, 0, 'R', FALSE);
                        $row_total = round($amount*$time_in_100, 2);
                        $this->table_sum_row += $row_total;
                        $this->Cell($width[4], 5, sprintf('%.02f', $row_total).' kr', 0, 0, 'R', FALSE);
                        $calc = ($row_total * 80) / 100;
                        $this->Cell($width[5], 5, sprintf('%.02f', round($calc, 2)).' kr', 0, 1, 'R', FALSE);

                        $this->table_sum += $calc;
                    }
                }
            }
        }

        if (!empty($oncall_2_to_14)) {
            foreach ($oncall_2_to_14 as $amount => $hour_value) {
                if ($hour_value['hour'] == 0.00) continue;
                $time_in_100 = $equipment->time_user_format($hour_value['hour'], 100);
                $amount = round($amount, 2);
                
                $this->SetX(20);
                $this->Cell($width[0]+$width[1], 5, sprintf('%.02f', $time_in_100), 0, 0, 'L', FALSE);
                $this->Cell($width[2], 5, utf8_decode('Jour'), 0, 0, 'L', FALSE);
                $this->Cell($width[3], 5, $amount, 0, 0, 'R', FALSE);
                $row_total = round($amount*$time_in_100, 2);
                $this->table_sum_row += $row_total;
                $this->Cell($width[4], 5, sprintf('%.02f', $row_total).' kr', 0, 0, 'R', FALSE);
                $calc = ($row_total * 80) / 100;
                $this->Cell($width[5], 5, sprintf('%.02f', round($calc, 2)).' kr', 0, 1, 'R', FALSE);

                $this->table_sum += $calc;
            }
        }

        //new jour block
        if (!empty($lower_jour_inconv)) {
            foreach ($lower_jour_inconv as $jour_key => $jour_attributes) {
                $time_in_100 = $equipment->time_user_format($jour_attributes['hour'], 100);
                $amount = round($jour_attributes['amount'], 2);
                
                $this->SetX(20);
                $this->Cell($width[0]+$width[1], 5, sprintf('%.02f', $time_in_100), 0, 0, 'L', FALSE);
                $this->Cell($width[2], 5, utf8_decode($jour_key), 0, 0, 'L', FALSE);
                $this->Cell($width[3], 5, $amount, 0, 0, 'R', FALSE);
                $row_total = round($amount*$time_in_100, 2);
                $this->table_sum_row += $row_total;
                $this->Cell($width[4], 5, sprintf('%.02f', $row_total).' kr', 0, 0, 'R', FALSE);
                $calc = ($row_total * 80) / 100;
                $this->Cell($width[5], 5, sprintf('%.02f', round($calc, 2)).' kr', 0, 1, 'R', FALSE);
                
                $this->table_sum += round($calc, 2);
            }
        }
        
        
        //------------------summery-------------------------
        $this->Ln();
        $this->SetFont('Times', '', 11);
        $summery_padding = 20+$width[0]+$width[1]+$width[2];
        $this->SetX($summery_padding);
        $this->Cell($width[3], 5, utf8_decode('Summa:'), 0, 0, 'C', FALSE);
        $this->Cell($width[4], 5, sprintf('%.02f', round($this->table_sum_row, 2)).' kr', 0, 0, 'R', FALSE);
        $this->Cell($width[5], 5, sprintf('%.02f', round($this->table_sum, 2)).' kr', 0, 1, 'R', FALSE);

        $total_table_sum = $this->table_sum;

        $this->Ln();
        $summery_padding_last = $summery_padding+$width[3];
        $this->SetX($summery_padding_last);
        if($this->company_details['sick_annex_calculation_mode'] == 1)
            $sem_ers = round($normal_2_to_14_total * 0.12 * 0.8, 2);
        else
            $sem_ers = round(($normal_2_to_14_total+$total_karense_val) * 0.12, 2);
        $this->Cell($width[4], 5, utf8_decode('Sem ers. '), 0, 0, 'R', FALSE);
        $this->Cell($width[5], 5, sprintf('%.02f', $sem_ers).' kr', 0, 1, 'R', FALSE);
        $total_table_sum += $sem_ers;

        $this->SetX($summery_padding);
        if ($SS_contibution == "") $SS_contibution = 0;
        $this->Cell($width[3], 5, $SS_contibution . "%", 0, 0, 'C', FALSE);
        $this->Cell($width[4], 5, utf8_decode('Socialaavg'), 0, 0, 'R', FALSE);
        $total_contribution = round($this->table_sum * $SS_contibution / 100, 2);
        $this->Cell($width[5], 5, sprintf('%.02f', $total_contribution).' kr', 0, 1, 'R', FALSE);
        $total_table_sum += $total_contribution;
        
        $this->SetX($summery_padding_last);
        if($this->company_details['sick_annex_calculation_mode'] == 1)
            $kp_avgift = round($this->table_sum * 0.068, 2);
        else
            $kp_avgift = round(($this->table_sum+$sem_ers) * 0.065, 2);
        $this->Cell($width[4], 5, utf8_decode('Kp avgift'), 0, 0, 'R', FALSE);
        $this->Cell($width[5], 5, sprintf('%.02f', $kp_avgift).' kr', 0, 1, 'R', FALSE);
        $total_table_sum += $kp_avgift;
        
        $this->Ln();
        $this->SetX($summery_padding_last);
        $total_table_sum = round($total_table_sum, 2);
       // $oresavrundning = round(ceil($total_table_sum) - $total_table_sum, 2);
        $oresavrundning = round(round($total_table_sum) - $total_table_sum, 2);
        $this->Cell($width[4], 5, utf8_decode('öresavrundning:'), 0, 0, 'R', FALSE);
        $this->Cell($width[5], 5, sprintf('%.02f', $oresavrundning).' kr', 0, 1, 'R', FALSE);
        $total_table_sum += $oresavrundning;
        
        $this->SetX($summery_padding_last);
        $this->Cell($width[4], 5, utf8_decode('Att betala:'), 0, 0, 'R', FALSE);
        $this->Cell($width[5], 5, sprintf('%.02f', round($total_table_sum, 2)).' kr', 0, 1, 'R', FALSE);
        
        $this->Ln();
        // $this->draw_hr();
    }

    function no_content_page(){
        
        $this->SetXY(10, 60);
        $this->SetFont('Times', 'B', 14);
        $this->Cell(192, 5, utf8_decode($this->smarty->translate['no_employee']), 0, 0, 'C', FALSE);
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

    function draw_hr(){
        $this->Line(0, $this->GetY(), 220, $this->GetY());
    }
}
?>