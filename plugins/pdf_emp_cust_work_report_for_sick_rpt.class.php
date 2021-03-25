<?php
/**
* Author: Shamsudheen <shamsu@arioninfotech.com>
* for: FKKN customer work report
*/

require_once('./plugins/F_pdf.class.php');
require_once('./plugins/fpdi/fpdi.php');

class PDF_work_rpt_from_sick extends FPDI {
    
    function __construct() {
        parent::__construct();
        $this->SetAuthor('Shamsudheen');
        $this->SetCreator('Shamsudheen');
        $this->SetTitle('Work Report');
        $this->SetAutoPageBreak(FALSE);
        
        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0, 50, 50);
    }

    function report_top($company_data, $month, $year) {
        $this->SetXY(0, 150);
        $this->Cell(12, 50, '', 0, 0, 'L', TRUE);    

        $this->SetFont('Times', 'B', 20);
        $this->SetXY(13, 20);
//        $this->Cell(29, 7, $year . ' - ' . sprintf("%02d",$month), 0, 0, 'L', FALSE);      // month and year figure
        $this->Cell(180, 7, utf8_decode($company_data['name']), 0, 0, 'L', FALSE);      // company name
        $this->SetXY(13, 20);
        $this->Cell(180, 7, utf8_decode('Arbetsrapport'), 0, 0, 'R', FALSE);
        
        $this->SetFont('Times', 'B', 12);
        $this->SetXY(163.5, 30);
        $this->Cell(29, 7, $year . ' - ' . sprintf("%02d",$month), 1, 0, 'C', FALSE);      // month and year figure
    }

    function SubPart1($cust_details) {
        $this->SetFont('Arial', 'B', 9);
        $this->SetXY(13, 42);
        $this->Cell(10, 9, utf8_decode($cust_details[0]['fullname']), 0, 0, 'L', FALSE);    //Customer full name
        $this->SetXY(148, $this->GetY());
        $this->Cell(10, 9, $cust_details[0]['century'] . $this->format_SSN($cust_details[0]['social_security']), 0, 0, 'L', FALSE);    // Personal number
    }

    function SubPart2($emp_details) {
        $this->SetFont('Arial', 'B', 9);
        $this->SetXY(13, 64);
        $this->Cell(10, 9, utf8_decode($emp_details[0]['fullname']), 0, 0, 'L', FALSE);    //Employee Full Name
        $this->SetXY(148, $this->GetY());
        $this->Cell(10, 9, $emp_details[0]['century'] . $this->format_SSN($emp_details[0]['social_security']), 0, 0, 'L', FALSE);    // personel number
        
        $post_city = $emp_details[0]['post'];
        if(trim($emp_details[0]['city']) != '')
            $post_city .= ' '.$emp_details[0]['city'];
        $this->SetXY(13, 73.5);
        $this->Cell(10, 9, utf8_decode($emp_details[0]['address']), 0, 0, 'L', FALSE);    //Address
        $this->SetXY(103, $this->GetY());
        $this->Cell(10, 9, utf8_decode($post_city), 0, 0, 'L', FALSE);    // Post & city
    }

    function SubPart3_table($work_details) {
        $w = array(7.6, 30, 17.5, 17.5, 17.5);
        $col_h = 6.72;
        $init_y = 125.6;
        $this->SetY($init_y);
        $this->SetFont('Arial', 'B', 9);
        $total_Tid = 0;
        $toal_Jourtid = 0;
        $total_content_rows = count($work_details);
        
        $normal_included_slot_types = array(0, 1, 2, 4, 5, 6, 7, 8, 10, 11, 12);
        $oncall_included_slot_types = array(3, 9, 13, 14);
        
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
                $this->Cell($w[1], $col_h, $work_details[$i]['time_from'] . '      ' . $work_details[$i]['time_to'], 0, 0, 'C', FALSE);   //table cell 2
                if (in_array($work_details[$i]['type'], $normal_included_slot_types)) {
                    $this->Cell($w[2], $col_h, sprintf('%.02f', round($total_time, 2)), 0, 0, 'C', FALSE);   //table cell 3
                    $total_Tid = $total_Tid + round($total_time, 2);
                }else
                    $this->Cell($w[2], $col_h, '', 0, 0, 'C', FALSE);   //table cell 3

                if (in_array($work_details[$i]['type'], $oncall_included_slot_types)) {
                    $this->Cell($w[3], $col_h, sprintf('%.02f', round($total_time, 2)), 0, 0, 'C', FALSE);   //table cell 4
                    $toal_Jourtid = $toal_Jourtid + round($total_time, 2);
                }else
                    $this->Cell($w[3], $col_h, '', 0, 0, 'C', FALSE);   //table cell 4

                $this->Cell($w[4], $col_h, '', 0, 0, 'C', FALSE);   //table cell 5
            }

            $this->SetY($this->GetY() + $col_h);

            if ($i == 15)
                $this->SetY($init_y);
        }
        
        $this->SetFont('Arial', 'B', 9);
        $this->SetXY(140.5, 227);
        $this->Cell($w[2], 11, sprintf('%.02f', round($total_Tid, 2)), 0, 0, 'C', FALSE);   //table summery cell
        $this->Cell($w[3], 11, sprintf('%.02f', round($toal_Jourtid, 2)), 0, 0, 'C', FALSE);   //table summery cell
        $this->Cell($w[4], 11, '--', 0, 0, 'C', FALSE);   //table summery cell
        
        
        $this->tot_normal += $total_Tid;
        $this->tot_oncall += $toal_Jourtid;
    }

    function SubPart4($emp_details, $sign_details = NULL) {
//        echo "<pre>".print_r($emp_details, 1)."</pre>";
        if (!empty($sign_details) && $sign_details[0]['signin_employee'] == $emp_details[0]['username']) {
            $this->SetFont('Arial', '', 10);
            $this->SetXY(13, 264);
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

    function HidePage2Contents() {
        
        //hide the page 2 contents
        $this->SetXY(5, 55);
        $this->Cell(210, 150, '', 0, 0, 'L', TRUE); 
    }
    
    function summery_report_top_2($cust_details) {
        $this->SetFont('Times', 'B', 10);
        $this->SetXY(148, 13);
        $this->Cell(25, 5, $cust_details[0]['century'] . $this->format_SSN($cust_details[0]['social_security']), 0, 0, 'L', FALSE);      // personal number
    }
    
    function Page2_footer($company_data) {
        $this->SetFont('Times', '', 12);
        $this->SetXY(12, 275);
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

    function SetCol($col) {
        // Set position at a given column
        $this->col = $col;
        $x = 10 + $col * 65;
        $this->SetLeftMargin($x);
        $this->SetX($x);
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