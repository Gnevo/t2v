<?php

require_once('./plugins/F_pdf.class.php');
require_once('class/setup.php');
//require_once('./plugins/fpdi/fpdi.php');
//FPDI
class PDF_Customer_week_report extends FPDF     { //FPDF
    
    var $report_month = '';
    var $report_year = '';
    var $report_customer = '';
    var $report_start_date = '';
    var $report_end_date = '';

    var $rpt_contents = array();
    var $rpt_sum = array();
    
    function __construct($orientation) {
//        echo $orientation;
        parent::__construct($orientation);
        $this->FPDF($orientation);
        //$this->k=2;
    }

    function P1_Part1($customer) {
        
        $year = $this->report_year;
        $month = $this->report_month;
        
        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0, 50, 50);

        $this->SetFont('Arial', 'B', 18);     
        $this->SetXY(18, $this->GetY()+ 5);
        $this->Cell(265, 5, utf8_decode('Månadsrapport Kund'), 0, 0, 'C', FALSE);
        
        $this->SetXY(18, $this->GetY()+10);
        $this->Cell(180,11,'',1,0,'L',true);    //set border
        $this->Cell(85,11,'',1,0,'L',true);    //set border

        $this->SetFont('Arial','',10);
        $this->SetXY(20,  $this->GetY()-2);
        $this->Cell(10,9,utf8_decode('Förnamn och efternamn '),0,0,'L',FALSE);    //label name1
        $this->SetXY(200,  $this->GetY());
        $this->Cell(10,9,utf8_decode(' Personnummer '),0,0,'L',FALSE);    // label name2

        $this->SetFont('Arial','B',12);
        $this->SetXY(20,  $this->GetY()+ 5);
        $this->Cell(10,9,utf8_decode($customer['first_name'] . " " . $customer['last_name']),0,0,'L',FALSE);    //label value1
        $this->SetXY(202,  $this->GetY());
        //$this->Cell(10,9,'920320-1968 ',0,0,'L',FALSE);    // label value2
        $this->Cell(10,9,$customer['social_security'],0,0,'L',FALSE);    // label value2

        $this->Ln();
    
    
        $this->SetXY(18, $this->GetY()-1.3);
        $this->Cell(265, 11, '', 1, 0, 'L', TRUE);
        
        if ($year % 400 == 0 || ($year % 100 != 0 && $year % 4 == 0))
            $month_days = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
        else
            $month_days = array(31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

        $this->SetFont('Arial','',10);
        $this->SetXY(20,  $this->GetY()-2);
        $this->Cell(10,9,utf8_decode('Period'),0,0,'L',FALSE);    //label name1
        
        $this->SetFont('Arial','B',12);
        $this->SetXY(20,  $this->GetY()+ 7);
        $this->Cell(177, 5, utf8_decode($year.'-'.sprintf('%02d',$month).'-01 -- '.$year.'-'.sprintf('%02d',$month).'-'.$month_days[$month-1]), 0, 0, 'L', FALSE);

        $this->Ln(13);
//        
//        $year = $this->report_year;
//        $month = $this->report_month;
//        
//        $this->SetFillColor(255, 255, 255);
//        $this->SetTextColor(0, 50, 50);
//
//        $this->SetFont('Arial', 'B', 18);     
//        $this->SetXY(18, $this->GetY()+ 5);
//        $this->Cell(180, 5, utf8_decode('Månadsrapport Kund'), 0, 0, 'C', FALSE);
//        
//        $this->SetXY(18, $this->GetY()+10);
//        $this->Cell(120,11,'',1,0,'L',true);    //set border
//        $this->Cell(60,11,'',1,0,'L',true);    //set border
//
//        $this->SetFont('Arial','',10);
//        $this->SetXY(20,  $this->GetY()-2);
//        $this->Cell(10,9,utf8_decode('Förnamn och efternamn '),0,0,'L',FALSE);    //label name1
//        $this->SetXY(140,  $this->GetY());
//        $this->Cell(10,9,utf8_decode(' Personnummer '),0,0,'L',FALSE);    // label name2
//
//        $this->SetFont('Arial','B',12);
//        $this->SetXY(20,  $this->GetY()+ 5);
//        $this->Cell(10,9,utf8_decode($customer['first_name'] . " " . $customer['last_name']),0,0,'L',FALSE);    //label value1
//        $this->SetXY(141,  $this->GetY());
//        //$this->Cell(10,9,'920320-1968 ',0,0,'L',FALSE);    // label value2
//        $this->Cell(10,9,$customer['social_security'],0,0,'L',FALSE);    // label value2
//
//        $this->Ln();
//    
//    
//        $this->SetXY(18, $this->GetY()-1.3);
//        $this->Cell(180, 11, '', 1, 0, 'L', TRUE);
//        
//        if ($year % 400 == 0 || ($year % 100 != 0 && $year % 4 == 0))
//            $month_days = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
//        else
//            $month_days = array(31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
//
//        $this->SetFont('Arial','',10);
//        $this->SetXY(20,  $this->GetY()-2);
//        $this->Cell(10,9,utf8_decode('Period'),0,0,'L',FALSE);    //label name1
//        
//        $this->SetFont('Arial','B',12);
//        $this->SetXY(20,  $this->GetY()+ 7);
//        $this->Cell(177, 5, utf8_decode($year.'-'.sprintf('%02d',$month).'-01 -- '.$year.'-'.sprintf('%02d',$month).'-'.$month_days[$month-1]), 0, 0, 'L', FALSE);
//
//        $this->Ln(13);
    }


