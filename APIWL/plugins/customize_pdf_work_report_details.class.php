<?php

require_once('./plugins/F_pdf.class.php');
//require_once('./plugins/fpdi/fpdi.php');
require_once('./class/setup.php');
require_once('./configs/config.inc.php');

class PDF_Work_report extends FPDF { //FPDF

    var $report_month = '';
    var $report_year = '';
    var $report_employee = '';
    var $report_customer = '';
    
    var $days_in_month = array();
    
    //variables for all slots
    var $rpt_content_normal = array();
    var $rpt_content_travel = array();
    var $rpt_content_break = array();
    var $rpt_content_oncall = array();
    var $rpt_content_over = array();
    var $rpt_content_quality = array();
    var $rpt_content_more = array();
    var $rpt_content_some = array();
    var $rpt_content_training = array();
    var $rpt_content_personal = array();
    var $rpt_content_calltraining = array();
    var $rpt_content_voluntary = array();
    var $rpt_content_complementary = array();
    var $rpt_content_complementary_oncall = array();
    var $rpt_content_more_oncall = array();
    var $rpt_content_standby = array();
    var $rpt_content_dismissal = array();
    var $rpt_content_dismissal_oncall = array();
    
    //variables for leave
    var $rpt_content_leave = array();
    var $rpt_content_leave_travel = array();
    var $rpt_content_leave_break = array();
    var $rpt_content_leave_over = array();
    var $rpt_content_leave_quality = array();
    var $rpt_content_leave_more = array();
    var $rpt_content_leave_some = array();
    var $rpt_content_leave_training = array();
    var $rpt_content_leave_personal = array();
    var $rpt_content_leave_calltraining = array();
    var $rpt_content_leave_oncall = array();
    var $rpt_content_leave_voluntary = array();
    var $rpt_content_leave_more_oncall = array();
    var $rpt_content_leave_standby = array();
    var $rpt_content_leave_dismissal = array();
    
    //variables for heading
    var $sub_keys_normal = array();
    var $sub_keys_travel = array();
    var $sub_keys_break = array();
    var $sub_keys_over = array();
    var $sub_keys_quality = array();
    var $sub_keys_more = array();
    var $sub_keys_some = array();
    var $sub_keys_training = array();
    var $sub_keys_personal = array();
    var $sub_keys_oncall = array();
    var $sub_keys_calltraining = array();
    var $sub_keys_voluntary = array();
    var $sub_keys_complementary = array();
    var $sub_keys_complementary_oncall = array();
    var $sub_keys_more_oncall = array();
    var $sub_keys_standby = array();
    var $sub_keys_dismissal = array();
    var $sub_keys_dismissal_oncall = array();
    
    var $sub_keys_leave_normal = array();
    var $sub_keys_leave_normal_inconv = array();
    var $sub_keys_leave_normal_head = array();
    var $sub_keys_leave_travel = array();
    var $sub_keys_leave_travel_inconv = array();
    var $sub_keys_leave_travel_head = array();
    var $sub_keys_leave_break = array();
    var $sub_keys_leave_break_inconv = array();
    var $sub_keys_leave_break_head = array();
    var $sub_keys_leave_over = array();
    var $sub_keys_leave_over_inconv = array();
    var $sub_keys_leave_over_head = array();
    var $sub_keys_leave_quality = array();
    var $sub_keys_leave_quality_inconv = array();
    var $sub_keys_leave_quality_head = array();
    var $sub_keys_leave_more = array();
    var $sub_keys_leave_more_inconv = array();
    var $sub_keys_leave_more_head = array();
    var $sub_keys_leave_some = array();
    var $sub_keys_leave_some_inconv = array();
    var $sub_keys_leave_some_head = array();
    var $sub_keys_leave_training = array();
    var $sub_keys_leave_training_inconv = array();
    var $sub_keys_leave_training_head = array();
    var $sub_keys_leave_personal = array();
    var $sub_keys_leave_personal_inconv = array();
    var $sub_keys_leave_personal_head = array();
    var $sub_keys_leave_oncall = array();
    var $sub_keys_leave_oncall_inconv = array();
    var $sub_keys_leave_oncall_head = array();
    var $sub_keys_leave_calltraining = array();
    var $sub_keys_leave_calltraining_inconv = array();
    var $sub_keys_leave_calltraining_head = array();
    var $sub_keys_leave_voluntary = array();
    var $sub_keys_leave_voluntary_inconv = array();
    var $sub_keys_leave_voluntary_head = array();
    var $sub_keys_leave_more_oncall = array();
    var $sub_keys_leave_more_oncall_inconv = array();
    var $sub_keys_leave_more_oncall_head = array();
    var $sub_keys_leave_standby = array();
    var $sub_keys_leave_standby_inconv = array();
    var $sub_keys_leave_standby_head = array();
    var $sub_keys_leave_dismissal = array();
    var $sub_keys_leave_dismissal_inconv = array();
    var $sub_keys_leave_dismissal_head = array();
    
    //variables for sum
    var $sum_normal = array();
    var $sum_travel = array();
    var $sum_break = array();
    var $sum_over = array();
    var $sum_quality = array();
    var $sum_more = array();
    var $sum_some = array();
    var $sum_training = array();
    var $sum_personal = array();
    var $sum_oncall = array();
    var $sum_calltraining = array();
    var $sum_voluntary = array();
    var $sum_complementary = array();
    var $sum_complementary_oncall = array();
    var $sum_more_oncall = array();
    var $sum_standby = array();
    var $sum_dismissal = array();
    var $sum_dismissal_oncall = array();
    
    var $sum_leave_normal = array();
    var $sum_leave_normal_inconv = array();
    var $sum_leave_travel = array();
    var $sum_leave_travel_inconv = array();
    var $sum_leave_break = array();
    var $sum_leave_break_inconv = array();
    var $sum_leave_over = array();
    var $sum_leave_over_inconv = array();
    var $sum_leave_quality = array();
    var $sum_leave_quality_inconv = array();
    var $sum_leave_more = array();
    var $sum_leave_more_inconv = array();
    var $sum_leave_some = array();
    var $sum_leave_some_inconv = array();
    var $sum_leave_training = array();
    var $sum_leave_training_inconv = array();
    var $sum_leave_personal = array();
    var $sum_leave_personal_inconv = array();
    var $sum_leave_oncall = array();
    var $sum_leave_oncall_inconv = array();
    var $sum_leave_calltraining = array();
    var $sum_leave_calltraining_inconv = array();
    var $sum_leave_voluntary = array();
    var $sum_leave_voluntary_inconv = array();
    var $sum_leave_more_oncall = array();
    var $sum_leave_more_oncall_inconv = array();
    var $sum_leave_standby = array();
    var $sum_leave_standby_inconv = array();
    var $sum_leave_dismissal = array();
    var $sum_leave_dismissal_inconv = array();
    
    
    //for grouping different categories asper different salary amount
    var $salary_hours = array();
    
    var $smarty = array();

    function __construct($orientation = 'P') {

        parent::__construct();
        $this->FPDF($orientation);
        //$this->k=2;
        $this->smarty = new smartySetup(array("month.xml", "reports.xml", "gdschema.xml"),FALSE);
    }

    function P1_Part1($employee) {

        $year = $this->report_year;
        $month = $this->report_month;

        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0, 50, 50);

        $this->SetFont('Arial', 'B', 18);
        $this->SetXY(18, $this->GetY() + 5);
        $this->Cell(180, 5, utf8_decode('Schema anställd per månad'), 0, 0, 'C', FALSE);

        $this->SetXY(18, $this->GetY() + 10);
        $this->Cell(120, 11, '', 1, 0, 'L', true);    //set border
        $this->Cell(60, 11, '', 1, 0, 'L', true);    //set border

        $this->SetFont('Arial', '', 10);
        $this->SetXY(20, $this->GetY() - 2);
        $this->Cell(10, 9, utf8_decode('Förnamn och efternamn '), 0, 0, 'L', FALSE);    //label name1
        $this->SetXY(140, $this->GetY());
        $this->Cell(10, 9, utf8_decode(' Personnummer '), 0, 0, 'L', FALSE);    // label name2

        $this->SetFont('Arial', 'B', 12);
        $this->SetXY(20, $this->GetY() + 5);
        $this->Cell(10, 9, utf8_decode($employee['first_name'] . " " . $employee['last_name']), 0, 0, 'L', FALSE);    //label value1
        $this->SetXY(141, $this->GetY());
        //$this->Cell(10,9,'920320-1968 ',0,0,'L',FALSE);    // label value2
        $this->Cell(10, 9, $employee['social_security'], 0, 0, 'L', FALSE);    // label value2

        $this->Ln();


        $this->SetXY(18, $this->GetY() - 1.3);
        $this->Cell(180, 11, '', 1, 0, 'L', TRUE);

        if ($year % 400 == 0 || ($year % 100 != 0 && $year % 4 == 0))
            $month_days = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
        else
            $month_days = array(31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

        $this->SetFont('Arial', '', 10);
        $this->SetXY(20, $this->GetY() - 2);
        $this->Cell(10, 9, utf8_decode('Period'), 0, 0, 'L', FALSE);    //label name1

        $this->SetFont('Arial', 'B', 12);
        $this->SetXY(20, $this->GetY() + 7);
        $this->Cell(177, 5, utf8_decode($year . '-' . sprintf('%02d', $month) . '-01 -- ' . $year . '-' . sprintf('%02d', $month) . '-' . $month_days[$month - 1]), 0, 0, 'L', FALSE);

//        $this->SetFont('Arial', '', 12);                           //Personnummer
//        $this->SetXY(18, $this->GetY());
//        $this->Cell(177, 5, utf8_decode('Period: '.$year.'-'.sprintf('%02d',$month).'-01 -- '.$year.'-'.sprintf('%02d',$month).'-'.$month_days[$month-1]), 0, 0, 'R', FALSE);

        $this->Ln(13);
    }

    function P1_Part1_Landscap($employee, $cust_name) {

        $year = $this->report_year;
        $month = $this->report_month;

        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0, 50, 50);

        $this->SetFont('Arial', 'B', 18);
        $this->SetXY(18, $this->GetY() + 5);
        $this->Cell(265, 5, utf8_decode($this->smarty->translate['employee_monthly_report']), 0, 0, 'C', FALSE);

        $this->SetXY(18, $this->GetY() + 10);
        $this->Cell(180, 11, '', 1, 0, 'L', true);    //set border
        $this->Cell(85, 11, '', 1, 0, 'L', true);    //set border

        $this->SetFont('Arial', '', 10);
        $this->SetXY(20, $this->GetY() - 2);
        $this->Cell(10, 9, utf8_decode('Assistent: Förnamn och efternamn '), 0, 0, 'L', FALSE);    //label name1
        $this->SetXY(200, $this->GetY());
        $this->Cell(10, 9, utf8_decode(' Personnummer '), 0, 0, 'L', FALSE);    // label name2

        $this->SetFont('Arial', 'B', 12);
        $this->SetXY(20, $this->GetY() + 5);
        $this->Cell(10, 9, utf8_decode($employee['first_name'] . " " . $employee['last_name']), 0, 0, 'L', FALSE);    //label value1
        $this->SetXY(202, $this->GetY());
        $this->Cell(10, 9, $employee['social_security'], 0, 0, 'L', FALSE);    // label value2

        $this->Ln();


        $this->SetXY(18, $this->GetY() - 1.3);
        $this->Cell(130, 11, '', 1, 0, 'L', TRUE);
        $this->Cell(135, 11, '', 1, 0, 'L', TRUE);

        if ($year % 400 == 0 || ($year % 100 != 0 && $year % 4 == 0))
            $month_days = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
        else
            $month_days = array(31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

        $this->SetFont('Arial', '', 10);
        $this->SetXY(20, $this->GetY() - 2);
        $this->Cell(10, 9, utf8_decode('Kund: Förnamn och efternamn '), 0, 0, 'L', FALSE);    //label name1
        $this->SetX(150);
        $this->Cell(10, 9, utf8_decode('Period'), 0, 0, 'L', FALSE);    //label name1

        $this->SetFont('Arial', 'B', 12);
        $this->SetXY(20, $this->GetY() + 5);
        $this->Cell(10, 9, utf8_decode($cust_name), 0, 0, 'L', FALSE);    // label value2
        $this->SetX(150);
        $this->Cell(120, 9, utf8_decode($year . '-' . sprintf('%02d', $month) . '-01 -- ' . $year . '-' . sprintf('%02d', $month) . '-' . $month_days[$month - 1]), 0, 0, 'L', FALSE);

//        $this->SetFont('Arial', '', 12);                           //Personnummer
//        $this->SetXY(18, $this->GetY());
//        $this->Cell(177, 5, utf8_decode('Period: '.$year.'-'.sprintf('%02d',$month).'-01 -- '.$year.'-'.sprintf('%02d',$month).'-'.$month_days[$month-1]), 0, 0, 'R', FALSE);

        $this->Ln(13);
    }

