<?php
/**
* Author: Shamsudheen <shamsu@arioninfotech.com>
* for: PDF sick details report for employee
*/

require_once('./plugins/F_pdf.class.php');
require_once('./plugins/fpdi/fpdi.php');

class PDF_vab_report extends FPDI {
    
    var $smarty = array();
    var $login_company_id = '';
    
    function __construct() {
        parent::__construct();
        $this->SetAuthor('Shamsudheen');
        $this->SetCreator('Shamsudheen');
        $this->SetTitle('Work Report');
        $this->SetAutoPageBreak(FALSE);
        
        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0, 50, 50);
        
        $this->smarty = new smartySetup(array("forms.xml"),FALSE);
//        $this->login_company_id = $_SESSION['company_id'];
//        $this->login_company_id = 8;    //optimal
    }

    function report_header($year, $month, $company_data, $cust_details, $emp_details) {
        $this->SetFont('Times', 'B', 20);
        $this->SetXY(13, 20);
//        $this->Cell(180, 7, utf8_decode('Stugknuten ekonomisk förening'), 0, 0, 'L', FALSE);
        $this->Cell(180, 7, utf8_decode($company_data['name']), 0, 0, 'L', FALSE);
        $this->SetXY(13, 20);
//        $this->Cell(180, 7, utf8_decode('Avvikelserapport'), 0, 0, 'R', FALSE);
        $this->Cell(180, 7, utf8_decode($this->login_company_id == 8 ? $this->smarty->translate['print_sick_details_report_optimal'] : $this->smarty->translate['print_sick_details_report']), 0, 0, 'R', FALSE);
        
        $this->SetFont('Times', '', 13);
//        $this->SetXY(13, $this->GetY()+8);
//        $this->Cell(180, 7, utf8_decode('sjukdom, VAB, utbildning samt introduktion'), 0, 0, 'R', FALSE);
        
        $this->SetXY(13, $this->GetY()+10);
        $this->Cell(32, 7, utf8_decode('Assistans'), 0, 1, 'L', FALSE);
        $this->SetXY(13, $this->GetY()-2);
        $this->Cell(22, 7, utf8_decode('berättigad:'), 0, 0, 'L', FALSE);
        $this->Cell(63, 7, utf8_decode($cust_details[0]['fullname']), 'B', 0, 'L', FALSE);
        
        $this->SetXY(105, $this->GetY());
        $this->Cell(32, 7, utf8_decode('Avser år/månad:'), 0, 0, 'L', FALSE);
        $this->Cell(55, 7, $year.  ' / ' . sprintf("%02d",$month), 'B', 1, 'L', FALSE);
        
        
        $this->SetXY(13, $this->GetY()+5);
        $this->Cell(32, 7, utf8_decode('Assistens namn:'), 0, 0, 'L', FALSE);
        $this->Cell(55, 7, utf8_decode($emp_details[0]['fullname']), 'B', 0, 'L', FALSE);
        
        $this->SetX(105);
        $this->Cell(16.5, 7, utf8_decode('Pers nr:'), 0, 0, 'L', FALSE);
        $this->Cell(70.5, 7, $emp_details[0]['century'] . $this->format_SSN($emp_details[0]['social_security']), 'B', 0, 'L', FALSE);
    }

    function content_table_old($sick_details, $distinct_ob_field_names, $company_salary_system = '') {
        $obj_equipment = new equipment();
        $obj_smarty = new smartySetup(array('month.xml'),FALSE);
        $w = array(7.6, 12.6, 27, 15, 27, 15, 75);
        $col_h = 6.72;
        $dark_line_width = 0.7;
        $this->SetFont('Arial', 'B', 9);
//        $total_content_rows = count($sick_details);
        
        $this->SetXY(13, $this->GetY()+13);
        
        //OB column widths
//        $OB_columns = array('Kväll', 'Natt', 'Helg', 'Storhelg');
        $OB_columns = $distinct_ob_field_names;
        list($this_x, $this_y) = array($this->GetX(), $this->GetY());
        
        $normal_sum = $jour_sum = 0;
        $ob_sum_array = array();
        
        //draw table headings----------------------------------------------------------------------
        $this->SetLineWidth($dark_line_width);
        $this->Cell($w[0], $col_h, '', 'TL', 0, 'L', FALSE);   //table cell 1
        $this->Cell($w[1], $col_h, '', 'T', 0, 'L', FALSE);   //table cell 2
        $this->Cell($w[2], $col_h, '', 'T', 0, 'L', FALSE);   //table cell 3
        $this->Cell($w[3], $col_h, '', 'TR', 0, 'R', FALSE);   //table cell 4
        $this->Cell($w[4], $col_h, '', 'TL', 0, 'L', FALSE);   //table cell 5
        $this->Cell($w[5], $col_h, '', 'TR', 0, 'R', FALSE);   //table cell 6
        $this->Cell($w[6], $col_h, 'OB', 'TLR', 1, 'C', FALSE);   //table cell 7
        
        $this->SetX(13);
        $this->Cell($w[0], $col_h, 'Dat', 'BL', 0, 'L', FALSE);   //table cell 1
        $this->Cell($w[1], $col_h, 'Dag', 'B', 0, 'L', FALSE);   //table cell 2
        $this->Cell($w[2], $col_h, 'Arbetstid', 'B', 0, 'C', FALSE);   //table cell 3
        $this->Cell($w[3], $col_h, 'Tim', 'BR', 0, 'R', FALSE);   //table cell 4
        $this->Cell($w[4], $col_h, 'Jourtid', 'BL', 0, 'C', FALSE);   //table cell 5
        $this->Cell($w[5], $col_h, 'Tim', 'BR', 0, 'R', FALSE);   //table cell 6
        $this->SetLineWidth(0);
        $total_obs = count($OB_columns);
        $ob_column_width = ($total_obs > 0 ? $w[6]/$total_obs : $w[6]);
        if($total_obs > 0){
            foreach ($OB_columns as $ob_column){
                if($ob_column == '__holiday__') $ob_column = 'Storhelg';
                else if($ob_column == '__holiday_helg__') $ob_column = 'Helg';
                $this->Cell($ob_column_width, $col_h, utf8_decode($ob_column), 1, 0, 'C', FALSE);   //table cell 7
            }
        }else
            $this->Cell($w[6], $col_h, '', 'BLR', 0, 'C', FALSE);   //table cell 7
        
        //darken the border
        $this->SetXY($this_x, $this_y);
        $this->SetLineWidth($dark_line_width);
        $this->Cell(array_sum($w), $col_h*2, '', 1, 0, 'L', FALSE);
        $this->SetLineWidth(0);
        
        //draw table body----------------------------------------------------------------------
        $this->Ln();
        $total_sick_count = count($sick_details);
        $normal_included_slot_types = array(0, 1, 2, 4, 5, 6, 7, 8, 10, 11, 12);
        $oncall_included_slot_types = array(3, 9, 13);
        //echo "<pre>".print_r($sick_details, 1)."</pre>";
        for ($i = 0 ; $i < 23 ; $i++) {
            if(!in_array($sick_details[$i]['type'], $normal_included_slot_types) && !in_array($sick_details[$i]['type'], $oncall_included_slot_types))
                    continue;
            
            $this->SetX(13);
            list($this_x, $this_y) = array($this->GetX(), $this->GetY());
            
            if($i < $total_sick_count){
                $time_in_100 = $obj_equipment->time_user_format($obj_equipment->time_difference($sick_details[$i]['time_to'], $sick_details[$i]['time_from']), 100);
                $week_day_ind = strtolower(date_format(date_create($sick_details[$i]['date']), "D"));

                $this->Cell($w[0], $col_h, date('d', strtotime($sick_details[$i]['date'])), 1, 0, 'C', FALSE);   //table cell 1
                $this->Cell($w[1], $col_h, utf8_decode($obj_smarty->translate[$week_day_ind]), 1, 0, 'C', FALSE);   //table cell 2

                if (in_array($sick_details[$i]['type'], $normal_included_slot_types)) {
                    $this->Cell($w[2], $col_h, $sick_details[$i]['time_from'] . ' - ' . $sick_details[$i]['time_to'], 1, 0, 'C', FALSE);   //table cell 3
                    $this->Cell($w[3], $col_h, sprintf('%.02f', round($time_in_100, 2)), 1, 0, 'R', FALSE);   //table cell 4
                    $normal_sum += round($time_in_100, 2);
                }else{
                    $this->Cell($w[2], $col_h, '', 1, 0, 'L', FALSE);   //table cell 3
                    $this->Cell($w[3], $col_h, '', 1, 0, 'R', FALSE);   //table cell 4
                }

                if (in_array($sick_details[$i]['type'], $oncall_included_slot_types)) {
                    $this->Cell($w[4], $col_h, $sick_details[$i]['time_from'] . ' - ' . $sick_details[$i]['time_to'], 1, 0, 'C', FALSE);   //table cell 5
                    $this->Cell($w[5], $col_h, sprintf('%.02f', round($time_in_100, 2)), 1, 0, 'R', FALSE);   //table cell 6
                    $jour_sum += round($time_in_100, 2);
                }else{
                    $this->Cell($w[4], $col_h, '', 1, 0, 'L', FALSE);   //table cell 5
                    $this->Cell($w[5], $col_h, '', 1, 0, 'R', FALSE);   //table cell 6
                }

                if($total_obs > 0){
                    foreach ($OB_columns as $ob_column){
                        //skip oncall hours from OB area
                        if(isset($sick_details[$i]['inconv_details'][$ob_column])){
                            
                            if(($company_salary_system == 3) || ($company_salary_system != 3 && !in_array($sick_details[$i]['type'], $oncall_included_slot_types))){
                                echo "<pre>".print_r($sick_details, 1)."</pre>";
                                $ob_time_in_100 = $obj_equipment->time_user_format($sick_details[$i]['inconv_details'][$ob_column], 100);
                                //$ob_time_in_100 = $sick_details[$i]['inconv_details'][$ob_column];
                                $this->Cell($ob_column_width, $col_h, sprintf('%.02f', round($ob_time_in_100, 2)), 1, 0, 'R', FALSE);   //table cell 7

                                if(isset($ob_sum_array[$ob_column]))
                                    $ob_sum_array[$ob_column] += round($ob_time_in_100, 2);
                                else
                                    $ob_sum_array[$ob_column] = round($ob_time_in_100, 2);
                            }
                            else 
                                $this->Cell($ob_column_width, $col_h, '', 1, 0, 'R', FALSE);   //table cell 7
                            
                        }else
                            $this->Cell($ob_column_width, $col_h, '', 1, 0, 'R', FALSE);   //table cell 7
                    }
                }else
                    $this->Cell($w[6], $col_h, '', 1, 0, 'R', FALSE);   //table cell 7
            }
            else {
                $this->Cell($w[0], $col_h, '', 1, 0, 'C', FALSE);   //table cell 1
                $this->Cell($w[1], $col_h, '', 1, 0, 'C', FALSE);   //table cell 2
                $this->Cell($w[2], $col_h, '', 1, 0, 'L', FALSE);   //table cell 3
                $this->Cell($w[3], $col_h, '', 1, 0, 'R', FALSE);   //table cell 4
                $this->Cell($w[4], $col_h, '', 1, 0, 'L', FALSE);   //table cell 5
                $this->Cell($w[5], $col_h, '', 1, 0, 'R', FALSE);   //table cell 6

                if($total_obs > 0){
                    foreach ($OB_columns as $ob_column){
                        $this->Cell($ob_column_width, $col_h, '', 1, 0, 'R', FALSE);   //table cell 7
                    }
                }else
                    $this->Cell($w[6], $col_h, '', 1, 0, 'R', FALSE);   //table cell 7
            }

            //darken the border
            $this->SetXY($this_x, $this_y);
            $this->SetLineWidth($dark_line_width);
            $this->Cell($w[0]+$w[1]+$w[2]+$w[3], $col_h, '', 'LR', 0, 'L', FALSE);
            $this->Cell($w[4]+$w[5], $col_h, '', 'LR', 0, 'L', FALSE);
            $this->Cell($w[6], $col_h, '', 'LR', 0, 'L', FALSE);
            $this->SetLineWidth(0);

            $this->SetY($this->GetY() + $col_h);
        }
        
        //table sum----------------------------------------------------------------------
//        $this->Ln();
        $this->SetX(13);
        $this->SetLineWidth($dark_line_width);
        $this->Cell($w[0]+$w[1], $col_h, '', 'T', 0, 'C', FALSE);   //table cell 1
        $this->Cell($w[2], $col_h, utf8_decode('S:a tim'), 'TLB', 0, 'L', FALSE);   //table cell 3
        $this->Cell($w[3], $col_h, sprintf('%.02f', round($normal_sum, 2)), 'TRB', 0, 'R', FALSE);   //table cell 4

        $this->Cell($w[4], $col_h, utf8_decode('S:a tim'), 'TLB', 0, 'L', FALSE);   //table cell 5
        $this->Cell($w[5], $col_h, sprintf('%.02f', round($jour_sum, 2)), 'TRB', 0, 'R', FALSE);   //table cell 6
        
        if($total_obs > 0){
            foreach ($OB_columns as $ob_column){
                $this->Cell($ob_column_width, $col_h, sprintf('%.02f', round($ob_sum_array[$ob_column], 2)), 1, 0, 'R', FALSE);   //table cell 7
            }
        }else
            $this->Cell($w[6], $col_h, '', 1, 0, 'R', FALSE);   //table cell 7
        
        $this->SetLineWidth(0);
    }
    
    function calc_header_height($rw, $OB_columns) {
        
        $this->SetTextColor(255,255,255);
        $maxlen = 4;
        $tr_lower_y = 60;
        list($this_x, $this_y) = array($this->GetX(), $this->GetY());
        $this->SetXY(18, $this->GetY());
        $header_start_y = $this->GetY();
            
        foreach ($OB_columns as $ob_column){
            $a_x = $this->GetX();
            $a_y = $this->GetY();
            if($ob_column == '__holiday__') $ob_column = 'Storhelg';
            else if($ob_column == '__holiday_helg__') $ob_column = 'Helg';
            $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($ob_column)), 0, 'C');

            $caption_len = strlen($ob_column);
            if ($maxlen < $caption_len) {
                $maxlen = $caption_len;
                $tr_lower_y = $this->GetY();
            }
            $this->SetXY($a_x, $a_y);
        }
        
        $this->SetXY($this_x, $this_y);
        $new_header_height = $tr_lower_y - $header_start_y;
        $this->SetTextColor(0,0,0);
        return array('header_height' => $new_header_height, 'tr_start_y' => $tr_lower_y);
        
    }
    
    function content_table_generation($sick_details, $distinct_ob_field_names, $company_salary_system = ''){
        if($this->login_company_id == 8)
            $this->content_table_optimal($sick_details, $distinct_ob_field_names, $company_salary_system);
        else
            $this->content_table($sick_details, $distinct_ob_field_names, $company_salary_system);
    }
    function content_table($sick_details, $distinct_ob_field_names, $company_salary_system = '') {
        $obj_equipment = new equipment();
        $obj_smarty = new smartySetup(array('month.xml'),FALSE);
        $w = array(7.6, 12.6, 27, 15, 27, 15, 75);
        $col_h = 6.72;
        $dark_line_width = 0.7;
        $this->SetFont('Arial', 'B', 9);
//        $total_content_rows = count($sick_details);
        
        $this->SetXY(13, $this->GetY()+13);
        
        //OB column widths
//        $OB_columns = array('Kväll', 'Natt', 'Helg', 'Storhelg');
        $OB_columns = $distinct_ob_field_names;
        list($this_x, $this_y) = array($this->GetX(), $this->GetY());
        
        $normal_sum = $jour_sum = 0;
        $ob_sum_array = array();
        
        $total_obs = count($OB_columns);
        $ob_column_width = ($total_obs > 0 ? $w[6]/$total_obs : $w[6]);
        $ob_columns_count = ($total_obs > 0 ? $total_obs : 1);
        $header_calc_values = $this->calc_header_height($ob_column_width, $OB_columns);
        $calulated_header = $header_calc_values['header_height'];
        
        //draw table headings----------------------------------------------------------------------
        $this->SetLineWidth($dark_line_width);
        $this->Cell($w[0], $col_h, '', 'TL', 0, 'L', FALSE);   //table cell 1
        $this->Cell($w[1], $col_h, '', 'T', 0, 'L', FALSE);   //table cell 2
        $this->Cell($w[2], $col_h, '', 'T', 0, 'L', FALSE);   //table cell 3
        $this->Cell($w[3], $col_h, '', 'TR', 0, 'R', FALSE);   //table cell 4
        $this->Cell($w[4], $col_h, '', 'TL', 0, 'L', FALSE);   //table cell 5
        $this->Cell($w[5], $col_h, '', 'TR', 0, 'R', FALSE);   //table cell 6
        $this->Cell($w[6], $col_h, 'OB', 'TLR', 1, 'C', FALSE);   //table cell 7
        
        $this->SetX(13);
        $this->Cell($w[0], $calulated_header, 'Dat', 'BL', 0, 'L', FALSE);   //table cell 1
        $this->Cell($w[1], $calulated_header, 'Dag', 'B', 0, 'L', FALSE);   //table cell 2
        $this->Cell($w[2], $calulated_header, 'Arbetstid', 'B', 0, 'C', FALSE);   //table cell 3
        $this->Cell($w[3], $calulated_header, 'Tim', 'BR', 0, 'C', FALSE);   //table cell 4
        $this->Cell($w[4], $calulated_header, 'Jourtid', 'BL', 0, 'C', FALSE);   //table cell 5
        $this->Cell($w[5], $calulated_header, 'Tim', 'BR', 0, 'C', FALSE);   //table cell 6
        $this->SetLineWidth(0);
//        echo "<pre>".print_r($header_calc_values, 1)."</pre>";
        
        list($b4_x_ob_column, $b4_y_ob_column) = array($this->GetX(), $this->GetY());
        $this->SetFont('Arial', '', 7);
        if($total_obs > 0){
            foreach ($OB_columns as $ob_column){
                if($ob_column == '__holiday__') $ob_column = 'Storhelg';
                else if($ob_column == '__holiday_helg__') $ob_column = 'Helg';
//                $this->Cell($ob_column_width, $calulated_header, utf8_decode($ob_column), 1, 0, 'C', FALSE);   //table cell 7
                
                list($b4_x, $b4_y) = array($this->GetX(), $this->GetY());
                $this->Cell($ob_column_width, $calulated_header, '', 1, 0, 'C', TRUE);
                list($af_x, $af_y) = array($this->GetX(), $this->GetY());
                $this->SetXY($b4_x, $b4_y);
                $this->MultiCell($ob_column_width, 5, utf8_decode($ob_column), 0, 'C');
                $this->SetXY($af_x, $af_y);
            }
        }else
            $this->Cell($w[6], $calulated_header, '', 'BLR', 0, 'C', FALSE);   //table cell 7
        
        $this->SetFont('Arial', 'B', 9);
        //darken the border
        $this->SetXY($b4_x_ob_column, $b4_y_ob_column);
        $this->SetLineWidth($dark_line_width);
        $this->Cell($ob_column_width*$ob_columns_count, $calulated_header, '', 1, 0, 'L', FALSE);
        $this->SetLineWidth(0);
        
        //darken the border
        $this->SetXY($this_x, $this_y);
        $this->SetLineWidth($dark_line_width);
        $this->Cell(array_sum($w), $calulated_header+$col_h, '', 1, 0, 'L', FALSE);
        $this->SetLineWidth(0);
        
        //draw table body----------------------------------------------------------------------
        $this->Ln();
        $total_sick_count = count($sick_details);
        $normal_included_slot_types = array(0, 1, 2, 4, 5, 6, 7, 8, 10, 11, 12);
        $oncall_included_slot_types = array(3, 9, 13, 14);
//        echo "<pre>".print_r($sick_details, 1)."</pre>";
        for ($i = 0 ; $i < 20 ; $i++) {
            if(!in_array($sick_details[$i]['type'], $normal_included_slot_types) && !in_array($sick_details[$i]['type'], $oncall_included_slot_types))
                    continue;
            
            $this->SetX(13);
            list($this_x, $this_y) = array($this->GetX(), $this->GetY());
            
            if($i < $total_sick_count){
                $time_in_100 = $obj_equipment->time_user_format($obj_equipment->time_difference($sick_details[$i]['time_to'], $sick_details[$i]['time_from']), 100);
                $week_day_ind = strtolower(date_format(date_create($sick_details[$i]['date']), "D"));

                $this->Cell($w[0], $col_h, date('d', strtotime($sick_details[$i]['date'])), 1, 0, 'C', FALSE);   //table cell 1
                $this->Cell($w[1], $col_h, utf8_decode($obj_smarty->translate[$week_day_ind]), 1, 0, 'C', FALSE);   //table cell 2

                if (in_array($sick_details[$i]['type'], $normal_included_slot_types)) {
                    $this->Cell($w[2], $col_h, sprintf('%05.02f', $sick_details[$i]['time_from']) . ' - ' . sprintf('%05.02f', $sick_details[$i]['time_to']), 1, 0, 'C', FALSE);   //table cell 3
                    $this->Cell($w[3], $col_h, sprintf('%.02f', round($time_in_100, 2)), 1, 0, 'R', FALSE);   //table cell 4
                    $normal_sum += round($time_in_100, 2);
                }else{
                    $this->Cell($w[2], $col_h, '', 1, 0, 'L', FALSE);   //table cell 3
                    $this->Cell($w[3], $col_h, '', 1, 0, 'R', FALSE);   //table cell 4
                }

                if (in_array($sick_details[$i]['type'], $oncall_included_slot_types)) {
                    $this->Cell($w[4], $col_h, sprintf('%05.02f', $sick_details[$i]['time_from']) . ' - ' . sprintf('%05.02f', $sick_details[$i]['time_to']), 1, 0, 'C', FALSE);   //table cell 5
                    $this->Cell($w[5], $col_h, sprintf('%.02f', round($time_in_100, 2)), 1, 0, 'R', FALSE);   //table cell 6
                    $jour_sum += round($time_in_100, 2);
                }else{
                    $this->Cell($w[4], $col_h, '', 1, 0, 'L', FALSE);   //table cell 5
                    $this->Cell($w[5], $col_h, '', 1, 0, 'R', FALSE);   //table cell 6
                }
                
                if($total_obs > 0){
                    foreach ($OB_columns as $ob_column){
                        //skip oncall hours from OB area
                        if(isset($sick_details[$i]['inconv_details'][$ob_column])){
                            
                            if(($company_salary_system == 3) || ($company_salary_system != 3 && !in_array($sick_details[$i]['type'], $oncall_included_slot_types))){
                                //echo $sick_details[$i]['inconv_details'][$ob_column] ;
//                                echo gettype ( $sick_details[$i]['inconv_details'][$ob_column] );
                                $ob_time_in_100 = 0;
                                if(is_array( $sick_details[$i]['inconv_details'][$ob_column] )){
                                    if(!empty($sick_details[$i]['inconv_details'][$ob_column])){
                                        foreach ($sick_details[$i]['inconv_details'][$ob_column] as $key_oncall_ob_slot_type => $oncall_slot_hour){
                                            $ob_time_in_100 += $obj_equipment->time_user_format($oncall_slot_hour, 100);
                                        }
                                    }
//                                    $temp_key = key($sick_details[$i]['inconv_details'][$ob_column]);
//                                    $ob_time_in_100 = $obj_equipment->time_user_format($sick_details[$i]['inconv_details'][$ob_column][$temp_key], 100);
                                }else{
                                    $ob_time_in_100 = $obj_equipment->time_user_format($sick_details[$i]['inconv_details'][$ob_column], 100);
                                }
                                //$ob_time_in_100 = $sick_details[$i]['inconv_details'][$ob_column];
                                $this->Cell($ob_column_width, $col_h, sprintf('%.02f', round($ob_time_in_100, 2)), 1, 0, 'R', FALSE);   //table cell 7

                                if(isset($ob_sum_array[$ob_column]))
                                    $ob_sum_array[$ob_column] += round($ob_time_in_100, 2);
                                else
                                    $ob_sum_array[$ob_column] = round($ob_time_in_100, 2);
                            }
                            else 
                                $this->Cell($ob_column_width, $col_h, '', 1, 0, 'R', FALSE);   //table cell 7
                            
                        }else
                            $this->Cell($ob_column_width, $col_h, '', 1, 0, 'R', FALSE);   //table cell 7
                    }
                }else
                    $this->Cell($w[6], $col_h, '', 1, 0, 'R', FALSE);   //table cell 7
            }
            else {
                $this->Cell($w[0], $col_h, '', 1, 0, 'C', FALSE);   //table cell 1
                $this->Cell($w[1], $col_h, '', 1, 0, 'C', FALSE);   //table cell 2
                $this->Cell($w[2], $col_h, '', 1, 0, 'L', FALSE);   //table cell 3
                $this->Cell($w[3], $col_h, '', 1, 0, 'R', FALSE);   //table cell 4
                $this->Cell($w[4], $col_h, '', 1, 0, 'L', FALSE);   //table cell 5
                $this->Cell($w[5], $col_h, '', 1, 0, 'R', FALSE);   //table cell 6

                if($total_obs > 0){
                    foreach ($OB_columns as $ob_column){
                        $this->Cell($ob_column_width, $col_h, '', 1, 0, 'R', FALSE);   //table cell 7
                    }
                }else
                    $this->Cell($w[6], $col_h, '', 1, 0, 'R', FALSE);   //table cell 7
            }

            //darken the border
            $this->SetXY($this_x, $this_y);
            $this->SetLineWidth($dark_line_width);
            $this->Cell($w[0]+$w[1]+$w[2]+$w[3], $col_h, '', 'LR', 0, 'L', FALSE);
            $this->Cell($w[4]+$w[5], $col_h, '', 'LR', 0, 'L', FALSE);
            $this->Cell($w[6], $col_h, '', 'LR', 0, 'L', FALSE);
            $this->SetLineWidth(0);

            $this->SetY($this->GetY() + $col_h);
        }
        
        //table sum----------------------------------------------------------------------
//        $this->Ln();
        $this->SetX(13);
        $this->SetLineWidth($dark_line_width);
        $this->Cell($w[0]+$w[1], $col_h, '', 'T', 0, 'C', FALSE);   //table cell 1
        $this->Cell($w[2], $col_h, utf8_decode('S:a tim'), 'TLB', 0, 'L', FALSE);   //table cell 3
        $this->Cell($w[3], $col_h, sprintf('%.02f', round($normal_sum, 2)), 'TRB', 0, 'R', FALSE);   //table cell 4

        $this->Cell($w[4], $col_h, utf8_decode('S:a tim'), 'TLB', 0, 'L', FALSE);   //table cell 5
        $this->Cell($w[5], $col_h, sprintf('%.02f', round($jour_sum, 2)), 'TRB', 0, 'R', FALSE);   //table cell 6
        
        if($total_obs > 0){
            foreach ($OB_columns as $ob_column){
                $this->Cell($ob_column_width, $col_h, sprintf('%.02f', round($ob_sum_array[$ob_column], 2)), 1, 0, 'R', FALSE);   //table cell 7
            }
        }else
            $this->Cell($w[6], $col_h, '', 1, 0, 'R', FALSE);   //table cell 7
        
        $this->SetLineWidth(0);
    }
    function content_table_optimal($sick_details, $distinct_ob_field_names, $company_salary_system = '') {
        $obj_equipment = new equipment();
        $obj_smarty = new smartySetup(array('month.xml'),FALSE);
//        $w = array(7.6, 12.6, 27, 15, 27, 15, 75);
        $w = array(7.6, 10.6, 20, 10, 20, 20, 10, 81);
        $col_h = 6.72;
        $dark_line_width = 0.7;
//        $this->SetFont('Arial', 'B', 9);
        $this->SetFont('Arial', '', 8);
//        $total_content_rows = count($sick_details);
        
        $this->SetXY(13, $this->GetY()+13);
        
        //OB column widths
//        $OB_columns = array('Kväll', 'Natt', 'Helg', 'Storhelg');
        $OB_columns = $distinct_ob_field_names;
        list($this_x, $this_y) = array($this->GetX(), $this->GetY());
        
        $normal_sum = $jour_sum = 0;
        $ob_sum_array = array();
        
        $total_obs = count($OB_columns);
        $ob_column_width = ($total_obs > 0 ? $w[7]/$total_obs : $w[7]);
        $ob_columns_count = ($total_obs > 0 ? $total_obs : 1);
        $header_calc_values = $this->calc_header_height($ob_column_width, $OB_columns);
        $calulated_header = $header_calc_values['header_height'];
        
        //draw table headings----------------------------------------------------------------------
        $this->SetLineWidth($dark_line_width);
        $this->Cell($w[0], $col_h, '', 'TL', 0, 'L', FALSE);   //table cell 1
        $this->Cell($w[1], $col_h, '', 'T', 0, 'L', FALSE);   //table cell 2
        $this->Cell($w[2], $col_h, '', 'T', 0, 'L', FALSE);   //table cell 3
        $this->Cell($w[3], $col_h, '', 'TR', 0, 'R', FALSE);   //table cell 4
        $this->Cell($w[4]+$w[5]+$w[6], $col_h, 'Jourtid', 'TLRB', 0, 'C', FALSE);   //table cell 5
        $this->Cell($w[7], $col_h, 'OB', 'TLR', 1, 'C', FALSE);   //table cell 7
        
        $this->SetX(13);
        $this->Cell($w[0], $calulated_header, 'Dat', 'BL', 0, 'L', FALSE);   //table cell 1
        $this->Cell($w[1], $calulated_header, 'Dag', 'B', 0, 'L', FALSE);   //table cell 2
        $this->Cell($w[2], $calulated_header, 'Arbetstid', 'B', 0, 'C', FALSE);   //table cell 3
        $this->Cell($w[3], $calulated_header, 'Tim', 'BR', 0, 'C', FALSE);   //table cell 4
        $this->Cell($w[4], $calulated_header, 'Jour vardag', 'BL', 0, 'C', FALSE);   //table cell 5
        $this->Cell($w[5], $calulated_header, 'Jour helg', 'B', 0, 'C', FALSE);   //table cell 5
        $this->Cell($w[6], $calulated_header, 'Tim', 'BR', 0, 'C', FALSE);   //table cell 6
        $this->SetLineWidth(0);
//        echo "<pre>".print_r($header_calc_values, 1)."</pre>";
        
        list($b4_x_ob_column, $b4_y_ob_column) = array($this->GetX(), $this->GetY());
        $this->SetFont('Arial', '', 8);
        if($total_obs > 0){
            foreach ($OB_columns as $ob_column){
                if($ob_column == '__holiday__') $ob_column = 'Storhelg';
                else if($ob_column == '__holiday_helg__') $ob_column = 'Helg';
//                $this->Cell($ob_column_width, $calulated_header, utf8_decode($ob_column), 1, 0, 'C', FALSE);   //table cell 7
                
                list($b4_x, $b4_y) = array($this->GetX(), $this->GetY());
                $this->Cell($ob_column_width, $calulated_header, '', 1, 0, 'C', TRUE);
                list($af_x, $af_y) = array($this->GetX(), $this->GetY());
                $this->SetXY($b4_x, $b4_y);
                $this->MultiCell($ob_column_width, 5, utf8_decode($ob_column), 0, 'C');
                $this->SetXY($af_x, $af_y);
            }
        }else
            $this->Cell($w[6], $calulated_header, '', 'BLR', 0, 'C', FALSE);   //table cell 7
        
//        $this->SetFont('Arial', 'B', 9);
        $this->SetFont('Arial', '', 8);
        //darken the border
        $this->SetXY($b4_x_ob_column, $b4_y_ob_column);
        $this->SetLineWidth($dark_line_width);
        $this->Cell($ob_column_width*$ob_columns_count, $calulated_header, '', 1, 0, 'L', FALSE);
        $this->SetLineWidth(0);
        
        //darken the border
        $this->SetXY($this_x, $this_y);
        $this->SetLineWidth($dark_line_width);
        $this->Cell(array_sum($w), $calulated_header+$col_h, '', 1, 0, 'L', FALSE);
        $this->SetLineWidth(0);
        
        //draw table body----------------------------------------------------------------------
        $this->Ln();
        $total_sick_count = count($sick_details);
        $normal_included_slot_types = array(0, 1, 2, 4, 5, 6, 7, 8, 10, 11, 12);
        $oncall_included_slot_types = array(3, 9, 13, 14);
//        echo "sick_details<pre>".print_r($sick_details, 1)."</pre>";
        for ($i = 0 ; $i < 20 ; $i++) {
            if(!in_array($sick_details[$i]['type'], $normal_included_slot_types) && !in_array($sick_details[$i]['type'], $oncall_included_slot_types))
                    continue;
            
            $this->SetX(13);
            list($this_x, $this_y) = array($this->GetX(), $this->GetY());
            
            if($i < $total_sick_count){
                $time_in_100 = $obj_equipment->time_user_format($obj_equipment->time_difference($sick_details[$i]['time_to'], $sick_details[$i]['time_from']), 100);
                $week_day_ind = strtolower(date_format(date_create($sick_details[$i]['date']), "D"));

                $this->Cell($w[0], $col_h, date('d', strtotime($sick_details[$i]['date'])), 1, 0, 'C', FALSE);   //table cell 1
                $this->Cell($w[1], $col_h, utf8_decode($obj_smarty->translate[$week_day_ind]), 1, 0, 'C', FALSE);   //table cell 2

                if (in_array($sick_details[$i]['type'], $normal_included_slot_types)) {
                    $this->Cell($w[2], $col_h, sprintf('%05.02f', $sick_details[$i]['time_from']) . ' - ' . sprintf('%05.02f', $sick_details[$i]['time_to']), 1, 0, 'C', FALSE);   //table cell 3
                    $this->Cell($w[3], $col_h, sprintf('%.02f', round($time_in_100, 2)), 1, 0, 'R', FALSE);   //table cell 4
                    $normal_sum += round($time_in_100, 2);
                }else{
                    $this->Cell($w[2], $col_h, '', 1, 0, 'L', FALSE);   //table cell 3
                    $this->Cell($w[3], $col_h, '', 1, 0, 'R', FALSE);   //table cell 4
                }

                if (in_array($sick_details[$i]['type'], $oncall_included_slot_types)) {
                    if(isset($sick_details[$i]['inconv_details']['Jour helg']) && !empty($sick_details[$i]['inconv_details']['Jour helg'])){
                        $this->Cell($w[4], $col_h, '', 1, 0, 'C', FALSE);   //table cell 5
                        $this->Cell($w[5], $col_h, sprintf('%05.02f', $sick_details[$i]['time_from']) . ' - ' . sprintf('%05.02f', $sick_details[$i]['time_to']), 1, 0, 'L', FALSE);   //table cell 5
                    }
                    else{
                        $this->Cell($w[4], $col_h, sprintf('%05.02f', $sick_details[$i]['time_from']) . ' - ' . sprintf('%05.02f', $sick_details[$i]['time_to']), 1, 0, 'C', FALSE);   //table cell 5
                        $this->Cell($w[5], $col_h, '', 1, 0, 'L', FALSE);   //table cell 5
                    }
                    $this->Cell($w[6], $col_h, sprintf('%.02f', round($time_in_100, 2)), 1, 0, 'R', FALSE);   //table cell 6
                    $jour_sum += round($time_in_100, 2);
                }else{
                    $this->Cell($w[4], $col_h, '', 1, 0, 'L', FALSE);   //table cell 5
                    $this->Cell($w[5], $col_h, '', 1, 0, 'L', FALSE);   //table cell 5
                    $this->Cell($w[6], $col_h, '', 1, 0, 'R', FALSE);   //table cell 6
                }
                
                if($total_obs > 0){
                    foreach ($OB_columns as $ob_column){
                        //skip oncall hours from OB area
                        if(isset($sick_details[$i]['inconv_details'][$ob_column])){
                            
                            if(($company_salary_system == 3) || ($company_salary_system != 3 && !in_array($sick_details[$i]['type'], $oncall_included_slot_types))){
                                //echo $sick_details[$i]['inconv_details'][$ob_column] ;
//                                echo gettype ( $sick_details[$i]['inconv_details'][$ob_column] );
                                $ob_time_in_100 = 0;
                                if(is_array( $sick_details[$i]['inconv_details'][$ob_column] )){
                                    if(!empty($sick_details[$i]['inconv_details'][$ob_column])){
                                        foreach ($sick_details[$i]['inconv_details'][$ob_column] as $key_oncall_ob_slot_type => $oncall_slot_hour){
                                            $ob_time_in_100 += $obj_equipment->time_user_format($oncall_slot_hour, 100);
                                        }
                                    }
//                                    $temp_key = key($sick_details[$i]['inconv_details'][$ob_column]);
//                                    $ob_time_in_100 = $obj_equipment->time_user_format($sick_details[$i]['inconv_details'][$ob_column][$temp_key], 100);
                                }else{
                                    $ob_time_in_100 = $obj_equipment->time_user_format($sick_details[$i]['inconv_details'][$ob_column], 100);
                                }
                                //$ob_time_in_100 = $sick_details[$i]['inconv_details'][$ob_column];
                                $this->Cell($ob_column_width, $col_h, sprintf('%.02f', round($ob_time_in_100, 2)), 1, 0, 'R', FALSE);   //table cell 7

                                if(isset($ob_sum_array[$ob_column]))
                                    $ob_sum_array[$ob_column] += round($ob_time_in_100, 2);
                                else
                                    $ob_sum_array[$ob_column] = round($ob_time_in_100, 2);
                            }
                            else 
                                $this->Cell($ob_column_width, $col_h, '', 1, 0, 'R', FALSE);   //table cell 7
                            
                        }else
                            $this->Cell($ob_column_width, $col_h, '', 1, 0, 'R', FALSE);   //table cell 7
                    }
                }else
                    $this->Cell($w[6], $col_h, '', 1, 0, 'R', FALSE);   //table cell 7
            }
            else {
                $this->Cell($w[0], $col_h, '', 1, 0, 'C', FALSE);   //table cell 1
                $this->Cell($w[1], $col_h, '', 1, 0, 'C', FALSE);   //table cell 2
                $this->Cell($w[2], $col_h, '', 1, 0, 'L', FALSE);   //table cell 3
                $this->Cell($w[3], $col_h, '', 1, 0, 'R', FALSE);   //table cell 4
                $this->Cell($w[4], $col_h, '', 1, 0, 'L', FALSE);   //table cell 5
                $this->Cell($w[5], $col_h, '', 1, 0, 'L', FALSE);   //table cell 5
                $this->Cell($w[6], $col_h, '', 1, 0, 'R', FALSE);   //table cell 6

                if($total_obs > 0){
                    foreach ($OB_columns as $ob_column){
                        $this->Cell($ob_column_width, $col_h, '', 1, 0, 'R', FALSE);   //table cell 7
                    }
                }else
                    $this->Cell($w[6], $col_h, '', 1, 0, 'R', FALSE);   //table cell 7
            }

            //darken the border
            $this->SetXY($this_x, $this_y);
            $this->SetLineWidth($dark_line_width);
            $this->Cell($w[0]+$w[1]+$w[2]+$w[3], $col_h, '', 'LR', 0, 'L', FALSE);
            $this->Cell($w[4]+$w[5]+$w[6], $col_h, '', 'LR', 0, 'L', FALSE);
            $this->Cell($w[7], $col_h, '', 'LR', 0, 'L', FALSE);
            $this->SetLineWidth(0);

            $this->SetY($this->GetY() + $col_h);
        }
        
        //table sum----------------------------------------------------------------------
//        $this->Ln();
        $this->SetX(13);
        $this->SetLineWidth($dark_line_width);
        $this->Cell($w[0]+$w[1], $col_h, '', 'T', 0, 'C', FALSE);   //table cell 1
        $this->Cell($w[2], $col_h, utf8_decode('S:a tim'), 'TLB', 0, 'L', FALSE);   //table cell 3
        $this->Cell($w[3], $col_h, sprintf('%.02f', round($normal_sum, 2)), 'TRB', 0, 'R', FALSE);   //table cell 4

        $this->Cell($w[4]+$w[5], $col_h, utf8_decode('S:a tim'), 'TLB', 0, 'L', FALSE);   //table cell 5
        $this->Cell($w[6], $col_h, sprintf('%.02f', round($jour_sum, 2)), 'TRB', 0, 'R', FALSE);   //table cell 6
        
        if($total_obs > 0){
            foreach ($OB_columns as $ob_column){
                $this->Cell($ob_column_width, $col_h, sprintf('%.02f', round($ob_sum_array[$ob_column], 2)), 1, 0, 'R', FALSE);   //table cell 7
            }
        }else
            $this->Cell($w[7], $col_h, '', 1, 0, 'R', FALSE);   //table cell 7
        
        $this->SetLineWidth(0);
    }
    
    function signing_part($emp_details, $sign_details) {
        $this->SetXY(13, $this->GetY()+16);
        $this->SetFont('Times', 'B', 13);
        $this->Cell(180, 7, utf8_decode('Underskrift av dig som är assistent'), 0, 1, 'L', FALSE);
        
        $this->SetX(13);
        $this->SetFont('Times', '', 10);
        $this->Cell(180, 8, utf8_decode('Jag intygar att uppgifterna är riktiga.'), 1, 1, 'L', FALSE);
        
        $this->SetX(13);
        $this->SetFont('Times', '', 9);
        $this->Cell(45, 6, utf8_decode('Datum'), 'TLR', 0, 'L', FALSE);
        $this->Cell(90, 6, utf8_decode('Namnteckning'), 'TLR', 0, 'L', FALSE);
        $this->Cell(45, 6, utf8_decode('Telefon, även riktnummer'), 'TLR', 1, 'L', FALSE);
        
        $this->SetX(13);
        $this->SetFont('Times', '', 11);
        $this->Cell(45, 9, '', 'BLR', 0, 'L', FALSE);
        $this->Cell(90, 9, '', 'BLR', 0, 'L', FALSE);
        $this->Cell(45, 9, '', 'BLR', 1, 'L', FALSE);
        
        if (!empty($sign_details) && $sign_details[0]['signin_employee'] == $emp_details[0]['username']) {
            $this->SetFont('Arial', '', 10);
            $this->SetXY(13, $this->GetY()-8);
            $this->Cell(45, 9, date("Y-m-d", strtotime($sign_details[0]['signin_date'])) . ", kl. ".date("H.i", strtotime($sign_details[0]['signin_date'])), 0, 0, 'L', FALSE);    //sign date
//            $this->Cell(45, 9, date("Y-m-d") . ", kl. ".date("H.i"), 0, 0, 'L', FALSE);    //sign date
            
            $this->SetFont('Arial', 'I', 10);
            $this->Cell(90, 9, utf8_decode($emp_details[0]['fullname']), 0, 0, 'L', FALSE);    //sign employee name
//            $this->Cell(90, 9, 'Shamsudheen', 0, 0, 'L', FALSE);    //sign employee name
            
            $this->SetFont('Arial', 'I', 7.5);
            $this->SetX(113);
            $this->Cell(35, 9, utf8_decode('e-signering via Time2View'), 0, 0, 'R', FALSE);    //side water mark
            
            $this->SetFont('Arial', '', 10);
            $phno = (trim($emp_details[0]['mobile']) != '' ? ($this->formatting_phone($emp_details[0]['mobile'])) : trim($emp_details[0]['phone']));
//            $phno = '9037499954';
            $this->SetX(148);
            $this->Cell(40, 9, $phno, 0, 0, 'L', FALSE);    // sign employee tel number
        }
    }

    function Page_footer_content($company_data) {
        $this->SetFont('Times', '', 12);
        $this->SetY($this->GetY()+10);
        $this->SetXY(12, $this->GetY());
        $this->Cell(180, 7, utf8_decode('Assistansen utförd av '. $company_data['name']), 0, 1, 'L', FALSE);
        $this->SetXY(12, $this->GetY());
        $this->Cell(180, 7, utf8_decode('Telefon:  '. $company_data['phone']), 0, 0, 'L', FALSE); 
        $this->SetXY(12, $this->GetY());
        if(trim($company_data['email']) == '') $company_data['email'] = '                     ';
        $this->Cell(180, 7, utf8_decode('e-post: '. $company_data['email']), 0, 0, 'R', FALSE);
    }
    
    function Header(){
        $this->AliasNbPages();
        $this->SetXY(-25,8);
        $this->SetFont('Arial', '', 9);
        $this->Cell(10, 10, $this->PageNo() . ' ({nb})', 0, 0, 'C');
    }
    
    function format_SSN($SSN) {
        $formated_SSN = substr($SSN,0,6) . "-".substr($SSN,6);
        return $formated_SSN;
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
    
    function sample_html(){
        
        $this->SetXY(10, 20);
        $html='
<table border="1" width="100px">
<tr>
<td>Datum</td><td>Ord. tid</td><td>Ord. tid</td><td>Jour Vardag</td>
<td>Vantetid</td><td>Arb. tid</td><td>Sjuk OB helg</td>
<td>Sjuk Ord. tid</td><td>Franvaro Ord. tid</td><td>Sjuk Jour helg</td>
<td>Sjuk Jour Vardag</td><td>Franvaro Väntetid</td><td>Franvaro</td>
</tr>
<tr>
<td style="padding:5px 2px;">01-03 Fre</td>
<td>4.25</td>
<td style="background:#F5BE87">4.25</td>
<td>6</td>
<td style="background:#F5BE87">6</td>
<td>10.25</td>
<td style="background:#F9DDDD">3</td>
<td style="background:#F9DDDD">6</td>
<td style="background:#F5BE87">3</td>
<td style="background:#F9DDDD">1.5</td>
<td style="background:#F9DDDD">45</td>
<td style="background:#F5BE87">1.5</td>
<td style="background:#F9DDDD">4.5</td>
</tr>
<tr align="center">
<td style="padding:5px 2px;">01-03 Fre</td>
<td>4.25</td>
<td style="background:#F5BE87">4.25</td>
<td>6</td>
<td style="background:#F5BE87">6</td>
<td>10.25</td>
<td style="background:#F9DDDD">3</td>
<td style="background:#F9DDDD">6</td>
<td style="background:#F5BE87">3</td>
<td style="background:#F9DDDD">1.5</td>
<td style="background:#F9DDDD">45</td>
<td style="background:#F5BE87">1.5</td>
<td style="background:#F9DDDD">4.5</td>
</tr>
<tr align="center">
<td style="padding:5px 2px;">01-03 Fre</td>
<td>4.25</td>
<td style="background:#F5BE87">4.25</td>
<td>6</td>
<td style="background:#F5BE87">6</td>
<td>10.25</td>
<td style="background:#F9DDDD">3</td>
<td style="background:#F9DDDD">6</td>
<td style="background:#F5BE87">3</td>
<td style="background:#F9DDDD">1.5</td>
<td style="background:#F9DDDD">45</td>
<td style="background:#F5BE87">1.5</td>
<td style="background:#F9DDDD">4.5</td>  
</tr>
</table>';
        
        $this->WriteHTML($html);
    }
}
?>