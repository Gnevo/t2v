<?php
// error_reporting(E_ALL);
// error_reporting(E_WARNING);
// ini_set('error_reporting', E_ALL);
// ini_set("display_errors", 1);

require_once('./plugins/F_pdf.class.php');
require_once('class/setup.php');

//require_once('./plugins/fpdi/fpdi.php');
//FPDI
class PDF_Customer_week_report extends FPDF { //FPDF

    var $report_month = '';
    var $report_year = '';
    var $report_customer = '';
    var $report_start_date = '';
    var $report_end_date = '';
    var $rpt_contents = array();
    var $rpt_sum = array();
    
    var $contract_hours_fk = '';
    var $contract_hours_kn = '';
    var $worked_hour_fk = '';
    var $worked_hour_kn = '';

    function __construct($orientation) {
       // echo $orientation;
        parent::__construct($orientation);
        $this->FPDF($orientation);
        //$this->k=2;
    }

    function P1_Part1($customer) {

        $year = $this->report_year;
        $month = $this->report_month;
        $start_date = $this->report_start_date;
        $end_date = $this->report_end_date;
        $smarty = new smartySetup(array("reports.xml"), FALSE);
        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0, 50, 50);

        $this->SetFont('Arial', 'B', 15);
        $this->SetXY(10, $this->GetY() + 5);
        $this->Cell(180, 5, utf8_decode($smarty->translate['customer_month_report_pdf']), 0, 0, 'C', FALSE);

        $this->SetXY(10, $this->GetY() + 10);
       // $this->Cell(180,11,'',1,0,'L',true);    //set border
       // $this->Cell(85,11,'',1,0,'L',true);    //set border

        if ($customer['username'] != '' || $customer['username'] != null) {
            $this->SetFont('Arial', '', 8);
            $this->SetXY(17, $this->GetY() - 2);
            $this->Cell(10, 9, utf8_decode($smarty->translate['customer_report_customer_name']), 0, 0, 'L', FALSE);    //label name1
            $this->SetXY(170, $this->GetY());
            $this->Cell(10, 9, utf8_decode($smarty->translate['customer_report_socialsecurity']), 0, 0, 'L', FALSE);    // label name2

            $this->SetFont('Arial', 'B', 10);
            $this->SetXY(17, $this->GetY() + 3);
            $this->Cell(10, 9, utf8_decode($customer['first_name'] . " " . $customer['last_name']), 0, 0, 'L', FALSE);    //label value1
            $this->SetXY(172, $this->GetY());
            //$this->Cell(10,9,'920320-1968 ',0,0,'L',FALSE);    // label value2
            $this->Cell(10, 9, $customer['social_security'], 0, 0, 'L', FALSE);    // label value2

            $this->Ln();
        }

       // $this->SetXY(10, $this->GetY()-2);
       // $this->Cell(265, 11, '', 1, 0, 'L', TRUE);

        if ($year % 400 == 0 || ($year % 100 != 0 && $year % 4 == 0))
            $month_days = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
        else
            $month_days = array(31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

        $this->SetFont('Arial', '', 10);
        $this->SetXY(17, $this->GetY() - 4);
        $this->Cell(10, 9, utf8_decode($smarty->translate['report_period']), 0, 0, 'L', FALSE);    //label name1
        $this->Ln(1);
        $this->SetFont('Arial', 'B', 10);
        $this->SetXY(17, $this->GetY() + 5);
        $this->Cell(177, 5, utf8_decode($start_date . ' -- ' . $end_date), 0, 0, 'L', FALSE);

        if ($customer['username'] != ''&& $customer['username'] != null) {
            $this->Ln(5);

            //report sum hours
            $this->SetFont('Arial', '', 8);
            $this->SetXY(10, $this->GetY());
            $this->Cell(95.25, 5, utf8_decode($smarty->translate['contract_hour']), 'LTR', 0, 'T', FALSE);    //label name1
            $this->Cell(95.25, 5, utf8_decode($smarty->translate['worked_hour']), 'LTR', 1, 'T', FALSE);    //label name1

            $this->SetFont('Arial', 'B', 10);
            $this->SetXY(10, $this->GetY());
            $this->Cell(95.25, 7, 'FK: '.$this->contract_hours_fk.' | KN: '.$this->contract_hours_kn, 'LBR', 0, 'L', FALSE);
            $this->Cell(95.25, 7, 'FK: '.$this->worked_hour_fk.' | KN: '.$this->worked_hour_kn, 'LBR', 1, 'L', FALSE);
        }

        $this->Ln(5);
    }

    function P1_Part1_L($customer) {

        $year = $this->report_year;
        $month = $this->report_month;
        $start_date = $this->report_start_date;
        $end_date = $this->report_end_date;
        $smarty = new smartySetup(array("reports.xml"), FALSE);
        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0, 50, 50);

        $this->SetFont('Arial', 'B', 18);
        $this->SetXY(18, $this->GetY() + 5);
        $this->Cell(265, 5, utf8_decode($smarty->translate['customer_month_report_pdf']), 0, 0, 'C', FALSE);

        $this->SetXY(18, $this->GetY() + 10);
        $this->Cell(180, 11, '', 1, 0, 'L', true);    //set border
        $this->Cell(85, 11, '', 1, 0, 'L', true);    //set border
        if ($customer['username'] != '' || $customer['username'] != null) {
            $this->SetFont('Arial', '', 10);
            $this->SetXY(20, $this->GetY() - 2);
            $this->Cell(10, 9, utf8_decode($smarty->translate['customer_report_customer_name']), 0, 0, 'L', FALSE);    //label name1
            $this->SetXY(200, $this->GetY());
            $this->Cell(10, 9, utf8_decode($smarty->translate['customer_report_socialsecurity']), 0, 0, 'L', FALSE);    // label name2

            $this->SetFont('Arial', 'B', 12);
            $this->SetXY(20, $this->GetY() + 5);
            $this->Cell(10, 9, utf8_decode($customer['first_name'] . " " . $customer['last_name']), 0, 0, 'L', FALSE);    //label value1
            $this->SetXY(202, $this->GetY());
            //$this->Cell(10,9,'920320-1968 ',0,0,'L',FALSE);    // label value2
            $this->Cell(10, 9, $customer['social_security'], 0, 0, 'L', FALSE);    // label value2

            $this->Ln();
        }


        $this->SetXY(18, $this->GetY() - 1.3);
        $this->Cell(265, 11, '', 1, 0, 'L', TRUE);

        if ($year % 400 == 0 || ($year % 100 != 0 && $year % 4 == 0))
            $month_days = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
        else
            $month_days = array(31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

        $this->SetFont('Arial', '', 10);
        $this->SetXY(20, $this->GetY() - 2);
        $this->Cell(10, 9, utf8_decode($smarty->translate['report_period']), 0, 0, 'L', FALSE);    //label name1

        $this->SetFont('Arial', 'B', 12);
        $this->SetXY(20, $this->GetY() + 7);
        $this->Cell(177, 5, utf8_decode($start_date . ' -- ' . $end_date), 0, 0, 'L', FALSE);

        
        if ($customer['username'] != ''&& $customer['username'] != null) {
            $this->Ln(7);

            //report sum hours
            $this->SetFont('Arial', '', 8);
            $this->SetXY(18, $this->GetY());
            $this->Cell(132, 5, utf8_decode($smarty->translate['contract_hour']), 'LTR', 0, 'T', FALSE);    //label name1
            $this->Cell(133, 5, utf8_decode($smarty->translate['worked_hour']), 'LTR', 1, 'T', FALSE);    //label name1

            $this->SetFont('Arial', 'B', 10);
            $this->SetXY(18, $this->GetY());
            $this->Cell(132, 7, 'FK: '.$this->contract_hours_fk.' | KN: '.$this->contract_hours_kn, 'LBR', 0, 'L', FALSE);
            $this->Cell(133, 7, 'FK: '.$this->worked_hour_fk.' | KN: '.$this->worked_hour_kn, 'LBR', 1, 'L', FALSE);
        }
        
        $this->Ln(5);
    }