    function P1_Part2() {
//        echo "<pre>\n".print_r($smarty, 1)."</pre>";

        $total_columns = 1;
        $total_columns += count($this->sub_keys_normal);
        $total_columns += count($this->sub_keys_over);
        $total_columns += count($this->sub_keys_quality);
        $total_columns += count($this->sub_keys_more);
        $total_columns += count($this->sub_keys_some);
        $total_columns += count($this->sub_keys_training);
        $total_columns += count($this->sub_keys_personal);

        $total_columns += count($this->sub_keys_oncall);
        $total_columns += count($this->sub_keys_leave);
        if (!empty($this->sub_keys_normal) || !empty($this->sub_keys_over) || !empty($this->sub_keys_quality) || !empty($this->sub_keys_more) || !empty($this->sub_keys_some) || !empty($this->sub_keys_training) || !empty($this->sub_keys_personal))
            $total_columns += 1;
        if (!empty($this->sub_keys_oncall))
            $total_columns += 1;
        if (!empty($this->sub_keys_leave))
            $total_columns += 1;
//        echo $total_columns;

        $maxlen = 0;
        $max_col_head_length = 0;
        if (!empty($this->sub_keys_normal)) {
            $maxlen = max(array_map('strlen', $this->sub_keys_normal));
            $max_col_head_length = $maxlen;
        }
        if (!empty($this->sub_keys_oncall)) {
            $maxlen = max(array_map('strlen', $this->sub_keys_oncall));
            if ($max_col_head_length < $maxlen)
                $max_col_head_length = $maxlen;
        }
        if (!empty($this->sub_keys_leave)) {
            $maxlen = max(array_map('strlen', $this->sub_keys_leave));
            if ($max_col_head_length < $maxlen)
                $max_col_head_length = $maxlen;
        }
        if ($max_col_head_length < 15)   // to check 'Sum. Arb. tid'
            $max_col_head_length = 15;
//        echo $max_col_head_length;


        $date_col_w = 30;
        $rw = (180 - $date_col_w) / $total_columns;
//        $rh = $max_col_head_length + $max_col_head_length / 2;
        $rh = 35;
        $w = array(10, 38.2, 28, 15.1, 17);
        $col_h = 10;
        $this->SetFont('Arial', 'B', 12);

//        $this->Rotate(90, 60, 60);
//        $this->Text(-35, 9, '30591101');       
//        $this->Rotate(0);
        ////////////////////////column headers/////////////////////////////////////
        $this->SetXY(18, $this->GetY());

        $this->Rotate(90, 60, 60);
        $this->Text(($this->GetY() - $rh + $this->GetStringWidth('Datum') + 1), $this->GetX() + ($date_col_w / 2), utf8_decode('Datum'));
        $this->Rotate(0);
        $this->Cell($date_col_w, $rh, '', 1, 0, 'C', FALSE);   //table cell 1


        $m = 0;
        $n = $this->GetY();
        foreach ($this->sub_keys_normal as $entries1) {
            $t = $m * $rw;
            $this->Cell($rw, $rh, '', 1, 0, 'C', FALSE);
            $this->Rotate(90, 60, 60);
            $this->Text($n - ($rh / 2) - 3, $n + $t, utf8_decode($entries1));
            $this->Rotate(0);
            $m += 1;
        }

        $this->SetFillColor(245, 190, 135);
        if ($this->sub_keys_normal || $this->sub_keys_over || $this->sub_keys_quality || $this->sub_keys_more || $this->sub_keys_some || $this->sub_keys_training) {
            $t = $m * $rw;
            $this->Cell($rw, $rh, '', 1, 0, 'C', TRUE);   //table cell 1
            $this->Rotate(90, 60, 60);
            $this->Text($n - ($rh / 2) - 3, $n + $t, utf8_decode('Sum Ordinarie'));
            $this->Rotate(0);
            $m += 1;
        }

        foreach ($this->sub_keys_oncall as $entries1) {
            $t = $m * $rw;

            $this->Cell($rw, $rh, '', 1, 0, 'C', FALSE);
            $this->Rotate(90, 60, 60);
            if ($entries1 == 'jour') {
                $this->Text($n - ($rh / 2) - 3, $n + $t, utf8_decode('Jour'));
            } else {
                $this->Text($n - ($rh / 2) - 3, $n + $t, utf8_decode(substr($entries1, 0, -4)));
            }
            $this->Rotate(0);
            $m += 1;
        }

        $this->SetFillColor(245, 190, 135);
        if ($this->sub_keys_oncall) {
            $t = $m * $rw;
            $this->Cell($rw, $rh, '', 1, 0, 'C', TRUE);   //table cell 1
            $this->Rotate(90, 60, 60);
            $this->Text($n - ($rh / 2) - 3, $n + $t, utf8_decode('Sum Jour'));
            $this->Rotate(0);
            $m += 1;
        }

        $t = $m * $rw;
        $this->Cell($rw, $rh, '', 1, 0, 'C', FALSE);   //table cell 1
        $this->Rotate(90, 60, 60);
        $this->Text($n - ($rh / 2) - 3, $n + $t, utf8_decode('Sum. Arb. tid'));
        $this->Rotate(0);
        $m += 1;

        $this->SetFillColor(249, 221, 221);
        foreach ($this->sub_keys_leave as $entries1) {
            $t = $m * $rw;
            $this->Cell($rw, $rh, '', 1, 0, 'C', TRUE);
            $this->Rotate(90, 60, 60);
            if ($entries1 == 1) {
                $this->Text($n - ($rh / 2) - 3, $n + $t, utf8_decode('Sjuk'));
            } else if ($entries1 == 2) {
                $this->Text($n - ($rh / 2) - 3, $n + $t, utf8_decode('Sem'));
            } else if ($entries1 == 3) {
                $this->Text($n - ($rh / 2) - 3, $n + $t, utf8_decode('VAB'));
            } else if ($entries1 == 4) {
                $this->Text($n - ($rh / 2) - 3, $n + $t, utf8_decode('FP'));
            } else if ($entries1 == 5) {
                $this->Text($n - ($rh / 2) - 3, $n + $t, utf8_decode('möte'));
            } else if ($entries1 == 6) {
                $this->Text($n - ($rh / 2) - 3, $n + $t, utf8_decode('Utbild'));
            } else if ($entries1 == 7) {
                $this->Text($n - ($rh / 2) - 3, $n + $t, utf8_decode('Övrigt'));
            } else if ($entries1 == 8) {
                $this->Text($n - ($rh / 2) - 3, $n + $t, utf8_decode('Byte'));
            } else {
                $this->Text($n - ($rh / 2) - 3, $n + $t, utf8_decode('Sjuk'));
            }
            $this->Rotate(0);
            $m += 1;
        }

        $this->SetFillColor(249, 221, 221);
        if (!empty($this->sub_keys_leave)) {
            $t = $m * $rw;
            $this->Cell($rw, $rh, '', 1, 0, 'C', TRUE);
            $this->Rotate(90, 60, 60);
            $this->Text($n - ($rh / 2) - 3, $n + $t, utf8_decode('Sum. Frånvaro'));
            $this->Rotate(0);
        }

        $this->SetFont('Arial', '', 11);
        $this->Ln();
        $this->SetX(18);
        ///////////////////////////////table body/////////////////////////////////////////

        $i = 0;
        $sum_sum_hour = 0;
//        $sum_sum_hour_leave = 0;
        $sum_sum_hour_ord = 0;
        $sum_sum_hour_jour = 0;
        foreach ($this->days_in_month as $day_in_month) {
            $sum_hour = 0;
            $sum_hour_ord = 0;
            $sum_hour_jour = 0;
            $sum_hour_leave = 0;
            $j = 0;
            $tot = array();


//            var_dump(date_create($day_in_month));
//            $smarty->translate['customer_monthly_report'];
            $week_day_ind = strtolower(date_format(date_create($day_in_month), "D"))/* .utf8_encode(substr(date_format($day_in_month, "%a"),1,1)) */;
            $filtered_week_day = strtolower(substr($this->smarty->translate[$week_day_ind], 0, 3)); //.utf8_encode(substr(strtolower($smarty->translate[$week_day_ind]),1,1));
//            echo $smarty->translate[$week_day_ind]."<br />";
            $this->Cell($date_col_w, $col_h, utf8_decode($day_in_month . " " . $filtered_week_day), 1, 0, 'C', FALSE);

            foreach ($this->sub_keys_normal as $entries1) {
                if ($this->rpt_content_normal[$day_in_month][$entries1]) {
                    $value = $this->rpt_content_normal[$day_in_month][$entries1];
                    $this->Cell($rw, $col_h, round($value, 2), 1, 0, 'C', FALSE);
                    $sum_hour += $value;
                    $sum_hour_ord += $value;
                } else {
                    $this->Cell($rw, $col_h, '', 1, 0, 'C', FALSE);
                }
            }

            $this->SetFillColor(245, 190, 135);
            if ($this->sub_keys_normal) {
                if ($sum_hour_ord)
                    $this->Cell($rw, $col_h, round($sum_hour_ord, 2), 1, 0, 'C', TRUE);
                else
                    $this->Cell($rw, $col_h, '', 1, 0, 'C', TRUE);
                $sum_sum_hour_ord += $sum_hour_ord;
            }

            foreach ($this->sub_keys_oncall as $entries1) {
                if ($this->rpt_content_oncall[$day_in_month][$entries1]) {
                    $value = $this->rpt_content_oncall[$day_in_month][$entries1];
                    $this->Cell($rw, $col_h, round($value, 2), 1, 0, 'C', FALSE);
                    $sum_hour += $value;
                    $sum_hour_jour += $value;
                } else {
                    $this->Cell($rw, $col_h, '', 1, 0, 'C', FALSE);
                }
            }

            $this->SetFillColor(245, 190, 135);
            if ($this->sub_keys_oncall) {
                if ($sum_hour_jour)
                    $this->Cell($rw, $col_h, round($sum_hour_jour, 2), 1, 0, 'C', TRUE);
                else
                    $this->Cell($rw, $col_h, '', 1, 0, 'C', TRUE);
                $sum_sum_hour_jour += $sum_hour_jour;
            }

            if ($sum_hour) {
                $value = $sum_hour;
                $this->Cell($rw, $col_h, round($value, 2), 1, 0, 'C', FALSE);
            } else {
                $this->Cell($rw, $col_h, '', 1, 0, 'C', FALSE);
            }

            $sum_sum_hour += $sum_hour;
            $this->SetFillColor(249, 221, 221);
            foreach ($this->sub_keys_leave as $entries1) {
                if ($this->rpt_content_leave[$day_in_month][$entries1]) {
                    $value = $this->rpt_content_leave[$day_in_month][$entries1];
                    $this->Cell($rw, $col_h, round($value, 2), 1, 0, 'C', TRUE);
                    $sum_hour_leave += $value;
                } else {
                    $this->Cell($rw, $col_h, '', 1, 0, 'C', TRUE);
                }
            }

            $this->SetFillColor(249, 221, 221);
            if ($this->sub_keys_leave) {
                $value = $sum_hour_leave;
                $this->Cell($rw, $col_h, round($value, 2), 1, 0, 'C', TRUE);
            }

            $sum_sum_hour_leave += $sum_hour_leave;

            $this->Ln();
            $this->SetX(18);
        }


        $this->SetFont('Arial', 'B', 12);
        ////////////////////////////////////////////////grand totals//////////////////////

        $this->Cell($date_col_w, $col_h, utf8_decode('Summa'), 1, 0, 'C', FALSE);

        foreach ($this->sum_normal as $entries1) {
            $value = $entries1;
//            $y = round(($entries1 - (int)$entries1)*60);
            $this->Cell($rw, $col_h, round($value, 2), 1, 0, 'C', FALSE);
        }

        $this->SetFillColor(245, 190, 135);
        if ($this->sub_keys_normal) {
            $this->Cell($rw, $col_h, round($sum_sum_hour_ord, 2), 1, 0, 'C', TRUE);
        }

        foreach ($this->sum_oncall as $entries1) {
            $value = $entries1;
            $this->Cell($rw, $col_h, round($value, 2), 1, 0, 'C', FALSE);
        }

        $this->SetFillColor(245, 190, 135);
        if ($this->sub_keys_oncall) {
            $this->Cell($rw, $col_h, round($sum_sum_hour_jour, 2), 1, 0, 'C', TRUE);
        }

        $value = $sum_sum_hour;
//        $y = round(($sum_sum_hour - (int)$sum_sum_hour)*60);
        $this->Cell($rw, $col_h, round($value, 2), 1, 0, 'C', FALSE);

        $this->SetFillColor(249, 221, 221);
        foreach ($this->sum_leave as $entries1) {
            $value = (int) $entries1;
            $y = round(($entries1 - (int) $entries1) * 60);
            $this->Cell($rw, $col_h, $value . '.' . $y, 1, 0, 'C', TRUE);
        }

        $this->SetFillColor(249, 221, 221);
        if ($this->sub_keys_leave) {
            $value = $sum_sum_hour_leave;
            $this->Cell($rw, $col_h, round($value, 2), 1, 0, 'C', TRUE);
        }
    }

