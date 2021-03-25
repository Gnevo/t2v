<?php

require_once('./plugins/F_pdf.class.php');
require_once('class/setup.php');

//require_once('./plugins/F_pdf.class.php');
//require_once('./plugins/fpdi/fpdi.php');
//require_once('configs/config.inc.php');
class PDF_Employee_week_report extends FPDF { //FPDF

    var $report_month = '';
    var $report_year = '';
    var $report_customer = '';
    var $report_start_date = '';
    var $report_end_date = '';
    var $rpt_contents = array();
    var $rpt_sum = array();
    
    var $contract_hours = '';
    var $time_sum = '';
    var $oncall_worked = '';

    function __construct($orientation) {
        parent::__construct($orientation);
        $this->FPDF($orientation);
        //$this->k=2;
    }

    function P1_Part1($employee) {
        $start_date = $this->report_start_date;
        $end_date = $this->report_end_date;

        $smarty = new smartySetup(array("reports.xml"), FALSE);
        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0, 50, 50);

        $this->SetFont('Arial', 'B', 15);
        $this->SetXY(10, $this->GetY() + 5);
        $this->Cell(230, 5, utf8_decode($smarty->translate['employee_month_report_pdf']), 0, 0, 'C', FALSE);

        $this->SetXY(10, $this->GetY() + 5);
       // $this->Cell(190,11,'',1,0,'L',true);    //set border
       // $this->Cell(85,11,'',1,0,'L',true);    //set border
        if ($employee) {
            $this->SetFont('Arial', '', 8);
            $this->SetXY(17, $this->GetY() - 2);
            $this->Cell(10, 9, utf8_decode($smarty->translate['employee_report_employee_name']), 0, 0, 'L', FALSE);    //label name1
            $this->SetXY(250, $this->GetY());
            $this->Cell(10, 9, utf8_decode($smarty->translate['employee_report_socialsecurity']), 0, 0, 'L', FALSE);    // label name2

            $this->SetFont('Arial', 'B', 10);
            $this->SetXY(17, $this->GetY() + 3);
            $this->Cell(10, 9, utf8_decode($employee['first_name'] . " " . $employee['last_name']), 0, 0, 'L', FALSE);    //label value1
            $this->SetXY(250, $this->GetY() + 1);
            //$this->Cell(10,9,'920320-1968 ',0,0,'L',FALSE);    // label value2
            $this->Cell(10, 9, $employee['social_security'], 0, 0, 'L', FALSE);    // label value2

            $this->Ln();
        }


        $this->SetXY(18, $this->GetY() - 2);
       // $this->Cell(265, 11, '', 1, 0, 'L', TRUE);

        if ($year % 400 == 0 || ($year % 100 != 0 && $year % 4 == 0))
            $month_days = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
        else
            $month_days = array(31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

        $this->SetFont('Arial', '', 8);
        $this->SetXY(17, $this->GetY() - 2);
        $this->Cell(10, 9, utf8_decode($smarty->translate['report_period']), 0, 0, 'L', FALSE);    //label name1

        $this->SetFont('Arial', 'B', 10);
        $this->SetXY(17, $this->GetY() + 5);
        $this->Cell(177, 5, utf8_decode($start_date . ' -- ' . $end_date), 0, 0, 'L', FALSE);
        
        $this->Ln(5);
        
        //report sum hours
        $this->SetFont('Arial', '', 8);
        $this->SetXY(18, $this->GetY());
        $this->Cell(88, 5, utf8_decode($smarty->translate['contract_hour']), 'LTR', 0, 'T', FALSE);    //label name1
        $this->Cell(88, 5, utf8_decode($smarty->translate['worked_hour']), 'LTR', 0, 'T', FALSE);    //label name1
        $this->Cell(88, 5, utf8_decode($smarty->translate['oncall_worked_hour']), 'LTR', 1, 'T', FALSE);    //label name1

        $this->SetFont('Arial', 'B', 10);
        $this->SetXY(18, $this->GetY());
        $this->Cell(88, 7, $this->contract_hours, 'LBR', 0, 'L', FALSE);
        $this->Cell(88, 7, $this->time_sum, 'LBR', 0, 'L', FALSE);
        $this->Cell(88, 7, $this->oncall_worked, 'LBR', 1, 'L', FALSE);

        $this->Ln(5);
    }

    function P1_Part1_P($employee) {
        $start_date = $this->report_start_date;
        $end_date = $this->report_end_date;
        $smarty = new smartySetup(array("reports.xml"), FALSE);
        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0, 50, 50);

        $this->SetFont('Arial', 'B', 15);
        $this->SetXY(10, $this->GetY() + 5);
        $this->Cell(180, 5, utf8_decode($smarty->translate['employee_month_report_pdf']), 0, 0, 'C', FALSE);

        $this->SetXY(10, $this->GetY() + 5);
//        $this->Cell(190,11,'',1,0,'L',true);    //set border
//        $this->Cell(85,11,'',1,0,'L',true);    //set border
        if ($employee) {
            $this->SetFont('Arial', '', 8);
            $this->SetXY(17, $this->GetY() - 2);
            $this->Cell(10, 9, utf8_decode($smarty->translate['employee_report_employee_name']), 0, 0, 'L', FALSE);    //label name1
            $this->SetXY(170, $this->GetY());
            $this->Cell(10, 9, utf8_decode($smarty->translate['employee_report_socialsecurity']), 0, 0, 'L', FALSE);    // label name2

            $this->SetFont('Arial', 'B', 10);
            $this->SetXY(17, $this->GetY() + 3);
            $this->Cell(10, 9, utf8_decode($employee['first_name'] . " " . $employee['last_name']), 0, 0, 'L', FALSE);    //label value1
            $this->SetXY(172, $this->GetY());
            //$this->Cell(10,9,'920320-1968 ',0,0,'L',FALSE);    // label value2
            $this->Cell(10, 9, $employee['social_security'], 0, 0, 'L', FALSE);    // label value2

            $this->Ln();
        }


        $this->SetXY(18, $this->GetY() - 2);
//        $this->Cell(265, 11, '', 1, 0, 'L', TRUE);

        if ($year % 400 == 0 || ($year % 100 != 0 && $year % 4 == 0))
            $month_days = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
        else
            $month_days = array(31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

        $this->SetFont('Arial', '', 8);
        $this->SetXY(17, $this->GetY() - 2);
        $this->Cell(10, 9, utf8_decode($smarty->translate['report_period']), 0, 0, 'L', FALSE);    //label name1

        $this->SetFont('Arial', 'B', 10);
        $this->SetXY(17, $this->GetY() + 5);
        $this->Cell(177, 5, utf8_decode($start_date . ' -- ' . $end_date), 0, 0, 'L', FALSE);
        
        $this->Ln(5);
        
        //report sum hours
        $this->SetFont('Arial', '', 8);
        $this->SetXY(10, $this->GetY());
        $this->Cell(63.3, 5, utf8_decode($smarty->translate['contract_hour']), 'LTR', 0, 'T', FALSE);    //label name1
        $this->Cell(63.3, 5, utf8_decode($smarty->translate['worked_hour']), 'LTR', 0, 'T', FALSE);    //label name1
        $this->Cell(63.3, 5, utf8_decode($smarty->translate['oncall_worked_hour']), 'LTR', 1, 'T', FALSE);    //label name1

        $this->SetFont('Arial', 'B', 10);
        $this->SetXY(10, $this->GetY());
        $this->Cell(63.3, 7, $this->contract_hours, 'LBR', 0, 'L', FALSE);
        $this->Cell(63.3, 7, $this->time_sum, 'LBR', 0, 'L', FALSE);
        $this->Cell(63.3, 7, $this->oncall_worked, 'LBR', 1, 'L', FALSE);

        $this->Ln(5);
    }

    function setFillColourByStatus($status = NULL){
        if($status === NULL){
            $this->SetFillColor(230, 230, 230);
        }
        elseif($status == 2){
            $this->SetFillColor(216, 187, 187);
        }
        else {
            $this->SetFillColor(230, 230, 230);
        }
    }