    function P1_Part2() {


        $w = array(20, 20, 20, 20, 20, 20, 20, 20, 20);
        $table_head_content = array("Anställd", "Mån", "Tis", "Ons", "Tors", "Fre", "Lör", "Sön", "Summa");
        $col_h = 10;

        $i = 0;
        foreach ($this->rpt_contents as $report) {
            $this->SetFont('Arial', 'B', 12);
            $this->SetXY(18, $this->GetY());
            $this->Cell(180, 11, utf8_decode('Vecka ' . $report['week']), 1, 1, 'C', FALSE);    //week table heading (week number)

            $sun_sum = 0;
            $sun_mon = 0;
            $sun_tue = 0;
            $sun_wed = 0;
            $sun_thu = 0;
            $sun_fri = 0;
            $sun_sat = 0;

            $this->SetX(18);
            for ($m = 0; $m < 9; $m++) {     //set column headings for each table
                $this->Cell($w[$m], $col_h, utf8_decode($table_head_content[$m]), 1, 0, 'C', FALSE);
            }


            $this->Ln();
            $this->SetFont('Arial', '', 8);
            foreach ($report['employee'] as $emp) {
                $this->SetX(18);

                $max_entries = 0;       //find max no.of entries per row
                $we = count($emp['Mon']);
                if ($max_entries < $we)
                    $max_entries = $we;
                $we = count($emp['Tue']);
                if ($max_entries < $we)
                    $max_entries = $we;
                $we = count($emp['Wed']);
                if ($max_entries < $we)
                    $max_entries = $we;
                $we = count($emp['Thu']);
                if ($max_entries < $we)
                    $max_entries = $we;
                $we = count($emp['Fri']);
                if ($max_entries < $we)
                    $max_entries = $we;
                $we = count($emp['Sat']);
                if ($max_entries < $we)
                    $max_entries = $we;
                $we = count($emp['Sun']);
                if ($max_entries < $we)
                    $max_entries = $we;
                $current_rh = $max_entries * $col_h;

                $this->Cell($w[0], $current_rh, utf8_decode($emp['name']), 1, 0, 'L', FALSE);


                //col mon
                $start_x = $this->GetX();
                $start_y = $this->GetY();
                if (!empty($emp['Mon'])) {
                    $indx = 0;
                    foreach ($emp['Mon'] as $mon) {
                        $man = explode(',', $mon);
                        //                    if($man[1] == 0){
                        //                        $this->Cell($w[1], $col_h, utf8_decode($man[0]), 1, 0, 'L', FALSE);
                        //                    }
                        $this->Cell($w[1], $col_h, utf8_decode($man[0]), 1, 0, 'L', FALSE);
                        if (++$indx != count($emp['Mon'])) {
                            $this->SetXY($start_x, $this->GetY() + $col_h);
                        } else {
                            $this->SetXY($start_x + $w[1], $start_y);
                        }
                    }
                } else {
                    $this->Cell($w[1], $current_rh, '', 1, 0, 'L', FALSE);
                }


                //col tue
                $start_x = $this->GetX();
                $start_y = $this->GetY();
                if (!empty($emp['Tue'])) {
                    $indx = 0;
                    foreach ($emp['Tue'] as $tue) {
                        $man = explode(',', $tue);
                        $this->Cell($w[2], $col_h, utf8_decode($man[0]), 1, 0, 'L', FALSE);
                        if (++$indx != count($emp['Tue'])) {
                            $this->SetXY($start_x, $this->GetY() + $col_h);
                        } else {
                            $this->SetXY($start_x + $w[2], $start_y);
                        }
                    }
                } else {
                    $this->Cell($w[2], $current_rh, '', 1, 0, 'L', FALSE);
                }


                //col wed
                $start_x = $this->GetX();
                $start_y = $this->GetY();
                if (!empty($emp['Wed'])) {
                    $indx = 0;
                    foreach ($emp['Wed'] as $wed) {
                        $man = explode(',', $wed);
                        $this->Cell($w[3], $col_h, utf8_decode($man[0]), 1, 0, 'L', FALSE);
                        if (++$indx != count($emp['Wed'])) {
                            $this->SetXY($start_x, $this->GetY() + $col_h);
                        } else {
                            $this->SetXY($start_x + $w[3], $start_y);
                        }
                    }
                } else {
                    $this->Cell($w[3], $current_rh, '', 1, 0, 'L', FALSE);
                }


                //col thu
                $start_x = $this->GetX();
                $start_y = $this->GetY();
                if (!empty($emp['Thu'])) {
                    $indx = 0;
                    foreach ($emp['Thu'] as $thu) {
                        $man = explode(',', $thu);
                        $this->Cell($w[4], $col_h, utf8_decode($man[0]), 1, 0, 'L', FALSE);
                        if (++$indx != count($emp['Thu'])) {
                            $this->SetXY($start_x, $this->GetY() + $col_h);
                        } else {
                            $this->SetXY($start_x + $w[4], $start_y);
                        }
                    }
                } else {
                    $this->Cell($w[4], $current_rh, '', 1, 0, 'L', FALSE);
                }


                //col fri
                $start_x = $this->GetX();
                $start_y = $this->GetY();
                if (!empty($emp['Fri'])) {
                    $indx = 0;
                    foreach ($emp['Fri'] as $fri) {
                        $man = explode(',', $fri);
                        $this->Cell($w[5], $col_h, utf8_decode($man[0]), 1, 0, 'L', FALSE);
                        if (++$indx != count($emp['Fri'])) {
                            $this->SetXY($start_x, $this->GetY() + $col_h);
                        } else {
                            $this->SetXY($start_x + $w[5], $start_y);
                        }
                    }
                } else {
                    $this->Cell($w[5], $current_rh, '', 1, 0, 'L', FALSE);
                }


                //col sat
                $start_x = $this->GetX();
                $start_y = $this->GetY();
                if (!empty($emp['Sat'])) {
                    $indx = 0;
                    foreach ($emp['Sat'] as $sat) {
                        $man = explode(',', $sat);
                        $this->Cell($w[6], $col_h, utf8_decode($man[0]), 1, 0, 'L', FALSE);
                        if (++$indx != count($emp['Sat'])) {
                            $this->SetXY($start_x, $this->GetY() + $col_h);
                        } else {
                            $this->SetXY($start_x + $w[6], $start_y);
                        }
                    }
                } else {
                    $this->Cell($w[6], $current_rh, '', 1, 0, 'L', FALSE);
                }


                //col Sun
                $start_x = $this->GetX();
                $start_y = $this->GetY();
                if (!empty($emp['Sun'])) {
                    $indx = 0;
                    foreach ($emp['Sun'] as $sun) {
                        $man = explode(',', $sun);
                        $this->Cell($w[7], $col_h, utf8_decode($man[0]), 1, 0, 'L', FALSE);
                        if (++$indx != count($emp['Sun'])) {
                            $this->SetXY($start_x, $this->GetY() + $col_h);
                        } else {
                            $this->SetXY($start_x + $w[7], $start_y);
                        }
                    }
                } else {
                    $this->Cell($w[7], $current_rh, '', 1, 0, 'L', FALSE);
                }

                $this->Cell($w[8], $current_rh, utf8_decode($emp['sum']), 1, 0, 'L', FALSE);
                $this->Ln();
            }

            //display each col sum
            $this->SetX(18);
            $this->Cell($w[0], $col_h, utf8_decode('Summa'), 1, 0, 'L', FALSE);
            $this->Cell($w[1], $col_h, utf8_decode($this->rpt_sum[$i]['mon']), 1, 0, 'L', FALSE);
            $this->Cell($w[2], $col_h, utf8_decode($this->rpt_sum[$i]['tue']), 1, 0, 'L', FALSE);
            $this->Cell($w[3], $col_h, utf8_decode($this->rpt_sum[$i]['wed']), 1, 0, 'L', FALSE);
            $this->Cell($w[4], $col_h, utf8_decode($this->rpt_sum[$i]['thu']), 1, 0, 'L', FALSE);
            $this->Cell($w[5], $col_h, utf8_decode($this->rpt_sum[$i]['fri']), 1, 0, 'L', FALSE);
            $this->Cell($w[6], $col_h, utf8_decode($this->rpt_sum[$i]['sat']), 1, 0, 'L', FALSE);
            $this->Cell($w[7], $col_h, utf8_decode($this->rpt_sum[$i]['sun']), 1, 0, 'L', FALSE);
            $this->Cell($w[8], $col_h, '', 1, 0, 'L', FALSE);

            $i +=1;
            $this->Ln(15);
        }
    }