    function P1_Part2_Landscap($start, $end) {
        global $leave_type;
        $total_columns = $end - $start + 1;
        /*$total_columns = 1;
        $total_columns += count($this->sub_keys_normal);
        $total_columns += count($this->sub_keys_oncall);
        $total_columns += count($this->sub_keys_leave);
        $total_columns += count($this->sub_keys_more);
        $total_columns += count($this->sub_keys_over);
        $total_columns += count($this->sub_keys_quality);
        $total_columns += count($this->sub_keys_some);
        $total_columns += count($this->sub_keys_training);
        $total_columns += count($this->sub_keys_leave_normal_head);
        $total_columns += count($this->sub_keys_leave_over_head);
        $total_columns += count($this->sub_keys_leave_quality_head);
        $total_columns += count($this->sub_keys_leave_more_head);
        $total_columns += count($this->sub_keys_leave_some_head);
        $total_columns += count($this->sub_keys_leave_training_head);
        $total_columns += count($this->sub_keys_leave_oncall_head);
        if (!empty($this->sub_keys_normal) || !empty($this->sub_keys_over) || !empty($this->sub_keys_quality) || !empty($this->sub_keys_more) || !empty($this->sub_keys_some) || !empty($this->sub_keys_training))
            $total_columns += 1;
        if (!empty($this->sub_keys_oncall))
            $total_columns += 1;
        if (!empty($this->sub_keys_leave_normal_head) || !empty($this->sub_keys_leave_over_head) || !empty($this->sub_keys_leave_quality_head) || !empty($this->sub_keys_leave_more_head) || !empty($this->sub_keys_leave_some_head) || !empty($this->sub_keys_leave_training_head))
            $total_columns += 1;
        if (!empty($this->sub_keys_leave_oncall_head))
            $total_columns += 1;
        if (!empty($this->sub_keys_leave_normal_head) || !empty($this->sub_keys_leave_over_head) || !empty($this->sub_keys_leave_quality_head) || !empty($this->sub_keys_leave_more_head) || !empty($this->sub_keys_leave_some_head) || !empty($this->sub_keys_leave_training_head) || !empty($this->sub_keys_leave_oncall_head))
            $total_columns += 1; */

        $maxlen = 4;
        $date_col_w = 30;
        $rw = (265 - $date_col_w) / $total_columns;
//        $rh = $max_col_head_length + $max_col_head_length / 2;
        $rh = 5;
        $tr_lower_y = 0;
//        $w = array(10, 38.2, 28, 15.1, 17);
        $col_h = 10;
        $this->SetFont('Arial', 'B', 12);

//        $this->Rotate(90, 60, 60);
//        $this->Text(-35, 9, '30591101');       
//        $this->Rotate(0);
//        
        ////////////////////////column headers////////////////////////////////////////////////////////////////////////////////
        $this->SetXY(18, $this->GetY());
        $header_start_y = $this->GetY();
        $header_calc_values = $this->calc_header_height($date_col_w, $rw);
        $rh = $header_calc_values['header_height'];
        
        $b_x = $this->GetX();
        $b_y = $this->GetY();
        $this->SetFillColor(255, 255, 255);
        $this->Cell($date_col_w, $rh, '', 'TLR', 0, 'C', TRUE);
        $a_x = $this->GetX();
        $a_y = $this->GetY();
        $this->SetXY($b_x, $b_y);
        $this->MultiCell($date_col_w, 5, utf8_decode($this->smarty->translate['date']), 0, 'C', FALSE);
        $this->SetXY($a_x, $a_y);

        $current_column_number = 0;
        $n = $this->GetY();
        foreach ($this->sub_keys_normal as $entries1) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $b_x = $this->GetX();
                $b_y = $this->GetY();
                $this->Cell($rw, $rh, '', 'TLR', 0, 'C', TRUE);
                $a_x = $this->GetX();
                $a_y = $this->GetY();
                $this->SetXY($b_x, $b_y);
                $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($entries1)), 0, 'C');
                $this->SetXY($a_x, $a_y);
            }
        }
        
        foreach ($this->sub_keys_travel as $entries1) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $b_x = $this->GetX();
                $b_y = $this->GetY();
                $this->Cell($rw, $rh, '', 'TLR', 0, 'C', TRUE);
                $a_x = $this->GetX();
                $a_y = $this->GetY();
                $this->SetXY($b_x, $b_y);
                $col_heading = ($entries1 == 'travel' ? $this->smarty->translate['travel'] : ($entries1 . ' ' . $this->smarty->translate['travel']));
                $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
                $this->SetXY($a_x, $a_y);
            }
        }
        
        foreach ($this->sub_keys_break as $entries1) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $b_x = $this->GetX();
                $b_y = $this->GetY();
                $this->Cell($rw, $rh, '', 'TLR', 0, 'C', TRUE);
                $a_x = $this->GetX();
                $a_y = $this->GetY();
                $this->SetXY($b_x, $b_y);
                $col_heading = ($entries1 == 'break' ? $this->smarty->translate['break'] : ($entries1 . ' ' . $this->smarty->translate['break']));
                $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
                $this->SetXY($a_x, $a_y);
            }
        }

        foreach ($this->sub_keys_over as $entries1) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $b_x = $this->GetX();
                $b_y = $this->GetY();
                $this->Cell($rw, $rh, '', 'TLR', 0, 'C', TRUE);
                $a_x = $this->GetX();
                $a_y = $this->GetY();
                $this->SetXY($b_x, $b_y);
                $col_heading = ($entries1 == 'overtime' ? $this->smarty->translate['overtime'] : ($entries1 . ' ' . $this->smarty->translate['overtime']));
                $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
                $this->SetXY($a_x, $a_y);
            }
        }

        foreach ($this->sub_keys_quality as $entries1) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $b_x = $this->GetX();
                $b_y = $this->GetY();
                $this->Cell($rw, $rh, '', 'TLR', 0, 'C', TRUE);
                $a_x = $this->GetX();
                $a_y = $this->GetY();
                $this->SetXY($b_x, $b_y);
                $col_heading = ($entries1 == 'qual_overtime' ? $this->smarty->translate['qual_overtime'] : ($entries1 . ' ' . $this->smarty->translate['qual_overtime']));
                $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
                $this->SetXY($a_x, $a_y);
            }
        }

        foreach ($this->sub_keys_more as $entries1) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $b_x = $this->GetX();
                $b_y = $this->GetY();
                $this->Cell($rw, $rh, '', 'TLR', 0, 'C', TRUE);
                $a_x = $this->GetX();
                $a_y = $this->GetY();
                $this->SetXY($b_x, $b_y);
                $col_heading = ($entries1 == 'more_time' ? $this->smarty->translate['more_time'] : ($entries1 . ' ' . $this->smarty->translate['more_time']));
                $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
                $this->SetXY($a_x, $a_y);
            }
        }

        foreach ($this->sub_keys_some as $entries1) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $b_x = $this->GetX();
                $b_y = $this->GetY();
                $this->Cell($rw, $rh, '', 'TLR', 0, 'C', TRUE);
                $a_x = $this->GetX();
                $a_y = $this->GetY();
                $this->SetXY($b_x, $b_y);
                $col_heading = ($entries1 == 'some_other_time' ? $this->smarty->translate['some_other_time'] : ($entries1 . ' ' . $this->smarty->translate['some_other_time']));
                $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
                $this->SetXY($a_x, $a_y);
            }
        }

        foreach ($this->sub_keys_training as $entries1) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $b_x = $this->GetX();
                $b_y = $this->GetY();
                $this->Cell($rw, $rh, '', 'TLR', 0, 'C', TRUE);
                $a_x = $this->GetX();
                $a_y = $this->GetY();
                $this->SetXY($b_x, $b_y);
                $col_heading = ($entries1 == 'training' ? $this->smarty->translate['training_time'] : ($entries1 . ' ' . $this->smarty->translate['training_time']));
                $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
                $this->SetXY($a_x, $a_y);
            }
        }

        foreach ($this->sub_keys_voluntary as $entries1) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $b_x = $this->GetX();
                $b_y = $this->GetY();
                $this->Cell($rw, $rh, '', 'TLR', 0, 'C', TRUE);
                $a_x = $this->GetX();
                $a_y = $this->GetY();
                $this->SetXY($b_x, $b_y);
                $col_heading = ($entries1 == 'voluntary' ? $this->smarty->translate['voluntary'] : ($entries1 . ' ' . $this->smarty->translate['voluntary']));
                $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
                $this->SetXY($a_x, $a_y);
            }
        }

        foreach ($this->sub_keys_complementary as $entries1) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $b_x = $this->GetX();
                $b_y = $this->GetY();
                $this->Cell($rw, $rh, '', 'TLR', 0, 'C', TRUE);
                $a_x = $this->GetX();
                $a_y = $this->GetY();
                $this->SetXY($b_x, $b_y);
                $col_heading = ($entries1 == 'complementary' ? $this->smarty->translate['complementary'] : ($entries1 . ' ' . $this->smarty->translate['complementary']));
                $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
                $this->SetXY($a_x, $a_y);
            }
        }
        
        foreach ($this->sub_keys_standby as $entries1) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $b_x = $this->GetX();
                $b_y = $this->GetY();
                $this->Cell($rw, $rh, '', 'TLR', 0, 'C', TRUE);
                $a_x = $this->GetX();
                $a_y = $this->GetY();
                $this->SetXY($b_x, $b_y);
                $col_heading = ($entries1 == 'standby' ? $this->smarty->translate['standby'] : ($entries1 . ' ' . $this->smarty->translate['standby']));
                $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
                $this->SetXY($a_x, $a_y);
            }
        }
        
        foreach ($this->sub_keys_dismissal as $entries1) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $b_x = $this->GetX();
                $b_y = $this->GetY();
                $this->Cell($rw, $rh, '', 'TLR', 0, 'C', TRUE);
                $a_x = $this->GetX();
                $a_y = $this->GetY();
                $this->SetXY($b_x, $b_y);
                $col_heading = ($entries1 == 'dismissal' ? $this->smarty->translate['work_for_dismissal'] : ($entries1 . ' ' . $this->smarty->translate['work_for_dismissal']));
                $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
                $this->SetXY($a_x, $a_y);
            }
        }

        $this->SetFillColor(245, 190, 135);
        if (!empty($this->sub_keys_normal) || !empty($this->sub_keys_travel) || !empty($this->sub_keys_break) || !empty($this->sub_keys_over) || !empty($this->sub_keys_quality) || !empty($this->sub_keys_more) || !empty($this->sub_keys_some) || !empty($this->sub_keys_training) || !empty($this->sub_keys_voluntary) || !empty($this->sub_keys_complementary) || !empty($this->sub_keys_standby) || !empty($this->sub_keys_dismissal)) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $b_x = $this->GetX();
                $b_y = $this->GetY();
                $this->Cell($rw, $rh, '', 'TLR', 0, 'C', TRUE);
                $a_x = $this->GetX();
                $a_y = $this->GetY();
                $this->SetXY($b_x, $b_y);
                $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($this->smarty->translate['work_sum_ord'])), 0, 'C');
                $this->SetXY($a_x, $a_y);
            }
        }
        
        $this->SetFillColor(255, 255, 255);
        foreach ($this->sub_keys_personal as $entries1) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $b_x = $this->GetX();
                $b_y = $this->GetY();
                $this->Cell($rw, $rh, '', 'TLR', 0, 'C', TRUE);
                $a_x = $this->GetX();
                $a_y = $this->GetY();
                $this->SetXY($b_x, $b_y);
                $col_heading = ($entries1 == 'personal_meeting' ? $this->smarty->translate['personal_meeting'] : ($entries1 . ' ' . $this->smarty->translate['personal_meeting']));
                $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
                $this->SetXY($a_x, $a_y);
            }
        }
        
        $this->SetFillColor(245, 190, 135);
        if (!empty($this->sub_keys_personal)){
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $b_x = $this->GetX();
                $b_y = $this->GetY();
                $this->Cell($rw, $rh, '', 'TLR', 0, 'C', TRUE);
                $a_x = $this->GetX();
                $a_y = $this->GetY();
                $this->SetXY($b_x, $b_y);
                $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($this->smarty->translate['work_sum_personal'])), 0, 'C');
                $this->SetXY($a_x, $a_y);
            }
        }
        
        $this->SetFillColor(255, 255, 255);
        foreach ($this->sub_keys_oncall as $entries1) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $b_x = $this->GetX();
                $b_y = $this->GetY();
                $this->Cell($rw, $rh, '', 'TLR', 0, 'C', TRUE);
                $a_x = $this->GetX();
                $a_y = $this->GetY();
                $this->SetXY($b_x, $b_y);
                
                $col_heading = '';
                if($entries1 == 'jour') $col_heading = 'Jour';
                else if(stripos(' '.$entries1, 'jour')) $col_heading = $entries1;
                else $col_heading = 'Jour '. $entries1;
                
                $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
                $this->SetXY($a_x, $a_y);
            }
        }

        foreach ($this->sub_keys_calltraining as $entries1) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $b_x = $this->GetX();
                $b_y = $this->GetY();
                $this->Cell($rw, $rh, '', 'TLR', 0, 'C', TRUE);
                $a_x = $this->GetX();
                $a_y = $this->GetY();
                $this->SetXY($b_x, $b_y);
                $col_heading = ($entries1 == 'call_training' ? $this->smarty->translate['call_training'] : ($entries1 . ' ' . $this->smarty->translate['training_time']));
                $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
                $this->SetXY($a_x, $a_y);
            }
        }

        foreach ($this->sub_keys_complementary_oncall as $entries1) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $b_x = $this->GetX();
                $b_y = $this->GetY();
                $this->Cell($rw, $rh, '', 'TLR', 0, 'C', TRUE);
                $a_x = $this->GetX();
                $a_y = $this->GetY();
                $this->SetXY($b_x, $b_y);
                $col_heading = ($entries1 == 'complementary_oncall' ? $this->smarty->translate['complementary_oncall'] : ($entries1 . ' ' . $this->smarty->translate['complementary']));
                $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
                $this->SetXY($a_x, $a_y);
            }
        }
        
        foreach ($this->sub_keys_more_oncall as $entries1) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $b_x = $this->GetX();
                $b_y = $this->GetY();
                $this->Cell($rw, $rh, '', 'TLR', 0, 'C', TRUE);
                $a_x = $this->GetX();
                $a_y = $this->GetY();
                $this->SetXY($b_x, $b_y);
                $col_heading = ($entries1 == 'complementary_oncall' ? $this->smarty->translate['complementary_oncall'] : ($entries1 . ' ' . $this->smarty->translate['more_time']));
                $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
                $this->SetXY($a_x, $a_y);
            }
        }


        foreach ($this->sub_keys_dismissal_oncall as $entries1) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $b_x = $this->GetX();
                $b_y = $this->GetY();
                $this->Cell($rw, $rh, '', 'TLR', 0, 'C', TRUE);
                $a_x = $this->GetX();
                $a_y = $this->GetY();
                $this->SetXY($b_x, $b_y);
                $col_heading = ($entries1 == 'dismissal_oncall' ? $this->smarty->translate['dismissal_oncall'] : ($entries1 . ' ' . $this->smarty->translate['dismissal']));
                $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
                $this->SetXY($a_x, $a_y);
            }
        }



        $this->SetFillColor(245, 190, 135);
        if (!empty($this->sub_keys_oncall) || !empty($this->sub_keys_calltraining) || !empty($this->sub_keys_complementary_oncall) || !empty($this->sub_keys_more_oncall) || !empty($this->sub_keys_dismissal_oncall)) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $b_x = $this->GetX();
                $b_y = $this->GetY();
                $this->Cell($rw, $rh, '', 'TLR', 0, 'C', TRUE);
                $a_x = $this->GetX();
                $a_y = $this->GetY();
                $this->SetXY($b_x, $b_y);
                $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($this->smarty->translate['work_sum_jour'])), 0, 'C');
                $this->SetXY($a_x, $a_y);
            }
        }

        $this->SetFillColor(255, 255, 255);
        if (!empty($this->sub_keys_normal) || !empty($this->sub_keys_travel) || !empty($this->sub_keys_break) || !empty($this->sub_keys_over) || !empty($this->sub_keys_quality) || !empty($this->sub_keys_more) || !empty($this->sub_keys_some) || !empty($this->sub_keys_training) || !empty($this->sub_keys_personal) || !empty($this->sub_keys_voluntary) || !empty($this->sub_keys_complementary) || !empty($this->sub_keys_standby) || !empty($this->sub_keys_dismissal) || !empty($this->sub_keys_oncall) || !empty($this->sub_keys_calltraining) || !empty($this->sub_keys_complementary_oncall)  || !empty($this->sub_keys_more_oncall) || !empty($this->sub_keys_dismissal_oncall)) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $b_x = $this->GetX();
                $b_y = $this->GetY();
                $this->Cell($rw, $rh, '', 'TLR', 0, 'C', TRUE);
                $a_x = $this->GetX();
                $a_y = $this->GetY();
                $this->SetXY($b_x, $b_y);
                $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($this->smarty->translate['work_sum'])), 0, 'C');
                $this->SetXY($a_x, $a_y);
            }
        }

        $this->SetFillColor(249, 221, 221);
        foreach ($this->sub_keys_leave_normal_head as $entries3) {
            foreach ($entries3 as $entries1 => $entries2) {
                $current_column_number++;
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    $b_x = $this->GetX();
                    $b_y = $this->GetY();
                    $this->Cell($rw, $rh, '', 'TLR', 0, 'C', TRUE);
                    $a_x = $this->GetX();
                    $a_y = $this->GetY();
                    $this->SetXY($b_x, $b_y);
                    $col_heading = $leave_type[$entries1] . ' '. $entries2;
                    $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
                    $this->SetXY($a_x, $a_y);
                }
            }
        }
        
        foreach ($this->sub_keys_leave_travel_head as $entries3) {
            foreach ($entries3 as $entries1 => $entries2) {
                $current_column_number++;
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    $b_x = $this->GetX();
                    $b_y = $this->GetY();
                    $this->Cell($rw, $rh, '', 'TLR', 0, 'C', TRUE);
                    $a_x = $this->GetX();
                    $a_y = $this->GetY();
                    $this->SetXY($b_x, $b_y);
                    $col_heading = $leave_type[$entries1] . ' ';
                    $col_heading .= (stripos(' '.$entries2, 'travel') ? $this->smarty->translate[$entries2] : ($entries2 .' '. $this->smarty->translate['travel']));

                    $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
                    $this->SetXY($a_x, $a_y);
                }
            }
        }
        
        foreach ($this->sub_keys_leave_break_head as $entries3) {
            foreach ($entries3 as $entries1 => $entries2) {
                $current_column_number++;
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    $b_x = $this->GetX();
                    $b_y = $this->GetY();
                    $this->Cell($rw, $rh, '', 'TLR', 0, 'C', TRUE);
                    $a_x = $this->GetX();
                    $a_y = $this->GetY();
                    $this->SetXY($b_x, $b_y);
                    $col_heading = $leave_type[$entries1] . ' ';
                    $col_heading .= (stripos(' '.$entries2, 'break') ? $this->smarty->translate[$entries2] : ($entries2 .' '. $this->smarty->translate['break']));

                    $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
                    $this->SetXY($a_x, $a_y);
                }
            }
        }

        foreach ($this->sub_keys_leave_over_head as $entries3) {
            foreach ($entries3 as $entries1 => $entries2) {
                $current_column_number++;
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    $b_x = $this->GetX();
                    $b_y = $this->GetY();
                    $this->Cell($rw, $rh, '', 'TLR', 0, 'C', TRUE);
                    $a_x = $this->GetX();
                    $a_y = $this->GetY();
                    $this->SetXY($b_x, $b_y);
                    $col_heading = $leave_type[$entries1] . ' ';
                    $col_heading .= (stripos(' '.$entries2, 'overtime') ? $this->smarty->translate[$entries2] : ($entries2 .' '. $this->smarty->translate['overtime']));

                    $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
                    $this->SetXY($a_x, $a_y);
                }
            }
        }

        foreach ($this->sub_keys_leave_quality_head as $entries3) {
            foreach ($entries3 as $entries1 => $entries2) {
                $current_column_number++;
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    $b_x = $this->GetX();
                    $b_y = $this->GetY();
                    $this->Cell($rw, $rh, '', 'TLR', 0, 'C', TRUE);
                    $a_x = $this->GetX();
                    $a_y = $this->GetY();
                    $this->SetXY($b_x, $b_y);
                    $col_heading = $leave_type[$entries1] . ' ';
                    $col_heading .= (stripos(' '.$entries2, 'qual_overtime') ? $this->smarty->translate[$entries2] : ($entries2 .' '. $this->smarty->translate['qual_overtime']));

                    $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
                    $this->SetXY($a_x, $a_y);
                }
            }
        }

        foreach ($this->sub_keys_leave_more_head as $entries3) {
            foreach ($entries3 as $entries1 => $entries2) {
                $current_column_number++;
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    $b_x = $this->GetX();
                    $b_y = $this->GetY();
                    $this->Cell($rw, $rh, '', 'TLR', 0, 'C', TRUE);
                    $a_x = $this->GetX();
                    $a_y = $this->GetY();
                    $this->SetXY($b_x, $b_y);
                    $col_heading = $leave_type[$entries1] . ' ';
                    $col_heading .= (stripos(' '.$entries2, 'more_time') ? $this->smarty->translate[$entries2] : ($entries2 .' '. $this->smarty->translate['more_time']));

                    $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
                    $this->SetXY($a_x, $a_y);
                }
            }
        }

        foreach ($this->sub_keys_leave_some_head as $entries3) {
            foreach ($entries3 as $entries1 => $entries2) {
                $current_column_number++;
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    $b_x = $this->GetX();
                    $b_y = $this->GetY();
                    $this->Cell($rw, $rh, '', 'TLR', 0, 'C', TRUE);
                    $a_x = $this->GetX();
                    $a_y = $this->GetY();
                    $this->SetXY($b_x, $b_y);
                    $col_heading = $leave_type[$entries1] . ' ';
                    $col_heading .= (stripos(' '.$entries2, 'some_other_time') ? $this->smarty->translate[$entries2] : ($entries2 .' '. $this->smarty->translate['some_other_time']));

                    $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
                    $this->SetXY($a_x, $a_y);
                }
            }
        }

        foreach ($this->sub_keys_leave_training_head as $entries3) {
            foreach ($entries3 as $entries1 => $entries2) {
                $current_column_number++;
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    $b_x = $this->GetX();
                    $b_y = $this->GetY();
                    $this->Cell($rw, $rh, '', 'TLR', 0, 'C', TRUE);
                    $a_x = $this->GetX();
                    $a_y = $this->GetY();
                    $this->SetXY($b_x, $b_y);
                    $col_heading = $leave_type[$entries1] . ' ';
                    $col_heading .= (stripos(' '.$entries2, 'training') ? $this->smarty->translate[$entries2] : ($entries2 .' '. $this->smarty->translate['training']));

                    $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
                    $this->SetXY($a_x, $a_y);
                }
            }
        }

        foreach ($this->sub_keys_leave_personal_head as $entries3) {
            foreach ($entries3 as $entries1 => $entries2) {
                $current_column_number++;
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    $b_x = $this->GetX();
                    $b_y = $this->GetY();
                    $this->Cell($rw, $rh, '', 'TLR', 0, 'C', TRUE);
                    $a_x = $this->GetX();
                    $a_y = $this->GetY();
                    $this->SetXY($b_x, $b_y);
                    $col_heading = $leave_type[$entries1] . ' ';
                    $col_heading .= (stripos(' '.$entries2, 'personal_meeting') ? $this->smarty->translate[$entries2] : ($entries2 .' '. $this->smarty->translate['personal_meeting']));

                    $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
                    $this->SetXY($a_x, $a_y);
                }
            }
        }

        foreach ($this->sub_keys_leave_voluntary_head as $entries3) {
            foreach ($entries3 as $entries1 => $entries2) {
                $current_column_number++;
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    $b_x = $this->GetX();
                    $b_y = $this->GetY();
                    $this->Cell($rw, $rh, '', 'TLR', 0, 'C', TRUE);
                    $a_x = $this->GetX();
                    $a_y = $this->GetY();
                    $this->SetXY($b_x, $b_y);
                    $col_heading = $leave_type[$entries1] . ' ';
                    $col_heading .= (stripos(' '.$entries2, 'voluntary') ? $this->smarty->translate[$entries2] : ($entries2 .' '. $this->smarty->translate['voluntary']));

                    $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
                    $this->SetXY($a_x, $a_y);
                }
            }
        }
        
        foreach ($this->sub_keys_leave_standby_head as $entries3) {
            foreach ($entries3 as $entries1 => $entries2) {
                $current_column_number++;
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    $b_x = $this->GetX();
                    $b_y = $this->GetY();
                    $this->Cell($rw, $rh, '', 'TLR', 0, 'C', TRUE);
                    $a_x = $this->GetX();
                    $a_y = $this->GetY();
                    $this->SetXY($b_x, $b_y);
                    $col_heading = $leave_type[$entries1] . ' ';
                    $col_heading .= (stripos(' '.$entries2, 'standby') ? $this->smarty->translate[$entries2] : ($entries2 .' '. $this->smarty->translate['standby']));

                    $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
                    $this->SetXY($a_x, $a_y);
                }
            }
        }

        $this->SetFillColor(245, 190, 135);
        if (!empty($this->sub_keys_leave_normal_head) || !empty($this->sub_keys_leave_travel_head) || !empty($this->sub_keys_leave_break_head) || !empty($this->sub_keys_leave_over_head) || !empty($this->sub_keys_leave_quality_head) || !empty($this->sub_keys_leave_more_head) || !empty($this->sub_keys_leave_some_head) || !empty($this->sub_keys_leave_training_head) || !empty($this->sub_keys_leave_personal_head) || !empty($this->sub_keys_leave_voluntary_head) || !empty($this->sub_keys_leave_standby_head)) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $b_x = $this->GetX();
                $b_y = $this->GetY();
                $this->Cell($rw, $rh, '', 'TLR', 0, 'C', TRUE);
                $a_x = $this->GetX();
                $a_y = $this->GetY();
                $this->SetXY($b_x, $b_y);
                $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($this->smarty->translate['leave_sum_ord'])), 0, 'C');
                $this->SetXY($a_x, $a_y);
            }
        }

        $this->SetFillColor(249, 221, 221);
        foreach ($this->sub_keys_leave_oncall_head as $entries3) {
            foreach ($entries3 as $entries1 => $entries2) {
                $current_column_number++;
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    $b_x = $this->GetX();
                    $b_y = $this->GetY();
                    $this->Cell($rw, $rh, '', 'TLR', 0, 'C', TRUE);
                    $a_x = $this->GetX();
                    $a_y = $this->GetY();
                    $this->SetXY($b_x, $b_y);
                    $col_heading = $leave_type[$entries1] . ' '. $entries2;
                    $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
                    $this->SetXY($a_x, $a_y);
                }
            }
        }

        foreach ($this->sub_keys_leave_calltraining_head as $entries3) {
            foreach ($entries3 as $entries1 => $entries2) {
                $current_column_number++;
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    $b_x = $this->GetX();
                    $b_y = $this->GetY();
                    $this->Cell($rw, $rh, '', 'TLR', 0, 'C', TRUE);
                    $a_x = $this->GetX();
                    $a_y = $this->GetY();
                    $this->SetXY($b_x, $b_y);
                    $col_heading = $leave_type[$entries1] . ' ';
                    $col_heading .= (stripos(' '.$entries2, 'call_training') ? $this->smarty->translate[$entries2] : ($entries2 .' '. $this->smarty->translate['training_time']));

                    $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
                    $this->SetXY($a_x, $a_y);
                }
            }
        }
        
        foreach ($this->sub_keys_leave_more_oncall_head as $entries3) {
            foreach ($entries3 as $entries1 => $entries2) {
                $current_column_number++;
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    $b_x = $this->GetX();
                    $b_y = $this->GetY();
                    $this->Cell($rw, $rh, '', 'TLR', 0, 'C', TRUE);
                    $a_x = $this->GetX();
                    $a_y = $this->GetY();
                    $this->SetXY($b_x, $b_y);
                    $col_heading = $leave_type[$entries1] . ' ';
                    $col_heading .= (stripos(' '.$entries2, 'more_oncall') ? $this->smarty->translate[$entries2] : ($entries2 .' '. $this->smarty->translate['more_time']));

                    $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
                    $this->SetXY($a_x, $a_y);
                }
            }
        }

        $this->SetFillColor(245, 190, 135);
        if (!empty($this->sub_keys_leave_oncall_head) || !empty($this->sub_keys_leave_calltraining_head) || !empty($this->sub_keys_leave_more_oncall_head)) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $b_x = $this->GetX();
                $b_y = $this->GetY();
                $this->Cell($rw, $rh, '', 'TLR', 0, 'C', TRUE);
                $a_x = $this->GetX();
                $a_y = $this->GetY();
                $this->SetXY($b_x, $b_y);
                $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($this->smarty->translate['leave_sum_oncall'])), 0, 'C');
                $this->SetXY($a_x, $a_y);
            }
        }

        $this->SetFillColor(249, 221, 221);
        if (!empty($this->sub_keys_leave_normal_head) || !empty($this->sub_keys_leave_travel_head) || !empty($this->sub_keys_leave_break_head) || !empty($this->sub_keys_leave_over_head) || !empty($this->sub_keys_leave_quality_head) || !empty($this->sub_keys_leave_more_head) || !empty($this->sub_keys_leave_some_head) || !empty($this->sub_keys_leave_training_head) || !empty($this->sub_keys_leave_personal_head) || !empty($this->sub_keys_leave_voluntary_head) || !empty($this->sub_keys_leave_standby_head) || !empty($this->sub_keys_leave_oncall_head) || !empty($this->sub_keys_leave_calltraining_head) || !empty($this->sub_keys_leave_more_oncall_head)) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $b_x = $this->GetX();
                $b_y = $this->GetY();
                $this->Cell($rw, $rh, '', 'TLR', 0, 'C', TRUE);
                $a_x = $this->GetX();
                $a_y = $this->GetY();
                $this->SetXY($b_x, $b_y);
                $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($this->smarty->translate['leave_sum'])), 0, 'C');
            }
        }