    function P1_Part2($emp_flag) {
        $smarty = new smartySetup(array("user.xml", "month.xml", "messages.xml", "button.xml", "forms.xml"), FALSE);
        global $leave_type_short;
        // echo "<pre>".print_r($leave_type_short, 1)."<pre>";

        $this->SetFillColor(230, 230, 230);
        $w = array(33, 33, 33, 33, 33, 33, 33, 33);
        $table_head_content = array("Mån", "Tis", "Ons", "Tors", "Fre", "Lör", "Sön", "Summa");
        $weeks = array("mon", "tue", "wed", "thu", "fri", "sat", "sun");
        $col_h = 4;
        $col_h_w = 8;
        //print_r($this->rpt_contents) ;  
        $i = 0;
        foreach ($this->rpt_contents as $report) {
            $this->SetFont('Arial', 'B', 12);
            $y_value = floatval($this->GetY());
            $we = count($report['data']['mon']);
            if ($max_entries < $we)
                $max_entries = $we;
            $we = count($report['data']['tue']);
            if ($max_entries < $we)
                $max_entries = $we;
            $we = count($report['data']['wed']);
            if ($max_entries < $we)
                $max_entries = $we;
            $we = count($report['data']['thu']);
            if ($max_entries < $we)
                $max_entries = $we;
            $we = count($report['data']['fri']);
            if ($max_entries < $we)
                $max_entries = $we;
            $we = count($report['data']['sat']);
            if ($max_entries < $we)
                $max_entries = $we;
            $we = count($report['data']['sun']);
            if ($max_entries < $we)
                $max_entries = $we;
            $current_rh = $max_entries * $col_h * 2;
            if ($y_value + $current_rh >= 170.00) {
                $this->AddPage();
                $y_value = 25.00;
            }
            $this->SetXY(18, $y_value);
            $this->Cell(264, 8, utf8_decode('Vecka ' . $report['week']), 1, 1, 'C', FALSE);    //week table heading (week number)

            $this->SetX(18);
            for ($m = 0; $m < 8; $m++) {     //set column headings for each table
                $this->Cell($w[$m], $col_h + 1, utf8_decode($table_head_content[$m]) . "  " . $report[$weeks[$m]][0], 1, 0, 'C', FALSE);
            }
            $this->Ln();
            $this->SetFont('Arial', '', 9);
            $this->SetX(18);
            $max_entries = 0;       //find max no.of entries per row
            $we = count($report['data']['mon']);
            if ($max_entries < $we)
                $max_entries = $we;
            $we = count($report['data']['tue']);
            if ($max_entries < $we)
                $max_entries = $we;
            $we = count($report['data']['wed']);
            if ($max_entries < $we)
                $max_entries = $we;
            $we = count($report['data']['thu']);
            if ($max_entries < $we)
                $max_entries = $we;
            $we = count($report['data']['fri']);
            if ($max_entries < $we)
                $max_entries = $we;
            $we = count($report['data']['sat']);
            if ($max_entries < $we)
                $max_entries = $we;
            $we = count($report['data']['sun']);
            if ($max_entries < $we)
                $max_entries = $we;
            $current_rh = $max_entries * $col_h * 2;

            $this->Cell(1, $current_rh, '', 0, 0, 'L', FALSE);
            $this->SetX(18);


            $indx = 0;
            $start_x = $this->GetX();
            $start_y = $this->GetY();
            $this->Cell($w[6], $current_rh, '', 1, 0, 'L', FALSE);
            $this->SetXY($start_x, $start_y);
            if (!empty($report['data']['mon'])) {
                foreach ($report['data']['mon'] as $mon) {

                    $man = explode(',', $mon['time']);
                    if ($man[2] == 1)
                        $bg_flag = FALSE;
                    else{
                        $bg_flag = TRUE;
                        $this->setFillColourByStatus($man[2]);
                    }
                    $this->Cell($w[0] - 8, $col_h, utf8_decode($man[0]), 'TRL', 0, 'L', $bg_flag);
                    if ($man[2] == 2 && $man[6] != '')
                        $this->Cell(8, $col_h_w, utf8_decode($leave_type_short[$man[6]]), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 0)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['working_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 1)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['travel_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 2)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['lunch_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 3)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['oncall_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 4)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['overtime_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 5)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['more_overtime_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 6)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['quality_overtime_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 7)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['some_othertime_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 8)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['training_time_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 9)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['cal_training_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 10)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['personal_meeting_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 11)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['voluntary_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 12)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['complementary_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 13)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['complementary_oncall_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 14)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['more_oncall_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 16)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['work_for_dismissal_shortcut']), 1, 0, 'C', $bg_flag);
                    $this->SetXY($start_x, $this->GetY() + $col_h);
                    $cust = explode(" ", $mon['customer']);
                    if ($emp_flag == 1)
                        $this->Cell($w[0] - 8, $col_h, utf8_decode($cust[1]) . " (" . substr($man[4], 0, 1) . substr($man[5], 0, 1) . ")", 'LRB', 0, 'L', $bg_flag);
                    else
                        $this->Cell($w[0] - 8, $col_h, utf8_decode($cust[1]), 'LRB', 0, 'L', $bg_flag);
                    if (++$indx != count($report['data']['mon'])) {
                        $this->SetXY($start_x, $this->GetY() + $col_h);
                    } else {
                        $this->SetXY($start_x + $w[4], $start_y);
                    }
                }
            } else {
                $this->Cell($w[0], $current_rh, '', 1, 0, 'L', FALSE);
            }
            $this->setFillColourByStatus();

            $indx = 0;
            $start_x = $this->GetX();
            $start_y = $this->GetY();
            $this->Cell($w[1], $current_rh, '', 1, 0, 'L', FALSE);
            $this->SetXY($start_x, $start_y);
            if (!empty($report['data']['tue'])) {
                foreach ($report['data']['tue'] as $tue) {

                    $man = explode(',', $tue['time']);
                    if ($man[2] == 1)
                        $bg_flag = FALSE;
                    else{
                        $bg_flag = TRUE;
                        $this->setFillColourByStatus($man[2]);
                    }
                    $this->Cell($w[1] - 8, $col_h, utf8_decode($man[0]), 'TRL', 0, 'L', $bg_flag);
                    if ($man[2] == 2 && $man[6] != '')
                        $this->Cell(8, $col_h_w, utf8_decode($leave_type_short[$man[6]]), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 0)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['working_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 1)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['travel_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 2)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['lunch_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 3)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['oncall_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 4)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['overtime_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 5)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['more_overtime_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 6)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['quality_overtime_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 7)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['some_othertime_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 8)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['training_time_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 9)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['cal_training_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 10)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['personal_meeting_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 11)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['voluntary_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 12)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['complementary_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 13)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['complementary_oncall_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 14)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['more_oncall_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 16)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['work_for_dismissal_shortcut']), 1, 0, 'C', $bg_flag);
                    $this->SetXY($start_x, $this->GetY() + $col_h);
                    $cust = explode(" ", $tue['customer']);
                    if ($emp_flag == 1)
                        $this->Cell($w[0] - 8, $col_h, utf8_decode($cust[1]) . " (" . substr($man[4], 0, 1) . substr($man[5], 0, 1) . ")", 'LRB', 0, 'L', $bg_flag);
                    else
                        $this->Cell($w[0] - 8, $col_h, utf8_decode($cust[1]), 'LRB', 0, 'L', $bg_flag);
                    if (++$indx != count($report['data']['tue'])) {
                        $this->SetXY($start_x, $this->GetY() + $col_h);
                    } else {
                        $this->SetXY($start_x + $w[1], $start_y);
                    }
                }
            } else {
                $this->Cell($w[1], $current_rh, '', 1, 0, 'L', FALSE);
            }
            $this->setFillColourByStatus();

            $indx = 0;
            $start_x = $this->GetX();
            $start_y = $this->GetY();
            $this->Cell($w[2], $current_rh, '', 1, 0, 'L', FALSE);
            $this->SetXY($start_x, $start_y);
            if (!empty($report['data']['wed'])) {
                foreach ($report['data']['wed'] as $wed) {

                    $man = explode(',', $wed['time']);
                    if ($man[2] == 1)
                        $bg_flag = FALSE;
                    else{
                        $bg_flag = TRUE;
                        $this->setFillColourByStatus($man[2]);
                    }
                    $this->Cell($w[2] - 8, $col_h, utf8_decode($man[0]), 'TRL', 0, 'L', $bg_flag);
                    if ($man[2] == 2 && $man[6] != '')
                        $this->Cell(8, $col_h_w, utf8_decode($leave_type_short[$man[6]]), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 0)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['working_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 1)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['travel_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 2)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['lunch_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 3)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['oncall_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 4)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['overtime_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 5)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['more_overtime_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 6)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['quality_overtime_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 7)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['some_othertime_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 8)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['training_time_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 9)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['cal_training_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 10)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['personal_meeting_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 11)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['voluntary_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 12)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['complementary_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 13)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['complementary_oncall_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 14)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['more_oncall_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 16)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['work_for_dismissal_shortcut']), 1, 0, 'C', $bg_flag);
                    $this->SetXY($start_x, $this->GetY() + $col_h);
                    $cust = explode(" ", $wed['customer']);
                    if ($emp_flag == 1)
                        $this->Cell($w[0] - 8, $col_h, utf8_decode($cust[1]) . " (" . substr($man[4], 0, 1) . substr($man[5], 0, 1) . ")", 'LRB', 0, 'L', $bg_flag);
                    else
                        $this->Cell($w[0] - 8, $col_h, utf8_decode($cust[1]), 'LRB', 0, 'L', $bg_flag);
                    if (++$indx != count($report['data']['wed'])) {
                        $this->SetXY($start_x, $this->GetY() + $col_h);
                    } else {
                        $this->SetXY($start_x + $w[2], $start_y);
                    }
                }
            } else {
                $this->Cell($w[1], $current_rh, '', 1, 0, 'L', FALSE);
            }
            $this->setFillColourByStatus();

            $indx = 0;
            $start_x = $this->GetX();
            $start_y = $this->GetY();
            $this->Cell($w[3], $current_rh, '', 1, 0, 'L', FALSE);
            $this->SetXY($start_x, $start_y);
            if (!empty($report['data']['thu'])) {
                foreach ($report['data']['thu'] as $thu) {

                    $man = explode(',', $thu['time']);
                    if ($man[2] == "1")
                        $bg_flag = FALSE;
                    else
                        $bg_flag = TRUE;
                    $this->Cell($w[3] - 8, $col_h, utf8_decode($man[0]), 'TRL', 0, 'L', $bg_flag);
                    if ($man[2] == 2 && $man[6] != '')
                        $this->Cell(8, $col_h_w, utf8_decode($leave_type_short[$man[6]]), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 0)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['working_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 1)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['travel_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 2)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['lunch_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 3)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['oncall_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 4)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['overtime_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 5)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['more_overtime_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 6)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['quality_overtime_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 7)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['some_othertime_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 8)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['training_time_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 9)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['cal_training_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 10)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['personal_meeting_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 11)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['voluntary_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 12)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['complementary_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 13)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['complementary_oncall_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 14)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['more_oncall_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 16)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['work_for_dismissal_shortcut']), 1, 0, 'C', $bg_flag);
                    $this->SetXY($start_x, $this->GetY() + $col_h);
                    $cust = explode(" ", $thu['customer']);
                    if ($emp_flag == 1)
                        $this->Cell($w[0] - 8, $col_h, utf8_decode($cust[1]) . " (" . substr($man[4], 0, 1) . substr($man[5], 0, 1) . ")", 'LRB', 0, 'L', $bg_flag);
                    else
                        $this->Cell($w[0] - 8, $col_h, utf8_decode($cust[1]), 'LRB', 0, 'L', $bg_flag);
                    if (++$indx != count($report['data']['thu'])) {
                        $this->SetXY($start_x, $this->GetY() + $col_h);
                    } else {
                        $this->SetXY($start_x + $w[3], $start_y);
                    }
                }
            } else {
                $this->Cell($w[3], $current_rh, '', 1, 0, 'L', FALSE);
            }
            $this->setFillColourByStatus();

            $indx = 0;
            $start_x = $this->GetX();
            $start_y = $this->GetY();
            $this->Cell($w[4], $current_rh, '', 1, 0, 'L', FALSE);
            $this->SetXY($start_x, $start_y);
            if (!empty($report['data']['fri'])) {
                foreach ($report['data']['fri'] as $fri) {

                    $man = explode(',', $fri['time']);
                    if ($man[2] == 1)
                        $bg_flag = FALSE;
                    else{
                        $bg_flag = TRUE;
                        $this->setFillColourByStatus($man[2]);
                    }
                    $this->Cell($w[4] - 8, $col_h, utf8_decode($man[0]), 'TRL', 0, 'L', $bg_flag);
                    if ($man[2] == 2 && $man[6] != '')
                        $this->Cell(8, $col_h_w, utf8_decode($leave_type_short[$man[6]]), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 0)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['working_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 1)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['travel_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 2)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['lunch_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 3)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['oncall_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 4)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['overtime_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 5)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['more_overtime_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 6)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['quality_overtime_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 7)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['some_othertime_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 8)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['training_time_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 9)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['cal_training_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 10)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['personal_meeting_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 11)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['voluntary_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 12)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['complementary_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 13)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['complementary_oncall_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 14)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['more_oncall_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 16)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['work_for_dismissal_shortcut']), 1, 0, 'C', $bg_flag);
                    $this->SetXY($start_x, $this->GetY() + $col_h);
                    $cust = explode(" ", $fri['customer']);
                    if ($emp_flag == 1)
                        $this->Cell($w[0] - 8, $col_h, utf8_decode($cust[1]) . " (" . substr($man[4], 0, 1) . substr($man[5], 0, 1) . ")", 'LRB', 0, 'L', $bg_flag);
                    else
                        $this->Cell($w[0] - 8, $col_h, utf8_decode($cust[1]), 'LRB', 0, 'L', $bg_flag);
                    if (++$indx != count($report['data']['fri'])) {
                        $this->SetXY($start_x, $this->GetY() + $col_h);
                    } else {
                        $this->SetXY($start_x + $w[4], $start_y);
                    }
                }
            } else {
                $this->Cell($w[4], $current_rh, '', 1, 0, 'L', FALSE);
            }
            $this->setFillColourByStatus();

            $indx = 0;
            $start_x = $this->GetX();
            $start_y = $this->GetY();
            $this->Cell($w[5], $current_rh, '', 1, 0, 'L', FALSE);
            $this->SetXY($start_x, $start_y);
            if (!empty($report['data']['sat'])) {
                foreach ($report['data']['sat'] as $sat) {

                    $man = explode(',', $sat['time']);
                    if ($man[2] == 1)
                        $bg_flag = FALSE;
                    else{
                        $bg_flag = TRUE;
                        $this->setFillColourByStatus($man[2]);
                    }
                    $this->Cell($w[5] - 8, $col_h, utf8_decode($man[0]), 'TRL', 0, 'L', $bg_flag);
                    if ($man[2] == 2 && $man[6] != '')
                        $this->Cell(8, $col_h_w, utf8_decode($leave_type_short[$man[6]]), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 0)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['working_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 1)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['travel_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 2)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['lunch_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 3)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['oncall_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 4)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['overtime_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 5)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['more_overtime_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 6)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['quality_overtime_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 7)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['some_othertime_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 8)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['training_time_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 9)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['cal_training_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 10)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['personal_meeting_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 11)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['voluntary_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 12)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['complementary_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 13)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['complementary_oncall_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 14)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['more_oncall_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 16)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['work_for_dismissal_shortcut']), 1, 0, 'C', $bg_flag);
                    $this->SetXY($start_x, $this->GetY() + $col_h);
                    $cust = explode(" ", $sat['customer']);
                    if ($emp_flag == 1)
                        $this->Cell($w[0] - 8, $col_h, utf8_decode($cust[1]) . " (" . substr($man[4], 0, 1) . substr($man[5], 0, 1) . ")", 'LRB', 0, 'L', $bg_flag);
                    else
                        $this->Cell($w[0] - 8, $col_h, utf8_decode($cust[1]), 'LRB', 0, 'L', $bg_flag);
                    if (++$indx != count($report['data']['sat'])) {
                        $this->SetXY($start_x, $this->GetY() + $col_h);
                    } else {
                        $this->SetXY($start_x + $w[5], $start_y);
                    }
                }
            } else {
                $this->Cell($w[5], $current_rh, '', 1, 0, 'L', FALSE);
            }
            $this->setFillColourByStatus();

            $indx = 0;
            $start_x = $this->GetX();
            $start_y = $this->GetY();
            $this->Cell($w[0], $current_rh, '', 1, 0, 'L', FALSE);
            $this->SetXY($start_x, $start_y);
            //{foreach from=$report.data.mon item=mon}

            if (!empty($report['data']['sun'])) {
                foreach ($report['data']['sun'] as $sun) {
                    if ($this->GetY() < 11.00 || $this->GetY() > 180.00) {
                        
                    }
                    $man = explode(',', $sun['time']);
                    if ($man[2] == 1)
                        $bg_flag = FALSE;
                    else{
                        $bg_flag = TRUE;
                        $this->setFillColourByStatus($man[2]);
                    }
                    $this->Cell($w[6] - 8, $col_h, utf8_decode($man[0]), 'TRL', 0, 'L', $bg_flag);
                    if ($man[2] == 2 && $man[6] != '')
                        $this->Cell(8, $col_h_w, utf8_decode($leave_type_short[$man[6]]), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 0)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['working_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 1)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['travel_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 2)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['lunch_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 3)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['oncall_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 4)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['overtime_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 5)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['more_overtime_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 6)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['quality_overtime_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 7)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['some_othertime_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 8)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['training_time_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 9)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['cal_training_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 10)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['personal_meeting_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 11)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['voluntary_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 12)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['complementary_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 13)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['complementary_oncall_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 14)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['more_oncall_shortcut']), 1, 0, 'C', $bg_flag);
                    elseif ($man[1] == 16)
                        $this->Cell(8, $col_h_w, utf8_decode($smarty->translate['work_for_dismissal_shortcut']), 1, 0, 'C', $bg_flag);
                    $this->SetXY($start_x, $this->GetY() + $col_h);
                    $cust = explode(" ", $sun['customer']);
                    if ($emp_flag == 1)
                        $this->Cell($w[0] - 8, $col_h, utf8_decode($cust[1]) . " (" . substr($man[4], 0, 1) . substr($man[5], 0, 1) . ")", 'LRB', 0, 'L', $bg_flag);
                    else
                        $this->Cell($w[0] - 8, $col_h, utf8_decode($cust[1]), 'LRB', 0, 'L', $bg_flag);
                    if (++$indx != count($report['data']['sun'])) {
                        $this->SetXY($start_x, $this->GetY() + $col_h);
                    } else {
                        $this->SetXY($start_x + $w[6], $start_y);
                    }
                }
            } else {
                $this->Cell($w[6], $current_rh, '', 1, 0, 'L', FALSE);
            }
            $this->setFillColourByStatus();

            $this->SetFont('Arial', 'B', 11);
            $this->Cell($w[7], $current_rh, utf8_decode($report['data']['sum']), 1, 0, 'C', FALSE);

            $this->Ln();
            $this->SetX(18);
            $this->SetFont('Arial', 'B', 11);

            $this->Cell($w[0], $col_h, utf8_decode($this->rpt_sum[$i]['mon']), 1, 0, 'C', FALSE);
            $this->Cell($w[1], $col_h, utf8_decode($this->rpt_sum[$i]['tue']), 1, 0, 'C', FALSE);
            $this->Cell($w[2], $col_h, utf8_decode($this->rpt_sum[$i]['wed']), 1, 0, 'C', FALSE);
            $this->Cell($w[3], $col_h, utf8_decode($this->rpt_sum[$i]['thu']), 1, 0, 'C', FALSE);
            $this->Cell($w[4], $col_h, utf8_decode($this->rpt_sum[$i]['fri']), 1, 0, 'C', FALSE);
            $this->Cell($w[5], $col_h, utf8_decode($this->rpt_sum[$i]['sat']), 1, 0, 'C', FALSE);
            $this->Cell($w[6], $col_h, utf8_decode($this->rpt_sum[$i]['sun']), 1, 0, 'C', FALSE);
            $this->Cell($w[7], $col_h, '', 1, 0, 'L', FALSE);

            $i +=1;
            $this->Ln(5);
        }
    }

    function report_part($start_date, $end_date, $emp_flag) {
        $smarty = new smartySetup(array("user.xml", "month.xml", "messages.xml", "button.xml", "forms.xml"), FALSE);
//        $this->SetFillColor(230, 230, 230);
        global $leave_type_short;
        
        
        $this->SetFillColor(255, 255, 255);
        $w = array(33, 33, 33, 33, 33, 33, 33, 33);
        $table_head_content = array("Sön", "Mån", "Tis", "Ons", "Tors", "Fre", "Lör", "Summa");
        $weeks = array("sun", "mon", "tue", "wed", "thu", "fri", "sat");
        $col_h = 4;
        $col_h_w = 8;
        $y = 0.0;
        $_SESSION['pdf_y_val_even'] = $this->GetY();
        $_SESSION['pdf_y_val_odd'] = $this->GetY();
        $sizes = array();
//        echo "<pre>". print_r($this->rpt_contents, 1)."</pre>";
        for ($i = 0; $i < count($this->rpt_contents); $i++) {
            $counts = count($this->rpt_contents[$i]['data']['sun']) + count($this->rpt_contents[$i]['data']['mon']) + count($this->rpt_contents[$i]['data']['tue']) + count($this->rpt_contents[$i]['data']['wed']) + count($this->rpt_contents[$i]['data']['thu']) + count($this->rpt_contents[$i]['data']['fri']) + count($this->rpt_contents[$i]['data']['sat']);
            $sizes [] = $counts;
        }
        $i = 0;
        $page_begin = "";
        $pagechange = "";
        foreach ($this->rpt_contents as $key => $report) {

            $this->SetFont('Arial', '', 8);
            $this->SetXY(10, $this->GetY());

//            $this->Cell(132.5,6,'Veka1',1,0,'L',true);

            $this->SetXY(10, $this->GetY());
            if ($i % 2 == 0) {
//                echo 1 ."  ";
//                echo "<pre>". print_r($this->pages, 1)."</pre>";
                if ($this->page != $page_begin && $page_begin != "") {
                    $this->pages[$this->page] = $pagechange . $this->pages[$this->page];
//                    $pagechange = $this->pages[$this->page];
//                    $this->page = $page_begin;
                }
                $page_begin = $this->page;
                $this->SetFillColor(255, 255, 255);
                $this->SetXY(10, $_SESSION['pdf_y_val_even']);
                $i++;
                $this->Cell(95, 4, utf8_decode('Vecka ' . $report['week']), 1, 1, 'C', FALSE);
                //            echo "<pre>". print_r($report['data']['mon'], 1)."</pre>";

                if (!empty($report['data']['mon'])) {
                    $a = 0;
                    foreach ($report['data']['mon'] as $mon) {
                        $this->SetX(10);
                        $mon_flags = explode(",", $mon['time']);
                        // if ($mon_flags[2] == 2) {
                        //     $this->setFillColourByStatus($mon_flags[2]);
                        // } else {
                        //     $this->SetFillColor(255, 255, 255);
                        // }
                        if ($mon_flags[2] == 1)
                            $bg_flag = FALSE;
                        else{
                            $bg_flag = TRUE;
                            $this->setFillColourByStatus($mon_flags[2]);
                        }
                        $time_val = explode(".", $mon_flags[0]);
                        $x_val = $this->GetX();
                        if ($a == 0) {
                            $this->Cell(30, 4, $report['mon'][2] . "-" . $report['mon'][1] . "-" . $report['mon'][0], 1, 0, 'L', $bg_flag);
                            $this->SetX($x_val + 20);
                            $this->Cell(10, 4, utf8_decode($smarty->translate['mon']), 'TRB', 0, 'L', $bg_flag);
                        } else {
                            $this->Cell(30, 4, '', 1, 0, 'L', $bg_flag);
                        }
                        if ($mon_flags[2] == 2 && $mon_flags[6] != '')
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $mon_flags[3] . "  " . utf8_decode($leave_type_short[$mon_flags[6]]), 1, 0, 'L', $bg_flag);
                        elseif ($mon_flags[1] == 3)
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $mon_flags[3] . "  " . utf8_decode($smarty->translate['oncall_shortcut']), 1, 0, 'L', $bg_flag);
                        elseif ($mon_flags[1] == 9)
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $mon_flags[3] . "  " . utf8_decode($smarty->translate['cal_training_shortcut']), 1, 0, 'L', $bg_flag);
                        else
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $mon_flags[3], 1, 0, 'L', $bg_flag);
                        $cust = explode(" ", $mon['customer']);
                        if ($emp_flag == 1) {
                            if ($mon_flags[4] != "")
                                $this->Cell(33, 4, utf8_decode($cust[0]) . " (" . substr($mon_flags[4], 0, 1) . substr($mon_flags[5], 0, 1) . ")", 1, 0, 'L', $bg_flag);
                            else
                                $this->Cell(33, 4, utf8_decode($cust[0]), 1, 0, 'L', $bg_flag);
                        }
                        else
                            $this->Cell(33, 4, utf8_decode($mon['customer']), 1, 0, 'L', $bg_flag);
                        $a++;

                        $this->SetXY(10, $this->GetY() + 4);
                        $this->setFillColourByStatus();
                    }
                }
                if (!empty($report['data']['tue'])) {
                    $a = 0;
                    foreach ($report['data']['tue'] as $tue) {
                        $this->SetX(10);
                        $tue_flags = explode(",", $tue['time']);
                        // if ($tue_flags[2] == 2) {
                        //     $this->setFillColourByStatus($tue_flags[2]);
                        // } else {
                        //     $this->SetFillColor(255, 255, 255);
                        // }
                        if ($tue_flags[2] == 1)
                            $bg_flag = FALSE;
                        else{
                            $bg_flag = TRUE;
                            $this->setFillColourByStatus($tue_flags[2]);
                        }
                        $time_val = explode(".", $tue_flags[0]);
                        $x_val = $this->GetX();
                        if ($a == 0) {
                            $this->Cell(30, 4, $report['tue'][2] . "-" . $report['tue'][1] . "-" . $report['tue'][0], 1, 0, 'L', $bg_flag);
                            $this->SetX($x_val + 20);
                            $this->Cell(10, 4, utf8_decode($smarty->translate['tue']), 'TRB', 0, 'L', $bg_flag);
                        } else {
                            $this->Cell(30, 4, '', 1, 0, 'L', $bg_flag);
                        }

                        if ($tue_flags[2] == 2 && $tue_flags[6] != '')
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $tue_flags[3] . "  " . utf8_decode($leave_type_short[$tue_flags[6]]), 1, 0, 'L', $bg_flag);
                        elseif ($tue_flags[1] == 3)
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $tue_flags[3] . "  " . utf8_decode($smarty->translate['oncall_shortcut']), 1, 0, 'L', $bg_flag);
                        elseif ($tue_flags[1] == 9)
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $tue_flags[3] . "  " . utf8_decode($smarty->translate['cal_training_shortcut']), 1, 0, 'L', $bg_flag);
                        else
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $tue_flags[3], 1, 0, 'L', $bg_flag);

                        $cust = explode(" ", $tue['customer']);
                        if ($emp_flag == 1) {
                            if ($tue_flags[4] != "")
                                $this->Cell(33, 4, utf8_decode($cust[0]) . " (" . substr($tue_flags[4], 0, 1) . substr($tue_flags[5], 0, 1) . ")", 1, 0, 'L', $bg_flag);
                            else
                                $this->Cell(33, 4, utf8_decode($cust[0]), 1, 0, 'L', $bg_flag);
                        }
                        else
                            $this->Cell(33, 4, utf8_decode($tue['customer']), 1, 0, 'L', $bg_flag);
                        $this->SetXY(10, $this->GetY() + 4);
                        $a++;
                        $this->setFillColourByStatus();
                    }
                }
                if (!empty($report['data']['wed'])) {
                    $a = 0;
                    foreach ($report['data']['wed'] as $wed) {
                        $this->SetX(10);
                        $wed_flags = explode(",", $wed['time']);
                        // if ($wed_flags[2] == 2) {
                        //     $this->setFillColourByStatus($wed_flags[2]);
                        // } else {
                        //     $this->SetFillColor(255, 255, 255);
                        // }
                        if ($wed_flags[2] == 1)
                            $bg_flag = FALSE;
                        else{
                            $bg_flag = TRUE;
                            $this->setFillColourByStatus($wed_flags[2]);
                        }
                        $x_val = $this->GetX();
                        $time_val = explode(".", $wed_flags[0]);
                        if ($a == 0) {
                            $this->Cell(30, 4, $report['wed'][2] . "-" . $report['wed'][1] . "-" . $report['wed'][0], 1, 0, 'L', $bg_flag);
                            $this->SetX($x_val + 20);
                            $this->Cell(10, 4, utf8_decode($smarty->translate['wed']), 'TRB', 0, 'L', $bg_flag);
                        } else {
                            $this->Cell(30, 4, '', 1, 0, 'L', $bg_flag);
                        }
                        if ($wed_flags[2] == 2 && $wed_flags[6] != '')
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $wed_flags[3] . "  " . utf8_decode($leave_type_short[$wed_flags[6]]), 1, 0, 'L', $bg_flag);
                        elseif ($wed_flags[1] == 3)
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $wed_flags[3] . "  " . utf8_decode($smarty->translate['oncall_shortcut']), 1, 0, 'L', $bg_flag);
                        elseif ($wed_flags[1] == 9)
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $wed_flags[3] . "  " . utf8_decode($smarty->translate['cal_training_shortcut']), 1, 0, 'L', $bg_flag);
                        else
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $wed_flags[3], 1, 0, 'L', $bg_flag);
                        $cust = explode(" ", $wed['customer']);
                        if ($emp_flag == 1) {
                            if ($wed_flags[4] != "")
                                $this->Cell(33, 4, utf8_decode($cust[0]) . " (" . substr($wed_flags[4], 0, 1) . substr($wed_flags[5], 0, 1) . ")", 1, 0, 'L', $bg_flag);
                            else
                                $this->Cell(33, 4, utf8_decode($cust[0]), 1, 0, 'L', $bg_flag);
                        }
                        else
                            $this->Cell(33, 4, utf8_decode($wed['customer']), 1, 0, 'L', $bg_flag);
                        $this->SetXY(10, $this->GetY() + 4);
                        $a++;
                        $this->setFillColourByStatus();
                    }
                }
                if (!empty($report['data']['thu'])) {
                    $a = 0;
                    foreach ($report['data']['thu'] as $thu) {
                        $this->SetX(10);
                        $thu_flags = explode(",", $thu['time']);
                        // if ($thu_flags[2] == 2) {
                        //     $this->setFillColourByStatus($thu_flags[2]);
                        // } else {
                        //     $this->SetFillColor(255, 255, 255);
                        // }
                        if ($thu_flags[2] == 1)
                            $bg_flag = FALSE;
                        else{
                            $bg_flag = TRUE;
                            $this->setFillColourByStatus($thu_flags[2]);
                        }
                        $x_val = $this->GetX();
                        $time_val = explode(".", $thu_flags[0]);
                        if ($a == 0) {
                            $this->Cell(30, 4, $report['thu'][2] . "-" . $report['thu'][1] . "-" . $report['thu'][0], 1, 0, 'L', $bg_flag);
                            $this->SetX($x_val + 20);
                            $this->Cell(10, 4, utf8_decode($smarty->translate['thu']), 'TRB', 0, 'L', $bg_flag);
                        } else {
                            $this->Cell(30, 4, '', 1, 0, 'L', $bg_flag);
                        }
                        if ($thu_flags[2] == 2 && $thu_flags[6] != '')
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $thu_flags[3] . "  " . utf8_decode($leave_type_short[$thu_flags[6]]), 1, 0, 'L', $bg_flag);
                        elseif ($thu_flags[1] == 3)
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $thu_flags[3] . "  " . utf8_decode($smarty->translate['oncall_shortcut']), 1, 0, 'L', $bg_flag);
                        elseif ($thu_flags[1] == 9)
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $thu_flags[3] . "  " . utf8_decode($smarty->translate['cal_training_shortcut']), 1, 0, 'L', $bg_flag);
                        else
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $thu_flags[3], 1, 0, 'L', $bg_flag);
                        $cust = explode(" ", $thu['customer']);
                        if ($emp_flag == 1) {
                            if ($thu_flags[4] != "")
                                $this->Cell(33, 4, utf8_decode($cust[0]) . " (" . substr($thu_flags[4], 0, 1) . substr($thu_flags[5], 0, 1) . ")", 1, 0, 'L', $bg_flag);
                            else
                                $this->Cell(33, 4, utf8_decode($cust[0]), 1, 0, 'L', $bg_flag);
                        }
                        else
                            $this->Cell(33, 4, utf8_decode($thu['customer']), 1, 0, 'L', $bg_flag);
                        $this->SetXY(10, $this->GetY() + 4);
                        $a++;
                        $this->setFillColourByStatus();
                    }
                }
                if (!empty($report['data']['fri'])) {
                    $a = 0;
                    foreach ($report['data']['fri'] as $fri) {
                        $this->SetX(10);
                        $fri_flags = explode(",", $fri['time']);
                        // if ($fri_flags[2] == 2) {
                        //     $this->setFillColourByStatus($fri_flags[2]);
                        // } else {
                        //     $this->SetFillColor(255, 255, 255);
                        // }
                        if ($fri_flags[2] == 1)
                            $bg_flag = FALSE;
                        else{
                            $bg_flag = TRUE;
                            $this->setFillColourByStatus($fri_flags[2]);
                        }
                        $x_val = $this->GetX();
                        $time_val = explode(".", $fri_flags[0]);
                        if ($a == 0) {
                            $this->Cell(30, 4, $report['fri'][2] . "-" . $report['fri'][1] . "-" . $report['fri'][0], 1, 0, 'L', $bg_flag);
                            $this->SetX($x_val + 20);
                            $this->Cell(10, 4, utf8_decode($smarty->translate['fri']), 'TRB', 0, 'L', $bg_flag);
                        } else {
                            $this->Cell(30, 4, '', 1, 0, 'L', $bg_flag);
                        }
                        if ($fri_flags[2] == 2 && $fri_flags[6] != '')
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $fri_flags[3] . "  " . utf8_decode($leave_type_short[$fri_flags[6]]), 1, 0, 'L', $bg_flag);
                        elseif ($fri_flags[1] == 3)
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $fri_flags[3] . "  " . utf8_decode($smarty->translate['oncall_shortcut']), 1, 0, 'L', $bg_flag);
                        elseif ($fri_flags[1] == 9)
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $fri_flags[3] . "  " . utf8_decode($smarty->translate['cal_training_shortcut']), 1, 0, 'L', $bg_flag);
                        else
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $fri_flags[3], 1, 0, 'L', $bg_flag);

                        $cust = explode(" ", $fri['customer']);
                        if ($emp_flag == 1) {
                            if ($fri_flags[4] != "")
                                $this->Cell(33, 4, utf8_decode($cust[0]) . " (" . substr($fri_flags[4], 0, 1) . substr($fri_flags[5], 0, 1) . ")", 1, 0, 'L', $bg_flag);
                            else
                                $this->Cell(33, 4, utf8_decode($cust[0]), 1, 0, 'L', $bg_flag);
                        }
                        else
                            $this->Cell(33, 4, utf8_decode($fri['customer']), 1, 0, 'L', $bg_flag);
                        $this->SetXY(10, $this->GetY() + 4);
                        $a++;
                        $this->setFillColourByStatus();
                    }
                }
                if (!empty($report['data']['sat'])) {
                    $a = 0;
                    foreach ($report['data']['sat'] as $sat) {
                        $this->SetX(10);
                        $sat_flags = explode(",", $sat['time']);
                        // if ($sat_flags[2] == 2) {
                        //     $this->setFillColourByStatus($sat_flags[2]);
                        // } else {
                        //     $this->SetFillColor(255, 255, 255);
                        // }
                        if ($sat_flags[2] == 1)
                            $bg_flag = FALSE;
                        else{
                            $bg_flag = TRUE;
                            $this->setFillColourByStatus($sat_flags[2]);
                        }
                        $x_val = $this->GetX();
                        $time_val = explode(".", $sat_flags[0]);
                        if ($a == 0) {
                            $this->Cell(30, 4, $report['sat'][2] . "-" . $report['sat'][1] . "-" . $report['sat'][0], 1, 0, 'L', $bg_flag);
                            $this->SetX($x_val + 20);
                            $this->Cell(10, 4, utf8_decode($smarty->translate['sat']), 'TRB', 0, 'L', $bg_flag);
                        } else {
                            $this->Cell(30, 4, '', 1, 0, 'L', $bg_flag);
                        }
                        if ($sat_flags[2] == 2 && $sat_flags[6] != '')
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $sat_flags[3] . "  " . utf8_decode($leave_type_short[$sat_flags[6]]), 1, 0, 'L', $bg_flag);
                        elseif ($sat_flags[1] == 3)
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $sat_flags[3] . "  " . utf8_decode($smarty->translate['oncall_shortcut']), 1, 0, 'L', $bg_flag);
                        elseif ($sat_flags[1] == 9)
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $sat_flags[3] . "  " . utf8_decode($smarty->translate['cal_training_shortcut']), 1, 0, 'L', $bg_flag);
                        else
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $sat_flags[3], 1, 0, 'L', $bg_flag);
                        $cust = explode(" ", $sat['customer']);
                        if ($emp_flag == 1) {
                            if ($sat_flags[4] != "")
                                $this->Cell(33, 4, utf8_decode($cust[0]) . " (" . substr($sat_flags[4], 0, 1) . substr($sat_flags[5], 0, 1) . ")", 1, 0, 'L', $bg_flag);
                            else
                                $this->Cell(33, 4, utf8_decode($cust[0]), 1, 0, 'L', $bg_flag);
                        }
                        else
                            $this->Cell(33, 4, utf8_decode($sat['customer']), 1, 0, 'L', $bg_flag);
                        $this->SetXY(10, $this->GetY() + 4);
                        $a++;
                        $this->setFillColourByStatus();
                    }
                }
                if (!empty($report['data']['sun'])) {
                    $a = 0;
                    foreach ($report['data']['sun'] as $sun) {
                        $this->SetX(10);
                        $sun_flags = explode(",", $sun['time']);
                        // if ($sun_flags[2] == 2) {
                        //     $this->setFillColourByStatus($sun_flags[2]);
                        // } else {
                        //     $this->SetFillColor(255, 255, 255);
                        // }
                        if ($sun_flags[2] == 1)
                            $bg_flag = FALSE;
                        else{
                            $bg_flag = TRUE;
                            $this->setFillColourByStatus($sun_flags[2]);
                        }
                        $time_val = explode(".", $sun_flags[0]);
                        $x_val = $this->GetX(); //set border
                        if ($a == 0) {
                            $this->Cell(30, 4, $report['sun'][2] . "-" . $report['sun'][1] . "-" . $report['sun'][0], 1, 0, 'L', $bg_flag);
                            $this->SetX($x_val + 20);
                            $this->Cell(10, 4, utf8_decode($smarty->translate['sun']), 'TRB', 0, 'L', $bg_flag);
                        } else {
                            $this->Cell(30, 4, '', 1, 0, 'L', $bg_flag);
                        }
                        if ($sun_flags[2] == 2 && $sun_flags[6] != '')
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $sun_flags[3] . "  " . utf8_decode($leave_type_short[$sun_flags[6]]), 1, 0, 'L', $bg_flag);
                        elseif ($sun_flags[1] == 3)
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $sun_flags[3] . "  " . utf8_decode($smarty->translate['oncall_shortcut']), 1, 0, 'L', $bg_flag);
                        elseif ($sun_flags[1] == 9)
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $sun_flags[3] . "  " . utf8_decode($smarty->translate['cal_training_shortcut']), 1, 0, 'L', $bg_flag);
                        else
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $sun_flags[3], 1, 0, 'L', $bg_flag);
//                        $this->Cell(32,4,$time_val[0].$time_val[1].$time_val[2].$time_val[3]."   ".$sun_flags[3]."  ",1,0,'L',$bg_flag);
                        $cust = explode(" ", $sun['customer']);
                        if ($emp_flag == 1) {
                            if ($sun_flags[4] != "")
                                $this->Cell(33, 4, utf8_decode($cust[0]) . " (" . substr($sun_flags[4], 0, 1) . substr($sun_flags[5], 0, 1) . ")", 1, 0, 'L', $bg_flag);
                            else
                                $this->Cell(33, 4, utf8_decode($cust[0]), 1, 0, 'L', $bg_flag);
                        }
                        else
                            $this->Cell(33, 4, utf8_decode($sun['customer']), 1, 0, 'L', $bg_flag);
                        $this->SetXY(10, $this->GetY() + 4);
                        $a++;
                        $this->setFillColourByStatus();
                    }
                }
                $pagechange . $this->pages[$this->page];
                $_SESSION['pdf_y_val_even'] = $this->GetY();
            }else {
                if ($page_begin != $this->page) {
                    $pagechange = $this->pages[$this->page];
                    $this->page = $page_begin;
                    $x = 1;
                }
                $page_begin = $this->page;
//                echo 2 ."  ";
//                echo "<pre>". print_r($this->pages, 1)."</pre>";
//                $page_begin = $this->page;
                $this->SetFillColor(255, 255, 255);
//                $i++;
                $this->SetXY(105, $_SESSION['pdf_y_val_odd']);
                $this->Cell(95, 4, utf8_decode('Vecka ' . $report['week']), 1, 1, 'C', FALSE);
                //            echo "<pre>". print_r($report['data']['mon'], 1)."</pre>";

                if (!empty($report['data']['mon'])) {
                    $a = 0;
                    foreach ($report['data']['mon'] as $mon) {
                        $this->SetX(105);
                        $mon_flags = explode(",", $mon['time']);
                        // if ($mon_flags[2] == 2) {
                        //     $this->setFillColourByStatus($mon_flags[2]);
                        // } else {
                        //     $this->SetFillColor(255, 255, 255);
                        // }
                        if ($mon_flags[2] == 1)
                            $bg_flag = FALSE;
                        else{
                            $bg_flag = TRUE;
                            $this->setFillColourByStatus($mon_flags[2]);
                        }
                        $x_val = $this->GetX();
                        $time_val = explode(".", $mon_flags[0]);
                        if ($a == 0) {
                            $this->Cell(30, 4, $report['mon'][2] . "-" . $report['mon'][1] . "-" . $report['mon'][0], 1, 0, 'L', $bg_flag);
                            $this->SetX($x_val + 20);
                            $this->Cell(10, 4, utf8_decode($smarty->translate['mon']), 'TRB', 0, 'L', $bg_flag);
                        } else {
                            $this->Cell(30, 4, '', 1, 0, 'L', $bg_flag);
                        }
                        if ($mon_flags[2] == 2 && $mon_flags[6] != '')
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $mon_flags[3] . "  " . utf8_decode($leave_type_short[$mon_flags[6]]), 1, 0, 'L', $bg_flag);
                        elseif ($mon_flags[1] == 3)
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $mon_flags[3] . "  " . utf8_decode($smarty->translate['oncall_shortcut']), 1, 0, 'L', $bg_flag);
                        elseif ($mon_flags[1] == 9)
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $mon_flags[3] . "  " . utf8_decode($smarty->translate['cal_training_shortcut']), 1, 0, 'L', $bg_flag);
                        else
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $mon_flags[3], 1, 0, 'L', $bg_flag);
                        $cust = explode(" ", $mon['customer']);
                        if ($emp_flag == 1) {
                            if ($mon_flags[4] != "")
                                $this->Cell(33, 4, utf8_decode($cust[0]) . " (" . substr($mon_flags[4], 0, 1) . substr($mon_flags[5], 0, 1) . ")", 1, 0, 'L', $bg_flag);
                            else
                                $this->Cell(33, 4, utf8_decode($cust[0]), 1, 0, 'L', $bg_flag);
                        }
                        else
                            $this->Cell(33, 4, utf8_decode($mon['customer']), 1, 0, 'L', $bg_flag);
                        $this->SetXY(105, $this->GetY() + 4);
                        $a++;
                        $this->setFillColourByStatus();
                    }
                }
                if (!empty($report['data']['tue'])) {
                    $a = 0;
                    foreach ($report['data']['tue'] as $tue) {
                        $this->SetX(105);
                        $tue_flags = explode(",", $tue['time']);
                        // if ($tue_flags[2] == 2) {
                        //     $this->setFillColourByStatus($tue_flags[2]);
                        // } else {
                        //     $this->SetFillColor(255, 255, 255);
                        // }
                        if ($tue_flags[2] == 1)
                            $bg_flag = FALSE;
                        else{
                            $bg_flag = TRUE;
                            $this->setFillColourByStatus($tue_flags[2]);
                        }
                        $x_val = $this->GetX();
                        $time_val = explode(".", $tue_flags[0]);
                        if ($a == 0) {
                            $this->Cell(30, 4, $report['tue'][2] . "-" . $report['tue'][1] . "-" . $report['tue'][0], 1, 0, 'L', $bg_flag);
                            $this->SetX($x_val + 20);
                            $this->Cell(10, 4, utf8_decode($smarty->translate['tue']), 'TRB', 0, 'L', $bg_flag);
                        } else {
                            $this->Cell(30, 4, '', 1, 0, 'L', $bg_flag);
                        }
                        if ($tue_flags[2] == 2 && $tue_flags[6] != '')
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $tue_flags[3] . "  " . utf8_decode($leave_type_short[$tue_flags[6]]), 1, 0, 'L', $bg_flag);
                        elseif ($tue_flags[1] == 3)
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $tue_flags[3] . "  " . utf8_decode($smarty->translate['oncall_shortcut']), 1, 0, 'L', $bg_flag);
                        elseif ($tue_flags[1] == 9)
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $tue_flags[3] . "  " . utf8_decode($smarty->translate['cal_training_shortcut']), 1, 0, 'L', $bg_flag);
                        else
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $tue_flags[3], 1, 0, 'L', $bg_flag);
                        $cust = explode(" ", $tue['customer']);
                        if ($emp_flag == 1) {
                            if ($tue_flags[4] != "")
                                $this->Cell(33, 4, utf8_decode($cust[0]) . " (" . substr($tue_flags[4], 0, 1) . substr($tue_flags[5], 0, 1) . ")", 1, 0, 'L', $bg_flag);
                            else
                                $this->Cell(33, 4, utf8_decode($cust[0]), 1, 0, 'L', $bg_flag);
                        }
                        else
                            $this->Cell(33, 4, utf8_decode($tue['customer']), 1, 0, 'L', $bg_flag);
                        $this->SetXY(105, $this->GetY() + 4);
                        $a++;
                        $this->setFillColourByStatus();
                    }
                }
                if (!empty($report['data']['wed'])) {
                    $a = 0;
                    foreach ($report['data']['wed'] as $wed) {
                        $this->SetX(105);
                        $wed_flags = explode(",", $wed['time']);
                        // if ($wed_flags[2] == 2) {
                        //     $this->setFillColourByStatus($wed_flags[2]);
                        // } else {
                        //     $this->SetFillColor(255, 255, 255);
                        // }
                        if ($wed_flags[2] == 1)
                            $bg_flag = FALSE;
                        else{
                            $bg_flag = TRUE;
                            $this->setFillColourByStatus($wed_flags[2]);
                        }
                        $x_val = $this->GetX();
                        $time_val = explode(".", $wed_flags[0]);
                        if ($a == 0) {
                            $this->Cell(30, 4, $report['wed'][2] . "-" . $report['wed'][1] . "-" . $report['wed'][0], 1, 0, 'L', $bg_flag);
                            $this->SetX($x_val + 20);
                            $this->Cell(10, 4, utf8_decode($smarty->translate['wed']), 'TRB', 0, 'L', $bg_flag);
                        } else {
                            $this->Cell(30, 4, '', 1, 0, 'L', $bg_flag);
                        }
                        if ($wed_flags[2] == 2 && $wed_flags[6] != '')
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $wed_flags[3] . "  " . utf8_decode($leave_type_short[$wed_flags[6]]), 1, 0, 'L', $bg_flag);
                        elseif ($wed_flags[1] == 3)
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $wed_flags[3] . "  " . utf8_decode($smarty->translate['oncall_shortcut']), 1, 0, 'L', $bg_flag);
                        elseif ($wed_flags[1] == 9)
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $wed_flags[3] . "  " . utf8_decode($smarty->translate['cal_training_shortcut']), 1, 0, 'L', $bg_flag);
                        else
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $wed_flags[3], 1, 0, 'L', $bg_flag);
                        $cust = explode(" ", $wed['customer']);
                        if ($emp_flag == 1) {
                            if ($wed_flags[4] != "")
                                $this->Cell(33, 4, utf8_decode($cust[0]) . " (" . substr($wed_flags[4], 0, 1) . substr($wed_flags[5], 0, 1) . ")", 1, 0, 'L', $bg_flag);
                            else
                                $this->Cell(33, 4, utf8_decode($cust[0]), 1, 0, 'L', $bg_flag);
                        }
                        else
                            $this->Cell(33, 4, utf8_decode($wed['customer']), 1, 0, 'L', $bg_flag);
                        $this->SetXY(105, $this->GetY() + 4);
                        $a++;
                        $this->setFillColourByStatus();
                    }
                }
                if (!empty($report['data']['thu'])) {
                    $a = 0;
                    foreach ($report['data']['thu'] as $thu) {
                        $this->SetX(105);
                        $thu_flags = explode(",", $thu['time']);
                        // if ($thu_flags[2] == 2) {
                        //     $this->setFillColourByStatus($thu_flags[2]);
                        // } else {
                        //     $this->SetFillColor(255, 255, 255);
                        // }
                        if ($thu_flags[2] == 1)
                            $bg_flag = FALSE;
                        else{
                            $bg_flag = TRUE;
                            $this->setFillColourByStatus($thu_flags[2]);
                        }
                        $x_val = $this->GetX();
                        $time_val = explode(".", $thu_flags[0]);
                        if ($a == 0) {
                            $this->Cell(30, 4, $report['thu'][2] . "-" . $report['thu'][1] . "-" . $report['thu'][0], 1, 0, 'L', $bg_flag);
                            $this->SetX($x_val + 20);
                            $this->Cell(10, 4, utf8_decode($smarty->translate['thu']), 'TRB', 0, 'L', $bg_flag);
                        } else {
                            $this->Cell(30, 4, '', 1, 0, 'L', $bg_flag);
                        }
                        if ($thu_flags[2] == 2 && $thu_flags[6] != '')
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $thu_flags[3] . "  " . utf8_decode($leave_type_short[$thu_flags[6]]), 1, 0, 'L', $bg_flag);
                        elseif ($thu_flags[1] == 3)
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $thu_flags[3] . "  " . utf8_decode($smarty->translate['oncall_shortcut']), 1, 0, 'L', $bg_flag);
                        elseif ($thu_flags[1] == 9)
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $thu_flags[3] . "  " . utf8_decode($smarty->translate['cal_training_shortcut']), 1, 0, 'L', $bg_flag);
                        else
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $thu_flags[3], 1, 0, 'L', $bg_flag);
                        $cust = explode(" ", $thu['customer']);
                        if ($emp_flag == 1) {
                            if ($thu_flags[4] != "")
                                $this->Cell(33, 4, utf8_decode($cust[0]) . " (" . substr($thu_flags[4], 0, 1) . substr($thu_flags[5], 0, 1) . ")", 1, 0, 'L', $bg_flag);
                            else
                                $this->Cell(33, 4, utf8_decode($cust[0]), 1, 0, 'L', $bg_flag);
                        }
                        else
                            $this->Cell(33, 4, utf8_decode($thu['customer']), 1, 0, 'L', $bg_flag);
                        $this->SetXY(105, $this->GetY() + 4);
                        $a++;
                        $this->setFillColourByStatus();
                    }
                }
                if (!empty($report['data']['fri'])) {
                    $a = 0;
                    foreach ($report['data']['fri'] as $fri) {
                        $this->SetX(105);
                        $fri_flags = explode(",", $fri['time']);
                        // if ($fri_flags[2] == 2) {
                        //     $this->setFillColourByStatus($fri_flags[2]);
                        // } else {
                        //     $this->SetFillColor(255, 255, 255);
                        // }
                        if ($fri_flags[2] == 1)
                            $bg_flag = FALSE;
                        else{
                            $bg_flag = TRUE;
                            $this->setFillColourByStatus($fri_flags[2]);
                        }
                        $x_val = $this->GetX();
                        $time_val = explode(".", $fri_flags[0]);
                        if ($a == 0) {
                            $this->Cell(30, 4, $report['fri'][2] . "-" . $report['fri'][1] . "-" . $report['fri'][0], 1, 0, 'L', $bg_flag);
                            $this->SetX($x_val + 20);
                            $this->Cell(10, 4, utf8_decode($smarty->translate['fri']), 'TRB', 0, 'L', $bg_flag);
                        } else {
                            $this->Cell(30, 4, '', 1, 0, 'L', $bg_flag);
                        }
                        if ($fri_flags[2] == 2 && $fri_flags[6] != '')
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $fri_flags[3] . "  " . utf8_decode($leave_type_short[$fri_flags[6]]), 1, 0, 'L', $bg_flag);
                        elseif ($fri_flags[1] == 3)
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $fri_flags[3] . "  " . utf8_decode($smarty->translate['oncall_shortcut']), 1, 0, 'L', $bg_flag);
                        elseif ($fri_flags[1] == 9)
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $fri_flags[3] . "  " . utf8_decode($smarty->translate['cal_training_shortcut']), 1, 0, 'L', $bg_flag);
                        else
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $fri_flags[3], 1, 0, 'L', $bg_flag);
                        $cust = explode(" ", $fri['customer']);
                        if ($emp_flag == 1) {
                            if ($fri_flags[4] != "")
                                $this->Cell(33, 4, utf8_decode($cust[0]) . " (" . substr($fri_flags[4], 0, 1) . substr($fri_flags[5], 0, 1) . ")", 1, 0, 'L', $bg_flag);
                            else
                                $this->Cell(33, 4, utf8_decode($cust[0]), 1, 0, 'L', $bg_flag);
                        }
                        else
                            $this->Cell(33, 4, utf8_decode($fri['customer']), 1, 0, 'L', $bg_flag);
                        $this->SetXY(105, $this->GetY() + 4);
                        $a++;
                        $this->setFillColourByStatus();
                    }
                }
                if (!empty($report['data']['sat'])) {
                    $a = 0;
                    foreach ($report['data']['sat'] as $sat) {
                        $this->SetX(105);
                        $sat_flags = explode(",", $sat['time']);
                        // if ($sat_flags[2] == 2) {
                        //     $this->setFillColourByStatus($sat_flags[2]);
                        // } else {
                        //     $this->SetFillColor(255, 255, 255);
                        // }
                        if ($sat_flags[2] == 1)
                            $bg_flag = FALSE;
                        else{
                            $bg_flag = TRUE;
                            $this->setFillColourByStatus($sat_flags[2]);
                        }
                        $x_val = $this->GetX();
                        $time_val = explode(".", $sat_flags[0]);
                        if ($a == 0) {
                            $this->Cell(30, 4, $report['sat'][2] . "-" . $report['sat'][1] . "-" . $report['sat'][0], 1, 0, 'L', $bg_flag);
                            $this->SetX($x_val + 20);
                            $this->Cell(10, 4, utf8_decode($smarty->translate['sat']), 'TRB', 0, 'L', $bg_flag);
                        } else {
                            $this->Cell(30, 4, '', 1, 0, 'L', $bg_flag);
                        }
                        if ($sat_flags[2] == 2 && $sat_flags[6] != '')
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $sat_flags[3] . "  " . utf8_decode($leave_type_short[$sat_flags[6]]), 1, 0, 'L', $bg_flag);
                        elseif ($sat_flags[1] == 3)
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $sat_flags[3] . "  " . utf8_decode($smarty->translate['oncall_shortcut']), 1, 0, 'L', $bg_flag);
                        elseif ($sat_flags[1] == 9)
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $sat_flags[3] . "  " . utf8_decode($smarty->translate['cal_training_shortcut']), 1, 0, 'L', $bg_flag);
                        else
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $sat_flags[3], 1, 0, 'L', $bg_flag);
                        $cust = explode(" ", $sat['customer']);
                        if ($emp_flag == 1) {
                            if ($sat_flags[4] != "")
                                $this->Cell(33, 4, utf8_decode($cust[0]) . " (" . substr($sat_flags[4], 0, 1) . substr($sat_flags[5], 0, 1) . ")", 1, 0, 'L', $bg_flag);
                            else
                                $this->Cell(33, 4, utf8_decode($cust[0]), 1, 0, 'L', $bg_flag);
                        }
                        else
                            $this->Cell(33, 4, utf8_decode($sat['customer']), 1, 0, 'L', $bg_flag);
                        $this->SetXY(105, $this->GetY() + 4);
                        $a++;
                        $this->setFillColourByStatus();
                    }
                }
                if (!empty($report['data']['sun'])) {
                    $a = 0;
                    foreach ($report['data']['sun'] as $sun) {
                        $this->SetX(105);
                        $sun_flags = explode(",", $sun['time']);
                        // if ($sun_flags[2] == 2) {
                        //     $this->setFillColourByStatus($sun_flags[2]);
                        // } else {
                        //     $this->SetFillColor(255, 255, 255);
                        // }
                        if ($sun_flags[2] == 1)
                            $bg_flag = FALSE;
                        else{
                            $bg_flag = TRUE;
                            $this->setFillColourByStatus($sun_flags[2]);
                        }
                        $x_val = $this->GetX();
                        $time_val = explode(".", $sun_flags[0]);
                        if ($a == 0) {
                            $this->Cell(30, 4, $report['sun'][2] . "-" . $report['sun'][1] . "-" . $report['sun'][0], 1, 0, 'L', $bg_flag);
                            $this->SetX($x_val + 20);
                            $this->Cell(10, 4, utf8_decode($smarty->translate['sun']), 'TRB', 0, 'L', $bg_flag);
                        } else {
                            $this->Cell(30, 4, '', 1, 0, 'L', $bg_flag);
                        }
                        if ($sun_flags[2] == 2 && $sun_flags[6] != '')
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $sun_flags[3] . "  " . utf8_decode($leave_type_short[$sun_flags[6]]), 1, 0, 'L', $bg_flag);
                        elseif ($sun_flags[1] == 3)
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $sun_flags[3] . "  " . utf8_decode($smarty->translate['oncall_shortcut']), 1, 0, 'L', $bg_flag);
                        elseif ($sun_flags[1] == 9)
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $sun_flags[3] . "  " . utf8_decode($smarty->translate['cal_training_shortcut']), 1, 0, 'L', $bg_flag);
                        else
                            $this->Cell(32, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $sun_flags[3], 1, 0, 'L', $bg_flag);
                        $cust = explode(" ", $sun['customer']);
                        if ($emp_flag == 1) {
                            if ($sun_flags[4] != "")
                                $this->Cell(33, 4, utf8_decode($cust[0]) . " (" . substr($sun_flags[4], 0, 1) . substr($sun_flags[5], 0, 1) . ")", 1, 0, 'L', $bg_flag);
                            else
                                $this->Cell(33, 4, utf8_decode($cust[0]), 1, 0, 'L', $bg_flag);
                        }
                        else
                            $this->Cell(33, 4, utf8_decode($sun['customer']), 1, 0, 'L', $bg_flag);
                        $this->SetXY(105, $this->GetY() + 4);
                        $a++;
                        $this->setFillColourByStatus();
                    }
                }
                $this->setFillColourByStatus();

                if ($sizes[$i] < $sizes[$i - 1]) {
//                    echo ""
                    $this->SetX(105);
//                    echo ($sizes[$i-1]-$sizes[$i])-1;
                    for ($j = 0; $j < ($sizes[$i - 1] - $sizes[$i]) - 1; $j++) {
//                        echo $this->GetY()."<br>";
                        if ($this->GetY() > 270) {
                            $this->Cell(95, 4, '', 'LRT', 1, 'C', FALSE);
                            $this->SetXY(105, $this->GetY());
                        } else if ($this->GetY() > 265) {
                            $this->Cell(94, 4, '', 'LRB', 1, 'C', FALSE);
                            $this->SetXY(105, $this->GetY());
                        } else if ($this->GetY() < 16) {
                            $this->Cell(95, 4, '', 'LRT', 1, 'C', FALSE);
                            $this->SetXY(105, $this->GetY());
                        } else {
                            $this->Cell(95, 4, '', 'LR', 1, 'C', FALSE);
                            $this->SetXY(105, $this->GetY());
                        }
//                        echo $this->GetY()."<br>";
//                        $this->Cell(132.5, 6,'','LR',1,'C',FALSE);
//                        $this->SetXY(105,$this->GetY());
                    }
                    if ($this->GetY() < 16) {
                        $this->Cell(95, 4, '', 'LRBT', 1, 'C', FALSE);
                        $this->SetXY(105, $this->GetY());
                    } else if ($this->GetY() > 270) {
                        $this->Cell(95, 4, '', 'LRBT', 1, 'C', FALSE);
                        $this->SetXY(105, $this->GetY());
                    } else {
                        $this->Cell(95, 4, '', 'LRB', 1, 'C', FALSE);
                        $this->SetXY(105, $this->GetY());
                    }
                } else {

                    $this->SetXY(10, $_SESSION['pdf_y_val_even']);

                    for ($j = 0; $j < ($sizes[$i] - $sizes[$i - 1]) - 1; $j++) {
                        if ($this->GetY() > 270) {
                            $this->Cell(95, 4, '', 'LRT', 1, 'C', FALSE);
                            $this->SetXY(10, $this->GetY());
                        } else if ($this->GetY() > 268) {
                            $this->Cell(95, 4, 6, '', 'LRB', 1, 'C', FALSE);
                            $this->SetXY(10, $this->GetY());
                        } else if ($this->GetY() < 14) {
                            $this->Cell(95, 4, '', 'LRT', 1, 'C', FALSE);
                            $this->SetXY(10, $this->GetY());
                        } else {
                            $this->Cell(95, 4, '', 'LR', 1, 'C', FALSE);
                            $this->SetXY(10, $this->GetY());
                        }
//                        echo $this->GetY()."<br>";
//                        $this->Cell(132.5, 6,'','LR',1,'C',FALSE);
//                        $this->SetXY(105,$this->GetY());
                    }
                    if ($this->GetY() < 14) {
                        $this->Cell(95, 4, '', 'LRBT', 1, 'C', FALSE);
                        $this->SetXY(10, $this->GetY());
                    } else if ($this->GetY() > 270) {
                        $this->Cell(95, 4, 6, '', 'LRBT', 1, 'C', FALSE);
                        $this->SetXY(10, $this->GetY());
                    } else {
                        $this->Cell(95, 4, '', 'LRB', 1, 'C', FALSE);
                        $this->SetXY(10, $this->GetY());
                    }
                }
                if ($x == 1) {
                    $this->pages[$this->page] = $pagechange . $this->pages[$this->page];
                }
                $pagechange . $this->pages[$this->page];
                $i++;
                $_SESSION['pdf_y_val_odd'] = $this->GetY();
                $_SESSION['pdf_y_val_even'] = $this->GetY();
            }
        }
    }

    function htmltable($year, $month) {
        $smarty = new smartySetup(array("user.xml", "month.xml", "messages.xml", "button.xml", "forms.xml"), FALSE);
        $this->SetFillColor(255, 255, 255);
        $table_head_content = array("Sön", "Mån", "Tis", "Ons", "Tors", "Fre", "Lör", "Summa");
        $weeks = array("sun", "mon", "tue", "wed", "thu", "fri", "sat");
        $html = '<table width="100%" border="0" cellpadding="0" cellspacing="0">';
        $size = array();
        for ($i = 0; $i < count($this->rpt_contents); $i++) {
            $counts = count($this->rpt_contents[$i]['data']['sun']) + count($this->rpt_contents[$i]['data']['mon']) + count($this->rpt_contents[$i]['data']['tue']) + count($this->rpt_contents[$i]['data']['wed']) + count($this->rpt_contents[$i]['data']['thu']) + count($this->rpt_contents[$i]['data']['fri']) + count($this->rpt_contents[$i]['data']['sat']);
            $size [] = $counts;
        }
        for ($i = 0; $i < count($this->rpt_contents); $i = $i + 2) {
            $html .= '<tr><td><table width="100%" border="1" cellspacing="0" cellpadding="0">
                    <tr height="27">
                        <td colspan="3">Vecka ' . $this->rpt_contents[$i]['week'] . '</td>
                    </tr>';
            if (!empty($this->rpt_contents[$i]['data']['sun'])) {
                foreach ($this->rpt_contents[$i]['data']['sun'] as $thu) {
                    $thu_flags = explode(",", $thu['time']);
                    $time_val = explode(".", $thu_flags[0]);
                    $html .= '<tr height="27">
                            <td  bgcolor="#efeeee">' . $year . "-" . $month . "-" . $this->rpt_contents[$i]['sun'] . '     ' . utf8_decode($smarty->translate['thu']) . '</td>
                            <td  bgcolor="#efeeee">' . $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $thu_flags[3] . '</td>
                            <td  bgcolor="#efeeee">' . utf8_decode($thu['customer']) . '</td>
                          </tr>';
                }
            }
            if (!empty($this->rpt_contents[$i]['data']['mon'])) {
                foreach ($this->rpt_contents[$i]['data']['mon'] as $thu) {
                    $thu_flags = explode(",", $thu['time']);
                    $time_val = explode(".", $thu_flags[0]);
                    $html .= '<tr height="27">
                            <td  bgcolor="#efeeee">' . $year . "-" . $month . "-" . $this->rpt_contents[$i]['mon'] . '     ' . utf8_decode($smarty->translate['thu']) . '</td>
                            <td  bgcolor="#efeeee">' . $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $thu_flags[3] . '</td>
                            <td  bgcolor="#efeeee">' . utf8_decode($thu['customer']) . '</td>
                          </tr>';
                }
            }
            if (!empty($this->rpt_contents[$i]['data']['tue'])) {
                foreach ($this->rpt_contents[$i]['data']['tue'] as $thu) {
                    $thu_flags = explode(",", $thu['time']);
                    $time_val = explode(".", $thu_flags[0]);
                    $html .= '<tr height="27">
                            <td  bgcolor="#efeeee">' . $year . "-" . $month . "-" . $this->rpt_contents[$i]['tue'] . '     ' . utf8_decode($smarty->translate['thu']) . '</td>
                            <td  bgcolor="#efeeee">' . $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $thu_flags[3] . '</td>
                            <td  bgcolor="#efeeee">' . utf8_decode($thu['customer']) . '</td>
                          </tr>';
                }
            }
            if (!empty($this->rpt_contents[$i]['data']['wed'])) {
                foreach ($this->rpt_contents[$i]['data']['wed'] as $thu) {
                    $thu_flags = explode(",", $thu['time']);
                    $time_val = explode(".", $thu_flags[0]);
                    $html .= '<tr height="27">
                            <td  bgcolor="#efeeee">' . $year . "-" . $month . "-" . $this->rpt_contents[$i]['wed'] . '     ' . utf8_decode($smarty->translate['thu']) . '</td>
                            <td  bgcolor="#efeeee">' . $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $thu_flags[3] . '</td>
                            <td  bgcolor="#efeeee">' . utf8_decode($thu['customer']) . '</td>
                          </tr>';
                }
            }
            if (!empty($this->rpt_contents[$i]['data']['thu'])) {
                foreach ($this->rpt_contents[$i]['data']['thu'] as $thu) {
                    $thu_flags = explode(",", $thu['time']);
                    $time_val = explode(".", $thu_flags[0]);
                    $html .= '<tr height="27">
                            <td  bgcolor="#efeeee">' . $year . "-" . $month . "-" . $this->rpt_contents[$i]['thu'] . '     ' . utf8_decode($smarty->translate['thu']) . '</td>
                            <td  bgcolor="#efeeee">' . $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $thu_flags[3] . '</td>
                            <td  bgcolor="#efeeee">' . utf8_decode($thu['customer']) . '</td>
                          </tr>';
                }
            }
            if (!empty($this->rpt_contents[$i]['data']['fri'])) {
                foreach ($this->rpt_contents[$i]['data']['fri'] as $thu) {
                    $thu_flags = explode(",", $thu['time']);
                    $time_val = explode(".", $thu_flags[0]);
                    $html .= '<tr height="27">
                            <td  bgcolor="#efeeee">' . $year . "-" . $month . "-" . $this->rpt_contents[$i]['fri'] . '     ' . utf8_decode($smarty->translate['thu']) . '</td>
                            <td  bgcolor="#efeeee">' . $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $thu_flags[3] . '</td>
                            <td  bgcolor="#efeeee">' . utf8_decode($thu['customer']) . '</td>
                          </tr>';
                }
            }
            if (!empty($this->rpt_contents[$i]['data']['sat'])) {
                foreach ($this->rpt_contents[$i]['data']['sat'] as $thu) {
                    $thu_flags = explode(",", $thu['time']);
                    $time_val = explode(".", $thu_flags[0]);
                    $html .= '<tr height="27">
                            <td  bgcolor="#efeeee">' . $year . "-" . $month . "-" . $this->rpt_contents[$i]['sat'] . '     ' . utf8_decode($smarty->translate['thu']) . '</td>
                            <td  bgcolor="#efeeee">' . $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $thu_flags[3] . '</td>
                            <td  bgcolor="#efeeee">' . utf8_decode($thu['customer']) . '</td>
                          </tr>';
                }
            }
            if ($size[$i + 1] > $size[$i]) {
                for ($j = 0; $j < $size[$i + 1] - $size[$i]; $j++) {
                    $html .= '<tr height="27" style="border:none"><td colspan="3"></td></tr>';
                }
            }
            if ($size[$i + 1] != "" || $size[$i + 1] != NULL) {
                $html .= '</table></td><td><table width="100%" border="1" cellspacing="0" cellpadding="0">
                        <tr height="27">
                            <td colspan="3">Vecka ' . $this->rpt_contents[$i + 1]['week'] . '</td>
                        </tr>';
                if (!empty($this->rpt_contents[$i + 1]['data']['sun'])) {
                    foreach ($this->rpt_contents[$i + 1]['data']['sun'] as $thu) {
                        $thu_flags = explode(",", $thu['time']);
                        $time_val = explode(".", $thu_flags[0]);
                        $html .= '<tr height="27">
                                <td  bgcolor="#efeeee">' . $year . "-" . $month . "-" . $this->rpt_contents[$i + 1]['sun'] . '     ' . utf8_decode($smarty->translate['thu']) . '</td>
                                <td  bgcolor="#efeeee">' . $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $thu_flags[3] . '</td>
                                <td  bgcolor="#efeeee">' . utf8_decode($thu['customer']) . '</td>
                              </tr>';
                    }
                }
                if (!empty($this->rpt_contents[$i + 1]['data']['mon'])) {
                    foreach ($this->rpt_contents[$i + 1]['data']['mon'] as $thu) {
                        $thu_flags = explode(",", $thu['time']);
                        $time_val = explode(".", $thu_flags[0]);
                        $html .= '<tr height="27">
                                <td  bgcolor="#efeeee">' . $year . "-" . $month . "-" . $this->rpt_contents[$i + 1]['mon'] . '     ' . utf8_decode($smarty->translate['thu']) . '</td>
                                <td  bgcolor="#efeeee">' . $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $thu_flags[3] . '</td>
                                <td  bgcolor="#efeeee">' . utf8_decode($thu['customer']) . '</td>
                              </tr>';
                    }
                }
                if (!empty($this->rpt_contents[$i + 1]['data']['tue'])) {
                    foreach ($this->rpt_contents[$i + 1]['data']['tue'] as $thu) {
                        $thu_flags = explode(",", $thu['time']);
                        $time_val = explode(".", $thu_flags[0]);
                        $html .= '<tr height="27">
                                <td  bgcolor="#efeeee">' . $year . "-" . $month . "-" . $this->rpt_contents[$i + 1]['tue'] . '     ' . utf8_decode($smarty->translate['thu']) . '</td>
                                <td  bgcolor="#efeeee">' . $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $thu_flags[3] . '</td>
                                <td  bgcolor="#efeeee">' . utf8_decode($thu['customer']) . '</td>
                              </tr>';
                    }
                }
                if (!empty($this->rpt_contents[$i + 1]['data']['wed'])) {
                    foreach ($this->rpt_contents[$i + 1]['data']['wed'] as $thu) {
                        $thu_flags = explode(",", $thu['time']);
                        $time_val = explode(".", $thu_flags[0]);
                        $html .= '<tr height="27">
                                <td  bgcolor="#efeeee">' . $year . "-" . $month . "-" . $this->rpt_contents[$i + 1]['wed'] . '     ' . utf8_decode($smarty->translate['thu']) . '</td>
                                <td  bgcolor="#efeeee">' . $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $thu_flags[3] . '</td>
                                <td  bgcolor="#efeeee">' . utf8_decode($thu['customer']) . '</td>
                              </tr>';
                    }
                }
                if (!empty($this->rpt_contents[$i + 1]['data']['thu'])) {
                    foreach ($this->rpt_contents[$i + 1]['data']['thu'] as $thu) {
                        $thu_flags = explode(",", $thu['time']);
                        $time_val = explode(".", $thu_flags[0]);
                        $html .= '<tr height="27">
                                <td  bgcolor="#efeeee">' . $year . "-" . $month . "-" . $this->rpt_contents[$i + 1]['thu'] . '     ' . utf8_decode($smarty->translate['thu']) . '</td>
                                <td  bgcolor="#efeeee">' . $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $thu_flags[3] . '</td>
                                <td  bgcolor="#efeeee">' . utf8_decode($thu['customer']) . '</td>
                              </tr>';
                    }
                }
                if (!empty($this->rpt_contents[$i + 1]['data']['fri'])) {
                    foreach ($this->rpt_contents[$i + 1]['data']['fri'] as $thu) {
                        $thu_flags = explode(",", $thu['time']);
                        $time_val = explode(".", $thu_flags[0]);
                        $html .= '<tr height="27">
                                <td  bgcolor="#efeeee">' . $year . "-" . $month . "-" . $this->rpt_contents[$i + 1]['fri'] . '     ' . utf8_decode($smarty->translate['thu']) . '</td>
                                <td  bgcolor="#efeeee">' . $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $thu_flags[3] . '</td>
                                <td  bgcolor="#efeeee">' . utf8_decode($thu['customer']) . '</td>
                              </tr>';
                    }
                }
                if (!empty($this->rpt_contents[$i + 1]['data']['sat'])) {
                    foreach ($this->rpt_contents[$i + 1]['data']['sat'] as $thu) {
                        $thu_flags = explode(",", $thu['time']);
                        $time_val = explode(".", $thu_flags[0]);
                        $html .= '<tr height="27">
                                <td  bgcolor="#efeeee">' . $year . "-" . $month . "-" . $this->rpt_contents[$i + 1]['sat'] . '     ' . utf8_decode($smarty->translate['thu']) . '</td>
                                <td  bgcolor="#efeeee">' . $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $thu_flags[3] . '</td>
                                <td  bgcolor="#efeeee">' . utf8_decode($thu['customer']) . '</td>
                              </tr>';
                    }
                }
                if ($size[$i] > $size[$i + 1]) {
                    for ($j = 0; $j < $size[$i] - $size[$i + 1]; $j++) {
                        $html .= '<tr height="27" ><td colspan="3"></td></tr>';
                    }
                }
            }
            $html .= '</table></td></tr>';
        }
        $html .= '</table>';
//        return $html;
        echo $html;
    }


    function P1_Part1_for_excel($employee, $total_number_of_columns) {
        $start_date = $this->report_start_date;
        $end_date = $this->report_end_date;

        $smarty = new smartySetup(array("reports.xml"), FALSE);

        $html = '<tr bgcolor="#DAF2F7" style="background:#DAF2F7; color:#666; font-size=17px;">
                        <th colspan="'.$total_number_of_columns.'">'.utf8_decode($smarty->translate['employee_month_report_pdf']).'</th>
                    </tr>';

        if ($employee) {

            $first_column_span  = floor($total_number_of_columns/2);
            $second_column_span = ceil($total_number_of_columns/2);

            $html .= '<tr bgcolor="#DAF2F7"  style="background:#DAF2F7; color:#666;">
                        <th colspan="'.$first_column_span.'">'.utf8_decode($smarty->translate['employee_report_employee_name']).'</th>
                        <th colspan="'.$second_column_span.'">'.utf8_decode($smarty->translate['employee_report_socialsecurity']).'</th>
                    </tr>
                    <tr>
                        <td colspan="'.$first_column_span.'">'.utf8_decode($employee['first_name'] . " " . $employee['last_name']).'</td>
                        <td colspan="'.$second_column_span.'">'.$employee['social_security'].'</td>
                    </tr>';
        }


        $this->SetXY(18, $this->GetY() - 2);
       // $this->Cell(265, 11, '', 1, 0, 'L', TRUE);

        if ($year % 400 == 0 || ($year % 100 != 0 && $year % 4 == 0))
            $month_days = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
        else
            $month_days = array(31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

        $html .= '<tr  bgcolor="#DAF2F7"  style="background:#DAF2F7; color:#666;">
                        <th colspan="'.$total_number_of_columns.'">'.utf8_decode($smarty->translate['report_period']).'</th>
                    </tr>
                    <tr>
                        <td colspan="'.$total_number_of_columns.'">'.utf8_decode($start_date . ' -- ' . $end_date).'</td>
                    </tr>';

        $first_column_span  = $second_column_span =  floor($total_number_of_columns/3);
        $third_column_span = $total_number_of_columns-$first_column_span-$second_column_span;

        $html .= '<tr><td colspan="'.$total_number_of_columns.'"></td></tr>
                    <tr bgcolor="#DAF2F7"  style="background:#DAF2F7; color:#666;">
                        <th colspan="'.$first_column_span.'">'.utf8_decode($smarty->translate['contract_hour']).'</th>
                        <th colspan="'.$second_column_span.'">'.utf8_decode($smarty->translate['worked_hour']).'</th>
                        <th colspan="'.$third_column_span.'">'.utf8_decode($smarty->translate['oncall_worked_hour']).'</th>
                    </tr>
                    <tr>
                        <td colspan="'.$first_column_span.'">'.$this->contract_hours.'</td>
                        <td colspan="'.$second_column_span.'">'.$this->time_sum.'</td>
                        <td colspan="'.$third_column_span.'">'.$this->oncall_worked.'</td>
                    </tr>';

        return $html;
    }

    function P1_Part2_for_excel($emp_flag, $total_number_of_columns) {
        $smarty = new smartySetup(array("user.xml", "month.xml", "messages.xml", "button.xml", "forms.xml"), FALSE);
        global $leave_type_short;

        $w = array(33, 33, 33, 33, 33, 33, 33, 33);
        $table_head_content = array("Mån", "Tis", "Ons", "Tors", "Fre", "Lör", "Sön", "Summa");
        $weeks = array("mon", "tue", "wed", "thu", "fri", "sat", "sun");
        $col_h = 4;
        $col_h_w = 8;
        $i = 0;

        $html .= '<tr><td colspan="'.$total_number_of_columns.'"></td></tr>';

        foreach ($this->rpt_contents as $report) {

            $html .= '<tr bgcolor="#DAF2F7" style="background:#DAF2F7; color:#666; font-size=17px;">
                        <th colspan="'.$total_number_of_columns.'">'.utf8_decode('Vecka ' . $report['week']).'</th>
                    </tr>';

            $html .= '<tr bgcolor="#DAF2F7" style="background:#DAF2F7; color:#666; font-size=17px;">';

            for ($m = 0; $m < 8; $m++) {     //set column headings for each table
                $html .= '<th>'.utf8_decode($table_head_content[$m]) . "  " . $report[$weeks[$m]][0].'</th>';
            }
            $html .= '</tr>';


            $controller = array(1 => 'mon', 2 => 'tue', 3 => 'wed', 4 => 'thu', 5 => 'fri', 6 => 'sat', 7 => 'sun');
            foreach ($controller as $w_key => $day_thread) {
                $indx = 0;
                $html .= '<td>';
                if (!empty($report['data'][$day_thread])) {
                    foreach ($report['data'][$day_thread] as $day_val) {

                        $man = explode(',', $day_val['time']);

                        $additional_label = '';

                        if ($man[2] == 2 && $man[6] != '') $additional_label = utf8_decode($leave_type_short[$man[6]]);
                        elseif ($man[1] == 0) $additional_label = utf8_decode($smarty->translate['working_shortcut']);
                        elseif ($man[1] == 1) $additional_label = utf8_decode($smarty->translate['travel_shortcut']);
                        elseif ($man[1] == 2) $additional_label = utf8_decode($smarty->translate['lunch_shortcut']);
                        elseif ($man[1] == 3) $additional_label = utf8_decode($smarty->translate['oncall_shortcut']);
                        elseif ($man[1] == 4) $additional_label = utf8_decode($smarty->translate['overtime_shortcut']);
                        elseif ($man[1] == 5) $additional_label = utf8_decode($smarty->translate['more_overtime_shortcut']);
                        elseif ($man[1] == 6) $additional_label = utf8_decode($smarty->translate['quality_overtime_shortcut']);
                        elseif ($man[1] == 7) $additional_label = utf8_decode($smarty->translate['some_othertime_shortcut']);
                        elseif ($man[1] == 8) $additional_label = utf8_decode($smarty->translate['training_time_shortcut']);
                        elseif ($man[1] == 9) $additional_label = utf8_decode($smarty->translate['cal_training_shortcut']);
                        elseif ($man[1] == 10) $additional_label = utf8_decode($smarty->translate['personal_meeting_shortcut']);
                        elseif ($man[1] == 11) $additional_label = utf8_decode($smarty->translate['voluntary_shortcut']);
                        elseif ($man[1] == 12) $additional_label = utf8_decode($smarty->translate['complementary_shortcut']);
                        elseif ($man[1] == 13) $additional_label = utf8_decode($smarty->translate['complementary_oncall_shortcut']);
                        elseif ($man[1] == 14) $additional_label = utf8_decode($smarty->translate['more_oncall_shortcut']);
                        elseif ($man[1] == 16) $additional_label = utf8_decode($smarty->translate['work_for_dismissal_shortcut']);

                        $html .= utf8_decode($man[0]);

                        $cust = explode(" ", $day_val['customer']);
                        if ($emp_flag == 1)
                            $html .= " ". utf8_decode($cust[1]) . " (" . substr($man[4], 0, 1) . substr($man[5], 0, 1) . ")";
                        else
                            $html .= " ". utf8_decode($cust[1]);

                        $html .= "  ". $additional_label .'<br/>';
                        ++$indx;
                    }
                }
                $html .= '</td>';
            }

            $html .= '<td>'.utf8_decode($report['data']['sum']).'</td>';
            $html .= '</tr>';

            $html .= '<tr bgcolor="#dadaf7" style="background:#dadaf7; color:#666;">
                            <td>'.utf8_decode($this->rpt_sum[$i]['mon']).'</td>
                            <td>'.utf8_decode($this->rpt_sum[$i]['tue']).'</td>
                            <td>'.utf8_decode($this->rpt_sum[$i]['wed']).'</td>
                            <td>'.utf8_decode($this->rpt_sum[$i]['thu']).'</td>
                            <td>'.utf8_decode($this->rpt_sum[$i]['fri']).'</td>
                            <td>'.utf8_decode($this->rpt_sum[$i]['sat']).'</td>
                            <td>'.utf8_decode($this->rpt_sum[$i]['sun']).'</td>
                            <td></td>
                    </tr>';

            $i++;

            $html .= '<tr><td colspan="'.$total_number_of_columns.'"></td></tr>';
        }

        return $html;
    }

}
?>