    function P1_Part2() {
        
        
        $w = array(20, 20, 20, 20, 20, 20, 20, 20, 20);
        $table_head_content = array("Anställd", "Mån", "Tis", "Ons", "Tors", "Fre", "Lör", "Sön", "Summa");
        $col_h = 10;
            
        $i = 0;
        foreach($this->rpt_contents as $report){
            $this->SetFont('Arial','B',12);
            $this->SetXY(18,  $this->GetY());
            $this->Cell(180, 11,utf8_decode('Vecka '.$report['week']),1,1,'C',FALSE);    //week table heading (week number)
            
            $sun_sum = 0;
            $sun_mon = 0;
            $sun_tue = 0;
            $sun_wed = 0;
            $sun_thu = 0;
            $sun_fri = 0;
            $sun_sat = 0;
            
            $this->SetX(18);
            for($m = 0 ; $m <9 ; $m++){     //set column headings for each table
                $this->Cell($w[$m], $col_h, utf8_decode($table_head_content[$m]), 1, 0, 'C', FALSE);
            }
            
            
            $this->Ln();
            $this->SetFont('Arial','',8);
            foreach($report['employee'] as $emp){
                $this->SetX(18);
                
                $max_entries = 0;       //find max no.of entries per row
                $we=count($emp['Mon']);
                if($max_entries<$we)
                    $max_entries = $we;
                $we=count($emp['Tue']);
                if($max_entries<$we)
                    $max_entries = $we;
                $we=count($emp['Wed']);
                if($max_entries<$we)
                    $max_entries = $we;
                $we=count($emp['Thu']);
                if($max_entries<$we)
                    $max_entries = $we;
                $we=count($emp['Fri']);
                if($max_entries<$we)
                    $max_entries = $we;
                $we=count($emp['Sat']);
                if($max_entries<$we)
                    $max_entries = $we;
                $we=count($emp['Sun']);
                if($max_entries<$we)
                    $max_entries = $we;
                $current_rh = $max_entries*$col_h;
                
                $this->Cell($w[0], $current_rh, utf8_decode($emp['name']), 1, 0, 'L', FALSE);
                
                
                //col mon
                $start_x = $this->GetX();
                $start_y = $this->GetY();
                if(!empty($emp['Mon'])){
                    $indx = 0;
                    foreach($emp['Mon'] as $mon){
                        $man = explode(',', $mon);
    //                    if($man[1] == 0){
    //                        $this->Cell($w[1], $col_h, utf8_decode($man[0]), 1, 0, 'L', FALSE);
    //                    }
                        $this->Cell($w[1], $col_h, utf8_decode($man[0]), 1, 0, 'L', FALSE);
                        if (++$indx != count($emp['Mon'])){
                            $this->SetXY($start_x,$this->GetY()+$col_h);
                        }  else {
                            $this->SetXY($start_x+$w[1],$start_y);
                        }
                    }
                }else{
                    $this->Cell($w[1], $current_rh, '', 1, 0, 'L', FALSE);
                }
                
                
                //col tue
                $start_x = $this->GetX();
                $start_y = $this->GetY();
                if(!empty($emp['Tue'])){
                    $indx = 0;
                    foreach($emp['Tue'] as $tue){
                        $man = explode(',', $tue);
                        $this->Cell($w[2], $col_h, utf8_decode($man[0]), 1, 0, 'L', FALSE);
                        if (++$indx != count($emp['Tue'])){
                            $this->SetXY($start_x,$this->GetY()+$col_h);
                        }  else {
                            $this->SetXY($start_x+$w[2],$start_y);
                        }
                    }
                }else{
                    $this->Cell($w[2], $current_rh, '', 1, 0, 'L', FALSE);
                }
                
                
                //col wed
                $start_x = $this->GetX();
                $start_y = $this->GetY();
                if(!empty($emp['Wed'])){
                    $indx = 0;
                    foreach($emp['Wed'] as $wed){
                        $man = explode(',', $wed);
                        $this->Cell($w[3], $col_h, utf8_decode($man[0]), 1, 0, 'L', FALSE);
                        if (++$indx != count($emp['Wed'])){
                            $this->SetXY($start_x,$this->GetY()+$col_h);
                        }  else {
                            $this->SetXY($start_x+$w[3],$start_y);
                        }
                    }
                }else{
                    $this->Cell($w[3], $current_rh, '', 1, 0, 'L', FALSE);
                }
                
                
                //col thu
                $start_x = $this->GetX();
                $start_y = $this->GetY();
                if(!empty($emp['Thu'])){
                    $indx = 0;
                    foreach($emp['Thu'] as $thu){
                        $man = explode(',', $thu);
                        $this->Cell($w[4], $col_h, utf8_decode($man[0]), 1, 0, 'L', FALSE);
                        if (++$indx != count($emp['Thu'])){
                            $this->SetXY($start_x,$this->GetY()+$col_h);
                        }  else {
                            $this->SetXY($start_x+$w[4],$start_y);
                        }
                    }
                }else{
                    $this->Cell($w[4], $current_rh, '', 1, 0, 'L', FALSE);
                }
                
                
                //col fri
                $start_x = $this->GetX();
                $start_y = $this->GetY();
                if(!empty($emp['Fri'])){
                    $indx = 0;
                    foreach($emp['Fri'] as $fri){
                        $man = explode(',', $fri);
                        $this->Cell($w[5], $col_h, utf8_decode($man[0]), 1, 0, 'L', FALSE);
                        if (++$indx != count($emp['Fri'])){
                            $this->SetXY($start_x,$this->GetY()+$col_h);
                        }  else {
                            $this->SetXY($start_x+$w[5],$start_y);
                        }
                    }
                }else{
                    $this->Cell($w[5], $current_rh, '', 1, 0, 'L', FALSE);
                }
                
                
                //col sat
                $start_x = $this->GetX();
                $start_y = $this->GetY();
                if(!empty($emp['Sat'])){
                    $indx = 0;
                    foreach($emp['Sat'] as $sat){
                        $man = explode(',', $sat);
                        $this->Cell($w[6], $col_h, utf8_decode($man[0]), 1, 0, 'L', FALSE);
                        if (++$indx != count($emp['Sat'])){
                            $this->SetXY($start_x,$this->GetY()+$col_h);
                        }  else {
                            $this->SetXY($start_x+$w[6],$start_y);
                        }
                    }
                }else{
                    $this->Cell($w[6], $current_rh, '', 1, 0, 'L', FALSE);
                }
                
                
                //col Sun
                $start_x = $this->GetX();
                $start_y = $this->GetY();
                if(!empty($emp['Sun'])){
                    $indx = 0;
                    foreach($emp['Sun'] as $sun){
                        $man = explode(',', $sun);
                        $this->Cell($w[7], $col_h, utf8_decode($man[0]), 1, 0, 'L', FALSE);
                        if (++$indx != count($emp['Sun'])){
                            $this->SetXY($start_x,$this->GetY()+$col_h);
                        }  else {
                            $this->SetXY($start_x+$w[7],$start_y);
                        }
                    }
                }else{
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

    function P1_Part2_Landscape() {
        $smarty = new smartySetup(array("user.xml","month.xml","messages.xml","button.xml","forms.xml"),FALSE);
        $this->SetFillColor(230, 230, 230);
        $w = array(42, 29, 29, 29, 29, 29, 29, 29, 20);
        $table_head_content = array( "Sön","Mån", "Tis", "Ons", "Tors", "Fre", "Lör", "Summa");
        $weeks = array("sun","mon", "tue", "wed", "thu", "fri", "sat");
        $col_h = 5;
            
        $i = 0;
        foreach($this->rpt_contents as $report){
            $this->SetFont('Arial','B',12);
//            
            $y_value = floatval($this->GetY());
            if($y_value >= 150.00){
                $this->AddPage();
                $y_value = 25.00;
            }
//            echo "<script>alert('".$this->GetY()."----".$y_value."');</script>";
            $this->SetXY(18,  $y_value);
            $this->Cell(265, 11,utf8_decode('Vecka '.$report['week']),1,1,'C',FALSE);    //week table heading (week number)
            
            $this->SetX(18);
            $this->Cell($w[0], $col_h, utf8_decode('Anställd'), 1, 0, 'C', FALSE);
            for($m = 0 ; $m <8 ; $m++){     //set column headings for each table
                $this->Cell($w[$m+1], $col_h, utf8_decode($table_head_content[$m])."  ".$report[$weeks[$m]], 1, 0, 'C', FALSE);
                
            }
            
            
            $this->Ln();
            $this->SetFont('Arial','',9);
            foreach($report['employee'] as $emp){
                $this->SetX(18);
                
//                $this->Cell($w[0], $col_h, $this->GetY(), 1, 0, 'C', FALSE);
//                if(floatval($this->GetY()) < 26.00){
//                    $this->SetXY(18,11);
//                    $this->Cell($w[0], $col_h, utf8_decode('Anställd'), 1, 0, 'C', FALSE);
//                    for($m = 0 ; $m <8 ; $m++){     //set column headings for each table
//                        $this->SetXY(18,11);
//                        $this->Cell($w[$m+1], $col_h, utf8_decode($table_head_content[$m])."  ".$report[$weeks[$m]], 1, 0, 'C', FALSE);
//                        
//                    }
//                    $this->Ln();
//                }
                $max_entries = 0;       //find max no.of entries per row
                $we=count($emp['Mon']);
                if($max_entries<$we)
                    $max_entries = $we;
                $we=count($emp['Tue']);
                if($max_entries<$we)
                    $max_entries = $we;
                $we=count($emp['Wed']);
                if($max_entries<$we)
                    $max_entries = $we;
                $we=count($emp['Thu']);
                if($max_entries<$we)
                    $max_entries = $we;
                $we=count($emp['Fri']);
                if($max_entries<$we)
                    $max_entries = $we;
                $we=count($emp['Sat']);
                if($max_entries<$we)
                    $max_entries = $we;
                $we=count($emp['Sun']);
                if($max_entries<$we)
                    $max_entries = $we;
                $current_rh = $max_entries*$col_h;
                
                
                if($this->GetY()<11.00 || $this->GetY()>180.00){
                    $this->SetFont('Arial','B',12);
                    if($this->GetY()>180.00)
                        $this->AddPage ();
//                    echo "<script>alert('".$emp['name'].$this->GetY()."');</script>";
                    $this->SetX(18);
                    $this->Cell(265, 11,utf8_decode('Vecka '.$report['week']),1,1,'C',FALSE);
                    $this->SetX(18);
                    $this->Cell($w[0], $col_h, utf8_decode('Anställd'), 1, 0, 'C', FALSE);
                    for($m = 0 ; $m <8 ; $m++){     //set column headings for each table
                        
                        $this->Cell($w[$m+1], $col_h, utf8_decode($table_head_content[$m])."  ".$report[$weeks[$m]], 1, 0, 'C', FALSE);
                        
                    }
                    $this->Ln();
                    $this->SetFont('Arial','',9);
                }
                $this->SetX(18);
//                echo "<script>alert('".$emp['name'].$this->GetY()."');</script>";
                $this->Cell($w[0], $current_rh, utf8_decode($emp['name']), 1, 0, 'L', FALSE);
//                    echo "<script>alert('".$emp['name'].$this->GetY()."');</script>";
                //$this->Image('./images/fk2.gif', 11, $this->GetY(), 8, 8);
                //col mon
                $start_x = $this->GetX();
                $start_y = $this->GetY();
                $y_value = floatval($this->GetY());
             
                $this->Cell($w[1], $current_rh, '', 1, 0, 'L', FALSE);
                $this->SetXY($start_x,$start_y);
                if(!empty($emp['Sun'])){
                    
                    $indx = 0;
                    foreach($emp['Sun'] as $sun){
                        $man = explode(',', $sun);
                        if($man[2] == 1)
                            $bg_flag = FALSE;
                        else
                            $bg_flag = TRUE;
                        $this->Cell($w[7]-8, $col_h, utf8_decode($man[0]), 1, 0, 'C', $bg_flag);
                        
                        if($man[1] == 0)
                            $this->Cell(8, $col_h,$smarty->translate['working_shortcut'], 1, 0, 'C', $bg_flag);
                        if($man[1] == 1)
                            $this->Cell(8, $col_h, $smarty->translate['travel_shortcut'], 1, 0, 'C', $bg_flag);
                        if($man[1] == 2)
                            $this->Cell(8, $col_h, $smarty->translate['lunch_shortcut'],1, 0, 'C', $bg_flag);
                        if($man[1] == 3)
                           $this->Cell(8, $col_h,$smarty->translate['oncall_shortcut'], 1, 0, 'C', $bg_flag);
                        if($man[1] == 4)
                            $this->Cell(8, $col_h, $smarty->translate['overtime_shortcut'], 1, 0, 'C', $bg_flag);
                        if($man[1] == 5)
                            $this->Cell(8, $col_h, $smarty->translate['more_overtime_shortcut'], 1, 0, 'C', $bg_flag);
                        if($man[1] == 6)
                            $this->Cell(8, $col_h,$smarty->translate['quality_overtime_shortcut'], 1, 0, 'C', $bg_flag);
                        if($man[1] == 7)
                            $this->Cell(8, $col_h, $smarty->translate['some_othertime_shortcut'], 1, 0, 'C', $bg_flag);
                        
                        if (++$indx != count($emp['Sun'])){
                            $this->SetXY($start_x,$this->GetY()+$col_h);
                        }  else {
                            $this->SetXY($start_x+$w[7],$start_y);
                        }
                    }
                }else{
                    $this->Cell($w[7], $current_rh, '', 1, 0, 'L', FALSE);
                }
                
                $start_x = $this->GetX();
                $start_y = $this->GetY();
                $this->Cell($w[7], $current_rh, '', 1, 0, 'L', FALSE);
                $this->SetXY($start_x,$start_y);
                
                if(!empty($emp['Mon'])){
                    $indx = 0;
                    foreach($emp['Mon'] as $mon){
                        $man = explode(',', $mon);
    //                    if($man[1] == 0){
    //                        $this->Cell($w[1], $col_h, utf8_decode($man[0]), 1, 0, 'L', FALSE);
    //                    }
                        if($man[2] == 1)
                            $bg_flag = FALSE;
                        else
                            $bg_flag = TRUE;
                        $this->Cell($w[1]-8, $col_h, utf8_decode($man[0]), 1, 0, 'L', $bg_flag);
                        if($man[1] == 0)
                            $this->Cell(8, $col_h,$smarty->translate['working_shortcut'], 1, 0, 'C', $bg_flag);
                        if($man[1] == 1)
                            $this->Cell(8, $col_h, $smarty->translate['travel_shortcut'], 1, 0, 'C', $bg_flag);
                        if($man[1] == 2)
                            $this->Cell(8, $col_h, $smarty->translate['lunch_shortcut'],1, 0, 'C', $bg_flag);
                        if($man[1] == 3)
                           $this->Cell(8, $col_h,$smarty->translate['oncall_shortcut'], 1, 0, 'C', $bg_flag);
                        if($man[1] == 4)
                            $this->Cell(8, $col_h, $smarty->translate['overtime_shortcut'], 1, 0, 'C', $bg_flag);
                        if($man[1] == 5)
                            $this->Cell(8, $col_h, $smarty->translate['more_overtime_shortcut'], 1, 0, 'C', $bg_flag);
                        if($man[1] == 6)
                            $this->Cell(8, $col_h,$smarty->translate['quality_overtime_shortcut'], 1, 0, 'C', $bg_flag);
                        if($man[1] == 7)
                            $this->Cell(8, $col_h, $smarty->translate['some_othertime_shortcut'], 1, 0, 'C', $bg_flag);
                        
                        if (++$indx != count($emp['Mon'])){
                            $this->SetXY($start_x,$this->GetY()+$col_h);
                        }  else {
                            $this->SetXY($start_x+$w[1],$start_y);
                        }
                    }
                }else{
                    $this->Cell($w[1], $current_rh, '', 1, 0, 'L', FALSE);
                }
                
                
                //col tue
                $start_x = $this->GetX();
                $start_y = $this->GetY();
                $this->Cell($w[2], $current_rh, '', 1, 0, 'L', FALSE);
                $this->SetXY($start_x,$start_y);
                if(!empty($emp['Tue'])){
                    $indx = 0;
                    foreach($emp['Tue'] as $tue){
                        $man = explode(',', $tue);
                        if($man[2] == 1)
                            $bg_flag = FALSE;
                        else
                            $bg_flag = TRUE;
                        $this->Cell($w[2]-8, $col_h, utf8_decode($man[0]), 1, 0, 'L', $bg_flag);
                        
                        if($man[1] == 0)
                            $this->Cell(8, $col_h,$smarty->translate['working_shortcut'], 1, 0, 'C', $bg_flag);
                        if($man[1] == 1)
                            $this->Cell(8, $col_h, $smarty->translate['travel_shortcut'], 1, 0, 'C', $bg_flag);
                        if($man[1] == 2)
                            $this->Cell(8, $col_h, $smarty->translate['lunch_shortcut'],1, 0, 'C', $bg_flag);
                        if($man[1] == 3)
                           $this->Cell(8, $col_h,$smarty->translate['oncall_shortcut'], 1, 0, 'C', $bg_flag);
                        if($man[1] == 4)
                            $this->Cell(8, $col_h, $smarty->translate['overtime_shortcut'], 1, 0, 'C', $bg_flag);
                        if($man[1] == 5)
                            $this->Cell(8, $col_h, $smarty->translate['more_overtime_shortcut'], 1, 0, 'C', $bg_flag);
                        if($man[1] == 6)
                            $this->Cell(8, $col_h,$smarty->translate['quality_overtime_shortcut'], 1, 0, 'C', $bg_flag);
                        if($man[1] == 7)
                            $this->Cell(8, $col_h, $smarty->translate['some_othertime_shortcut'], 1, 0, 'C', $bg_flag);
                        
                        if (++$indx != count($emp['Tue'])){
                            $this->SetXY($start_x,$this->GetY()+$col_h);
                        }  else {
                            $this->SetXY($start_x+$w[2],$start_y);
                        }
                    }
                }else{
                    $this->Cell($w[2], $current_rh, '', 1, 0, 'L', FALSE);
                }
                
                
                //col wed
                $start_x = $this->GetX();
                $start_y = $this->GetY();
                $this->Cell($w[3], $current_rh, '', 1, 0, 'L', FALSE);
                $this->SetXY($start_x,$start_y);
                if(!empty($emp['Wed'])){
                    $indx = 0;
                    foreach($emp['Wed'] as $wed){
                        $man = explode(',', $wed);
                        if($man[2] == 1)
                            $bg_flag = FALSE;
                        else
                            $bg_flag = TRUE;
                        $this->Cell($w[3]-8, $col_h, utf8_decode($man[0]), 1, 0, 'L', $bg_flag);
                        
                        if($man[1] == 0)
                            $this->Cell(8, $col_h,$smarty->translate['working_shortcut'], 1, 0, 'C', $bg_flag);
                        if($man[1] == 1)
                            $this->Cell(8, $col_h, $smarty->translate['travel_shortcut'], 1, 0, 'C', $bg_flag);
                        if($man[1] == 2)
                            $this->Cell(8, $col_h, $smarty->translate['lunch_shortcut'],1, 0, 'C', $bg_flag);
                        if($man[1] == 3)
                           $this->Cell(8, $col_h,$smarty->translate['oncall_shortcut'], 1, 0, 'C', $bg_flag);
                        if($man[1] == 4)
                            $this->Cell(8, $col_h, $smarty->translate['overtime_shortcut'], 1, 0, 'C', $bg_flag);
                        if($man[1] == 5)
                            $this->Cell(8, $col_h, $smarty->translate['more_overtime_shortcut'], 1, 0, 'C', $bg_flag);
                        if($man[1] == 6)
                            $this->Cell(8, $col_h,$smarty->translate['quality_overtime_shortcut'], 1, 0, 'C', $bg_flag);
                        if($man[1] == 7)
                            $this->Cell(8, $col_h, $smarty->translate['some_othertime_shortcut'], 1, 0, 'C', $bg_flag);
                        
                        if (++$indx != count($emp['Wed'])){
                            $this->SetXY($start_x,$this->GetY()+$col_h);
                        }  else {
                            $this->SetXY($start_x+$w[3],$start_y);
                        }
                    }
                }else{
                    $this->Cell($w[3], $current_rh, '', 1, 0, 'L', FALSE);
                }
                
                
                //col thu
                $start_x = $this->GetX();
                $start_y = $this->GetY();
                $this->Cell($w[4], $current_rh, '', 1, 0, 'L', FALSE);
                $this->SetXY($start_x,$start_y);
                if(!empty($emp['Thu'])){
                    $indx = 0;
                    foreach($emp['Thu'] as $thu){
                        $man = explode(',', $thu);
                        if($man[2] == 1)
                            $bg_flag = FALSE;
                        else
                            $bg_flag = TRUE;
                        $this->Cell($w[4]-8, $col_h, utf8_decode($man[0]), 1, 0, 'L', $bg_flag);
                        
                        if($man[1] == 0)
                            $this->Cell(8, $col_h,$smarty->translate['working_shortcut'], 1, 0, 'C', $bg_flag);
                        if($man[1] == 1)
                            $this->Cell(8, $col_h, $smarty->translate['travel_shortcut'], 1, 0, 'C', $bg_flag);
                        if($man[1] == 2)
                            $this->Cell(8, $col_h, $smarty->translate['lunch_shortcut'],1, 0, 'C', $bg_flag);
                        if($man[1] == 3)
                           $this->Cell(8, $col_h,$smarty->translate['oncall_shortcut'], 1, 0, 'C', $bg_flag);
                        if($man[1] == 4)
                            $this->Cell(8, $col_h, $smarty->translate['overtime_shortcut'], 1, 0, 'C', $bg_flag);
                        if($man[1] == 5)
                            $this->Cell(8, $col_h, $smarty->translate['more_overtime_shortcut'], 1, 0, 'C', $bg_flag);
                        if($man[1] == 6)
                            $this->Cell(8, $col_h,$smarty->translate['quality_overtime_shortcut'], 1, 0, 'C', $bg_flag);
                        if($man[1] == 7)
                            $this->Cell(8, $col_h, $smarty->translate['some_othertime_shortcut'], 1, 0, 'C', $bg_flag);
                        
                        if (++$indx != count($emp['Thu'])){
                            $this->SetXY($start_x,$this->GetY()+$col_h);
                        }  else {
                            $this->SetXY($start_x+$w[4],$start_y);
                        }
                    }
                }else{
                    $this->Cell($w[4], $current_rh, '', 1, 0, 'L', FALSE);
                }
                
                
                //col fri
                $start_x = $this->GetX();
                $start_y = $this->GetY();
                $this->Cell($w[5], $current_rh, '', 1, 0, 'L', FALSE);
                $this->SetXY($start_x,$start_y);
                if(!empty($emp['Fri'])){
                    $indx = 0;
                    foreach($emp['Fri'] as $fri){
                        $man = explode(',', $fri);
                        if($man[2] == 1)
                            $bg_flag = FALSE;
                        else
                            $bg_flag = TRUE;
                        $this->Cell($w[5]-8, $col_h, utf8_decode($man[0]), 1, 0, 'L', $bg_flag);
                        
                        if($man[1] == 0)
                            $this->Cell(8, $col_h,$smarty->translate['working_shortcut'], 1, 0, 'C', $bg_flag);
                        if($man[1] == 1)
                            $this->Cell(8, $col_h, $smarty->translate['travel_shortcut'], 1, 0, 'C', $bg_flag);
                        if($man[1] == 2)
                            $this->Cell(8, $col_h, $smarty->translate['lunch_shortcut'],1, 0, 'C', $bg_flag);
                        if($man[1] == 3)
                           $this->Cell(8, $col_h,$smarty->translate['oncall_shortcut'], 1, 0, 'C', $bg_flag);
                        if($man[1] == 4)
                            $this->Cell(8, $col_h, $smarty->translate['overtime_shortcut'], 1, 0, 'C', $bg_flag);
                        if($man[1] == 5)
                            $this->Cell(8, $col_h, $smarty->translate['more_overtime_shortcut'], 1, 0, 'C', $bg_flag);
                        if($man[1] == 6)
                            $this->Cell(8, $col_h,$smarty->translate['quality_overtime_shortcut'], 1, 0, 'C', $bg_flag);
                        if($man[1] == 7)
                            $this->Cell(8, $col_h, $smarty->translate['some_othertime_shortcut'], 1, 0, 'C', $bg_flag);
                        
                        if (++$indx != count($emp['Fri'])){
                            $this->SetXY($start_x,$this->GetY()+$col_h);
                        }  else {
                            $this->SetXY($start_x+$w[5],$start_y);
                        }
                    }
                }else{
                    $this->Cell($w[5], $current_rh, '', 1, 0, 'L', FALSE);
                }
                
                
                //col sat
                $start_x = $this->GetX();
                $start_y = $this->GetY();
                $this->Cell($w[6], $current_rh, '', 1, 0, 'L', FALSE);
                $this->SetXY($start_x,$start_y);
                if(!empty($emp['Sat'])){
                    $indx = 0;
                    foreach($emp['Sat'] as $sat){
                        $man = explode(',', $sat);
                        if($man[2] == 1)
                            $bg_flag = FALSE;
                        else
                            $bg_flag = TRUE;
                        $this->Cell($w[6]-8, $col_h, utf8_decode($man[0]), 1, 0, 'L', $bg_flag);
                        
                        if($man[1] == 0)
                            $this->Cell(8, $col_h,$smarty->translate['working_shortcut'], 1, 0, 'C', $bg_flag);
                        if($man[1] == 1)
                            $this->Cell(8, $col_h, $smarty->translate['travel_shortcut'], 1, 0, 'C', $bg_flag);
                        if($man[1] == 2)
                            $this->Cell(8, $col_h, $smarty->translate['lunch_shortcut'],1, 0, 'C', $bg_flag);
                        if($man[1] == 3)
                           $this->Cell(8, $col_h,$smarty->translate['oncall_shortcut'], 1, 0, 'C', $bg_flag);
                        if($man[1] == 4)
                            $this->Cell(8, $col_h, $smarty->translate['overtime_shortcut'], 1, 0, 'C', $bg_flag);
                        if($man[1] == 5)
                            $this->Cell(8, $col_h, $smarty->translate['more_overtime_shortcut'], 1, 0, 'C', $bg_flag);
                        if($man[1] == 6)
                            $this->Cell(8, $col_h,$smarty->translate['quality_overtime_shortcut'], 1, 0, 'C', $bg_flag);
                        if($man[1] == 7)
                            $this->Cell(8, $col_h, $smarty->translate['some_othertime_shortcut'], 1, 0, 'C', $bg_flag);
                        
                        if (++$indx != count($emp['Sat'])){
                            $this->SetXY($start_x,$this->GetY()+$col_h);
                        }  else {
                            $this->SetXY($start_x+$w[6],$start_y);
                        }
                    }
                }else{
                    $this->Cell($w[6], $current_rh, '', 1, 0, 'L', FALSE);
                }
                
                
                //col Sun
                
                
                $this->Cell($w[8], $current_rh, utf8_decode($emp['sum']), 1, 0, 'C', FALSE);
                $this->Ln();
            }
            
            //display each col sum
            $this->SetX(18);
            $this->Cell($w[0], $col_h, utf8_decode('Summa'), 1, 0, 'L', FALSE);
            $this->Cell($w[7], $col_h, utf8_decode($this->rpt_sum[$i]['sun']), 1, 0, 'L', FALSE);
            $this->Cell($w[1], $col_h, utf8_decode($this->rpt_sum[$i]['mon']), 1, 0, 'L', FALSE);
            $this->Cell($w[2], $col_h, utf8_decode($this->rpt_sum[$i]['tue']), 1, 0, 'L', FALSE);
            $this->Cell($w[3], $col_h, utf8_decode($this->rpt_sum[$i]['wed']), 1, 0, 'L', FALSE);
            $this->Cell($w[4], $col_h, utf8_decode($this->rpt_sum[$i]['thu']), 1, 0, 'L', FALSE);
            $this->Cell($w[5], $col_h, utf8_decode($this->rpt_sum[$i]['fri']), 1, 0, 'L', FALSE);
            $this->Cell($w[6], $col_h, utf8_decode($this->rpt_sum[$i]['sat']), 1, 0, 'L', FALSE);
            
            $this->Cell($w[8], $col_h, '', 1, 0, 'L', FALSE);
            
            $i +=1;
            $this->Ln(15);
            
        }
    }


    

}

?>