//        $this->SetXY(18, $header_start_y);
//        $new_header_height = $tr_lower_y - $header_start_y;
//        $this->redraw_columnheader($new_header_height,$date_col_w,$rw);
//        $this->Cell($date_col_w, $new_header_height, '', 'TLR', 0, 'C', FALSE);

        $this->SetY($header_calc_values['tr_start_y']);
//        $this->Ln();
        ///////////////////////////////table body/////////////////////////////////////////////////////////////////////////

        $this->SetX(18);
        $this->SetFont('Arial', '', 11);
        $i = 0;
        $sum_sum_hour = 0;
//        $sum_sum_hour_leave = 0;
        $sum_sum_hour_ord = 0;
        $sum_sum_hour_personal = 0;
        $sum_sum_hour_jour = 0;
        $sum_sum_hour_leave = 0;
        $sum_sum_hour_leave_oncall = 0;
        foreach ($this->days_in_month as $day_in_month) {
            $sum_hour = 0;
            $sum_hour_ord = 0;
            $sum_hour_personal = 0;
            $sum_hour_jour = 0;
            $sum_hour_leave = 0;
            $sum_hour_leave_oncall = 0;
            $j = 0;
            $tot = array();
            $current_column_number = 0;
            
            $this->SetFillColor(255, 255, 255);
            $week_day_ind = strtolower(date_format(date_create($day_in_month), "D"))/* .utf8_encode(substr(date_format($day_in_month, "%a"),1,1)) */;
            $filtered_week_day = strtolower(substr($this->smarty->translate[$week_day_ind], 0, 3)); //.utf8_encode(substr(strtolower($smarty->translate[$week_day_ind]),1,1));
            $this->Cell($date_col_w, $col_h, html_entity_decode(utf8_decode($day_in_month . " " . $filtered_week_day)), 1, 0, 'C', TRUE);

            foreach ($this->sub_keys_normal as $entries1) {
                $current_column_number++;
                if ($this->rpt_content_normal[$day_in_month][$entries1]) {
                        $value = $this->rpt_content_normal[$day_in_month][$entries1];
                        $sum_hour += $value;
                        $sum_hour_ord += $value;
                }
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    if ($this->rpt_content_normal[$day_in_month][$entries1])
                        $this->Cell($rw, $col_h, round($value, 2), 1, 0, 'C', FALSE);
                    else
                        $this->Cell($rw, $col_h, '', 1, 0, 'C', FALSE);
                }
            }

            foreach ($this->sub_keys_travel as $entries1) {
                $current_column_number++;
                if ($this->rpt_content_travel[$day_in_month][$entries1]) {
                        $value = $this->rpt_content_travel[$day_in_month][$entries1];
                        $sum_hour += $value;
                        $sum_hour_ord += $value;
                }
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    if ($this->rpt_content_travel[$day_in_month][$entries1]) {
                        $this->Cell($rw, $col_h, round($value, 2), 1, 0, 'C', FALSE);
                    } else {
                        $this->Cell($rw, $col_h, '', 1, 0, 'C', FALSE);
                    }
                }
            }

            foreach ($this->sub_keys_break as $entries1) {
                $current_column_number++;
                if ($this->rpt_content_break[$day_in_month][$entries1]) {
                        $value = $this->rpt_content_break[$day_in_month][$entries1];
                        $sum_hour += $value;
                        $sum_hour_ord += $value;
                }
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    if ($this->rpt_content_break[$day_in_month][$entries1]) {
                        $this->Cell($rw, $col_h, round($value, 2), 1, 0, 'C', FALSE);
                    } else {
                        $this->Cell($rw, $col_h, '', 1, 0, 'C', FALSE);
                    }
                }
            }

            foreach ($this->sub_keys_over as $entries1) {
                $current_column_number++;
                if ($this->rpt_content_over[$day_in_month][$entries1]) {
                    $value = $this->rpt_content_over[$day_in_month][$entries1];
                    $sum_hour += $value;
                    $sum_hour_ord += $value;
                }
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    if ($this->rpt_content_over[$day_in_month][$entries1]) {
                        $this->Cell($rw, $col_h, round($value, 2), 1, 0, 'C', FALSE);
                    } else {
                        $this->Cell($rw, $col_h, '', 1, 0, 'C', FALSE);
                    }
                }
            }

            foreach ($this->sub_keys_quality as $entries1) {
                $current_column_number++;
                if ($this->rpt_content_quality[$day_in_month][$entries1]) {
                    $value = $this->rpt_content_quality[$day_in_month][$entries1];
                    $sum_hour += $value;
                    $sum_hour_ord += $value;
                }
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    if ($this->rpt_content_quality[$day_in_month][$entries1]) {
                        $this->Cell($rw, $col_h, round($value, 2), 1, 0, 'C', FALSE);
                    } else {
                        $this->Cell($rw, $col_h, '', 1, 0, 'C', FALSE);
                    }
                }
            }

            foreach ($this->sub_keys_more as $entries1) {
                $current_column_number++;
                if ($this->rpt_content_more[$day_in_month][$entries1]) {
                    $value = $this->rpt_content_more[$day_in_month][$entries1];
                    $sum_hour += $value;
                    $sum_hour_ord += $value;
                }
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    if ($this->rpt_content_more[$day_in_month][$entries1]) {
                        $this->Cell($rw, $col_h, round($value, 2), 1, 0, 'C', FALSE);
                    } else {
                        $this->Cell($rw, $col_h, '', 1, 0, 'C', FALSE);
                    }
                }
            }

            foreach ($this->sub_keys_some as $entries1) {
                $current_column_number++;
                if ($this->rpt_content_some[$day_in_month][$entries1]) {
                    $value = $this->rpt_content_some[$day_in_month][$entries1];
                    $sum_hour += $value;
                    $sum_hour_ord += $value;
                }
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    if ($this->rpt_content_some[$day_in_month][$entries1]) {
                        $this->Cell($rw, $col_h, round($value, 2), 1, 0, 'C', FALSE);
                    } else {
                        $this->Cell($rw, $col_h, '', 1, 0, 'C', FALSE);
                    }
                }
            }

            foreach ($this->sub_keys_training as $entries1) {
                $current_column_number++;
                if ($this->rpt_content_training[$day_in_month][$entries1]) {
                    $value = $this->rpt_content_training[$day_in_month][$entries1];
                    $sum_hour += $value;
                    $sum_hour_ord += $value;
                }
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    if ($this->rpt_content_training[$day_in_month][$entries1]) {
                        $this->Cell($rw, $col_h, round($value, 2), 1, 0, 'C', FALSE);
                    } else {
                        $this->Cell($rw, $col_h, '', 1, 0, 'C', FALSE);
                    }
                }
            }

            foreach ($this->sub_keys_voluntary as $entries1) {
                $current_column_number++;
                if ($this->rpt_content_voluntary[$day_in_month][$entries1]) {
                    $value = $this->rpt_content_voluntary[$day_in_month][$entries1];
                    $sum_hour += $value;
                    $sum_hour_ord += $value;
                }
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    if ($this->rpt_content_voluntary[$day_in_month][$entries1]) {
                        $this->Cell($rw, $col_h, round($value, 2), 1, 0, 'C', FALSE);
                    } else {
                        $this->Cell($rw, $col_h, '', 1, 0, 'C', FALSE);
                    }
                }
            }

            foreach ($this->sub_keys_complementary as $entries1) {
                $current_column_number++;
                if ($this->rpt_content_complementary[$day_in_month][$entries1]) {
                    $value = $this->rpt_content_complementary[$day_in_month][$entries1];
                    $sum_hour += $value;
                    $sum_hour_ord += $value;
                }
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    if ($this->rpt_content_complementary[$day_in_month][$entries1]) {
                        $this->Cell($rw, $col_h, round($value, 2), 1, 0, 'C', FALSE);
                    } else {
                        $this->Cell($rw, $col_h, '', 1, 0, 'C', FALSE);
                    }
                }
            }
            
            foreach ($this->sub_keys_standby as $entries1) {
                $current_column_number++;
                if ($this->rpt_content_standby[$day_in_month][$entries1]) {
                    $value = $this->rpt_content_standby[$day_in_month][$entries1];
                    $sum_hour += $value;
                    $sum_hour_ord += $value;
                }
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    if ($this->rpt_content_standby[$day_in_month][$entries1]) {
                        $this->Cell($rw, $col_h, round($value, 2), 1, 0, 'C', FALSE);
                    } else {
                        $this->Cell($rw, $col_h, '', 1, 0, 'C', FALSE);
                    }
                }
            }
            
            foreach ($this->sub_keys_dismissal as $entries1) {
                $current_column_number++;
                if ($this->rpt_content_dismissal[$day_in_month][$entries1]) {
                    $value = $this->rpt_content_dismissal[$day_in_month][$entries1];
                    $sum_hour += $value;
                    $sum_hour_ord += $value;
                }
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    if ($this->rpt_content_dismissal[$day_in_month][$entries1]) {
                        $this->Cell($rw, $col_h, round($value, 2), 1, 0, 'C', FALSE);
                    } else {
                        $this->Cell($rw, $col_h, '', 1, 0, 'C', FALSE);
                    }
                }
            }

            $this->SetFillColor(245, 190, 135);
            if (!empty($this->sub_keys_normal) || !empty($this->sub_keys_travel) || !empty($this->sub_keys_break) || !empty($this->sub_keys_over) || !empty($this->sub_keys_quality) || !empty($this->sub_keys_more) || !empty($this->sub_keys_some) || !empty($this->sub_keys_training) || !empty($this->sub_keys_voluntary) || !empty($this->sub_keys_complementary) || !empty($this->sub_keys_standby) || !empty($this->sub_keys_dismissal)) {
                $current_column_number++;
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    if ($sum_hour_ord)
                        $this->Cell($rw, $col_h, round($sum_hour_ord, 2), 1, 0, 'C', TRUE);
                    else
                        $this->Cell($rw, $col_h, '', 1, 0, 'C', TRUE);
                }
                $sum_sum_hour_ord += $sum_hour_ord;
            }
            
            $this->SetFillColor(255, 255, 255);
            foreach ($this->sub_keys_personal as $entries1) {
                $current_column_number++;
                if ($this->rpt_content_personal[$day_in_month][$entries1]) {
                    $value = $this->rpt_content_personal[$day_in_month][$entries1];
                    $sum_hour += $value;
                    $sum_hour_personal += $value;
                }
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    if ($this->rpt_content_personal[$day_in_month][$entries1]) {
                        $this->Cell($rw, $col_h, round($value, 2), 1, 0, 'C', FALSE);
                    } else {
                        $this->Cell($rw, $col_h, '', 1, 0, 'C', FALSE);
                    }
                }
            }
            
            $this->SetFillColor(245, 190, 135);
            if (!empty($this->sub_keys_personal)) {
                $current_column_number++;
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    if ($sum_hour_personal)
                        $this->Cell($rw, $col_h, round($sum_hour_personal, 2), 1, 0, 'C', TRUE);
                    else
                        $this->Cell($rw, $col_h, '', 1, 0, 'C', TRUE);
                }
                $sum_sum_hour_personal += $sum_hour_personal;
            }
            
            $this->SetFillColor(255, 255, 255);
            foreach ($this->sub_keys_oncall as $entries1) {
                $current_column_number++;
                if ($this->rpt_content_oncall[$day_in_month][$entries1]) {
                    $value = $this->rpt_content_oncall[$day_in_month][$entries1];
                    $sum_hour += $value;
                    $sum_hour_jour += $value;
                }
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    if ($this->rpt_content_oncall[$day_in_month][$entries1]) {
                        $this->Cell($rw, $col_h, round($value, 2), 1, 0, 'C', FALSE);
                    } else {
                        $this->Cell($rw, $col_h, '', 1, 0, 'C', FALSE);
                    }
                }
            }

            foreach ($this->sub_keys_calltraining as $entries1) {
                $current_column_number++;
                if ($this->rpt_content_calltraining[$day_in_month][$entries1]) {
                    $value = $this->rpt_content_calltraining[$day_in_month][$entries1];
                    $sum_hour += $value;
                    $sum_hour_jour += $value;
                }
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    if ($this->rpt_content_calltraining[$day_in_month][$entries1]) {
                        $this->Cell($rw, $col_h, round($value, 2), 1, 0, 'C', FALSE);
                    } else {
                        $this->Cell($rw, $col_h, '', 1, 0, 'C', FALSE);
                    }
                }
            }

            foreach ($this->sub_keys_complementary_oncall as $entries1) {
                $current_column_number++;
                if ($this->rpt_content_complementary_oncall[$day_in_month][$entries1]) {
                    $value = $this->rpt_content_complementary_oncall[$day_in_month][$entries1];
                    $sum_hour += $value;
                    $sum_hour_jour += $value;
                }
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    if ($this->rpt_content_complementary_oncall[$day_in_month][$entries1]) {
                        $this->Cell($rw, $col_h, round($value, 2), 1, 0, 'C', FALSE);
                    } else {
                        $this->Cell($rw, $col_h, '', 1, 0, 'C', FALSE);
                    }
                }
            }
            
            foreach ($this->sub_keys_more_oncall as $entries1) {
                $current_column_number++;
                if ($this->rpt_content_more_oncall[$day_in_month][$entries1]) {
                    $value = $this->rpt_content_more_oncall[$day_in_month][$entries1];
                    $sum_hour += $value;
                    $sum_hour_jour += $value;
                }
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    if ($this->rpt_content_more_oncall[$day_in_month][$entries1]) {
                        $this->Cell($rw, $col_h, round($value, 2), 1, 0, 'C', FALSE);
                    } else {
                        $this->Cell($rw, $col_h, '', 1, 0, 'C', FALSE);
                    }
                }
            }

            foreach ($this->sub_keys_dismissal_oncall as $entries1) {
                $current_column_number++;
                if ($this->rpt_content_dismissal_oncall[$day_in_month][$entries1]) {
                    $value = $this->rpt_content_dismissal_oncall[$day_in_month][$entries1];
                    $sum_hour += $value;
                    $sum_hour_jour += $value;
                }
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    if ($this->rpt_content_dismissal_oncall[$day_in_month][$entries1]) {
                        $this->Cell($rw, $col_h, round($value, 2), 1, 0, 'C', FALSE);
                    } else {
                        $this->Cell($rw, $col_h, '', 1, 0, 'C', FALSE);
                    }
                }
            }

            $this->SetFillColor(245, 190, 135);
            if (!empty($this->sub_keys_oncall) || !empty($this->sub_keys_calltraining) || !empty($this->sub_keys_complementary_oncall) || !empty($this->sub_keys_more_oncall) || !empty($this->sub_keys_dismissal_oncall)) {
                $current_column_number++;
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    if ($sum_hour_jour)
                        $this->Cell($rw, $col_h, round($sum_hour_jour, 2), 1, 0, 'C', TRUE);
                    else
                        $this->Cell($rw, $col_h, '', 1, 0, 'C', TRUE);
                }
                $sum_sum_hour_jour += $sum_hour_jour;
            }

            if (!empty($this->sub_keys_normal) || !empty($this->sub_keys_travel) || !empty($this->sub_keys_break) || !empty($this->sub_keys_over) || !empty($this->sub_keys_quality) || !empty($this->sub_keys_more) || !empty($this->sub_keys_some) || !empty($this->sub_keys_training) || !empty($this->sub_keys_personal) || !empty($this->sub_keys_voluntary) || !empty($this->sub_keys_complementary) || !empty($this->sub_keys_standby) || !empty($this->sub_keys_dismissal) || !empty($this->sub_keys_oncall) || !empty($this->sub_keys_calltraining) || !empty($this->sub_keys_complementary_oncall)  || !empty($this->sub_keys_more_oncall) || !empty($this->sub_keys_dismissal_oncall)) {
                $current_column_number++;
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    if ($sum_hour) {
                        $this->Cell($rw, $col_h, round($sum_hour, 2), 1, 0, 'C', FALSE);
                    } else {
                        $this->Cell($rw, $col_h, '', 1, 0, 'C', FALSE);
                    }
                }
                $sum_sum_hour += $sum_hour;
            }

            $this->SetFillColor(249, 221, 221);
            foreach ($this->sub_keys_leave_normal_head as $entries3) {
                foreach ($entries3 as $entries2 => $entries1) {
                    $current_column_number++;
                    if ($this->rpt_content_leave[$day_in_month][$entries2][$entries1]) {
                        $value = $this->rpt_content_leave[$day_in_month][$entries2][$entries1];
                        $sum_hour_leave += $value;
                    }
                    if ($current_column_number >= $start && $current_column_number <= $end) {
                        if ($this->rpt_content_leave[$day_in_month][$entries2][$entries1]) {
                            $this->Cell($rw, $col_h, round($value, 2), 1, 0, 'C', TRUE);
                        } else {
                            $this->Cell($rw, $col_h, '', 1, 0, 'C', TRUE);
                        }
                    }
                }
            }
            
            foreach ($this->sub_keys_leave_travel_head as $entries3) {
                foreach ($entries3 as $entries2 => $entries1) {
                    $current_column_number++;
                    if ($this->rpt_content_leave_travel[$day_in_month][$entries2][$entries1]) {
                        $value = $this->rpt_content_leave_travel[$day_in_month][$entries2][$entries1];
                        $sum_hour_leave += $value;
                    }
                    if ($current_column_number >= $start && $current_column_number <= $end) {
                        if ($this->rpt_content_leave_travel[$day_in_month][$entries2][$entries1]) {
                            $this->Cell($rw, $col_h, round($value, 2), 1, 0, 'C', TRUE);
                        } else {
                            $this->Cell($rw, $col_h, '', 1, 0, 'C', TRUE);
                        }
                    }
                }
            }
            
            foreach ($this->sub_keys_leave_break_head as $entries3) {
                foreach ($entries3 as $entries2 => $entries1) {
                    $current_column_number++;
                    if ($this->rpt_content_leave_break[$day_in_month][$entries2][$entries1]) {
                        $value = $this->rpt_content_leave_break[$day_in_month][$entries2][$entries1];
                        $sum_hour_leave += $value;
                    }
                    if ($current_column_number >= $start && $current_column_number <= $end) {
                        if ($this->rpt_content_leave_break[$day_in_month][$entries2][$entries1]) {
                            $this->Cell($rw, $col_h, round($value, 2), 1, 0, 'C', TRUE);
                        } else {
                            $this->Cell($rw, $col_h, '', 1, 0, 'C', TRUE);
                        }
                    }
                }
            }

            foreach ($this->sub_keys_leave_over_head as $entries3) {
                foreach ($entries3 as $entries2 => $entries1) {
                    $current_column_number++;
                    if ($this->rpt_content_leave_over[$day_in_month][$entries2][$entries1]) {
                        $value = $this->rpt_content_leave_over[$day_in_month][$entries2][$entries1];
                        $sum_hour_leave += $value;
                    }
                    if ($current_column_number >= $start && $current_column_number <= $end) {
                        if ($this->rpt_content_leave_over[$day_in_month][$entries2][$entries1]) {
                            $this->Cell($rw, $col_h, round($value, 2), 1, 0, 'C', TRUE);
                        } else {
                            $this->Cell($rw, $col_h, '', 1, 0, 'C', TRUE);
                        }
                    }
                }
            }

            foreach ($this->sub_keys_leave_quality_head as $entries3) {
                foreach ($entries3 as $entries2 => $entries1) {
                    $current_column_number++;
                    if ($this->rpt_content_leave_quality[$day_in_month][$entries2][$entries1]) {
                        $value = $this->rpt_content_leave_quality[$day_in_month][$entries2][$entries1];
                        $sum_hour_leave += $value;
                    }
                    if ($current_column_number >= $start && $current_column_number <= $end) {
                        if ($this->rpt_content_leave_quality[$day_in_month][$entries2][$entries1]) {
                            $this->Cell($rw, $col_h, round($value, 2), 1, 0, 'C', TRUE);
                        } else {
                            $this->Cell($rw, $col_h, '', 1, 0, 'C', TRUE);
                        }
                    }
                }
            }

            foreach ($this->sub_keys_leave_more_head as $entries3) {
                foreach ($entries3 as $entries2 => $entries1) {
                    $current_column_number++;
                    if ($this->rpt_content_leave_more[$day_in_month][$entries2][$entries1]) {
                        $value = $this->rpt_content_leave_more[$day_in_month][$entries2][$entries1];
                        $sum_hour_leave += $value;
                    }
                    if ($current_column_number >= $start && $current_column_number <= $end) {
                        if ($this->rpt_content_leave_more[$day_in_month][$entries2][$entries1]) {
                            $this->Cell($rw, $col_h, round($value, 2), 1, 0, 'C', TRUE);
                        } else {
                            $this->Cell($rw, $col_h, '', 1, 0, 'C', TRUE);
                        }
                    }
                }
            }

            foreach ($this->sub_keys_leave_some_head as $entries3) {
                foreach ($entries3 as $entries2 => $entries1) {
                    $current_column_number++;
                    if ($this->rpt_content_leave_some[$day_in_month][$entries2][$entries1]) {
                        $value = $this->rpt_content_leave_some[$day_in_month][$entries2][$entries1];
                        $sum_hour_leave += $value;
                    }
                    if ($current_column_number >= $start && $current_column_number <= $end) {
                        if ($this->rpt_content_leave_some[$day_in_month][$entries2][$entries1]) {
                            $this->Cell($rw, $col_h, round($value, 2), 1, 0, 'C', TRUE);
                        } else {
                            $this->Cell($rw, $col_h, '', 1, 0, 'C', TRUE);
                        }
                    }
                }
            }

            foreach ($this->sub_keys_leave_training_head as $entries3) {
                foreach ($entries3 as $entries2 => $entries1) {
                    $current_column_number++;
                    if ($this->rpt_content_leave_training[$day_in_month][$entries2][$entries1]) {
                        $value = $this->rpt_content_leave_training[$day_in_month][$entries2][$entries1];
                        $sum_hour_leave += $value;
                    }
                    if ($current_column_number >= $start && $current_column_number <= $end) {
                        if ($this->rpt_content_leave_training[$day_in_month][$entries2][$entries1]) {
                            $this->Cell($rw, $col_h, round($value, 2), 1, 0, 'C', TRUE);
                        } else {
                            $this->Cell($rw, $col_h, '', 1, 0, 'C', TRUE);
                        }
                    }
                }
            }

            foreach ($this->sub_keys_leave_personal_head as $entries3) {
                foreach ($entries3 as $entries2 => $entries1) {
                    $current_column_number++;
                    if ($this->rpt_content_leave_personal[$day_in_month][$entries2][$entries1]) {
                        $value = $this->rpt_content_leave_personal[$day_in_month][$entries2][$entries1];
                        $sum_hour_leave += $value;
                    }
                    if ($current_column_number >= $start && $current_column_number <= $end) {
                        if ($this->rpt_content_leave_personal[$day_in_month][$entries2][$entries1]) {
                            $this->Cell($rw, $col_h, round($value, 2), 1, 0, 'C', TRUE);
                        } else {
                            $this->Cell($rw, $col_h, '', 1, 0, 'C', TRUE);
                        }
                    }
                }
            }

            foreach ($this->sub_keys_leave_voluntary_head as $entries3) {
                foreach ($entries3 as $entries2 => $entries1) {
                    $current_column_number++;
                    if ($this->rpt_content_leave_voluntary[$day_in_month][$entries2][$entries1]) {
                        $value = $this->rpt_content_leave_voluntary[$day_in_month][$entries2][$entries1];
                        $sum_hour_leave += $value;
                    }
                    if ($current_column_number >= $start && $current_column_number <= $end) {
                        if ($this->rpt_content_leave_voluntary[$day_in_month][$entries2][$entries1]) {
                            $this->Cell($rw, $col_h, round($value, 2), 1, 0, 'C', TRUE);
                        } else {
                            $this->Cell($rw, $col_h, '', 1, 0, 'C', TRUE);
                        }
                    }
                }
            }
            
            foreach ($this->sub_keys_leave_standby_head as $entries3) {
                foreach ($entries3 as $entries2 => $entries1) {
                    $current_column_number++;
                    if ($this->rpt_content_leave_standby[$day_in_month][$entries2][$entries1]) {
                        $value = $this->rpt_content_leave_standby[$day_in_month][$entries2][$entries1];
                        $sum_hour_leave += $value;
                    }
                    if ($current_column_number >= $start && $current_column_number <= $end) {
                        if ($this->rpt_content_leave_standby[$day_in_month][$entries2][$entries1]) {
                            $this->Cell($rw, $col_h, round($value, 2), 1, 0, 'C', TRUE);
                        } else {
                            $this->Cell($rw, $col_h, '', 1, 0, 'C', TRUE);
                        }
                    }
                }
            }

            $this->SetFillColor(245, 190, 135);
            if (!empty($this->sub_keys_leave_normal_head) || !empty($this->sub_keys_leave_travel_head) || !empty($this->sub_keys_leave_break_head) || !empty($this->sub_keys_leave_over_head) || !empty($this->sub_keys_leave_quality_head) || !empty($this->sub_keys_leave_more_head) || !empty($this->sub_keys_leave_some_head) || !empty($this->sub_keys_leave_training_head) || !empty($this->sub_keys_leave_personal_head) || !empty($this->sub_keys_leave_voluntary_head) || !empty($this->sub_keys_leave_standby_head)) {
                $current_column_number++;
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    if ($sum_hour_leave)
                        $this->Cell($rw, $col_h, round($sum_hour_leave, 2), 1, 0, 'C', TRUE);
                    else
                        $this->Cell($rw, $col_h, '', 1, 0, 'C', TRUE);
                }
            }

            $sum_sum_hour_leave += $sum_hour_leave;

            $this->SetFillColor(249, 221, 221);
            foreach ($this->sub_keys_leave_oncall_head as $entries3) {
                foreach ($entries3 as $entries2 => $entries1) {
                    $current_column_number++;
                    if ($this->rpt_content_leave_oncall[$day_in_month][$entries2][$entries1]) {
                        $value = $this->rpt_content_leave_oncall[$day_in_month][$entries2][$entries1];
                        $sum_hour_leave_oncall += $value;
                    }
                    if ($current_column_number >= $start && $current_column_number <= $end) {
                        if ($this->rpt_content_leave_oncall[$day_in_month][$entries2][$entries1]) {
                            $this->Cell($rw, $col_h, round($value, 2), 1, 0, 'C', TRUE);
                        } else {
                            $this->Cell($rw, $col_h, '', 1, 0, 'C', TRUE);
                        }
                    }
                }
            }

            foreach ($this->sub_keys_leave_calltraining_head as $entries3) {
                foreach ($entries3 as $entries2 => $entries1) {
                    $current_column_number++;
                    if ($this->rpt_content_leave_calltraining[$day_in_month][$entries2][$entries1]) {
                        $value = $this->rpt_content_leave_calltraining[$day_in_month][$entries2][$entries1];
                        $sum_hour_leave_oncall += $value;
                    }
                    if ($current_column_number >= $start && $current_column_number <= $end) {
                        if ($this->rpt_content_leave_calltraining[$day_in_month][$entries2][$entries1]) {
                            $this->Cell($rw, $col_h, round($value, 2), 1, 0, 'C', TRUE);
                        } else {
                            $this->Cell($rw, $col_h, '', 1, 0, 'C', TRUE);
                        }
                    }
                }
            }
            
            foreach ($this->sub_keys_leave_more_oncall_head as $entries3) {
                foreach ($entries3 as $entries2 => $entries1) {
                    $current_column_number++;
                    if ($this->rpt_content_leave_more_oncall[$day_in_month][$entries2][$entries1]) {
                        $value = $this->rpt_content_leave_more_oncall[$day_in_month][$entries2][$entries1];
                        $sum_hour_leave_oncall += $value;
                    }
                    if ($current_column_number >= $start && $current_column_number <= $end) {
                        if ($this->rpt_content_leave_more_oncall[$day_in_month][$entries2][$entries1]) {
                            $this->Cell($rw, $col_h, round($value, 2), 1, 0, 'C', TRUE);
                        } else {
                            $this->Cell($rw, $col_h, '', 1, 0, 'C', TRUE);
                        }
                    }
                }
            }

            $this->SetFillColor(245, 190, 135);
            if (!empty($this->sub_keys_leave_oncall_head) || !empty($this->sub_keys_leave_calltraining_head) || !empty($this->sub_keys_leave_more_oncall_head)) {
                $current_column_number++;
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    if ($sum_hour_leave_oncall)
                        $this->Cell($rw, $col_h, round($sum_hour_leave_oncall, 2), 1, 0, 'C', TRUE);
                    else
                        $this->Cell($rw, $col_h, '', 1, 0, 'C', TRUE);
                }
            }



            $this->SetFillColor(249, 221, 221);
            if (!empty($this->sub_keys_leave_normal_head) || !empty($this->sub_keys_leave_travel_head) || !empty($this->sub_keys_leave_break_head) || !empty($this->sub_keys_leave_over_head) || !empty($this->sub_keys_leave_quality_head) || !empty($this->sub_keys_leave_more_head) || !empty($this->sub_keys_leave_some_head) || !empty($this->sub_keys_leave_training_head) || !empty($this->sub_keys_leave_personal_head) || !empty($this->sub_keys_leave_voluntary_head) || !empty($this->sub_keys_leave_standby_head) || !empty($this->sub_keys_leave_oncall_head) || !empty($this->sub_keys_leave_more_oncall_head)) {
                $current_column_number++;
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    if ($sum_hour_leave || $sum_hour_leave_oncall)
                        $this->Cell($rw, $col_h, round($sum_hour_leave + $sum_hour_leave_oncall, 2), 1, 0, 'C', TRUE);
                    else
                        $this->Cell($rw, $col_h, '', 1, 0, 'C', TRUE);
                }
            }

            $sum_sum_hour_leave_oncall += $sum_hour_leave_oncall;

            $this->Ln();
            $this->SetX(18);
        }


        $this->SetFont('Arial', 'B', 12);
        ////////////////////////////////////////////////grand totals/////////////////////////////////////////////////

        $current_column_number = 0;
        $this->SetFillColor(255, 255, 255);
        $this->Cell($date_col_w, $col_h, html_entity_decode(utf8_decode($this->smarty->translate['sum'])), 1, 0, 'C', TRUE);

        foreach ($this->sum_normal as $entries1) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $this->Cell($rw, $col_h, round($entries1, 2), 1, 0, 'C', FALSE);
            }
        }

        foreach ($this->sum_travel as $entries1) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $this->Cell($rw, $col_h, round($entries1, 2), 1, 0, 'C', FALSE);
            }
        }

        foreach ($this->sum_break as $entries1) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $this->Cell($rw, $col_h, round($entries1, 2), 1, 0, 'C', FALSE);
            }
        }

        foreach ($this->sum_over as $entries1) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $this->Cell($rw, $col_h, round($entries1, 2), 1, 0, 'C', FALSE);
            }
        }

        foreach ($this->sum_quality as $entries1) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $this->Cell($rw, $col_h, round($entries1, 2), 1, 0, 'C', FALSE);
            }
        }

        foreach ($this->sum_more as $entries1) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $this->Cell($rw, $col_h, round($entries1, 2), 1, 0, 'C', FALSE);
            }
        }

        foreach ($this->sum_some as $entries1) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $this->Cell($rw, $col_h, round($entries1, 2), 1, 0, 'C', FALSE);
            }
        }

        foreach ($this->sum_training as $entries1) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $this->Cell($rw, $col_h, round($entries1, 2), 1, 0, 'C', FALSE);
            }
        }

        foreach ($this->sum_voluntary as $entries1) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $this->Cell($rw, $col_h, round($entries1, 2), 1, 0, 'C', FALSE);
            }
        }

        foreach ($this->sum_complementary as $entries1) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $this->Cell($rw, $col_h, round($entries1, 2), 1, 0, 'C', FALSE);
            }
        }
        
        foreach ($this->sum_standby as $entries1) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $this->Cell($rw, $col_h, round($entries1, 2), 1, 0, 'C', FALSE);
            }
        }
        
        foreach ($this->sum_dismissal as $entries1) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $this->Cell($rw, $col_h, round($entries1, 2), 1, 0, 'C', FALSE);
            }
        }

        $this->SetFillColor(245, 190, 135);
        if (!empty($this->sub_keys_normal) || !empty($this->sub_keys_travel) || !empty($this->sub_keys_break) || !empty($this->sub_keys_over) || !empty($this->sub_keys_quality) || !empty($this->sub_keys_more) || !empty($this->sub_keys_some) || !empty($this->sub_keys_training) || !empty($this->sub_keys_voluntary) || !empty($this->sub_keys_complementary) || !empty($this->sub_keys_standby) || !empty($this->sub_keys_dismissal)) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $this->Cell($rw, $col_h, round($sum_sum_hour_ord, 2), 1, 0, 'C', TRUE);
            }
        }
        
        $this->SetFillColor(255, 255, 255);
        foreach ($this->sum_personal as $entries1) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $this->Cell($rw, $col_h, round($entries1, 2), 1, 0, 'C', FALSE);
            }
        }
        
        $this->SetFillColor(245, 190, 135);
        if (!empty($this->sub_keys_personal)) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $this->Cell($rw, $col_h, round($sum_sum_hour_personal, 2), 1, 0, 'C', TRUE);
            }
        }
        
        $this->SetFillColor(255, 255, 255);
        foreach ($this->sum_oncall as $entries1) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $this->Cell($rw, $col_h, round($entries1, 2), 1, 0, 'C', FALSE);
            }
        }
        
        foreach ($this->sum_calltraining as $entries1) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $this->Cell($rw, $col_h, round($entries1, 2), 1, 0, 'C', FALSE);
            }
        }
        
        foreach ($this->sum_complementary_oncall as $entries1) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $this->Cell($rw, $col_h, round($entries1, 2), 1, 0, 'C', FALSE);
            }
        }
        
        foreach ($this->sum_more_oncall as $entries1) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $this->Cell($rw, $col_h, round($entries1, 2), 1, 0, 'C', FALSE);
            }
        }

        foreach ($this->sum_dismissal_oncall as $entries1) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $this->Cell($rw, $col_h, round($entries1, 2), 1, 0, 'C', FALSE);
            }
        }

        $this->SetFillColor(245, 190, 135);
        if (!empty($this->sub_keys_oncall) || !empty($this->sub_keys_calltraining) || !empty($this->sub_keys_complementary_oncall) || !empty($this->sub_keys_more_oncall) || !empty($this->sub_keys_dismissal_oncall)) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $this->Cell($rw, $col_h, round($sum_sum_hour_jour, 2), 1, 0, 'C', TRUE);
            }
        }

        if (!empty($this->sub_keys_normal) || !empty($this->sub_keys_travel) || !empty($this->sub_keys_break) || !empty($this->sub_keys_over) || !empty($this->sub_keys_quality) || !empty($this->sub_keys_more) || !empty($this->sub_keys_some) || !empty($this->sub_keys_training) || !empty($this->sub_keys_personal) || !empty($this->sub_keys_voluntary) || !empty($this->sub_keys_complementary) || !empty($this->sub_keys_standby) || !empty($this->sub_keys_dismissal) || !empty($this->sub_keys_oncall) || !empty($this->sub_keys_calltraining) || !empty($this->sub_keys_complementary_oncall) || !empty($this->sub_keys_more_oncall) || !empty($this->sub_keys_dismissal_oncall)) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $this->Cell($rw, $col_h, round($sum_sum_hour, 2), 1, 0, 'C', FALSE);
            }
        }

        $this->SetFillColor(249, 221, 221);
        foreach ($this->sub_keys_leave_normal_head as $entries3) {
            foreach ($entries3 as $entries2 => $entries1) {
                $current_column_number++;
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    $this->Cell($rw, $col_h, round($this->sum_leave_normal_inconv[$entries2][$entries1], 2), 1, 0, 'C', TRUE);
                }
            }
        }
        
        foreach ($this->sub_keys_leave_travel_head as $entries3) {
            foreach ($entries3 as $entries2 => $entries1) {
                $current_column_number++;
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    $this->Cell($rw, $col_h, round($this->sum_leave_travel_inconv[$entries2][$entries1], 2), 1, 0, 'C', TRUE);
                }
            }
        }
        
        foreach ($this->sub_keys_leave_break_head as $entries3) {
            foreach ($entries3 as $entries2 => $entries1) {
                $current_column_number++;
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    $this->Cell($rw, $col_h, round($this->sum_leave_break_inconv[$entries2][$entries1], 2), 1, 0, 'C', TRUE);
                }
            }
        }

        foreach ($this->sub_keys_leave_over_head as $entries3) {
            foreach ($entries3 as $entries2 => $entries1) {
                $current_column_number++;
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    $this->Cell($rw, $col_h, round($this->sum_leave_over_inconv[$entries2][$entries1], 2), 1, 0, 'C', TRUE);
                }
            }
        }

        foreach ($this->sub_keys_leave_quality_head as $entries3) {
            foreach ($entries3 as $entries2 => $entries1) {
                $current_column_number++;
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    $this->Cell($rw, $col_h, round($this->sum_leave_quality_inconv[$entries2][$entries1], 2), 1, 0, 'C', TRUE);
                }
            }
        }

        foreach ($this->sub_keys_leave_more_head as $entries3) {
            foreach ($entries3 as $entries2 => $entries1) {
                $current_column_number++;
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    $this->Cell($rw, $col_h, round($this->sum_leave_more_inconv[$entries2][$entries1], 2), 1, 0, 'C', TRUE);
                }
            }
        }

        foreach ($this->sub_keys_leave_some_head as $entries3) {
            foreach ($entries3 as $entries2 => $entries1) {
                $current_column_number++;
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    $this->Cell($rw, $col_h, round($this->sum_leave_some_inconv[$entries2][$entries1], 2), 1, 0, 'C', TRUE);
                }
            }
        }

        foreach ($this->sub_keys_leave_training_head as $entries3) {
            foreach ($entries3 as $entries2 => $entries1) {
                $current_column_number++;
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    $this->Cell($rw, $col_h, round($this->sum_leave_training_inconv[$entries2][$entries1], 2), 1, 0, 'C', TRUE);
                }
            }
        }

        foreach ($this->sub_keys_leave_personal_head as $entries3) {
            foreach ($entries3 as $entries2 => $entries1) {
                $current_column_number++;
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    $this->Cell($rw, $col_h, round($this->sum_leave_personal_inconv[$entries2][$entries1], 2), 1, 0, 'C', TRUE);
                }
            }
        }

        foreach ($this->sub_keys_leave_voluntary_head as $entries3) {
            foreach ($entries3 as $entries2 => $entries1) {
                $current_column_number++;
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    $this->Cell($rw, $col_h, round($this->sum_leave_voluntary_inconv[$entries2][$entries1], 2), 1, 0, 'C', TRUE);
                }
            }
        }
        
        foreach ($this->sub_keys_leave_standby_head as $entries3) {
            foreach ($entries3 as $entries2 => $entries1) {
                $current_column_number++;
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    $this->Cell($rw, $col_h, round($this->sum_leave_standby_inconv[$entries2][$entries1], 2), 1, 0, 'C', TRUE);
                }
            }
        }

        $this->SetFillColor(245, 190, 135);
        if (!empty($this->sub_keys_leave_normal_head) || !empty($this->sub_keys_leave_travel_head) || !empty($this->sub_keys_leave_break_head) || !empty($this->sub_keys_leave_over_head) || !empty($this->sub_keys_leave_quality_head) || !empty($this->sub_keys_leave_more_head) || !empty($this->sub_keys_leave_some_head) || !empty($this->sub_keys_leave_training_head) || !empty($this->sub_keys_leave_personal_head) || !empty($this->sub_keys_leave_voluntary_head) || !empty($this->sub_keys_leave_standby_head)) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $this->Cell($rw, $col_h, round($sum_sum_hour_leave, 2), 1, 0, 'C', TRUE);
            }
        }

        $this->SetFillColor(249, 221, 221);
        foreach ($this->sub_keys_leave_oncall_head as $entries3) {
            foreach ($entries3 as $entries2 => $entries1) {
                $current_column_number++;
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    $this->Cell($rw, $col_h, round($this->sum_leave_oncall_inconv[$entries2][$entries1], 2), 1, 0, 'C', TRUE);
                }
            }
        }

        foreach ($this->sub_keys_leave_calltraining_head as $entries3) {
            foreach ($entries3 as $entries2 => $entries1) {
                $current_column_number++;
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    $this->Cell($rw, $col_h, round($this->sum_leave_calltraining_inconv[$entries2][$entries1], 2), 1, 0, 'C', TRUE);
                }
            }
        }
        
        foreach ($this->sub_keys_leave_more_oncall_head as $entries3) {
            foreach ($entries3 as $entries2 => $entries1) {
                $current_column_number++;
                if ($current_column_number >= $start && $current_column_number <= $end) {
                    $this->Cell($rw, $col_h, round($this->sum_leave_more_oncall_inconv[$entries2][$entries1], 2), 1, 0, 'C', TRUE);
                }
            }
        }

        $this->SetFillColor(245, 190, 135);
        if (!empty($this->sub_keys_leave_oncall_head) || !empty($this->sub_keys_leave_calltraining_head) || !empty($this->sub_keys_leave_more_oncall_head)) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $this->Cell($rw, $col_h, round($sum_sum_hour_leave_oncall, 2), 1, 0, 'C', TRUE);
            }
        }

        $this->SetFillColor(249, 221, 221);
        if (!empty($this->sub_keys_leave_normal_head) || !empty($this->sub_keys_leave_travel_head) || !empty($this->sub_keys_leave_break_head) || !empty($this->sub_keys_leave_over_head) || !empty($this->sub_keys_leave_quality_head) || !empty($this->sub_keys_leave_more_head) || !empty($this->sub_keys_leave_some_head) || !empty($this->sub_keys_leave_training_head) || !empty($this->sub_keys_leave_personal_head) || !empty($this->sub_keys_leave_voluntary_head) || !empty($this->sub_keys_leave_standby_head) || !empty($this->sub_keys_leave_oncall_head) || !empty($this->sub_keys_leave_calltraining_head) || !empty($this->sub_keys_leave_more_oncall_head)) {
            $current_column_number++;
            if ($current_column_number >= $start && $current_column_number <= $end) {
                $this->Cell($rw, $col_h, round($sum_sum_hour_leave + $sum_sum_hour_leave_oncall, 2), 1, 0, 'C', TRUE);
            }
        }
    }

    function Process_contents() {

//        require_once('class/employee.php');
//        $employee = new employee();
        require_once('class/inconvenient.php');
        $obj_inconv = new inconvenient();
        
        $emp = $this->report_employee;
        $yr = $this->report_year;
        $month = $this->report_month;
        $cust = $this->report_customer;

        $obj_inconv->generate_work_report($emp, $month, $yr, $cust);

        $this->sub_keys_leave_normal_head = $obj_inconv->sub_keys_leave_normal_head;
        $this->sub_keys_leave_travel_head = $obj_inconv->sub_keys_leave_travel_head;
        $this->sub_keys_leave_break_head = $obj_inconv->sub_keys_leave_break_head;
        $this->sub_keys_leave_over_head = $obj_inconv->sub_keys_leave_over_head;
        $this->sub_keys_leave_quality_head = $obj_inconv->sub_keys_leave_quality_head;
        $this->sub_keys_leave_more_head = $obj_inconv->sub_keys_leave_more_head;
        $this->sub_keys_leave_some_head = $obj_inconv->sub_keys_leave_some_head;
        $this->sub_keys_leave_training_head = $obj_inconv->sub_keys_leave_training_head;
        $this->sub_keys_leave_personal_head = $obj_inconv->sub_keys_leave_personal_head;
        $this->sub_keys_leave_voluntary_head = $obj_inconv->sub_keys_leave_voluntary_head;
        $this->sub_keys_leave_oncall_head = $obj_inconv->sub_keys_leave_oncall_head;
        $this->sub_keys_leave_calltraining_head = $obj_inconv->sub_keys_leave_calltraining_head;
        $this->sub_keys_leave_more_oncall_head = $obj_inconv->sub_keys_leave_more_oncall_head;
        $this->sub_keys_leave_standby_head = $obj_inconv->sub_keys_leave_standby_head;

        $this->sum_normal = $obj_inconv->sum_normal;
        $this->sum_travel = $obj_inconv->sum_travel;
        $this->sum_break = $obj_inconv->sum_break;
        $this->sum_over = $obj_inconv->sum_over;
        $this->sum_quality = $obj_inconv->sum_quality;
        $this->sum_more = $obj_inconv->sum_more;
        $this->sum_some = $obj_inconv->sum_some;
        $this->sum_training = $obj_inconv->sum_training;
        $this->sum_personal = $obj_inconv->sum_personal;
        $this->sum_voluntary = $obj_inconv->sum_voluntary;
        $this->sum_complementary = $obj_inconv->sum_complementary;
        $this->sum_oncall = $obj_inconv->sum_oncall;
        $this->sum_calltraining = $obj_inconv->sum_calltraining;
        $this->sum_complementary_oncall = $obj_inconv->sum_complementary_oncall;
        $this->sum_more_oncall = $obj_inconv->sum_more_oncall;
        $this->sum_standby = $obj_inconv->sum_standby;
        $this->sum_dismissal = $obj_inconv->sum_dismissal;
        $this->sum_dismissal_oncall = $obj_inconv->sum_dismissal_oncall;

        $this->sum_leave_normal = $obj_inconv->sum_leave_normal;
        $this->sum_leave_normal_inconv = $obj_inconv->sum_leave_normal_inconv;
        $this->sum_leave_travel = $obj_inconv->sum_leave_travel;
        $this->sum_leave_travel_inconv = $obj_inconv->sum_leave_travel_inconv;
        $this->sum_leave_break = $obj_inconv->sum_leave_break;
        $this->sum_leave_break_inconv = $obj_inconv->sum_leave_break_inconv;
        $this->sum_leave_over = $obj_inconv->sum_leave_over;
        $this->sum_leave_over_inconv = $obj_inconv->sum_leave_over_inconv;
        $this->sum_leave_quality = $obj_inconv->sum_leave_quality;
        $this->sum_leave_quality_inconv = $obj_inconv->sum_leave_quality_inconv;
        $this->sum_leave_more = $obj_inconv->sum_leave_more;
        $this->sum_leave_more_inconv = $obj_inconv->sum_leave_more_inconv;
        $this->sum_leave_some = $obj_inconv->sum_leave_some;
        $this->sum_leave_some_inconv = $obj_inconv->sum_leave_some_inconv;
        $this->sum_leave_training = $obj_inconv->sum_leave_training;
        $this->sum_leave_training_inconv = $obj_inconv->sum_leave_training_inconv;
        $this->sum_leave_personal = $obj_inconv->sum_leave_personal;
        $this->sum_leave_personal_inconv = $obj_inconv->sum_leave_personal_inconv;
        $this->sum_leave_voluntary = $obj_inconv->sum_leave_voluntary;
        $this->sum_leave_voluntary_inconv = $obj_inconv->sum_leave_voluntary_inconv;
        $this->sum_leave_oncall = $obj_inconv->sum_leave_oncall;
        $this->sum_leave_oncall_inconv = $obj_inconv->sum_leave_oncall_inconv;
        $this->sum_leave_calltraining = $obj_inconv->sum_leave_calltraining;
        $this->sum_leave_calltraining_inconv = $obj_inconv->sum_leave_calltraining_inconv;
        $this->sum_leave_more_oncall = $obj_inconv->sum_leave_more_oncall;
        $this->sum_leave_more_oncall_inconv = $obj_inconv->sum_leave_more_oncall_inconv;
        $this->sum_leave_standby = $obj_inconv->sum_leave_standby;
        $this->sum_leave_standby_inconv = $obj_inconv->sum_leave_standby_inconv;
//$this->sum_leave = $sum_leave;

        $this->days_in_month = $obj_inconv->days_in_month;

        $this->sub_keys_normal = $obj_inconv->sub_keys_normal;
        $this->sub_keys_travel = $obj_inconv->sub_keys_travel;
        $this->sub_keys_break = $obj_inconv->sub_keys_break;
        $this->sub_keys_over = $obj_inconv->sub_keys_over;
        $this->sub_keys_quality = $obj_inconv->sub_keys_quality;
        $this->sub_keys_more = $obj_inconv->sub_keys_more;
        $this->sub_keys_some = $obj_inconv->sub_keys_some;
        $this->sub_keys_training = $obj_inconv->sub_keys_training;
        $this->sub_keys_personal = $obj_inconv->sub_keys_personal;
        $this->sub_keys_voluntary = $obj_inconv->sub_keys_voluntary;
        $this->sub_keys_complementary = $obj_inconv->sub_keys_complementary;
        $this->sub_keys_oncall = $obj_inconv->sub_keys_oncall;
        $this->sub_keys_calltraining = $obj_inconv->sub_keys_calltraining;
        $this->sub_keys_complementary_oncall = $obj_inconv->sub_keys_complementary_oncall;
        $this->sub_keys_more_oncall = $obj_inconv->sub_keys_more_oncall;
        $this->sub_keys_standby = $obj_inconv->sub_keys_standby;
        $this->sub_keys_dismissal = $obj_inconv->sub_keys_dismissal;
        $this->sub_keys_dismissal_oncall = $obj_inconv->sub_keys_dismissal_oncall;
        
        $this->sub_keys_leave_normal = $obj_inconv->sub_keys_leave_normal;
        $this->sub_keys_leave_normal_inconv = $obj_inconv->sub_keys_leave_normal_inconv;
        $this->sub_keys_leave_travel = $obj_inconv->sub_keys_leave_travel;
        $this->sub_keys_leave_travel_inconv = $obj_inconv->sub_keys_leave_travel_inconv;
        $this->sub_keys_leave_break = $obj_inconv->sub_keys_leave_break;
        $this->sub_keys_leave_break_inconv = $obj_inconv->sub_keys_leave_break_inconv;
        $this->sub_keys_leave_over = $obj_inconv->sub_keys_leave_over;
        $this->sub_keys_leave_over_inconv = $obj_inconv->sub_keys_leave_over_inconv;
        $this->sub_keys_leave_quality = $obj_inconv->sub_keys_leave_quality;
        $this->sub_keys_leave_quality_inconv = $obj_inconv->sub_keys_leave_quality_inconv;
        $this->sub_keys_leave_more = $obj_inconv->sub_keys_leave_more;
        $this->sub_keys_leave_more_inconv = $obj_inconv->sub_keys_leave_more_inconv;
        $this->sub_keys_leave_some = $obj_inconv->sub_keys_leave_some;
        $this->sub_keys_leave_some_inconv = $obj_inconv->sub_keys_leave_some_inconv;
        $this->sub_keys_leave_training = $obj_inconv->sub_keys_leave_training;
        $this->sub_keys_leave_training_inconv = $obj_inconv->sub_keys_leave_training_inconv;
        $this->sub_keys_leave_personal = $obj_inconv->sub_keys_leave_personal;
        $this->sub_keys_leave_personal_inconv = $obj_inconv->sub_keys_leave_personal_inconv;
        $this->sub_keys_leave_voluntary = $obj_inconv->sub_keys_leave_voluntary;
        $this->sub_keys_leave_voluntary_inconv = $obj_inconv->sub_keys_leave_voluntary_inconv;
        $this->sub_keys_leave_oncall = $obj_inconv->sub_keys_leave_oncall;
        $this->sub_keys_leave_oncall_inconv = $obj_inconv->sub_keys_leave_oncall_inconv;
        $this->sub_keys_leave_calltraining = $obj_inconv->sub_keys_leave_calltraining;
        $this->sub_keys_leave_calltraining_inconv = $obj_inconv->sub_keys_leave_calltraining_inconv;
        $this->sub_keys_leave_more_oncall = $obj_inconv->sub_keys_leave_more_oncall;
        $this->sub_keys_leave_more_oncall_inconv = $obj_inconv->sub_keys_leave_more_oncall_inconv;
        $this->sub_keys_leave_standby = $obj_inconv->sub_keys_leave_standby;
        $this->sub_keys_leave_standby_inconv = $obj_inconv->sub_keys_leave_standby_inconv;

//$this->sub_keys_leave = $sub_keys_leave;


        $this->rpt_content_normal = $obj_inconv->rpt_content_normal;
        $this->rpt_content_travel = $obj_inconv->rpt_content_travel;
        $this->rpt_content_break = $obj_inconv->rpt_content_break;
        $this->rpt_content_over = $obj_inconv->rpt_content_over;
        $this->rpt_content_quality = $obj_inconv->rpt_content_quality;
        $this->rpt_content_more = $obj_inconv->rpt_content_more;
        $this->rpt_content_some = $obj_inconv->rpt_content_some;
        $this->rpt_content_training = $obj_inconv->rpt_content_training;
        $this->rpt_content_personal = $obj_inconv->rpt_content_personal;
        $this->rpt_content_voluntary = $obj_inconv->rpt_content_voluntary;
        $this->rpt_content_complementary = $obj_inconv->rpt_content_complementary;
        $this->rpt_content_oncall = $obj_inconv->rpt_content_oncall;
        $this->rpt_content_calltraining = $obj_inconv->rpt_content_calltraining;
        $this->rpt_content_complementary_oncall = $obj_inconv->rpt_content_complementary_oncall;
        $this->rpt_content_more_oncall = $obj_inconv->rpt_content_more_oncall;
        $this->rpt_content_standby = $obj_inconv->rpt_content_standby;
        $this->rpt_content_dismissal = $obj_inconv->rpt_content_dismissal;
        $this->rpt_content_dismissal_oncall = $obj_inconv->rpt_content_dismissal_oncall;

        $this->rpt_content_leave = $obj_inconv->rpt_content_leave;
        $this->rpt_content_leave_travel = $obj_inconv->rpt_content_leave_travel;
        $this->rpt_content_leave_break = $obj_inconv->rpt_content_leave_break;
        $this->rpt_content_leave_over = $obj_inconv->rpt_content_leave_over;
        $this->rpt_content_leave_quality = $obj_inconv->rpt_content_leave_quality;
        $this->rpt_content_leave_more = $obj_inconv->rpt_content_leave_more;
        $this->rpt_content_leave_some = $obj_inconv->rpt_content_leave_some;
        $this->rpt_content_leave_training = $obj_inconv->rpt_content_leave_training;
        $this->rpt_content_leave_personal = $obj_inconv->rpt_content_leave_personal;
        $this->rpt_content_leave_voluntary = $obj_inconv->rpt_content_leave_voluntary;
        $this->rpt_content_leave_oncall = $obj_inconv->rpt_content_leave_oncall;
        $this->rpt_content_leave_calltraining = $obj_inconv->rpt_content_leave_calltraining;
        $this->rpt_content_leave_more_oncall = $obj_inconv->rpt_content_leave_more_oncall;
        $this->rpt_content_leave_standby = $obj_inconv->rpt_content_leave_standby;
        ////////////////////////////////////////////////////////////////
    }

    function Rotate($angle, $x = -1, $y = -1) {   //created by shamsu
        if ($x == -1)
            $x = $this->x;
        if ($y == -1)
            $y = $this->y;
        if ($this->angle != 0)
            $this->_out('Q');
        $this->angle = $angle;
        if ($angle != 0) {
            $angle*=M_PI / 180;
            $c = cos($angle);
            $s = sin($angle);
            $cx = $x * $this->k;
            $cy = ($this->h - $y) * $this->k;
            $this->_out(sprintf('q %.5f %.5f %.5f %.5f %.2f %.2f cm 1 0 0 1 %.2f %.2f cm', $c, $s, -$s, $c, $cx, $cy, -$cx, -$cy));
        }
    }

    //deprecated
    function redraw_columnheader($new_header_height, $date_col_w, $rw) { // not used
//        $this->Cell($date_col_w, $new_header_height, '', 'TLR', 0, 'C', FALSE);
        $this->Cell($date_col_w, $new_header_height, '', 1, 0, 'C', FALSE);

        foreach ($this->sub_keys_normal as $entries1) {
            $this->Cell($rw, $new_header_height, '', 1, 0, 'C', FALSE);
        }

        foreach ($this->sub_keys_over as $entries1) {
            $this->Cell($rw, $new_header_height, '', 1, 0, 'C', FALSE);
        }

        foreach ($this->sub_keys_quality as $entries1) {
            $this->Cell($rw, $new_header_height, '', 1, 0, 'C', FALSE);
        }

        foreach ($this->sub_keys_more as $entries1) {
            $this->Cell($rw, $new_header_height, '', 1, 0, 'C', FALSE);
        }

        foreach ($this->sub_keys_some as $entries1) {
            $this->Cell($rw, $new_header_height, '', 1, 0, 'C', FALSE);
        }

        foreach ($this->sub_keys_training as $entries1) {
            $this->Cell($rw, $new_header_height, '', 1, 0, 'C', FALSE);
        }

        $this->SetFillColor(245, 190, 135);
        if (!empty($this->sub_keys_normal) || !empty($this->sub_keys_over) || !empty($this->sub_keys_quality) || !empty($this->sub_keys_more) || !empty($this->sub_keys_some) || !empty($this->sub_keys_training)) {
            $this->Cell($rw, $new_header_height, '', 1, 0, 'C', TRUE);
        }

        foreach ($this->sub_keys_oncall as $entries1) {
            $this->Cell($rw, $new_header_height, '', 1, 0, 'C', FALSE);
        }

        $this->SetFillColor(245, 190, 135);
        if (!empty($this->sub_keys_oncall)) {
            $this->Cell($rw, $new_header_height, '', 1, 0, 'C', TRUE);
        }

        $this->Cell($rw, $new_header_height, '', 1, 0, 'C', FALSE);

        $this->SetFillColor(249, 221, 221);
        foreach ($this->sub_keys_leave as $entries1) {
            $this->Cell($rw, $new_header_height, '', 1, 0, 'C', TRUE);
        }

        $this->SetFillColor(249, 221, 221);
        if (!empty($this->sub_keys_leave)) {
            $this->Cell($rw, $new_header_height, '', 1, 0, 'C', TRUE);
        }
    }

    function calc_header_height($date_col_w, $rw) {
        
        $this->SetTextColor(255,255,255);
        global $leave_type;

        $maxlen = 4;
        $tr_lower_y = 60;
        $this->SetXY(18, $this->GetY());
        $header_start_y = $this->GetY();

        $a_x = $this->GetX();
        $a_y = $this->GetY();
        $this->MultiCell($date_col_w, 5, html_entity_decode(utf8_decode($this->smarty->translate['date'])), 0, 'C');
        $this->SetXY($a_x, $a_y);

        foreach ($this->sub_keys_normal as $entries1) {
            $a_x = $this->GetX();
            $a_y = $this->GetY();
            $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($entries1)), 0, 'C');

            $caption_len = strlen($entries1);
            if ($maxlen < $caption_len) {
                $maxlen = $caption_len;
                $tr_lower_y = $this->GetY();
            }
            $this->SetXY($a_x, $a_y);
        }
        
        foreach ($this->sub_keys_travel as $entries1) {
            $a_x = $this->GetX();
            $a_y = $this->GetY();
            $col_heading = ($entries1 == 'travel' ? $this->smarty->translate['travel'] : ($entries1 . ' ' . $this->smarty->translate['travel']));
            $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
            $caption_len = strlen($col_heading);
            if ($maxlen < $caption_len) {
                $maxlen = $caption_len;
                $tr_lower_y = $this->GetY();
            }
            $this->SetXY($a_x, $a_y);
        }
        
        foreach ($this->sub_keys_break as $entries1) {
            $a_x = $this->GetX();
            $a_y = $this->GetY();
            $col_heading = ($entries1 == 'break' ? $this->smarty->translate['break'] : ($entries1 . ' ' . $this->smarty->translate['break']));
            $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
            $caption_len = strlen($col_heading);
            if ($maxlen < $caption_len) {
                $maxlen = $caption_len;
                $tr_lower_y = $this->GetY();
            }
            $this->SetXY($a_x, $a_y);
        }

        foreach ($this->sub_keys_over as $entries1) {
            $a_x = $this->GetX();
            $a_y = $this->GetY();
            $col_heading = ($entries1 == 'overtime' ? $this->smarty->translate['overtime'] : ($entries1 . ' ' . $this->smarty->translate['overtime']));
            $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
            $caption_len = strlen($col_heading);
            if ($maxlen < $caption_len) {
                $maxlen = $caption_len;
                $tr_lower_y = $this->GetY();
            }
            $this->SetXY($a_x, $a_y);
        }

        foreach ($this->sub_keys_quality as $entries1) {
            $a_x = $this->GetX();
            $a_y = $this->GetY();
            $col_heading = ($entries1 == 'qual_overtime' ? $this->smarty->translate['qual_overtime'] : ($entries1 . ' ' . $this->smarty->translate['qual_overtime']));
            $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
            $caption_len = strlen($col_heading);
            if ($maxlen < $caption_len) {
                $maxlen = $caption_len;
                $tr_lower_y = $this->GetY();
            }
            $this->SetXY($a_x, $a_y);
        }

        foreach ($this->sub_keys_more as $entries1) {
            $a_x = $this->GetX();
            $a_y = $this->GetY();
            $col_heading = ($entries1 == 'more_time' ? $this->smarty->translate['more_time'] : ($entries1 . ' ' . $this->smarty->translate['more_time']));
            $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
            $caption_len = strlen($col_heading);
            if ($maxlen < $caption_len) {
                $maxlen = $caption_len;
                $tr_lower_y = $this->GetY();
            }
            $this->SetXY($a_x, $a_y);
        }

        foreach ($this->sub_keys_some as $entries1) {
            $a_x = $this->GetX();
            $a_y = $this->GetY();
            $col_heading = ($entries1 == 'some_other_time' ? $this->smarty->translate['some_other_time'] : ($entries1 . ' ' . $this->smarty->translate['some_other_time']));
            $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
            $caption_len = strlen($col_heading);
            if ($maxlen < $caption_len) {
                $maxlen = $caption_len;
                $tr_lower_y = $this->GetY();
            }
            $this->SetXY($a_x, $a_y);
        }

        foreach ($this->sub_keys_training as $entries1) {
            $a_x = $this->GetX();
            $a_y = $this->GetY();
            $col_heading = ($entries1 == 'training' ? $this->smarty->translate['training_time'] : ($entries1 . ' ' . $this->smarty->translate['training_time']));
            $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
            $caption_len = strlen($col_heading);
            if ($maxlen < $caption_len) {
                $maxlen = $caption_len;
                $tr_lower_y = $this->GetY();
            }
            $this->SetXY($a_x, $a_y);
        }
        
        foreach ($this->sub_keys_voluntary as $entries1) {
            $a_x = $this->GetX();
            $a_y = $this->GetY();
            $col_heading = ($entries1 == 'voluntary' ? $this->smarty->translate['voluntary'] : ($entries1 . ' ' . $this->smarty->translate['voluntary']));
            $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
            $caption_len = strlen($col_heading);
            if ($maxlen < $caption_len) {
                $maxlen = $caption_len;
                $tr_lower_y = $this->GetY();
            }
            $this->SetXY($a_x, $a_y);
        }

        foreach ($this->sub_keys_complementary as $entries1) {
            $a_x = $this->GetX();
            $a_y = $this->GetY();
            $col_heading = ($entries1 == 'complementary' ? $this->smarty->translate['complementary'] : ($entries1 . ' ' . $this->smarty->translate['complementary']));
            $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
            $caption_len = strlen($col_heading);
            if ($maxlen < $caption_len) {
                $maxlen = $caption_len;
                $tr_lower_y = $this->GetY();
            }
            $this->SetXY($a_x, $a_y);
        }

        foreach ($this->sub_keys_standby as $entries1) {
            $a_x = $this->GetX();
            $a_y = $this->GetY();
            $col_heading = ($entries1 == 'standby' ? $this->smarty->translate['standby'] : ($entries1 . ' ' . $this->smarty->translate['standby']));
            $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
            $caption_len = strlen($col_heading);
            if ($maxlen < $caption_len) {
                $maxlen = $caption_len;
                $tr_lower_y = $this->GetY();
            }
            $this->SetXY($a_x, $a_y);
        }

        foreach ($this->sub_keys_dismissal as $entries1) {
            $a_x = $this->GetX();
            $a_y = $this->GetY();
            $col_heading = ($entries1 == 'dismissal' ? $this->smarty->translate['work_for_dismissal'] : ($entries1 . ' ' . $this->smarty->translate['work_for_dismissal']));
            $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
            $caption_len = strlen($col_heading);
            if ($maxlen < $caption_len) {
                $maxlen = $caption_len;
                $tr_lower_y = $this->GetY();
            }
            $this->SetXY($a_x, $a_y);
        }
        
