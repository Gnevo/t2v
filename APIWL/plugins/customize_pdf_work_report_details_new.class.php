<?php

require_once('./plugins/F_pdf.class.php');
//require_once('./plugins/fpdi/fpdi.php');
require_once('./class/setup.php');
require_once('./configs/config.inc.php');
require_once('class/inconvenient_new.php');

class PDF_Work_report_new extends FPDF {

    var $report_month        = '';
    var $report_year         = '';
    var $report_employee     = '';
    var $report_customer     = '';
    var $count_exclude_leave = '';
    var $count_leave         = '';
    var $fkkn_count          = '';
    var $total_count         = '';
    var $total_column_count  = ''; // new
    
    var $days_in_month = array();
    var $results       = array(); // new 
    var $results_leave = array(); // new
    var $total         = array(); // new
    var $total_leave   = array(); // new
    
    
    var $headings_leave = array(); // new 
    var $fkkn_slots     = array(); // new 
    var $headings       = array(); // new 
    var $employee       = array(); // new
    var $cust_name      = ''; // new
    
	function __construct($orientation = 'P') {
        parent::__construct();
        $this->FPDF($orientation);
        $this->smarty = new smartySetup(array("month.xml", "reports.xml", "gdschema.xml"),FALSE);
    }

    function Process_contents() {

        require_once('class/inconvenient.php');
        require_once('class/inconvenient_new.php');
        $obj_inconv = new inconvenient();
        $obj_inconv_new = new inconvenient_new();

        
        $emp = $this->report_employee;
        $yr = $this->report_year;
        $month = $this->report_month;
        $cust = $this->report_customer;

        $obj_inconv->generate_work_report($emp, $month, $yr, $cust);
        $obj_inconv_new->generate_work_report($emp, $month, $yr, $cust);


        $this->days_in_month = $obj_inconv->days_in_month; // r

		$this->headings       = $obj_inconv_new->headings; // new
		$this->headings_leave = $obj_inconv_new->headings_leave; // new 
		$this->fkkn_slots     =  $obj_inconv_new->fkkn_slots; //new 
		$this->result_data    = $obj_inconv_new->result_data; // new
		$this->results_leave  = $obj_inconv_new->result_data_leave; // new array contains leave details of dates.
		$this->total 		  = $obj_inconv_new->total; 
		$this->total_leave 	  = $obj_inconv_new->total_leave;
        
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
        $this->MultiCell($date_col_w, 5, html_entity_decode(utf8_decode($this->smarty->translate['date'])), 0, 'C',TRUE);
        $this->SetXY($a_x, $a_y);

         foreach ($this->headings as $key => $heading_first) { // sub header for normal type
	    		foreach ($heading_first as $key1 => $heading_second) {
	    			foreach ($heading_second as $key2 => $heading_third) {
	    				foreach ($heading_third as $key3 => $heading_fourth) {
	    					if(is_array($heading_fourth)) $key3;
	    					else $heading_fourth = array('sum');
	    					foreach ($heading_fourth as $key4 => $value) {
	    						$a_x = $this->GetX();
					            $a_y = $this->GetY();
					            $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($value)), 0, 'C');
					            $caption_len = strlen($value);
					            if ($maxlen < $caption_len) {
					                $maxlen = $caption_len;
					                $tr_lower_y = $this->GetY();
					            }
					            $this->SetXY($a_x, $a_y);
	    					}
	    				}
	    			}
	    		}
	    	}

	    foreach ($this->headings_leave as $key => $heading_first) {  // sub header for leave type
	    		foreach ($heading_first as $key1 => $heading_second) {
	    			foreach ($heading_second as $key2 => $heading_third) {
	    				foreach ($heading_third as $key3 => $heading_fourth) {
	    					foreach ($heading_fourth as $key4 => $heading_fifth) {
	    						if(is_array($heading_fifth)) $key4;
	    						else $heading_fifth = array('sum');
	    						foreach ($heading_fifth as $key5 => $value) {
	    							$a_x = $this->GetX();
						            $a_y = $this->GetY();
						            $this->MultiCell($rw, 5, html_entity_decode(utf8_decode($value)), 0, 'C');
						            $caption_len = strlen($value);
						            if ($maxlen < $caption_len) {
						                $maxlen = $caption_len;
						                $tr_lower_y = $this->GetY();
						            }
					            	$this->SetXY($a_x, $a_y);
	    						}
	    					}
	    				}
	    			}
	    		}
	    	}

	    if(!empty($this->fkkn_slots)){  // sub header for fkkn types;
        	if(!empty($this->fkkn_slots) && strpos(json_encode($this->fkkn_slots), "\"1\":") > 0 ){
        		$a_x = $this->GetX();
	            $a_y = $this->GetY();
	            $this->MultiCell($rw, 5, $this->smarty->translate['fk_sum'], 0, 'C');
	            $caption_len = strlen($this->smarty->translate['fk_sum']);
	            if ($maxlen < $caption_len) {
	                $maxlen = $caption_len;
	                $tr_lower_y = $this->GetY();
	            }
	            $this->SetXY($a_x, $a_y);
        		$this->fkkn_count = 1;
        		
        	}
        	if (!empty($this->fkkn_slots) && (strpos(json_encode($this->fkkn_slots), "\"2\":") > 0 || strpos(json_encode($this->fkkn_slots), "\"3\":") > 0)){
        		$this->fkkn_count = $this->fkkn_count + 1;
        		$a_x = $this->GetX();
	            $a_y = $this->GetY();
	            $this->MultiCell($rw, 5, $this->smarty->translate['kntu_sum'], 0, 'C');
	            $caption_len = strlen($this->smarty->translate['kntu_sum']);
	            if ($maxlen < $caption_len) {
	                $maxlen = $caption_len;
	                $tr_lower_y = $this->GetY();
	            }
	            $this->SetXY($a_x, $a_y);
        	}
	    }
        

        $this->SetXY(18, $header_start_y);
        $new_header_height = $tr_lower_y - $header_start_y;
        $this->SetTextColor(0,0,0);
        return array('header_height' => $new_header_height, 'tr_start_y' => $tr_lower_y);
    }

    function calc_main_header_height($date_col_w, $rw){
        ///////////// main header calculation  /////////////////////////

        $this->SetTextColor(255,255,255);
        global $leave_type;
        $height_of_main_header = array();

        $maxlen = 4;
        $tr_lower_y = 60;
        $this->SetXY(18, $this->GetY());
         $header_start_y = $this->GetY();

        $a_x = $this->GetX();
        $a_y = $this->GetY();
        $this->MultiCell($date_col_w, 10, html_entity_decode(utf8_decode($this->smarty->translate['date'])), 0, 'C',TRUE);
        $this->SetXY($a_x, $a_y);

        foreach ($this->headings as $key => $ordered_headings) {  // for main_headings excluding leave.
            foreach ($ordered_headings as $type_key => $ordered_types) {
                $colspan = count($ordered_types, 1)-(count($ordered_types)*2-1);
                $colspan_count = $colspan_count+$colspan;
               
                    $a_x = $this->GetX();
                    $a_y = $this->GetY();
                    $col_heading = ($type_key == 'normal' ? $this->smarty->translate['normal_main_head_signing_report'] : $this->smarty->translate[$type_key]);
                    $this->MultiCell($rw*$colspan, 10, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
                    $caption_len = strlen($col_heading);
                    if ($maxlen < $caption_len) {
                        $maxlen = $caption_len;
                         $tr_lower_y = $this->GetY();
                         
                    }
                    $this->SetXY($a_x, $a_y);
            }
        }

        $maxlen = 4;
        foreach ($this->headings_leave as $leave_types => $heads_main) { // heading for leave.
            $sub_count = 0;
            foreach ($heads_main as $ordered_heads) {
                foreach ($ordered_heads as $type_key => $ordered_types) {
                    $sub_count = $sub_count + count($ordered_types, 1)-(count($ordered_types)*2-1);
                    // echo $sub_count;
                    if($leave_types == 100){
                        $sub_count = $sub_count-1;
                    }
                }
            }
            // echo $sub_count.':';
                $a_x = $this->GetX();
                $a_y = $this->GetY();
                $col_heading = ($leave_types == 100 ? $this->smarty->translate['leave_sum'] : $leave_type[$leave_types]);
                 $this->MultiCell($rw*$sub_count, 10, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
                $caption_len = strlen($col_heading);

                    if ($maxlen < $caption_len) {

                        $maxlen = $caption_len;
                         $tr_lower_y = $this->GetY();
                        
                    }
                $this->SetXY($a_x, $a_y);


        }

        $maxlen = 4;
        if(!empty($this->fkkn_slots)){
            $fkkn_colspan = 0;
            if(!empty($this->fkkn_slots) && strpos(json_encode($this->fkkn_slots), "\"1\":") > 0 ){
                $fkkn_colspan = 1;
            }

            if (!empty($this->fkkn_slots) && (strpos(json_encode($this->fkkn_slots), "\"2\":") > 0 || strpos(json_encode($this->fkkn_slots), "\"3\":") > 0)){
                $fkkn_colspan = $fkkn_colspan + 1;
        }
        
        $a_x = $this->GetX();
        $a_y = $this->GetY();
        $col_heading =  $this->smarty->translate['fkkntu_sum'];
        $this->MultiCell($rw*$fkkn_colspan, 10, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
         $caption_len = strlen($col_heading);
        if ($maxlen < $caption_len) {
            
            $maxlen = $caption_len;
             $tr_lower_y = $this->GetY();
            
        }
        $this->SetXY($a_x, $a_y);
        
    }
        $this->SetXY(18, $header_start_y);
        $new_header_height = $tr_lower_y - $header_start_y;
        $this->SetTextColor(0,0,0);
        return array('header_height' => $new_header_height, 'tr_start_y' => $tr_lower_y);


        ////////// end main  header calculation  //////////////////////
        
    }

   

    function get_total_columns_new($section){
    	// echo "<pre>".print_r($this->fkkn_slots,1)."</pre>";
    	if($section == 1){
	    	foreach ($this->headings as $key => $heading_first) { // total count excluding leave types.
	    		foreach ($heading_first as $key1 => $heading_second) {
	    			foreach ($heading_second as $key2 => $heading_third) {
	    				foreach ($heading_third as $key3 => $value) {
	    					$this->count_exclude_leave +=count($value);
	    				}
	    			}
	    		}
	    	}
	    	return $this->count_exclude_leave;
	    }

    	if($section == 2){
	    	foreach ($this->headings_leave as $key => $heading_first) { // total count of leave types.
	    		foreach ($heading_first as $key1 => $heading_second) {
	    			foreach ($heading_second as $key2 => $heading_third) {
	    				foreach ($heading_third as $key3 => $heading_fourth) {
	    					foreach ($heading_fourth as $key4 => $value) {
	    						$this->count_leave +=count($value);
	    					}
	    				}
	    			}
	    		}
	    	}
	    	return $this->count_leave;
	    }
	    if($section == 3){
	    	if(!empty($this->fkkn_slots)){  // total count of fkkn types.
	        	if(!empty($this->fkkn_slots) && strpos(json_encode($this->fkkn_slots), "\"1\":") > 0 ){
	        		$this->fkkn_count = 1;
	        	}
	        	if (!empty($this->fkkn_slots) && (strpos(json_encode($this->fkkn_slots), "\"2\":") > 0 || strpos(json_encode($this->fkkn_slots), "\"3\":") > 0)){
	        		$this->fkkn_count = $this->fkkn_count + 1;

	        	}
	        }
	        return $this->total_count = $this->fkkn_count;
	    }
    }

   
    function header(){
        global $leave_type;
        if($this->PageNo() > 1){
             
        }

        else{
            $year = $this->report_year;
            $month = $this->report_month;
            if($this->total_column_count <= 22) {
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
                $this->Cell(10, 9, utf8_decode($this->employee['first_name'] . " " . $this->employee['last_name']), 0, 0, 'L', FALSE);    //label value1
                $this->SetXY(202, $this->GetY());
                $this->Cell(10, 9, $this->employee['social_security'], 0, 0, 'L', FALSE);    // label value2

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
                $this->Cell(10, 9, utf8_decode($this->cust_name), 0, 0, 'L', FALSE);    // label value2
                $this->SetX(150);
                $this->Cell(120, 9, utf8_decode($year . '-' . sprintf('%02d', $month) . '-01 -- ' . $year . '-' . sprintf('%02d', $month) . '-' . $month_days[$month - 1]), 0, 0, 'L', FALSE);


                $this->Ln(13);
            } else {
                $this->SetFillColor(255, 255, 255);
                $this->SetTextColor(0, 50, 50);

                $this->SetFont('Arial', 'B', 18);
                $this->SetXY(18, $this->GetY() + 5);
                $this->Cell(385, 5, utf8_decode($this->smarty->translate['employee_monthly_report']), 0, 0, 'C', FALSE);

                $this->SetXY(18, $this->GetY() + 10);
                $this->Cell(270, 11, '', 1, 0, 'L', true);    //set border
                $this->Cell(115, 11, '', 1, 0, 'L', true);    //set border

                $this->SetFont('Arial', '', 10);
                $this->SetXY(20, $this->GetY() - 2);
                $this->Cell(20, 9, utf8_decode('Assistent: Förnamn och efternamn '), 0, 0, 'L', FALSE);    //label name1
                $this->SetXY(290, $this->GetY());
                $this->Cell(20, 9, utf8_decode(' Personnummer '), 0, 0, 'L', FALSE);    // label name2

                $this->SetFont('Arial', 'B', 12);
                $this->SetXY(20, $this->GetY() + 5);
                $this->Cell(250, 9, utf8_decode($this->employee['first_name'] . " " . $this->employee['last_name']), 0, 0, 'L', FALSE);    //label value1
                $this->SetXY(291, $this->GetY());
                $this->Cell(105, 9, $this->employee['social_security'], 0, 0, 'L', FALSE);    // label value2

                $this->Ln();


                $this->SetXY(18, $this->GetY() - 1.3);
                $this->Cell(199, 11, '', 1, 0, 'L', TRUE);
                $this->Cell(186, 11, '', 1, 0, 'L', TRUE);

                if ($year % 400 == 0 || ($year % 100 != 0 && $year % 4 == 0))
                    $month_days = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
                else
                    $month_days = array(31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

                $this->SetFont('Arial', '', 10);
                $this->SetXY(20, $this->GetY() - 2);
                $this->Cell(160, 9, utf8_decode('Kund: Förnamn och efternamn '), 0, 0, 'L', FALSE);    //label name1
                $this->SetX(220);
                $this->Cell(160, 9, utf8_decode('Period'), 0, 0, 'L', FALSE);    //label name1

                $this->SetFont('Arial', 'B', 12);
                $this->SetXY(20, $this->GetY() + 5);
                $this->Cell(160, 9, utf8_decode($this->cust_name), 0, 0, 'L', FALSE);    // label value2
                $this->SetX(221);
                $this->Cell(160, 9, utf8_decode($year . '-' . sprintf('%02d', $month) . '-01 -- ' . $year . '-' . sprintf('%02d', $month) . '-' . $month_days[$month - 1]), 0, 0, 'L', FALSE);


                $this->Ln(13);
            }
        }
        
        $col_hi = 10;
        $col_wi = 10;
        $max =0;
        global $leave_type;
        // print_r($leave_type);
        // $total_columns = $end - $start + 1;
        // echo $total_columns;
        $maxlen = 4;
        $date_col_w = 30;
        if($this->total_column_count <= 22){ // 22 is the total number columns now allowed in single page. 
            $rw = (265-$date_col_w) / $this->total_column_count;
        }
        else{
            $rw = (385-$date_col_w) / $this->total_column_count;
        }
        // echo $rw;
        // $rw = (265 - $date_col_w) / $total_columns;
        //        $rh = $max_col_head_length + $max_col_head_length / 2;
        $rh = 5;
        $tr_lower_y = 0;
        //        $w = array(10, 38.2, 28, 15.1, 17);
        $col_h = 10;
        $this->SetFont('Arial', 'B', 11);

        ////////////////////////column main headers//////////////////////

        // echo $this->GetY().'::';
        $this->SetXY(18, $this->GetY());
        $header_start_y = $this->GetY();
        $header_calc_values = $this->calc_header_height($date_col_w, $rw);
        $this->header_calc_values = $this->calc_header_height($date_col_w, $rw);
        
        $rh = $header_calc_values['header_height'];
        $main_header_height = $this->calc_main_header_height($date_col_w, $rw);
        $rh = $main_header_height['header_height'];
        $this->rh = $rh;
        // 
        $this->SetFont('Arial', 'B', 11);
        $b_x = $this->GetX();
        $b_y = $this->GetY();

        $this->Cell($date_col_w, $rh, '', 'TLR', 0, 'C', TRUE);
        $a_x = $this->GetX();
        $a_y = $this->GetY();
        $this->SetXY($b_x, $b_y);
        $this->MultiCell($date_col_w, $col_hi,'', 0, 'C', FALSE);
        $this->SetXY($a_x, $a_y);
        $n = $this->GetY();
        // print_r($leave_type);
        // echo "<pre>".print_r($this->fkkn_slots ,1)."</pre>";
        // echo "<pre>".print_r($this->headings_leave ,1)."</pre>";
       // exit();
        foreach ($this->headings as $key => $ordered_headings) {  // for main_headings excluding leave.
            foreach ($ordered_headings as $type_key => $ordered_types) {
                $colspan = count($ordered_types, 1)-(count($ordered_types)*2-1);
                $colspan_count = $colspan_count+$colspan;
                // ECHO $colspan.'::';
                    $b_x = $this->GetX();
                    $b_y = $this->GetY();
                    $this->Cell($rw*$colspan, $rh, '', 'TLR', 0, 'C', TRUE);
                    $a_x = $this->GetX();
                    $a_y = $this->GetY();
                    $this->SetXY($b_x, $b_y);
                    $col_heading = ($type_key == 'normal' ? $this->smarty->translate['normal_main_head_signing_report'] : $this->smarty->translate[$type_key]);
                    $this->MultiCell($rw*$colspan, $col_hi, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
                    $this->SetXY($a_x, $a_y);
                    
           
            }
        }

        foreach ($this->headings_leave as $leave_types => $heads_main) { // heading for leave.
            $sub_count = 0;
            $column_count_leave = 0;
            foreach ($heads_main as $ordered_heads) {
                foreach ($ordered_heads as $type_key => $ordered_types) {
                    foreach ($ordered_types as $ordered_types_key => $ordered_types_value) {
                        foreach ($ordered_types_value as $key => $value) {
                            $column_count_leave += count($value);
                        }
                    }
                }
            }
            $b_x = $this->GetX();
            $b_y = $this->GetY();
            $this->Cell($rw*$column_count_leave, $rh, '', 'TLR', 0, 'C', TRUE);
            $a_x = $this->GetX();
            $a_y = $this->GetY();
            $this->SetXY($b_x, $b_y);
            $col_heading = ($leave_types == 100 ? $this->smarty->translate['leave_sum'] : $leave_type[$leave_types]);
            $this->MultiCell($rw*$column_count_leave, $col_hi, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
            $this->SetXY($a_x, $a_y);


        }
        if(!empty($this->fkkn_slots)){
            $fkkn_colspan = 0;
            if(!empty($this->fkkn_slots) && strpos(json_encode($this->fkkn_slots), "\"1\":") > 0 ){
                $fkkn_colspan = 1;
            }

            if (!empty($this->fkkn_slots) && (strpos(json_encode($this->fkkn_slots), "\"2\":") > 0 || strpos(json_encode($this->fkkn_slots), "\"3\":") > 0)){
                $fkkn_colspan = $fkkn_colspan + 1;
        }
        $b_x = $this->GetX();
        $b_y = $this->GetY();
        $this->Cell($rw*$fkkn_colspan, $rh, '', 'TLR', 0, 'C', TRUE);
        $a_x = $this->GetX();
        $a_y = $this->GetY();
        $this->SetXY($b_x, $b_y);
        $col_heading = $this->smarty->translate['fkkntu_sum'];
        // $col_heading =  html_entity_decode(utf8_decode('Summa arbetstider'));

        $this->MultiCell($rw*$fkkn_colspan, $col_hi, html_entity_decode(utf8_decode($col_heading)), 0, 'C');
        $this->SetXY($a_x, $a_y);
        
    } 

    /////////////////////// column sub header starts ////////////////////////
    $this->Ln($rh);
    $rh = $header_calc_values['header_height'];
    // $this->rh = $rh;
    // $this->Ln();
    $this->SetXY(18, $this->GetY());
    $header_start_y = $this->GetY();
    $x_value = 18;
    $y_value = $this->GetY();
    $b_x = $this->GetX();
    $b_y = $this->GetY();
    $this->SetFillColor(255, 255, 255);
    $this->Cell($date_col_w, $rh, '', 'TLR', 0, 'C', TRUE);
    $a_x = $this->GetX();
    $a_y = $this->GetY();
    $this->SetXY($b_x , $b_y);
    $this->MultiCell($date_col_w, 5, utf8_decode($this->smarty->translate['date']), 0, 'C',FALSE);
    $this->SetXY($a_x, $a_y);
   // echo $rh;
    foreach ($this->headings as $key => $heading_first) { // sub header for normal type
                foreach ($heading_first as $key1 => $heading_second) {
                    foreach ($heading_second as $key2 => $heading_third) {
                        foreach ($heading_third as $key3 => $heading_fourth) {
                            if(is_array($heading_fourth)) $key3;
                            else $heading_fourth = array('sum');
                            
                            foreach ($heading_fourth as $key4 => $value) {
                                if($value == 'sum'){
                                    $value = $this->smarty->translate[$value];
                                    $this->SetFillColor(245, 190, 135);
                                }
                                else{
                                    $this->SetFillColor(255, 255, 255);
                                }
                                 $this->SetFont('Arial', 'B', 8);
                                 $b_x = $this->GetX();
                                 $b_y = $this->GetY();
                                 $this->Cell($rw, $rh, '', 'TLR', 0, 'C', TRUE);
                                 $a_x = $this->GetX();
                                 $a_y = $this->GetY();
                                 $this->SetXY($b_x, $b_y);
                                 $this->MultiCell($rw,5,utf8_decode($value),0,'C');
                                 $this->SetXY($a_x, $a_y);
                                 $x_value +=$rw;
                            }
                        }
                    }
                }
            }

    foreach ($this->headings_leave as $key => $heading_first) {  // sub header for leave type
                foreach ($heading_first as $key1 => $heading_second) {
                    foreach ($heading_second as $key2 => $heading_third) {
                        foreach ($heading_third as $key3 => $heading_fourth) {
                            foreach ($heading_fourth as $key4 => $heading_fifth) {
                                if(is_array($heading_fifth)) $key4;
                                else $heading_fifth = array('sum');
                                foreach ($heading_fifth as $key5 => $value) {
                                 if($value == 'sum'){
                                    $value = $this->smarty->translate[$value];    
                                    $this->SetFillColor(245, 190, 135);
                                 }
                                 else{
                                    $this->SetFillColor(249, 221, 221);
                                 }
                                 $this->SetFont('Arial', 'B', 8);
                                 $b_x = $this->GetX();
                                 $b_y = $this->GetY();
                                 $this->Cell($rw, $rh, '', 'TLR', 0, 'C', TRUE);
                                 $a_x = $this->GetX();
                                 $a_y = $this->GetY();
                                 $this->SetXY($b_x, $b_y);
                                 $this->MultiCell($rw,5,utf8_decode($value),0,'C');
                                 $this->SetXY($a_x, $a_y);
                                    $x_value +=$rw;
                                }
                                
                            }
                        }
                    }
                }
            }

    if(!empty($this->fkkn_slots)){  // sub header for fkkn types;
            if(!empty($this->fkkn_slots) && strpos(json_encode($this->fkkn_slots), "\"1\":") > 0 ){
                $this->fkkn_count = 1;
                $this->SetFont('Arial', 'B', 8);
                $this->SetFillColor(245, 190, 135);
                $b_x = $this->GetX();
                $b_y = $this->GetY();
                $this->Cell($rw, $rh, '', 'TLR', 0, 'C', TRUE);
                $a_x = $this->GetX();
                $a_y = $this->GetY();
                $this->SetXY($b_x, $b_y);
                $this->MultiCell($rw,5,utf8_decode($this->smarty->translate['fk_sum']),0,'C');
                $this->SetXY($a_x, $a_y);
                
                $x_value +=$rw;
            }
            if (!empty($this->fkkn_slots) && (strpos(json_encode($this->fkkn_slots), "\"2\":") > 0 || strpos(json_encode($this->fkkn_slots), "\"3\":") > 0)){
                $this->fkkn_count = $this->fkkn_count + 1;
                $this->SetFont('Arial', 'B', 8);
                $this->SetFillColor(245, 190, 135);
                $b_x = $this->GetX();
                $b_y = $this->GetY();
                $this->Cell($rw, $rh, '', 'TLR', 0, 'C', TRUE);
                $a_x = $this->GetX();
                $a_y = $this->GetY();
                $this->SetXY($b_x, $b_y);
                $this->MultiCell($rw,5,utf8_decode($this->smarty->translate['kntu_sum']),0,'C');
                $this->SetXY($a_x, $a_y);
                
                $x_value +=$rw;
            }
        }
        // $this->Ln();
        /////////////////////// column sub header end ////////////////////////

    if($this->PageNo() > 1)
                $this->Ln($rh);
}
    function P1_Part2_Landscap() {
        
        $col_hi = 10;
        $date_col_w = 30;
        if($this->total_column_count <= 22){ // 22 is the total number columns now allowed in single page. 
            $rw = (265-$date_col_w) / $this->total_column_count;
        } else {
            $rw = (385-$date_col_w) / $this->total_column_count;
        }
	    $this->SetY($this->header_calc_values['tr_start_y']+$this->rh);
	    $this->SetX(18);
        $this->SetFont('Arial', '', 11);
	    $tot_fk = 0;
        $tot_kntu = 0;
        foreach($this->days_in_month as $date_key){
        	$date=date_create($date_key);
        	$d_format = strtolower(substr(date_format($date,"M-D-Y"),4,3));
        	$this->SetFillColor(255, 255, 255);
        	$this->Cell($date_col_w, $col_hi, html_entity_decode(utf8_decode(substr($date_key, 5) . " " . $this->smarty->translate[$d_format])), 1, 0, 'C', TRUE);
        	$contents = array();

            if (array_key_exists($date_key, $this->result_data)){
                $contents = $this->result_data[$date_key];
            }

	        foreach ($this->headings as $key => $heading_first) { // filling table value for normal types.
	    		foreach ($heading_first as $key1 => $heading_second) {
	    			foreach ($heading_second as $key2 => $heading_third) {
	    				foreach ($heading_third as $key3 => $heading_fourth) {
	    					if(is_array($heading_fourth)) $key3;
	    					else $heading_fourth = array('sum');
	    					foreach ($heading_fourth as $key4 => $value) {
	    						if (array_key_exists($key, $contents) && array_key_exists($key1, $contents[$key]) && array_key_exists($key2, $contents[$key][$key1]) && array_key_exists($key3, $contents[$key][$key1][$key2]) && array_key_exists($value,$contents[$key][$key1][$key2][$key3])){

	    							 $body_normal_value = $contents[$key][$key1][$key2][$key3][$value];

	    							 if($value == 'sum'){
	    								$this->SetFillColor(245, 190, 135);
	    								$this->Cell($rw, $col_hi, number_format((float)$body_normal_value, 2, '.', '') , 1, 0, 'C', TRUE);
	    							 }
	    							 else{
	    							 	$this->SetFillColor(255, 255, 255);
	    								$this->Cell($rw, $col_hi, number_format((float)$body_normal_value, 2, '.', '') , 1, 0, 'C', TRUE);
	    							 }
	    						}
	    						else{
	    							if($value == 'sum'){
	    								$this->SetFillColor(245, 190, 135);
	    								$this->Cell($rw, $col_hi, '', 1, 0, 'C', TRUE);
	    							}
	    							else{
	    								$this->SetFillColor(255, 255, 255);
										$this->Cell($rw, $col_hi, '', 1, 0, 'C', TRUE);
	    							}
	    						}
	    					}
	    				}
	    			}
	    		}
	    	}

	    	if (array_key_exists($date_key, $this->results_leave)){
                    $contents = $this->results_leave[$date_key];
	    	}
     
	    	// echo "<pre>".print_r($this->results_leave,1)."</pre>";

     		foreach ($this->headings_leave as $key => $heading_first) {  // filling table value for leave types.
	    		foreach ($heading_first as $key1 => $heading_second) {
	    			foreach ($heading_second as $key2 => $heading_third) {
	    				foreach ($heading_third as $key3 => $heading_fourth) {
	    					foreach ($heading_fourth as $key4 => $heading_fifth) {
	    						if(is_array($heading_fifth)) $key4;
	    						else $heading_fifth = array('sum');
	    						foreach ($heading_fifth as $key5 => $value) {
	    							// echo $value;
	    							// echo  $contents_leave[$key][$key1][$key2][$key3][$key4][$value];
	    							if (array_key_exists($key, $contents) && array_key_exists($key1, $contents[$key]) && array_key_exists($key2, $contents[$key][$key1]) && array_key_exists($key3, $contents[$key][$key1][$key2]) && array_key_exists($key4, $contents[$key][$key1][$key2][$key3]) && array_key_exists($value,$contents[$key][$key1][$key2][$key3][$key4])){

	    								$body_leave_value = $contents[$key][$key1][$key2][$key3][$key4][$value];
	    								// echo $value;

	    								if($value == 'sum'){
	    									$this->SetFillColor(245, 190, 135);
	    									$this->Cell($rw, $col_hi, number_format((float)$body_leave_value, 2, '.', '') , 1, 0, 'C', TRUE);
	    							 	}
	    							 	else{
	    							 		$this->SetFillColor(249, 221, 221);
	    									$this->Cell($rw, $col_hi, number_format((float)$body_leave_value, 2, '.', '') , 1, 0, 'C', TRUE);
	    							 	}
	    							}
	    							else{
	    								if($value == 'sum'){
	    									$this->SetFillColor(245, 190, 135);
	    									$this->Cell($rw, $col_hi, '', 1, 0, 'C', TRUE);
	    								}
	    								else{
	    									$this->SetFillColor(249, 221, 221);
											$this->Cell($rw, $col_hi, '', 1, 0, 'C', TRUE);
	    								}
	    							}
	    						}
	    					}
	    				}
	    			}
	    		}
	    	}
	    	$this->SetFillColor(245, 190, 135);
	    	if(!empty($this->fkkn_slots)){  // filling fkkn values in table body
	        	if(!empty($this->fkkn_slots) && strpos(json_encode($this->fkkn_slots), "\"1\":") > 0 ){
	        			$this->Cell($rw, $col_hi,  $this->fkkn_slots[$date_key][1] ? number_format((float)$this->fkkn_slots[$date_key][1], 2, '.', '')  : '',    1, 0, 'C', TRUE);
	        		if ($this->fkkn_slots.$date_key[1]){
	        			$tot_fk = $tot_fk + $this->fkkn_slots[$date_key][1];
	        		}
	        		
	        	}
	        	if (!empty($this->fkkn_slots) && (strpos(json_encode($this->fkkn_slots), "\"2\":") > 0 || strpos(json_encode($this->fkkn_slots), "\"3\":") > 0)){
	        		if ($this->fkkn_slots.$date_key[2] || $this->fkkn_slots.$date_key[3]){
	        			$fkkn_value = $this->fkkn_slots[$date_key][2]+$this->fkkn_slots[$date_key][3];
	        		}
	        		else{
	        			$fkkn_value = '';
	        		}
	        		$this->Cell($rw, $col_hi, $fkkn_value ? number_format((float)$fkkn_value, 2, '.', '') : '' , 1, 0, 'C', TRUE);
	        		if ($fkkn_slots.$date_key[2]){
	        			$tot_kntu = $tot_kntu + $this->fkkn_slots[$date_key][2];
	        		}
	        		
                    if ($fkkn_slots.$date_key[3]){
                   		$tot_kntu = $tot_kntu + $this->fkkn_slots[$date_key][3];
                    }
                    
	        	}	
		    }
		    $this->Ln();
		    $this->SetX(18);
        }
       		////////////////////// table body ends      /////////////////////////

        	/////////////////////  table total starts   /////////////////////////
        	$this->SetFillColor(0, 255, 0);
        	$this->Cell($date_col_w, $col_hi, html_entity_decode(utf8_decode($this->smarty->translate['sum'])), 1, 0, 'C', TRUE);

        	foreach ($this->total as $ordered_total){   // total sum of normal types
                foreach ($ordered_total as $total_categroy){
                    foreach ($total_categroy as $ordered_total_categroy){
                        foreach ($ordered_total_categroy as $ind_total){
                             $this->Cell($rw, $col_hi, number_format((float)$ind_total, 2, '.', '') , 1, 0, 'C', TRUE);
                        }
                    }
                }
            }   

            foreach ($this->total_leave as $total_leave_main){  //total sum of leave types 
                foreach ($total_leave_main as $ordered_total){
                    foreach ($ordered_total as $total_categroy){
                        foreach ($total_categroy as $ordered_total_categroy){
                           foreach ($ordered_total_categroy as $ind_total){
                           		$this->Cell($rw, $col_hi, number_format((float)$ind_total, 2, '.', ''), 1, 0, 'C', TRUE);
                           }
                        }
                    }
                }
            }
            
            if ($tot_fk){
            	$this->Cell($rw, $col_hi, number_format((float)$tot_fk, 2, '.', ''), 1, 0, 'C', TRUE);
            }
            if ($tot_kntu){
            	$this->Cell($rw, $col_hi, number_format((float)$tot_kntu, 2, '.', ''), 1, 0, 'C', TRUE);
            }


        	/////////////////////  table total ends   /////////////////////////

    }
     
    function Footer() {
        //Position at 1.5 cm from bottom
        $this->SetY(-15);
        //Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        //Page number
        $this->Cell(0, 10, $this->smarty->translate['page_no'] . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

}

?>