    function P1_Part2_Landscape($cust_flag = 0) {

        $smarty = new smartySetup(array("user.xml", "month.xml", "messages.xml", "button.xml", "forms.xml","gdschema.xml"), FALSE);
        global $leave_type_short;

        $this->SetFillColor(230, 230, 230);
        $w = array(42, 29, 29, 29, 29, 29, 29, 29, 20);
        $table_head_content = array("Mån", "Tis", "Ons", "Tors", "Fre", "Lör", "Sön", "Summa");
        $weeks = array("mon", "tue", "wed", "thu", "fri", "sat", "sun");
        $col_h = 5;
        $temp_col_h = 0;
        $temp_current_rh = 0;
        $temp_col_h_half = 0;
        $temp_current_rh_half = 0;
        $i = 0;
       // echo "<pre>". print_r($this->rpt_contents, 1)."</pre>";
        foreach ($this->rpt_contents as $report) {
            $this->SetFont('Arial', 'B', 12);
            $y_value = floatval($this->GetY());
            if ($y_value >= 150.00) {
                $this->AddPage();
                $y_value = 25.00;
            }
           // echo "<script>alert('".$this->GetY()."----".$y_value."');</script>";
            $this->SetXY(18, $y_value);
            $this->Cell(265, 11, utf8_decode('Vecka ' . $report['week']), 1, 1, 'C', FALSE);    //week table heading (week number)

            $this->SetX(18);
            $this->Cell($w[0], $col_h, utf8_decode('Anställd'), 1, 0, 'C', FALSE);
            for ($m = 0; $m < 8; $m++) {     //set column headings for each table
                $this->Cell($w[$m + 1], $col_h, utf8_decode($table_head_content[$m]) . "  " . $report[$weeks[$m]][0], 1, 0, 'C', FALSE);
            }


            $this->Ln();
            $this->SetFont('Arial', '', 8);
            foreach ($report['employee'] as $emp) {
                $this->SetX(18);

                $max_entries = 0;       //find max no.of entries per row
                $we = count($emp['Mon']);
                if ($max_entries < $we)
                    $max_entries = $we;
                $we = count($emp['Tue']);
                if ($max_entries < $we)
                    $max_entries = $we;
                $we = count($emp['Wed']);
                if ($max_entries < $we)
                    $max_entries = $we;
                $we = count($emp['Thu']);
                if ($max_entries < $we)
                    $max_entries = $we;
                $we = count($emp['Fri']);
                if ($max_entries < $we)
                    $max_entries = $we;
                $we = count($emp['Sat']);
                if ($max_entries < $we)
                    $max_entries = $we;
                $we = count($emp['Sun']);
                if ($max_entries < $we)
                    $max_entries = $we;
                $current_rh = $max_entries * $col_h;


                if ($this->GetY() < 11.00 || $this->GetY() > 180.00) {
                    $this->SetFont('Arial', 'B', 12);
                    if ($this->GetY() > 180.00)
                        $this->AddPage();
                    $this->SetX(18);
                    $this->Cell(265, 11, utf8_decode('Vecka ' . $report['week']), 1, 1, 'C', FALSE);
                    $this->SetX(18);
                    $this->Cell($w[0], $col_h, utf8_decode('Anställd'), 1, 0, 'C', FALSE);
                    for ($m = 0; $m < 8; $m++) {     //set column headings for each table
                        $this->Cell($w[$m + 1], $col_h, utf8_decode($table_head_content[$m]) . "  " . $report[$weeks[$m]][0], 1, 0, 'C', FALSE);
                    }
                    $this->Ln();
                    $this->SetFont('Arial', '', 9);
                }
                $this->SetX(18);
                $hex = str_replace("#", "", $emp['color']);
                $r = hexdec(substr($hex, 0, 2));
                $g = hexdec(substr($hex, 2, 2));
                $b = hexdec(substr($hex, 4, 2));
                $this->SetFillColor($r, $g, $b);
                $this->Cell(2, $current_rh, '', 1, 0, 'L', true);
                $this->SetFillColor(255, 255, 255);

                $this->Cell($w[0] - 2, $current_rh, utf8_decode($emp['name']), 1, 0, 'L', FALSE);

                ///-----------------------SDN alteration--------------------------------------------
                $controller = array(1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat', 7 => 'Sun');
                foreach ($controller as $w_key => $day_thread) {
                    $start_x = $this->GetX();
                    $start_y = $this->GetY();
                    $this->Cell($w[$w_key], $current_rh, '', 'LTB', 0, 'L', FALSE);
                    $this->SetXY($start_x, $start_y);

                    if (!empty($emp[$day_thread])) {
                        $indx = 0;
                        foreach ($emp[$day_thread] as $day_val) {
                            $man = explode(',', $day_val);
                            $this->SetFillColor($r, $g, $b);
                            $this->Cell(2, $col_h, '', 1, 0, 'L', true);
                            $this->SetFillColor(255, 255, 255);
                            if ($man[2] == 1)
                                $bg_flag = FALSE;
                            else {
                                $this->setFillColourByStatus($man[2]);
                                $bg_flag = TRUE;
                            }
                            $this->Cell($w[$w_key] - 8, $col_h, utf8_decode($man[0]) . "(" . substr($man[5], 0, 1) . substr($man[6], 0, 1) . ")", 'LTB', 0, 'L', $bg_flag);

                            if ($man[2] == 2 && $man[7] != '')
                                $this->Cell(6, $col_h, utf8_decode($leave_type_short[$man[7]]), 'TBR', 0, 'C', $bg_flag);
                            elseif ($man[1] == 0)
                                $this->Cell(6, $col_h, utf8_decode($smarty->translate['working_shortcut']), 'TBR', 0, 'C', $bg_flag);
                            else if ($man[1] == 1)
                                $this->Cell(6, $col_h, utf8_decode($smarty->translate['travel_shortcut']), 'TBR', 0, 'C', $bg_flag);
                            else if ($man[1] == 2)
                                $this->Cell(6, $col_h, utf8_decode($smarty->translate['lunch_shortcut']), 'TBR', 0, 'C', $bg_flag);
                            else if ($man[1] == 3)
                                $this->Cell(6, $col_h, utf8_decode($smarty->translate['oncall_shortcut']), 'TBR', 0, 'C', $bg_flag);
                            else if ($man[1] == 4)
                                $this->Cell(6, $col_h, utf8_decode($smarty->translate['overtime_shortcut']), 'TBR', 0, 'C', $bg_flag);
                            else if ($man[1] == 5)
                                $this->Cell(6, $col_h, utf8_decode($smarty->translate['more_overtime_shortcut']), 'TBR', 0, 'C', $bg_flag);
                            else if ($man[1] == 6)
                                $this->Cell(6, $col_h, utf8_decode($smarty->translate['quality_overtime_shortcut']), 'TBR', 0, 'C', $bg_flag);
                            else if ($man[1] == 7)
                                $this->Cell(6, $col_h, utf8_decode($smarty->translate['some_othertime_shortcut']), 'TBR', 0, 'C', $bg_flag);
                            else if ($man[1] == 8)
                                $this->Cell(6, $col_h, utf8_decode($smarty->translate['training_time_shortcut']), 'TBR', 0, 'C', $bg_flag);
                            else if ($man[1] == 9)
                                $this->Cell(6, $col_h, utf8_decode($smarty->translate['cal_training_shortcut']), 'TBR', 0, 'C', $bg_flag);
                            else if ($man[1] == 10)
                                $this->Cell(6, $col_h, utf8_decode($smarty->translate['personal_meeting_shortcut']), 'TBR', 0, 'C', $bg_flag);
                            else if ($man[1] == 11)
                                $this->Cell(6, $col_h, utf8_decode($smarty->translate['voluntary_shortcut']), 'TBR', 0, 'C', $bg_flag);
                            else if ($man[1] == 12)
                                $this->Cell(6, $col_h, utf8_decode($smarty->translate['complementary_shortcut']), 'TBR', 0, 'C', $bg_flag);
                            else if ($man[1] == 13)
                                $this->Cell(6, $col_h, utf8_decode($smarty->translate['complementary_oncall_shortcut']), 'TBR', 0, 'C', $bg_flag);
                            else if ($man[1] == 14)
                                $this->Cell(6, $col_h, utf8_decode($smarty->translate['more_oncall_shortcut']), 'TBR', 0, 'C', $bg_flag);
                            else if ($man[1] == 16)
                                $this->Cell(6, $col_h, utf8_decode($smarty->translate['work_for_dismissal_shortcut']), 'TBR', 0, 'C', $bg_flag);
                            else
                                $this->Cell(6, $col_h, '', 'TBR', 0, 'C', $bg_flag);
                            if (++$indx != count($emp[$day_thread])) {
                                $this->SetXY($start_x, $this->GetY() + $col_h);
                            } else {
                                $this->SetXY($start_x + $w[$w_key], $start_y);
                            }
                        }
                        $this->setFillColourByStatus();
                    }
                    else
                        $this->Cell($w[$w_key], $current_rh, '', 'LTB', 0, 'L', FALSE);
                }
                ///-----------------------SDN alteration endz--------------------------------------------

                $this->Cell($w[8], $current_rh, utf8_decode($emp['sum']), 1, 0, 'C', FALSE);
                $this->Ln();
            }


            if (!empty($report['unmanned'])) {
                $this->SetX(18);

                $max_entries = 0;       //find max no.of entries per row
                $we = !empty($report['unmanned']['Mon']) ? count($report['unmanned']['Mon']) : 0;
                if ($max_entries < $we)
                    $max_entries = $we;
                $we = !empty($report['unmanned']['Tue']) ? count($report['unmanned']['Tue']) : 0;
                if ($max_entries < $we)
                    $max_entries = $we;
                $we = !empty($report['unmanned']['Wed']) ? count($report['unmanned']['Wed']) : 0;
                if ($max_entries < $we)
                    $max_entries = $we;
                $we = !empty($report['unmanned']['Thu']) ? count($report['unmanned']['Thu']) : 0;
                if ($max_entries < $we)
                    $max_entries = $we;
                $we = !empty($report['unmanned']['Fri']) ? count($report['unmanned']['Fri']) : 0;
                if ($max_entries < $we)
                    $max_entries = $we;
                $we = !empty($report['unmanned']['Sat']) ? count($report['unmanned']['Sat']) : 0;
                if ($max_entries < $we)
                    $max_entries = $we;
                $we = !empty($report['unmanned']['Sun']) ? count($report['unmanned']['Sun']) : 0;
                if ($max_entries < $we)
                    $max_entries = $we;
                $current_rh = $max_entries * $col_h;


                if ($this->GetY() < 11.00 || $this->GetY() > 180.00) {
                    $this->SetFont('Arial', 'B', 12);
                    if ($this->GetY() > 180.00)
                        $this->AddPage();
                    $this->SetX(18);
                    $this->Cell(265, 11, utf8_decode('Vecka ' . $report['week']), 1, 1, 'C', FALSE);
                    $this->SetX(18);
                    $this->Cell($w[0], $col_h, utf8_decode('Anställd'), 1, 0, 'C', FALSE);
                    for ($m = 0; $m < 8; $m++) {     //set column headings for each table
                        $this->Cell($w[$m + 1], $col_h, utf8_decode($table_head_content[$m]) . "  " . $report[$weeks[$m]][0], 1, 0, 'C', FALSE);
                    }
                    $this->Ln();
                    $this->SetFont('Arial', '', 9);
                }
                $this->SetX(18);
                $this->Cell(2, $current_rh, '', 1, 0, 'L', FALSE);
                $this->SetFillColor(255, 255, 255);

                $this->Cell($w[0] - 2, $current_rh, utf8_decode($smarty->translate['unmanned']), 1, 0, 'L', FALSE);

                ///-----------------------SDN alteration--------------------------------------------
                $controller = array(1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat', 7 => 'Sun');
                foreach ($controller as $w_key => $day_thread) {
                    $start_x = $this->GetX();
                    $start_y = $this->GetY();
                    $this->Cell($w[$w_key], $current_rh, '', 'LTB', 0, 'L', FALSE);
                    $this->SetXY($start_x, $start_y);

                    if (!empty($report['unmanned'][$day_thread])) {
                        $indx = 0;
                        foreach ($report['unmanned'][$day_thread] as $day_val) {
                            $man = explode(',', $day_val);
                            $this->Cell(2, $col_h, '', 1, 0, 'L', FALSE);
                            $this->setFillColourByStatus($man[2]);
                            $bg_flag = TRUE;
                            $this->Cell($w[$w_key] - 8, $col_h, utf8_decode($man[0]) . "(" . substr($man[5], 0, 1) . substr($man[6], 0, 1) . ")", 'LTB', 0, 'L', $bg_flag);

                            if ($man[2] == 2 && $man[7] != '')
                                $this->Cell(6, $col_h, utf8_decode($leave_type_short[$man[7]]), 'TBR', 0, 'C', $bg_flag);
                            elseif ($man[1] == 0)
                                $this->Cell(6, $col_h, utf8_decode($smarty->translate['working_shortcut']), 'TBR', 0, 'C', $bg_flag);
                            else if ($man[1] == 1)
                                $this->Cell(6, $col_h, utf8_decode($smarty->translate['travel_shortcut']), 'TBR', 0, 'C', $bg_flag);
                            else if ($man[1] == 2)
                                $this->Cell(6, $col_h, utf8_decode($smarty->translate['lunch_shortcut']), 'TBR', 0, 'C', $bg_flag);
                            else if ($man[1] == 3)
                                $this->Cell(6, $col_h, utf8_decode($smarty->translate['oncall_shortcut']), 'TBR', 0, 'C', $bg_flag);
                            else if ($man[1] == 4)
                                $this->Cell(6, $col_h, utf8_decode($smarty->translate['overtime_shortcut']), 'TBR', 0, 'C', $bg_flag);
                            else if ($man[1] == 5)
                                $this->Cell(6, $col_h, utf8_decode($smarty->translate['more_overtime_shortcut']), 'TBR', 0, 'C', $bg_flag);
                            else if ($man[1] == 6)
                                $this->Cell(6, $col_h, utf8_decode($smarty->translate['quality_overtime_shortcut']), 'TBR', 0, 'C', $bg_flag);
                            else if ($man[1] == 7)
                                $this->Cell(6, $col_h, utf8_decode($smarty->translate['some_othertime_shortcut']), 'TBR', 0, 'C', $bg_flag);
                            else if ($man[1] == 8)
                                $this->Cell(6, $col_h, utf8_decode($smarty->translate['training_time_shortcut']), 'TBR', 0, 'C', $bg_flag);
                            else if ($man[1] == 9)
                                $this->Cell(6, $col_h, utf8_decode($smarty->translate['cal_training_shortcut']), 'TBR', 0, 'C', $bg_flag);
                            else if ($man[1] == 10)
                                $this->Cell(6, $col_h, utf8_decode($smarty->translate['personal_meeting_shortcut']), 'TBR', 0, 'C', $bg_flag);
                            else if ($man[1] == 11)
                                $this->Cell(6, $col_h, utf8_decode($smarty->translate['voluntary_shortcut']), 'TBR', 0, 'C', $bg_flag);
                            else if ($man[1] == 12)
                                $this->Cell(6, $col_h, utf8_decode($smarty->translate['complementary_shortcut']), 'TBR', 0, 'C', $bg_flag);
                            else if ($man[1] == 13)
                                $this->Cell(6, $col_h, utf8_decode($smarty->translate['complementary_oncall_shortcut']), 'TBR', 0, 'C', $bg_flag);
                            else if ($man[1] == 14)
                                $this->Cell(6, $col_h, utf8_decode($smarty->translate['more_oncall_shortcut']), 'TBR', 0, 'C', $bg_flag);
                            else if ($man[1] == 16)
                                $this->Cell(6, $col_h, utf8_decode($smarty->translate['work_for_dismissal_shortcut']), 'TBR', 0, 'C', $bg_flag);
                            else
                                $this->Cell(6, $col_h, '', 'TBR', 0, 'C', $bg_flag);
                            if (++$indx != count($report['unmanned'][$day_thread])) {
                                $this->SetXY($start_x, $this->GetY() + $col_h);
                            } else {
                                $this->SetXY($start_x + $w[$w_key], $start_y);
                            }
                        }
                        $this->setFillColourByStatus();
                    }
                    else
                        $this->Cell($w[$w_key], $current_rh, '', 'LTB', 0, 'L', FALSE);
                }
                ///-----------------------SDN alteration endz--------------------------------------------

                $this->Cell($w[8], $current_rh, utf8_decode($report['unmanned']['sum']), 1, 0, 'C', FALSE);
                $this->Ln();
            }

            //display each col sum
            $this->SetX(18);
            $this->Cell($w[0], $col_h, utf8_decode('Summa'), 'LTB', 0, 'L', FALSE);

            $this->Cell($w[1], $col_h, $this->rpt_sum[$i]['mon'], 1, 0, 'C', FALSE);
            $this->Cell($w[2], $col_h, $this->rpt_sum[$i]['tue'], 1, 0, 'C', FALSE);
            $this->Cell($w[3], $col_h, $this->rpt_sum[$i]['wed'], 1, 0, 'C', FALSE);
            $this->Cell($w[4], $col_h, $this->rpt_sum[$i]['thu'], 1, 0, 'C', FALSE);
            $this->Cell($w[5], $col_h, $this->rpt_sum[$i]['fri'], 1, 0, 'C', FALSE);
            $this->Cell($w[6], $col_h, $this->rpt_sum[$i]['sat'], 1, 0, 'C', FALSE);
            $this->Cell($w[7], $col_h, $this->rpt_sum[$i]['sun'], 1, 0, 'C', FALSE);
            $this->Cell($w[8], $col_h, sprintf('%.02f', round($this->rpt_sum[$i]['mon']+$this->rpt_sum[$i]['tue']+$this->rpt_sum[$i]['wed']+$this->rpt_sum[$i]['thu']+$this->rpt_sum[$i]['fri']+$this->rpt_sum[$i]['sat']+$this->rpt_sum[$i]['sun'], 2)), 1, 0, 'C', FALSE);

            $i +=1;
            $this->Ln(6);
        }
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

    function P1_Part2_New($start_date, $end_date, $cust_flag = 0) {
        $smarty = new smartySetup(array("user.xml", "month.xml", "messages.xml", "button.xml", "forms.xml", "gdschema.xml"), FALSE);
        global $leave_type_short;

        $colour_code_width = 2.5;
        $employee_name_column_width = 39.5;
        $time_data_column_width = 30;

        $this->SetFillColor(255, 255, 255);
        $w = array(42, 29, 29, 29, 29, 29, 29, 29, 20);
        $_SESSION['pdf_y_val_even'] = $this->GetY();
        $_SESSION['pdf_y_val_odd'] = $this->GetY();
        $sizes = array();

        for ($i = 0; $i < count($this->rpt_contents); $i++) {
            $counts = count($this->rpt_contents[$i]['data']['sun']) + count($this->rpt_contents[$i]['data']['mon']) + count($this->rpt_contents[$i]['data']['tue']) + count($this->rpt_contents[$i]['data']['wed']) + count($this->rpt_contents[$i]['data']['thu']) + count($this->rpt_contents[$i]['data']['fri']) + count($this->rpt_contents[$i]['data']['sat']);
            $counts += count($this->rpt_contents[$i]['unmanned-data']['sun']) + count($this->rpt_contents[$i]['unmanned-data']['mon']) + count($this->rpt_contents[$i]['unmanned-data']['tue']) + count($this->rpt_contents[$i]['unmanned-data']['wed']) + count($this->rpt_contents[$i]['unmanned-data']['thu']) + count($this->rpt_contents[$i]['unmanned-data']['fri']) + count($this->rpt_contents[$i]['unmanned-data']['sat']);
            $sizes [] = $counts;
        }
       // echo "<pre>".print_r($this->rpt_contents, 1)."</pre>";
       // echo "<pre>". print_r($sizes, 1)."</pre>";
        $i = 0;
        $page_begin = "";
        $pagechange = "";
        foreach ($this->rpt_contents as $report) {
            $this->SetFont('Arial', '', 8);
            $this->SetXY(10, $this->GetY());
            $pg_week_section_begins = $pg_week_section_begins_local = $this->page;
            $week_entry_count = 0;
            $section_start_y = $this->GetY();
            if ($i % 2 == 0) {
                //$i=0,2,4,...
                if ($this->page != $page_begin && $page_begin != "") {
                    $this->pages[$this->page] = $pagechange . $this->pages[$this->page];
                   // $pagechange = $this->pages[$this->page];
                   // $this->page = $page_begin;
                }
                $page_begin = $this->page;
                $this->SetFillColor(255, 255, 255);
               // $this->SetXY(10, $_SESSION['pdf_y_val_even']);
                $this->SetXY(10, $section_start_y);
                $i++;
                $this->Cell(95, 4, utf8_decode('Vecka ' . $report['week']), 1, 1, 'C', FALSE);
                foreach(array('mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun') as $day_key){
                    $a = 0;

                    //show manned slots
                    if (!empty($report['data'][$day_key])) {
                        foreach ($report['data'][$day_key] as $selected_day) {
                            $this->SetX(10);
                            $selected_day_flags = explode(",", $selected_day['time']);
                            if ($selected_day_flags[2] == 2) {
                                $this->setFillColourByStatus($selected_day_flags[2]);
                            } else {
                                $this->SetFillColor(255, 255, 255);
                            }
                            $bg_flag = ($selected_day_flags[2] == 1?  FALSE: TRUE);
                            $time_val = explode(".", $selected_day_flags[0]);
                            $x_val = $this->GetX();
                            if ($a == 0) {
                                $this->Cell(30, 4, $report[$day_key][2] . "-" . $report[$day_key][1] . "-" . $report[$day_key][0], 'TLB', 0, 'L', FALSE);
                                $this->SetX($x_val + 16);
                                $this->Cell(7, 4, utf8_decode($smarty->translate[$day_key]), 'TRB', 0, 'L', FALSE);
                            }
                            else
                                $this->Cell(23, 4, '', 1, 0, 'L', FALSE);

                            if ($selected_day_flags[2] == 2 && $selected_day_flags[7] != '')
                                $this->Cell($time_data_column_width, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $selected_day_flags[3] . "  " . utf8_decode($leave_type_short[$selected_day_flags[7]]), 1, 0, 'L', true);
                            elseif ($selected_day_flags[1] == 3)
                                $this->Cell($time_data_column_width, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $selected_day_flags[3] . "  " . utf8_decode($smarty->translate['oncall_shortcut']), 1, 0, 'L', true);
                            else if ($selected_day_flags[1] == 9)
                                $this->Cell($time_data_column_width, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $selected_day_flags[3] . "  " . utf8_decode($smarty->translate['cal_training_shortcut']), 1, 0, 'L', true);
                            else
                                $this->Cell($time_data_column_width, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $selected_day_flags[3], 1, 0, 'L', true);

                            $this->SetFillColor($selected_day['r'], $selected_day['g'], $selected_day['b']);
                            $this->Cell($colour_code_width, 4, '', 1, 0, 'L', true);
                            if ($selected_day_flags[2] == 2) {
                                $this->setFillColourByStatus($selected_day_flags[2]);
                            } else {
                                $this->SetFillColor(255, 255, 255);
                            }
                            $truncated_employee_name = $this->truncate_employee_name(trim($selected_day['empl']), 28);
                            if ($cust_flag == 1)
                                $this->Cell($employee_name_column_width, 4, utf8_decode($truncated_employee_name) . " ( " . substr($selected_day_flags[5], 0, 1) . substr($selected_day_flags[6], 0, 1) . " )", 1, 0, 'L', true);
                            else
                                $this->Cell($employee_name_column_width, 4, utf8_decode($truncated_employee_name), 1, 0, 'L', true);
                            $a++;
                            $week_entry_count++;

                            $this->SetXY(10, $this->GetY() + 4);
                            if ($this->page != $pg_week_section_begins_local) {
                                $pg_week_section_begins_local = $this->page;
                                $section_start_y = 10;
                                $week_entry_count = 0;
                            }
                        }
                    }

                    //show un-manned slots
                    if (!empty($report['unmanned-data'][$day_key])) {
                        foreach ($report['unmanned-data'][$day_key] as $selected_day) {
                            $this->SetX(10);
                            $selected_day_flags = explode(",", $selected_day['time']);
                            $this->setFillColourByStatus($selected_day_flags[2]);
                            $bg_flag = ($selected_day_flags[2] == 1?  FALSE: TRUE);
                            $time_val = explode(".", $selected_day_flags[0]);
                            $x_val = $this->GetX();
                            if ($a == 0) {
                                $this->Cell(30, 4, $report[$day_key][2] . "-" . $report[$day_key][1] . "-" . $report[$day_key][0], 'TLB', 0, 'L', FALSE);
                                $this->SetX($x_val + 16);
                                $this->Cell(7, 4, utf8_decode($smarty->translate[$day_key]), 'TRB', 0, 'L', FALSE);
                            }
                            else
                                $this->Cell(23, 4, '', 1, 0, 'L', FALSE);

                            if ($selected_day_flags[2] == 2 && $selected_day_flags[7] != '')
                                $this->Cell($time_data_column_width, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $selected_day_flags[3] . "  " . utf8_decode($leave_type_short[$selected_day_flags[7]]), 1, 0, 'L', true);
                            elseif ($selected_day_flags[1] == 3)
                                $this->Cell($time_data_column_width, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $selected_day_flags[3] . "  " . utf8_decode($smarty->translate['oncall_shortcut']), 1, 0, 'L', true);
                            else if ($selected_day_flags[1] == 9)
                                $this->Cell($time_data_column_width, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $selected_day_flags[3] . "  " . utf8_decode($smarty->translate['cal_training_shortcut']), 1, 0, 'L', true);
                            else
                                $this->Cell($time_data_column_width, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $selected_day_flags[3], 1, 0, 'L', true);

                            $this->Cell($colour_code_width, 4, '', 1, 0, 'L', true);
                            if ($cust_flag == 1)
                                $this->Cell($employee_name_column_width, 4, "( " . substr($selected_day_flags[5], 0, 1) . substr($selected_day_flags[6], 0, 1) . " )", 1, 0, 'L', true);
                            else
                                $this->Cell($employee_name_column_width, 4, "", 1, 0, 'L', true);
                            $a++;
                            $week_entry_count++;

                            $this->SetXY(10, $this->GetY() + 4);
                            if ($this->page != $pg_week_section_begins_local) {
                                $pg_week_section_begins_local = $this->page;
                                $section_start_y = 10;
                                $week_entry_count = 0;
                            }
                        }
                    }
                }

                $pagechange = $this->pages[$this->page];
                $_SESSION['pdf_y_val_even'] = $section_start_y = $this->GetY();
            } 
            else {
                //$i=1,3,5,.....
                if ($page_begin != $this->page) {
                    $pagechange = $this->pages[$this->page];
                    $this->page = $page_begin;
                    $x = 1;
                }
                $page_begin = $this->page;
               // $page_begin = $this->page;
                $this->SetFillColor(255, 255, 255);
                $this->SetXY(105, $_SESSION['pdf_y_val_odd']);
                $this->Cell(95, 4, utf8_decode('Vecka ' . $report['week']), 1, 1, 'C', FALSE);

                foreach(array('mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun') as $day_key){
                    $a = 0;

                    //show manned slots
                    if (!empty($report['data'][$day_key])) {
                        foreach ($report['data'][$day_key] as $selected_day) {
                            $this->SetX(105);
                            $selected_day_flags = explode(",", $selected_day['time']);
                            if ($selected_day_flags[2] == 2) {
                                $this->setFillColourByStatus($selected_day_flags[2]);
                            } else {
                                $this->SetFillColor(255, 255, 255);
                            }
                            $bg_flag = ($selected_day_flags[2] == 1 ? FALSE : TRUE);
                            $x_val = $this->GetX();
                            $time_val = explode(".", $selected_day_flags[0]);
                            if ($a == 0) {
                                $this->Cell(30, 4, $report[$day_key][2] . "-" . $report[$day_key][1] . "-" . $report[$day_key][0], 'TLB', 0, 'L', FALSE);
                                $this->SetX($x_val + 16);
                                $this->Cell(7, 4, utf8_decode($smarty->translate[$day_key]), 'TRB', 0, 'L', FALSE);
                            } else {
                                $this->Cell(23, 4, '', 1, 0, 'L', FALSE);
                            }
                            if ($selected_day_flags[2] == 2 && $selected_day_flags[7] != '')
                                $this->Cell($time_data_column_width, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $selected_day_flags[3] . "  " . utf8_decode($leave_type_short[$selected_day_flags[7]]), 1, 0, 'L', true);
                            elseif ($selected_day_flags[1] == 3)
                                $this->Cell($time_data_column_width, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $selected_day_flags[3] . "  " . utf8_decode($smarty->translate['oncall_shortcut']), 1, 0, 'L', true);
                            elseif ($selected_day_flags[1] == 9)
                                $this->Cell($time_data_column_width, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $selected_day_flags[3] . "  " . utf8_decode($smarty->translate['cal_training_shortcut']), 1, 0, 'L', true);
                            else
                                $this->Cell($time_data_column_width, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $selected_day_flags[3], 1, 0, 'L', true);

                            $this->SetFillColor($selected_day['r'], $selected_day['g'], $selected_day['b']);
                            $this->Cell($colour_code_width, 4, '', 1, 0, 'L', true);
                            if ($selected_day_flags[2] == 2) {
                                $this->setFillColourByStatus($selected_day_flags[2]);
                            } else {
                                $this->SetFillColor(255, 255, 255);
                            }
                            $truncated_employee_name = $this->truncate_employee_name(trim($selected_day['empl']), 28);
                            if ($cust_flag == 1)
                                $this->Cell($employee_name_column_width, 4, utf8_decode($truncated_employee_name) . " ( " . substr($selected_day_flags[5], 0, 1) . substr($selected_day_flags[6], 0, 1) . " )", 1, 0, 'L', true);
                            else
                                $this->Cell($employee_name_column_width, 4, utf8_decode($truncated_employee_name), 1, 0, 'L', true);
                            $this->SetXY(105, $this->GetY() + 4);
                            $a++;
                            $week_entry_count++;
                            if ($this->page != $pg_week_section_begins_local) {
                                $pg_week_section_begins_local = $this->page;
                                $section_start_y = 10;
                                $week_entry_count = 0;
                            }
                        }
                    }

                    //show un-manned slots
                    if (!empty($report['unmanned-data'][$day_key])) {
                        foreach ($report['unmanned-data'][$day_key] as $selected_day) {
                            $this->SetX(105);
                            $selected_day_flags = explode(",", $selected_day['time']);
                            $this->setFillColourByStatus($selected_day_flags[2]);
                            $bg_flag = ($selected_day_flags[2] == 1 ? FALSE : TRUE);
                            $x_val = $this->GetX();
                            $time_val = explode(".", $selected_day_flags[0]);
                            if ($a == 0) {
                                $this->Cell(30, 4, $report[$day_key][2] . "-" . $report[$day_key][1] . "-" . $report[$day_key][0], 'TLB', 0, 'L', FALSE);
                                $this->SetX($x_val + 16);
                                $this->Cell(7, 4, utf8_decode($smarty->translate[$day_key]), 'TRB', 0, 'L', FALSE);
                            } else {
                                $this->Cell(23, 4, '', 1, 0, 'L', FALSE);
                            }
                            if ($selected_day_flags[2] == 2 && $selected_day_flags[7] != '')
                                $this->Cell($time_data_column_width, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $selected_day_flags[3] . "  " . utf8_decode($leave_type_short[$selected_day_flags[7]]), 1, 0, 'L', true);
                            elseif ($selected_day_flags[1] == 3)
                                $this->Cell($time_data_column_width, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $selected_day_flags[3] . "  " . utf8_decode($smarty->translate['oncall_shortcut']), 1, 0, 'L', true);
                            elseif ($selected_day_flags[1] == 9)
                                $this->Cell($time_data_column_width, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $selected_day_flags[3] . "  " . utf8_decode($smarty->translate['cal_training_shortcut']), 1, 0, 'L', true);
                            else
                                $this->Cell($time_data_column_width, 4, $time_val[0] . $time_val[1] . $time_val[2] . $time_val[3] . "   " . $selected_day_flags[3], 1, 0, 'L', true);

                            $this->Cell($colour_code_width, 4, '', 1, 0, 'L', true);
                            if ($cust_flag == 1)
                                $this->Cell($employee_name_column_width, 4, "( " . substr($selected_day_flags[5], 0, 1) . substr($selected_day_flags[6], 0, 1) . " )", 1, 0, 'L', true);
                            else
                                $this->Cell($employee_name_column_width, 4, "", 1, 0, 'L', true);
                            $this->SetXY(105, $this->GetY() + 4);
                            $a++;
                            $week_entry_count++;
                            if ($this->page != $pg_week_section_begins_local) {
                                $pg_week_section_begins_local = $this->page;
                                $section_start_y = 10;
                                $week_entry_count = 0;
                            }
                        }
                    }
                }

                if ($sizes[$i] <= $sizes[$i - 1]) {
                    $this->SetX(105);
                    for ($j = 0; $j < ($sizes[$i - 1] - $sizes[$i]) - 1; $j++) {
                        if ($this->GetY() > 270) {
                            $this->Cell(95, 4, '', 'LRT', 1, 'C', FALSE);
                            $this->SetXY(105, $this->GetY());
                        }
                        
                        if ($this->GetY() > 268) {
                            $this->Cell(95, 4, '', 'LRB', 1, 'C', FALSE);
                        } else if ($this->GetY() < 14) {
                            $this->Cell(95, 4, '', 'LRT', 1, 'C', FALSE);
                        } else {
                            $this->Cell(95, 4, '', 'LR', 1, 'C', FALSE);
                        }
                        $this->SetXY(105, $this->GetY());
                    }
                    if ($this->GetY() < 14) {
                        $this->Cell(95, 4, '', 'LRBT', 1, 'C', FALSE);
                    } else if ($this->GetY() > 270) {
                        $this->Cell(95, 4, '', 'LRBT', 1, 'C', FALSE);
                    } else {
                        $this->Cell(95, 4, '', 'LRB', 1, 'C', FALSE);
                    }
                    $this->SetXY(105, $this->GetY());
                } else {

                    $this->SetXY(10,$_SESSION['pdf_y_val_even']);
                   // $this->SetXY(10, $section_start_y);

                    $temp_rows_count = $sizes[$i] - $sizes[$i - 1] - 1;
                    for ($j = 0; $j < $temp_rows_count; $j++) {
                        if ($this->GetY() > 270) {
                            $this->Cell(95, 4, '', 'LRT', 1, 'C', FALSE);
                        } else if ($this->GetY() > 268) {
                            $this->Cell(95, 4, 6, '', 'LRB', 1, 'C', FALSE);
                        } else if ($this->GetY() < 14) {
                            $this->Cell(95, 4, '', 'LRT', 1, 'C', FALSE);
                        } else {
                            $this->Cell(95, 4, '', 'LR', 1, 'C', FALSE);
                        }
                        $this->SetXY(10, $this->GetY());
                    }
                    if ($this->GetY() < 14) {
                        $this->Cell(95, 4, '', 'LRBT', 1, 'C', FALSE);
                    } else if ($this->GetY() > 270) {
                        $this->Cell(95, 4, 6, '', 'LRBT', 1, 'C', FALSE);
                    } else {
                        $this->Cell(95, 4, '', 'LRB', 1, 'C', FALSE);
                    }
                    $this->SetXY(10, $this->GetY());
                }
                if ($x == 1) {
                    $this->pages[$this->page] = $pagechange . $this->pages[$this->page];
                }
                $pagechange = $this->pages[$this->page];
                $i++;
                $_SESSION['pdf_y_val_odd'] = $this->GetY();
                $_SESSION['pdf_y_val_even'] = $this->GetY();
            }
            
            /*echo "end: <pre>".print_r(array('$page_begin' => $page_begin, 
                '$i' => $i-1,
                //'$pagechange' => $pagechange,
                '$pg_week_section_begins' => $pg_week_section_begins,
                '$pg_week_section_begins_local' => $pg_week_section_begins_local,
                '$week_entry_count' => $week_entry_count,
                '$section_start_y' => $section_start_y,
                'pdf_y_val_even' => $_SESSION['pdf_y_val_even'],
                'pdf_y_val_odd' => $_SESSION['pdf_y_val_odd']
                ), 1)."</pre>";*/
        }
    }

    function truncate_employee_name($employee_name, $limit, $break = " ", $pad = "...") {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: truncating the employee name
         */
        if (strlen($employee_name) <= $limit)
            return $employee_name;

        $employee_name = substr($employee_name, 0, $limit);
        if (false !== ($breakpoint = strrpos($employee_name, $break))) {
            $employee_name = substr($employee_name, 0, $breakpoint);
        }

        return $employee_name . $pad;
    }

    function P1_Part1_for_excel($customer, $html, $total_number_of_columns) {

        $year = $this->report_year;
        $month = $this->report_month;
        $start_date = $this->report_start_date;
        $end_date = $this->report_end_date;

        $smarty = new smartySetup(array("reports.xml"), FALSE);
        $html .= '<tr bgcolor="#DAF2F7" style="background:#DAF2F7; color:#666; font-size=17px;">
                        <th colspan="'.$total_number_of_columns.'">'.utf8_decode($smarty->translate['customer_month_report_pdf']).'</th>
                    </tr>';

        if ($customer['username'] != '' || $customer['username'] != null) {

            $first_column_span  = floor($total_number_of_columns/2);
            $second_column_span = ceil($total_number_of_columns/2);

            $html .= '<tr bgcolor="#DAF2F7"  style="background:#DAF2F7; color:#666;">
                        <th colspan="'.$first_column_span.'">'.utf8_decode($smarty->translate['customer_report_customer_name']).'</th>
                        <th colspan="'.$second_column_span.'">'.utf8_decode($smarty->translate['customer_report_socialsecurity']).'</th>
                    </tr>
                    <tr>
                        <td colspan="'.$first_column_span.'">'.utf8_decode($customer['first_name'] . " " . $customer['last_name']).'</td>
                        <td colspan="'.$second_column_span.'">'.$customer['social_security'].'</td>
                    </tr>';
        }


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

        
        if ($customer['username'] != ''&& $customer['username'] != null) {
            $html .= '<tr><td colspan="'.$total_number_of_columns.'"></td></tr>
                    <tr bgcolor="#DAF2F7"  style="background:#DAF2F7; color:#666;">
                        <th colspan="'.$first_column_span.'">'.utf8_decode($smarty->translate['contract_hour']).'</th>
                        <th colspan="'.$second_column_span.'">'.utf8_decode($smarty->translate['worked_hour']).'</th>
                    </tr>
                    <tr>
                        <td colspan="'.$first_column_span.'">'.'FK: '.$this->contract_hours_fk.' | KN: '.$this->contract_hours_kn.'</td>
                        <td colspan="'.$second_column_span.'">'.'FK: '.$this->worked_hour_fk.' | KN: '.$this->worked_hour_kn.'</td>
                    </tr>';
        }
        return $html;
    }

    function P1_Part2_Landscape_for_excel($cust_flag = 0, $html = '', $total_number_of_columns = 5) {

        $smarty = new smartySetup(array("user.xml", "month.xml", "messages.xml", "button.xml", "forms.xml", "gdschema.xml"), FALSE);
        global $leave_type_short;

        $table_head_content = array("Mån", "Tis", "Ons", "Tors", "Fre", "Lör", "Sön", "Summa");
        $weeks = array("mon", "tue", "wed", "thu", "fri", "sat", "sun");
        $col_h = 5;
        $temp_col_h = 0;
        $temp_current_rh = 0;
        $temp_col_h_half = 0;
        $temp_current_rh_half = 0;
        $i = 0;
        $html .= '<tr><td colspan="'.$total_number_of_columns.'"></td></tr>';

        foreach ($this->rpt_contents as $report) {

            $html .= '<tr bgcolor="#DAF2F7" style="background:#DAF2F7; color:#666; font-size=17px;">
                        <th colspan="'.$total_number_of_columns.'">'.utf8_decode('Vecka ' . $report['week']).'</th>
                    </tr>';

            $html .= '<tr bgcolor="#DAF2F7" style="background:#DAF2F7; color:#666; font-size=17px;">
                        <th>'.utf8_decode('Anställd').'</th>';

            for ($m = 0; $m < 8; $m++) {     //set column headings for each table
                $html .= '<th>'.utf8_decode($table_head_content[$m]) . "  " . $report[$weeks[$m]][0].'</th>';
            }
            $html .= '</tr>';

            foreach ($report['employee'] as $emp) {

                /*$html .= '<tr style="background:#DAF2F7; color:#666; font-size=17px;">
                        <th colspan="'.$total_number_of_columns.'">'.utf8_decode('Vecka ' . $report['week']).'</th>
                    </tr>';

                $html .= '<tr style="background:#DAF2F7; color:#666; font-size=17px;">
                            <th>'.utf8_decode('Anställd').'</th>';

                for ($m = 0; $m < 8; $m++) {     //set column headings for each table
                    $html .= '<th>'.utf8_decode($table_head_content[$m]) . "  " . $report[$weeks[$m]][0].'</th>';
                }
                $html .= '</tr>';*/


                $html .= '<tr>
                            <td>'.utf8_decode($emp['name']).'</td>';


                ///-----------------------SDN alteration--------------------------------------------
                $controller = array(1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat', 7 => 'Sun');
                foreach ($controller as $w_key => $day_thread) {
                    
                    $html .= '<td>';
                    if (!empty($emp[$day_thread])) {
                        $indx = 0;
                        foreach ($emp[$day_thread] as $day_val) {
                            $man = explode(',', $day_val);
                           

                            $additional_label = '';
                            if ($man[2] == 2 && $man[7] != '') $additional_label = utf8_decode($leave_type_short[$man[7]]);
                            elseif ($man[1] == 0) $additional_label = utf8_decode($smarty->translate['working_shortcut']);
                            else if ($man[1] == 1) $additional_label = utf8_decode($smarty->translate['travel_shortcut']);
                            else if ($man[1] == 2) $additional_label = utf8_decode($smarty->translate['lunch_shortcut']);
                            else if ($man[1] == 3) $additional_label = utf8_decode($smarty->translate['oncall_shortcut']);
                            else if ($man[1] == 4) $additional_label = utf8_decode($smarty->translate['overtime_shortcut']);
                            else if ($man[1] == 5) $additional_label = utf8_decode($smarty->translate['more_overtime_shortcut']);
                            else if ($man[1] == 6) $additional_label = utf8_decode($smarty->translate['quality_overtime_shortcut']);
                            else if ($man[1] == 7) $additional_label = utf8_decode($smarty->translate['some_othertime_shortcut']);
                            else if ($man[1] == 8) $additional_label = utf8_decode($smarty->translate['training_time_shortcut']);
                            else if ($man[1] == 9) $additional_label = utf8_decode($smarty->translate['cal_training_shortcut']);
                            else if ($man[1] == 10) $additional_label = utf8_decode($smarty->translate['personal_meeting_shortcut']);
                            else if ($man[1] == 11) $additional_label = utf8_decode($smarty->translate['voluntary_shortcut']);
                            else if ($man[1] == 12) $additional_label = utf8_decode($smarty->translate['complementary_shortcut']);
                            else if ($man[1] == 13) $additional_label = utf8_decode($smarty->translate['complementary_oncall_shortcut']);
                            else if ($man[1] == 14) $additional_label = utf8_decode($smarty->translate['more_oncall_shortcut']);
                            else if ($man[1] == 16) $additional_label = utf8_decode($smarty->translate['work_for_dismissal_shortcut']);
                            
                            $html .= utf8_decode($man[0]) . "(" . substr($man[5], 0, 1) . substr($man[6], 0, 1) . ")   ". $additional_label .'<br/>';
                            
                        }
                    }

                    $html .= '</td>';
                }

                $html .= '<td>'.$emp['sum'].'</td>';
                $html .= '</tr>';
                ///-----------------------SDN alteration endz--------------------------------------------

            }

            if (!empty($report['unmanned'])) {

                $html .= '<tr>
                            <td>'.utf8_decode($smarty->translate['unmanned']).'</td>';


                ///-----------------------SDN alteration--------------------------------------------
                $controller = array(1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat', 7 => 'Sun');
                foreach ($controller as $w_key => $day_thread) {
                    
                    $html .= '<td>';
                    if (!empty($report['unmanned'][$day_thread])) {
                        $indx = 0;
                        foreach ($report['unmanned'][$day_thread] as $day_val) {
                            $man = explode(',', $day_val);
                           

                            $additional_label = '';
                            if ($man[2] == 2 && $man[7] != '') $additional_label = utf8_decode($leave_type_short[$man[7]]);
                            elseif ($man[1] == 0) $additional_label = utf8_decode($smarty->translate['working_shortcut']);
                            else if ($man[1] == 1) $additional_label = utf8_decode($smarty->translate['travel_shortcut']);
                            else if ($man[1] == 2) $additional_label = utf8_decode($smarty->translate['lunch_shortcut']);
                            else if ($man[1] == 3) $additional_label = utf8_decode($smarty->translate['oncall_shortcut']);
                            else if ($man[1] == 4) $additional_label = utf8_decode($smarty->translate['overtime_shortcut']);
                            else if ($man[1] == 5) $additional_label = utf8_decode($smarty->translate['more_overtime_shortcut']);
                            else if ($man[1] == 6) $additional_label = utf8_decode($smarty->translate['quality_overtime_shortcut']);
                            else if ($man[1] == 7) $additional_label = utf8_decode($smarty->translate['some_othertime_shortcut']);
                            else if ($man[1] == 8) $additional_label = utf8_decode($smarty->translate['training_time_shortcut']);
                            else if ($man[1] == 9) $additional_label = utf8_decode($smarty->translate['cal_training_shortcut']);
                            else if ($man[1] == 10) $additional_label = utf8_decode($smarty->translate['personal_meeting_shortcut']);
                            else if ($man[1] == 11) $additional_label = utf8_decode($smarty->translate['voluntary_shortcut']);
                            else if ($man[1] == 12) $additional_label = utf8_decode($smarty->translate['complementary_shortcut']);
                            else if ($man[1] == 13) $additional_label = utf8_decode($smarty->translate['complementary_oncall_shortcut']);
                            else if ($man[1] == 14) $additional_label = utf8_decode($smarty->translate['more_oncall_shortcut']);
                            else if ($man[1] == 16) $additional_label = utf8_decode($smarty->translate['work_for_dismissal_shortcut']);
                            
                            $html .= utf8_decode($man[0]) . "(" . substr($man[5], 0, 1) . substr($man[6], 0, 1) . ")   ". $additional_label .'<br/>';
                            
                        }
                    }

                    $html .= '</td>';
                }

                $html .= '<td>'.$report['unmanned']['sum'].'</td>';
                $html .= '</tr>';
                ///-----------------------SDN alteration endz--------------------------------------------

            }

            $html .= '<tr bgcolor="#dadaf7" style="background:#dadaf7; color:#666;">
                            <td>'.utf8_decode('Summa').'</td>
                            <td>'.$this->rpt_sum[$i]['mon'].'</td>
                            <td>'.$this->rpt_sum[$i]['tue'].'</td>
                            <td>'.$this->rpt_sum[$i]['wed'].'</td>
                            <td>'.$this->rpt_sum[$i]['thu'].'</td>
                            <td>'.$this->rpt_sum[$i]['fri'].'</td>
                            <td>'.$this->rpt_sum[$i]['sat'].'</td>
                            <td>'.$this->rpt_sum[$i]['sun'].'</td>
                            <td>'.sprintf('%.02f', round($this->rpt_sum[$i]['mon']+$this->rpt_sum[$i]['tue']+$this->rpt_sum[$i]['wed']+$this->rpt_sum[$i]['thu']+$this->rpt_sum[$i]['fri']+$this->rpt_sum[$i]['sat']+$this->rpt_sum[$i]['sun'], 2)).'</td>
                    </tr>';
            $i +=1;

            $html .= '<tr><td colspan="'.$total_number_of_columns.'"></td></tr>';
        }

        return $html;
    }

}

?>