//        $this->SetFillColor(245, 190, 135);
        if (!empty($this->sub_keys_normal) || !empty($this->sub_keys_travel) || !empty($this->sub_keys_break) || !empty($this->sub_keys_over) || !empty($this->sub_keys_quality) || !empty($this->sub_keys_more) || !empty($this->sub_keys_some) || !empty($this->sub_keys_training) || !empty($this->sub_keys_voluntary) || !empty($this->sub_keys_complementary) || !empty($this->sub_keys_standby) || !empty($this->sub_keys_dismissal)) {
            $a_x = $this->GetX();
            $a_y = $this->GetY();
            $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($this->smarty->translate['work_sum_ord'])), 0, 'C');
            $caption_len = strlen($this->smarty->translate['work_sum_ord']);
            if ($maxlen < $caption_len) {
                $maxlen = $caption_len;
                $tr_lower_y = $this->GetY();
            }
            $this->SetXY($a_x, $a_y);
        }
        
        foreach ($this->sub_keys_personal as $entries1) {
            $a_x = $this->GetX();
            $a_y = $this->GetY();
            $col_heading = ($entries1 == 'personal_meeting' ? $this->smarty->translate['personal_meeting'] : ($entries1 . ' ' . $this->smarty->translate['personal_meeting']));
            $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
            $caption_len = strlen($col_heading);
            if ($maxlen < $caption_len) {
                $maxlen = $caption_len;
                $tr_lower_y = $this->GetY();
            }
            $this->SetXY($a_x, $a_y);
        }

//        $this->SetFillColor(245, 190, 135);
        if (!empty($this->sub_keys_personal)) {
            $a_x = $this->GetX();
            $a_y = $this->GetY();
            $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($this->smarty->translate['work_sum_personal'])), 0, 'C');
            $caption_len = strlen($this->smarty->translate['work_sum_personal']);
            if ($maxlen < $caption_len) {
                $maxlen = $caption_len;
                $tr_lower_y = $this->GetY();
            }
            $this->SetXY($a_x, $a_y);
        }
        
        foreach ($this->sub_keys_oncall as $entries1) {
            $a_x = $this->GetX();
            $a_y = $this->GetY();
            $col_heading = '';
            if($entries1 == 'jour') $col_heading = 'Jour';
            else if(stripos(' '.$entries1, 'jour')) $col_heading = $entries1;
            else $col_heading = 'Jour '. $entries1;
            
            $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
            $caption_len = strlen($col_heading);
            if ($maxlen < $caption_len) {
                $maxlen = $caption_len;
                $tr_lower_y = $this->GetY();
            }
            $this->SetXY($a_x, $a_y);
        }

        foreach ($this->sub_keys_calltraining as $entries1) {
            $a_x = $this->GetX();
            $a_y = $this->GetY();
            $col_heading = ($entries1 == 'call_training' ? $this->smarty->translate['call_training'] : ($entries1 . ' ' . $this->smarty->translate['training_time']));
            $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
            $caption_len = strlen($col_heading);
            if ($maxlen < $caption_len) {
                $maxlen = $caption_len;
                $tr_lower_y = $this->GetY();
            }
            $this->SetXY($a_x, $a_y);
        }

        foreach ($this->sub_keys_complementary_oncall as $entries1) {
            $a_x = $this->GetX();
            $a_y = $this->GetY();
            $col_heading = ($entries1 == 'complementary_oncall' ? $this->smarty->translate['complementary_oncall'] : ($entries1 . ' ' . $this->smarty->translate['complementary']));
            $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
            $caption_len = strlen($col_heading);
            if ($maxlen < $caption_len) {
                $maxlen = $caption_len;
                $tr_lower_y = $this->GetY();
            }
            $this->SetXY($a_x, $a_y);
        }
        
        foreach ($this->sub_keys_more_oncall as $entries1) {
            $a_x = $this->GetX();
            $a_y = $this->GetY();
            $col_heading = ($entries1 == 'more_oncall' ? $this->smarty->translate['more_oncall'] : ($entries1 . ' ' . $this->smarty->translate['more_time']));
            $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
            $caption_len = strlen($col_heading);
            if ($maxlen < $caption_len) {
                $maxlen = $caption_len;
                $tr_lower_y = $this->GetY();
            }
            $this->SetXY($a_x, $a_y);
        }
        
//        $this->SetFillColor(245, 190, 135);
        if (!empty($this->sub_keys_oncall) || !empty($this->sub_keys_calltraining) || !empty($this->sub_keys_complementary_oncall) || !empty($this->sub_keys_more_oncall)) {
            $a_x = $this->GetX();
            $a_y = $this->GetY();
            $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($this->smarty->translate['work_sum_jour'])), 0, 'C');
            $caption_len = strlen($this->smarty->translate['work_sum_jour']);
            if ($maxlen < $caption_len) {
                $maxlen = $caption_len;
                $tr_lower_y = $this->GetY();
            }
            $this->SetXY($a_x, $a_y);
        }

        if (!empty($this->sub_keys_normal) || !empty($this->sub_keys_travel) || !empty($this->sub_keys_break) || !empty($this->sub_keys_over) || !empty($this->sub_keys_quality) || !empty($this->sub_keys_more) || !empty($this->sub_keys_some) || !empty($this->sub_keys_training) || !empty($this->sub_keys_personal) || !empty($this->sub_keys_voluntary) || !empty($this->sub_keys_complementary) || !empty($this->sub_keys_standby) || !empty($this->sub_keys_dismissal) || !empty($this->sub_keys_oncall) || !empty($this->sub_keys_calltraining) || !empty($this->sub_keys_complementary_oncall)) {
            $a_x = $this->GetX();
            $a_y = $this->GetY();
            $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($this->smarty->translate['work_sum'])), 0, 'C');
            $caption_len = strlen($this->smarty->translate['work_sum']);
            if ($maxlen < $caption_len) {
                $maxlen = $caption_len;
                $tr_lower_y = $this->GetY();
            }
            $this->SetXY($a_x, $a_y);
        }

//        $this->SetFillColor(249, 221, 221);
        foreach ($this->sub_keys_leave_normal_head as $entries3) {
            foreach ($entries3 as $entries1 => $entries2) {
                $a_x = $this->GetX();
                $a_y = $this->GetY();
                $col_heading = $leave_type[$entries1] . ' '. $entries2;
                $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
                $caption_len = strlen($col_heading);
                if ($maxlen < $caption_len) {
                    $maxlen = $caption_len;
                    $tr_lower_y = $this->GetY();
                }
                $this->SetXY($a_x, $a_y);
            }
        }
        
        foreach ($this->sub_keys_leave_travel_head as $entries3) {
            foreach ($entries3 as $entries1 => $entries2) {
                $a_x = $this->GetX();
                $a_y = $this->GetY();
                $col_heading = $leave_type[$entries1] . ' ';
                $col_heading .= (stripos(' '.$entries2, 'travel') ? $this->smarty->translate[$entries2] : ($entries2 .' '. $this->smarty->translate['travel']));

                $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
                $caption_len = strlen($col_heading);
                if ($maxlen < $caption_len) {
                    $maxlen = $caption_len;
                    $tr_lower_y = $this->GetY();
                }
                $this->SetXY($a_x, $a_y);
            }
        }
        
        foreach ($this->sub_keys_leave_break_head as $entries3) {
            foreach ($entries3 as $entries1 => $entries2) {
                $a_x = $this->GetX();
                $a_y = $this->GetY();
                $col_heading = $leave_type[$entries1] . ' ';
                $col_heading .= (stripos(' '.$entries2, 'break') ? $this->smarty->translate[$entries2] : ($entries2 .' '. $this->smarty->translate['break']));

                $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
                $caption_len = strlen($col_heading);
                if ($maxlen < $caption_len) {
                    $maxlen = $caption_len;
                    $tr_lower_y = $this->GetY();
                }
                $this->SetXY($a_x, $a_y);
            }
        }
        
        foreach ($this->sub_keys_leave_over_head as $entries3) {
            foreach ($entries3 as $entries1 => $entries2) {
                $a_x = $this->GetX();
                $a_y = $this->GetY();
                $col_heading = $leave_type[$entries1] . ' ';
                $col_heading .= (stripos(' '.$entries2, 'overtime') ? $this->smarty->translate[$entries2] : ($entries2 .' '. $this->smarty->translate['overtime']));
                
                $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
                $caption_len = strlen($col_heading);
                if ($maxlen < $caption_len) {
                    $maxlen = $caption_len;
                    $tr_lower_y = $this->GetY();
                }
                $this->SetXY($a_x, $a_y);
            }
        }

        foreach ($this->sub_keys_leave_quality_head as $entries3) {
            foreach ($entries3 as $entries1 => $entries2) {
                $a_x = $this->GetX();
                $a_y = $this->GetY();
                $col_heading = $leave_type[$entries1] . ' ';
                $col_heading .= (stripos(' '.$entries2, 'qual_overtime') ? $this->smarty->translate[$entries2] : ($entries2 .' '. $this->smarty->translate['qual_overtime']));
                
                $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
                $caption_len = strlen($col_heading);
                if ($maxlen < $caption_len) {
                    $maxlen = $caption_len;
                    $tr_lower_y = $this->GetY();
                }
                $this->SetXY($a_x, $a_y);
            }
        }

        foreach ($this->sub_keys_leave_more_head as $entries3) {
            foreach ($entries3 as $entries1 => $entries2) {
                $a_x = $this->GetX();
                $a_y = $this->GetY();
                $col_heading = $leave_type[$entries1] . ' ';
                $col_heading .= (stripos(' '.$entries2, 'more_time') ? $this->smarty->translate[$entries2] : ($entries2 .' '. $this->smarty->translate['more_time']));
                
                $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
                $caption_len = strlen($col_heading);
                if ($maxlen < $caption_len) {
                    $maxlen = $caption_len;
                    $tr_lower_y = $this->GetY();
                }
                $this->SetXY($a_x, $a_y);
            }
        }

        foreach ($this->sub_keys_leave_some_head as $entries3) {
            foreach ($entries3 as $entries1 => $entries2) {
                $a_x = $this->GetX();
                $a_y = $this->GetY();
                $col_heading = $leave_type[$entries1] . ' ';
                $col_heading .= (stripos(' '.$entries2, 'some_other_time') ? $this->smarty->translate[$entries2] : ($entries2 .' '. $this->smarty->translate['some_other_time']));
                
                $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
                $caption_len = strlen($col_heading);
                if ($maxlen < $caption_len) {
                    $maxlen = $caption_len;
                    $tr_lower_y = $this->GetY();
                }
                $this->SetXY($a_x, $a_y);
            }
        }

        foreach ($this->sub_keys_leave_training_head as $entries3) {
            foreach ($entries3 as $entries1 => $entries2) {
                $a_x = $this->GetX();
                $a_y = $this->GetY();
                $col_heading = $leave_type[$entries1] . ' ';
                $col_heading .= (stripos(' '.$entries2, 'training') ? $this->smarty->translate[$entries2] : ($entries2 .' '. $this->smarty->translate['training']));
                
                $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
                $caption_len = strlen($col_heading);
                if ($maxlen < $caption_len) {
                    $maxlen = $caption_len;
                    $tr_lower_y = $this->GetY();
                }
                $this->SetXY($a_x, $a_y);
            }
        }

        foreach ($this->sub_keys_leave_personal_head as $entries3) {
            foreach ($entries3 as $entries1 => $entries2) {
                $a_x = $this->GetX();
                $a_y = $this->GetY();
                $col_heading = $leave_type[$entries1] . ' ';
                $col_heading .= (stripos(' '.$entries2, 'personal_meeting') ? $this->smarty->translate[$entries2] : ($entries2 .' '. $this->smarty->translate['personal_meeting']));
                
                $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
                $caption_len = strlen($col_heading);
                if ($maxlen < $caption_len) {
                    $maxlen = $caption_len;
                    $tr_lower_y = $this->GetY();
                }
                $this->SetXY($a_x, $a_y);
            }
        }
        
        foreach ($this->sub_keys_leave_voluntary_head as $entries3) {
            foreach ($entries3 as $entries1 => $entries2) {
                $a_x = $this->GetX();
                $a_y = $this->GetY();
                $col_heading = $leave_type[$entries1] . ' ';
                $col_heading .= (stripos(' '.$entries2, 'voluntary') ? $this->smarty->translate[$entries2] : ($entries2 .' '. $this->smarty->translate['voluntary']));

                $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
                $caption_len = strlen($col_heading);
                if ($maxlen < $caption_len) {
                    $maxlen = $caption_len;
                    $tr_lower_y = $this->GetY();
                }
                $this->SetXY($a_x, $a_y);
            }
        }
        
//        $this->SetFillColor(249, 221, 221);
        if (!empty($this->sub_keys_leave_normal_head) || !empty($this->sub_keys_leave_travel_head) || !empty($this->sub_keys_leave_break_head) || !empty($this->sub_keys_leave_over_head) || !empty($this->sub_keys_leave_quality_head) || !empty($this->sub_keys_leave_more_head) || !empty($this->sub_keys_leave_some_head) || !empty($this->sub_keys_leave_training_head) || !empty($this->sub_keys_leave_personal_head) || !empty($this->sub_keys_leave_voluntary_head)) {
            $a_x = $this->GetX();
            $a_y = $this->GetY();
            $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($this->smarty->translate['leave_sum_ord'])), 0, 'C');
            $caption_len = strlen($this->smarty->translate['leave_sum_ord']);
            if ($maxlen < $caption_len) {
                $maxlen = $caption_len;
                $tr_lower_y = $this->GetY();
            }
            $this->SetXY($a_x, $a_y);
        }

//        $this->SetFillColor(249, 221, 221);
        foreach ($this->sub_keys_leave_oncall_head as $entries3) {
            foreach ($entries3 as $entries1 => $entries2) {
                $a_x = $this->GetX();
                $a_y = $this->GetY();
                $col_heading = $leave_type[$entries1] . ' '. $entries2;
                $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
                $caption_len = strlen($col_heading);
                if ($maxlen < $caption_len) {
                    $maxlen = $caption_len;
                    $tr_lower_y = $this->GetY();
                }
                $this->SetXY($a_x, $a_y);
            }
        }

        foreach ($this->sub_keys_leave_calltraining_head as $entries3) {
            foreach ($entries3 as $entries1 => $entries2) {
                $a_x = $this->GetX();
                $a_y = $this->GetY();
                $col_heading = $leave_type[$entries1] . ' ';
                $col_heading .= (stripos(' '.$entries2, 'call_training') ? $this->smarty->translate[$entries2] : ($entries2 .' '. $this->smarty->translate['training_time']));
                
                $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
                $caption_len = strlen($col_heading);
                if ($maxlen < $caption_len) {
                    $maxlen = $caption_len;
                    $tr_lower_y = $this->GetY();
                }
                $this->SetXY($a_x, $a_y);
            }
        }
        
        foreach ($this->sub_keys_leave_more_oncall_head as $entries3) {
            foreach ($entries3 as $entries1 => $entries2) {
                $a_x = $this->GetX();
                $a_y = $this->GetY();
                $col_heading = $leave_type[$entries1] . ' ';
                $col_heading .= (stripos(' '.$entries2, 'more_oncall') ? $this->smarty->translate[$entries2] : ($entries2 .' '. $this->smarty->translate['more_time']));
                
                $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
                $caption_len = strlen($col_heading);
                if ($maxlen < $caption_len) {
                    $maxlen = $caption_len;
                    $tr_lower_y = $this->GetY();
                }
                $this->SetXY($a_x, $a_y);
            }
        }
//        $this->SetFillColor(245, 190, 135);
        if (!empty($this->sub_keys_leave_oncall_head) || !empty($this->sub_keys_leave_calltraining_head) || !empty($this->sub_keys_leave_more_oncall_head)) {
            $a_x = $this->GetX();
            $a_y = $this->GetY();
            $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($this->smarty->translate['leave_sum_oncall'])), 0, 'C');
            $caption_len = strlen($this->smarty->translate['leave_sum_oncall']);
            if ($maxlen < $caption_len) {
                $maxlen = $caption_len;
                $tr_lower_y = $this->GetY();
            }
            $this->SetXY($a_x, $a_y);
        }

//        $this->SetFillColor(249, 221, 221);
        if (!empty($this->sub_keys_leave_normal_head) || !empty($this->sub_keys_leave_travel_head) || !empty($this->sub_keys_leave_break_head) || !empty($this->sub_keys_leave_over_head) || !empty($this->sub_keys_leave_quality_head) || !empty($this->sub_keys_leave_more_head) || !empty($this->sub_keys_leave_some_head) || !empty($this->sub_keys_leave_training_head) || !empty($this->sub_keys_leave_personal_head) || !empty($this->sub_keys_leave_voluntary_head) || !empty($this->sub_keys_leave_oncall_head) || !empty($this->sub_keys_leave_calltraining_head)) {
            $a_x = $this->GetX();
            $a_y = $this->GetY();
            $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($this->smarty->translate['leave_sum'])), 0, 'C');
            $caption_len = strlen($this->smarty->translate['leave_sum']);
            if ($maxlen < $caption_len) {
                $maxlen = $caption_len;
                $tr_lower_y = $this->GetY();
            }
        }

        $this->SetXY(18, $header_start_y);
        $new_header_height = $tr_lower_y - $header_start_y;
        $this->SetTextColor(0,0,0);
        return array('header_height' => $new_header_height, 'tr_start_y' => $tr_lower_y);
    }

    function get_total_columns($section = NULL) {
        $total_columns = 1;
        if ($section == NULL) {
            $total_columns = 0;
            $total_columns += count($this->sub_keys_normal);
            $total_columns += count($this->sub_keys_travel);
            $total_columns += count($this->sub_keys_break);
            $total_columns += count($this->sub_keys_oncall);
//            $total_columns += count($this->sub_keys_leave);
            $total_columns += count($this->sub_keys_more);
            $total_columns += count($this->sub_keys_over);
            $total_columns += count($this->sub_keys_quality);
            $total_columns += count($this->sub_keys_some);
            $total_columns += count($this->sub_keys_training);
            $total_columns += count($this->sub_keys_personal);
            $total_columns += count($this->sub_keys_voluntary);
            $total_columns += count($this->sub_keys_complementary);
            $total_columns += count($this->sub_keys_calltraining);
            $total_columns += count($this->sub_keys_complementary_oncall);
            $total_columns += count($this->sub_keys_more_oncall);
            $total_columns += count($this->sub_keys_standby);
            $total_columns += count($this->sub_keys_dismissal);
            $total_columns += count($this->sub_keys_dismissal_oncall);
            
            $total_columns += count($this->sub_keys_leave_normal_head);
            $total_columns += count($this->sub_keys_leave_travel_head);
            $total_columns += count($this->sub_keys_leave_break_head);
            $total_columns += count($this->sub_keys_leave_over_head);
            $total_columns += count($this->sub_keys_leave_quality_head);
            $total_columns += count($this->sub_keys_leave_more_head);
            $total_columns += count($this->sub_keys_leave_some_head);
            $total_columns += count($this->sub_keys_leave_training_head);
            $total_columns += count($this->sub_keys_leave_personal_head);
            $total_columns += count($this->sub_keys_leave_voluntary_head);
            $total_columns += count($this->sub_keys_leave_oncall_head);
            $total_columns += count($this->sub_keys_leave_calltraining_head);
            $total_columns += count($this->sub_keys_leave_more_oncall_head);
            $total_columns += count($this->sub_keys_leave_standby_head);
            
            // Ordinary Work sum column
            if (!empty($this->sub_keys_normal) || !empty($this->sub_keys_travel) || !empty($this->sub_keys_break) || !empty($this->sub_keys_over) || !empty($this->sub_keys_quality) || !empty($this->sub_keys_more) || !empty($this->sub_keys_some) || !empty($this->sub_keys_training) || !empty($this->sub_keys_voluntary) || !empty($this->sub_keys_complementary) || !empty($this->sub_keys_standby) || !empty($this->sub_keys_dismissal))
                $total_columns += 1;
            
            // Personal Meeting Work sum column
            if (!empty($this->sub_keys_personal))
                $total_columns += 1;
            
            //Oncall Work sum column
            if (!empty($this->sub_keys_oncall) || !empty($this->sub_keys_calltraining) || !empty($this->sub_keys_complementary_oncall) || !empty($this->sub_keys_more_oncall) || !empty($this->sub_keys_dismissal_oncall))
                $total_columns += 1;
            
            //Total Work Sum
            if (!empty($this->sub_keys_normal) || !empty($this->sub_keys_travel) || !empty($this->sub_keys_break) || !empty($this->sub_keys_over) || !empty($this->sub_keys_quality) || !empty($this->sub_keys_more) || !empty($this->sub_keys_some) || !empty($this->sub_keys_training) || !empty($this->sub_keys_personal) || !empty($this->sub_keys_voluntary) || !empty($this->sub_keys_complementary) || !empty($this->sub_keys_standby) || !empty($this->sub_keys_dismissal) || !empty($this->sub_keys_oncall) || !empty($this->sub_keys_calltraining) || !empty($this->sub_keys_complementary_oncall) || !empty($this->sub_keys_more_oncall) || !empty($this->sub_keys_dismissal_oncall))
                $total_columns += 1;
            
            //Ordinary Leave sum
            if (!empty($this->sub_keys_leave_normal_head) || !empty($this->sub_keys_leave_travel_head) || !empty($this->sub_keys_leave_break_head) || !empty($this->sub_keys_leave_over_head) || !empty($this->sub_keys_leave_quality_head) || !empty($this->sub_keys_leave_more_head) || !empty($this->sub_keys_leave_some_head) || !empty($this->sub_keys_leave_training_head) || !empty($this->sub_keys_leave_personal_head) || !empty($this->sub_keys_leave_voluntary_head) || !empty($this->sub_keys_leave_standby_head))
                $total_columns += 1;
            
            //Oncall Leave sum
            if (!empty($this->sub_keys_leave_oncall_head) || !empty($this->sub_keys_leave_calltraining_head) || !empty($this->sub_keys_leave_more_oncall_head))
                $total_columns += 1;
            
            //Total Leave sum
            if (!empty($this->sub_keys_leave_normal_head) || !empty($this->sub_keys_leave_travel_head) || !empty($this->sub_keys_leave_break_head) || !empty($this->sub_keys_leave_over_head) || !empty($this->sub_keys_leave_quality_head) || !empty($this->sub_keys_leave_more_head) || !empty($this->sub_keys_leave_some_head) || !empty($this->sub_keys_leave_training_head) || !empty($this->sub_keys_leave_personal_head) || !empty($this->sub_keys_leave_voluntary_head) || !empty($this->sub_keys_leave_standby_head) || !empty($this->sub_keys_leave_oncall_head) || !empty($this->sub_keys_leave_calltraining_head) || !empty($this->sub_keys_leave_more_oncall_head))
                $total_columns += 1;
        }else if ($section == 1) {        //section 1 indicated Work Section (ie, total-leave part)
            $total_columns = 0;
            $total_columns += count($this->sub_keys_normal);
            $total_columns += count($this->sub_keys_travel);
            $total_columns += count($this->sub_keys_break);
            $total_columns += count($this->sub_keys_oncall);
            $total_columns += count($this->sub_keys_more);
            $total_columns += count($this->sub_keys_over);
            $total_columns += count($this->sub_keys_quality);
            $total_columns += count($this->sub_keys_some);
            $total_columns += count($this->sub_keys_training);
            $total_columns += count($this->sub_keys_personal);
            $total_columns += count($this->sub_keys_voluntary);
            $total_columns += count($this->sub_keys_complementary);
            $total_columns += count($this->sub_keys_calltraining);
            $total_columns += count($this->sub_keys_complementary_oncall);
            $total_columns += count($this->sub_keys_more_oncall);
            $total_columns += count($this->sub_keys_standby);
            $total_columns += count($this->sub_keys_dismissal);
            $total_columns += count($this->sub_keys_dismissal_oncall);
            
            // Ordinary Work sum column
            if (!empty($this->sub_keys_normal) || !empty($this->sub_keys_travel) || !empty($this->sub_keys_break) || !empty($this->sub_keys_over) || !empty($this->sub_keys_quality) || !empty($this->sub_keys_more) || !empty($this->sub_keys_some) || !empty($this->sub_keys_training) || !empty($this->sub_keys_voluntary) || !empty($this->sub_keys_complementary) || !empty($this->sub_keys_standby) || !empty($this->sub_keys_dismissal))
                $total_columns += 1;
            
            // Personal Meeting Work sum column
            if (!empty($this->sub_keys_personal))
                $total_columns += 1;
            
            //Oncall Work sum column
            if (!empty($this->sub_keys_oncall) || !empty($this->sub_keys_calltraining) || !empty($this->sub_keys_complementary_oncall) || !empty($this->sub_keys_more_oncall) | !empty($this->sub_keys_dismissal_oncall))
                $total_columns += 1;
            
            //Total Work Sum
            if (!empty($this->sub_keys_normal) || !empty($this->sub_keys_travel) || !empty($this->sub_keys_break) || !empty($this->sub_keys_over) || !empty($this->sub_keys_quality) || !empty($this->sub_keys_more) || !empty($this->sub_keys_some) || !empty($this->sub_keys_training) || !empty($this->sub_keys_personal) || !empty($this->sub_keys_voluntary) || !empty($this->sub_keys_complementary) || !empty($this->sub_keys_standby) || !empty($this->sub_keys_dismissal) || !empty($this->sub_keys_oncall) || !empty($this->sub_keys_calltraining) || !empty($this->sub_keys_complementary_oncall) || !empty($this->sub_keys_more_oncall) || !empty($this->sub_keys_dismissal_oncall))
                $total_columns += 1;
        }else if ($section == 2) {        //section 2 indicated leave Section
            $total_columns = 0;
            $total_columns += count($this->sub_keys_leave_normal_head);
            $total_columns += count($this->sub_keys_leave_travel_head);
            $total_columns += count($this->sub_keys_leave_break_head);
            $total_columns += count($this->sub_keys_leave_over_head);
            $total_columns += count($this->sub_keys_leave_quality_head);
            $total_columns += count($this->sub_keys_leave_more_head);
            $total_columns += count($this->sub_keys_leave_some_head);
            $total_columns += count($this->sub_keys_leave_training_head);
            $total_columns += count($this->sub_keys_leave_personal_head);
            $total_columns += count($this->sub_keys_leave_voluntary_head);
            $total_columns += count($this->sub_keys_leave_oncall_head);
            $total_columns += count($this->sub_keys_leave_calltraining_head);
            $total_columns += count($this->sub_keys_leave_more_oncall_head);
            $total_columns += count($this->sub_keys_leave_standby_head);
            //Ordinary Leave sum
            if (!empty($this->sub_keys_leave_normal_head) || !empty($this->sub_keys_leave_travel_head) || !empty($this->sub_keys_leave_break_head) || !empty($this->sub_keys_leave_over_head) || !empty($this->sub_keys_leave_quality_head) || !empty($this->sub_keys_leave_more_head) || !empty($this->sub_keys_leave_some_head) || !empty($this->sub_keys_leave_training_head) || !empty($this->sub_keys_leave_personal_head) || !empty($this->sub_keys_leave_voluntary_head) || !empty($this->sub_keys_leave_standby_head))
                $total_columns += 1;
            
            //Oncall Leave sum
            if (!empty($this->sub_keys_leave_oncall_head) || !empty($this->sub_keys_leave_calltraining_head) || !empty($this->sub_keys_leave_more_oncall_head))
                $total_columns += 1;
            
            //Total Leave sum
            if (!empty($this->sub_keys_leave_normal_head) || !empty($this->sub_keys_leave_travel_head) || !empty($this->sub_keys_leave_break_head) || !empty($this->sub_keys_leave_over_head) || !empty($this->sub_keys_leave_quality_head) || !empty($this->sub_keys_leave_more_head) || !empty($this->sub_keys_leave_some_head) || !empty($this->sub_keys_leave_training_head) || !empty($this->sub_keys_leave_personal_head) || !empty($this->sub_keys_leave_voluntary_head) || !empty($this->sub_keys_leave_standby_head) || !empty($this->sub_keys_leave_oncall_head) || !empty($this->sub_keys_leave_calltraining_head) || !empty($this->sub_keys_leave_more_oncall_head))
                $total_columns += 1;
        }
        return $total_columns;
    }

    function Footer() {
        //Position at 1.5 cm from bottom
        $this->SetY(-15);
        //Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        //Page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}
?>