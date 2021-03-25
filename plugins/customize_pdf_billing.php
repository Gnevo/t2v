<?php

require_once('./plugins/F_pdf.class.php');
require_once('./plugins/fpdi/fpdi.php');
require_once('./class/setup.php');
require_once('./configs/config.inc.php');
class PDF_billing extends FPDI     { //FPDF

    var $bill_info = array();
    var $company_info = array();
    var $tot_amount = '';
    var $smarty = array();

    function __construct() {

        parent::__construct();
        $this->smarty = new smartySetup(array("messages.xml","month.xml","button.xml", "customer.xml", "billing.xml"),FALSE);
    }

    function page_header(){
        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0, 50, 50);

        $this->SetFont('Arial', 'B', 18);
        $this->SetXY(18, $this->GetY() + 5);
        $this->Cell(180, 5, utf8_decode('Faktura'), 0, 0, 'C', FALSE);

        $this->SetXY(18, $this->GetY() + 10);
        $this->SetFont('Arial', 'B', 13);
        $this->Cell(180, 5, utf8_decode('Faktura nummer: '.  $this->bill_info[0]['file_number']), 0, 0, 'R', FALSE);
    }
    
    function page_header_org(){
        global $company;
        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0, 50, 50);

        $this->Image($this->smarty->url.'images/t2v_billing_logo.png', 18, $this->GetY());
        
        $this->SetFont('Arial', 'B', 16);
        $this->SetXY(18, $this->GetY() + 20);
        $this->Cell(180, 5, utf8_decode($this->smarty->translate['time2ve']), 0, 1, 'C', FALSE);
        
        $this->SetFont('Arial', 'B', 15);
        $this->SetXY(18, $this->GetY() + 2);
        $this->Cell(180, 5, utf8_decode($this->smarty->translate['invoice']), 0, 1, 'C', FALSE);

        $this->SetXY(18, $this->GetY() + 10);
//        ---------------------------------------------------------
        $top_y = $this->GetY();
        $cols_distance = 30;
        $field_height = 6;
        $col1_label_width = 35;
        $col1_value_width = 35;
        $col1_start_x = 18;
        $col2_label_width = 35;
        $col2_value_width = 35;
        $col2_start_x = $col1_start_x +$col1_label_width+$col1_value_width+$cols_distance;
        
        //column 1 
        $this->SetFont('Arial', '', 10);
        $this->SetX($col1_start_x);
        $this->Cell($col1_label_width, $field_height, utf8_decode($this->smarty->translate['invoice_date']), 0, 0, 'L', FALSE);
        $this->Cell($col1_value_width, $field_height, ': '.$this->bill_info[0]['bill_date'], 0, 1, 'L', FALSE);
        
        $this->SetX($col1_start_x);
        $this->Cell($col1_label_width, $field_height, utf8_decode($this->smarty->translate['invoice_number']), 0, 0, 'L', FALSE);
        $this->Cell($col1_value_width, $field_height, ': '.  utf8_decode($this->bill_info[0]['file_number']), 0, 1, 'L', FALSE);
        
        $this->SetX($col1_start_x);
        $this->Cell($col1_label_width, $field_height, utf8_decode($this->smarty->translate['pay_day']), 0, 0, 'L', FALSE);
        $this->Cell($col1_value_width, $field_height, ': '. utf8_encode(date("Y-m-d", strtotime($this->bill_info[0]['bill_date'] . " +15 days")).' (15 '.$this->smarty->translate['days'].')'), 0, 1, 'L', FALSE);
        
        $this->SetX($col1_start_x);
        $this->Cell($col1_label_width, $field_height, utf8_decode($this->smarty->translate['interest']), 0, 0, 'L', FALSE);
        $this->Cell($col1_value_width, $field_height, ': 10%', 0, 1, 'L', FALSE);
        
        $this->SetX($col1_start_x);
        $this->Cell($col1_label_width, $field_height, utf8_decode($this->smarty->translate['reminder_fee']), 0, 0, 'L', FALSE);
        $this->Cell($col1_value_width, $field_height, ': '.utf8_decode('150 '.$this->smarty->translate['kr']), 0, 1, 'L', FALSE);
        
        $this->SetX($col1_start_x);
        $this->Cell($col1_label_width, $field_height, utf8_decode($this->smarty->translate['our_reference']), 0, 0, 'L', FALSE);
        $this->Cell($col1_value_width, $field_height, ': '.utf8_decode($company['contact_person1']), 0, 1, 'L', FALSE);
        
        $this->SetX($col1_start_x);
        $this->Cell($col1_label_width, $field_height, utf8_decode($this->smarty->translate['your_reference']), 0, 0, 'L', FALSE);
        $this->Cell($col1_value_width, $field_height, ': '.utf8_decode($this->company_info['contact_person2']), 0, 1, 'L', FALSE);
        
        $after_y = $this->GetY();
        
        //column 2
        $this->SetY($top_y);
        $this->SetX($col2_start_x);
        $this->Cell($col2_label_width, $field_height, utf8_decode($this->smarty->translate['company_name']), 0, 0, 'L', FALSE);
        $this->Cell($col2_value_width, $field_height, ': '.utf8_decode($this->company_info['name']), 0, 1, 'L', FALSE);

        $this->SetX($col2_start_x);
        $this->Cell($col2_label_width, $field_height, utf8_decode($this->smarty->translate['address']), 0, 0, 'L', FALSE);
        $this->Cell(2, $field_height, ': ', 0, 0, 'L', FALSE);
        $this->MultiCell($col2_value_width, $field_height, utf8_decode($this->company_info['address']), 0, 'L', FALSE);
        
        $this->SetX($col2_start_x);
        $this->Cell($col2_label_width, $field_height, utf8_decode($this->smarty->translate['city']), 0, 0, 'L', FALSE);
        $this->Cell($col2_value_width, $field_height, ': '.utf8_decode($this->company_info['city']), 0, 1, 'L', FALSE);

        $this->SetX($col2_start_x);
        $this->Cell($col2_label_width, $field_height, utf8_decode($this->smarty->translate['zip_code']), 0, 0, 'L', FALSE);
        $this->Cell($col2_value_width, $field_height, ': '.utf8_decode($this->company_info['zipcode']), 0, 1, 'L', FALSE);
        
        $current_y = ($after_y >  $this->GetY()) ? $after_y : $this->GetY();
        $this->SetY($current_y);
    }
    
    
    function P1_Part1() {

        global $month;
        $total_field_padding = "     ";

        $this->SetXY(18, $this->GetY() + 5);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 11, utf8_decode($this->smarty->translate['item']), 1, 0, 'C', FALSE);    //set border
        $this->Cell(20, 11, utf8_decode($this->smarty->translate['amount']), 1, 0, 'C', FALSE);    //set border
        $this->Cell(30, 11, utf8_decode($this->smarty->translate['period']), 1, 0, 'C', FALSE);    //set border
        $this->Cell(25, 11, utf8_decode($this->smarty->translate['price_unit']).$total_field_padding, 1, 0, 'R', FALSE);    //set border
        $this->Cell(30, 11, utf8_decode($this->smarty->translate['total']).$total_field_padding, 1, 1, 'R', FALSE);    //set border
        
        $bill_date = $this->bill_info[0]['bill_date'];
        $bill_month = $this->bill_info[0]['bill_month'];
//        echo $this->smarty->translate[$month[9]['month']];
//        echo date('m', strtotime($bill_date));
//        echo $this->smarty->translate[$month[date('m', strtotime($bill_date))]['month']];
        $format_bill_date = $this->smarty->translate[$month[$bill_month-1]['month']] . ' ' . date('Y', strtotime($bill_date));
        
        $this->SetX(18);
        $this->SetFont('Arial', '', 10);
        $this->Cell(75, 11, utf8_decode($this->smarty->translate['active_customer']), 1, 0, 'C', FALSE);    //set border
        $this->Cell(20, 11, $this->bill_info[0]['no_active_customers'], 1, 0, 'C', FALSE);    //set border
        $this->Cell(30, 11, utf8_decode($format_bill_date), 1, 0, 'C', FALSE);    //set border
        $this->Cell(25, 11, $this->bill_info[0]['price_per_customer'] . ' ' . $this->smarty->translate['skr'] .$total_field_padding, 1, 0, 'R', FALSE);    //set border
        $total_row_amount = $this->bill_info[0]['price_per_customer'] * $this->bill_info[0]['no_active_customers'];
        $this->Cell(30, 11, $total_row_amount. ' '. $this->smarty->translate['skr'] .$total_field_padding, 1, 1, 'R', FALSE);    //set border
        
        $this->SetX(18);
        $this->Cell(75, 11, utf8_decode($this->smarty->translate['no_sms']), 1, 0, 'C', FALSE);    //set border
        $this->Cell(20, 11, $this->bill_info[0]['no_sms'], 1, 0, 'C', FALSE);    //set border
        $this->Cell(30, 11, utf8_decode($format_bill_date), 1, 0, 'C', FALSE);    //set border
        $this->Cell(25, 11, $this->bill_info[0]['price_per_sms']. ' '. $this->smarty->translate['skr'] .$total_field_padding, 1, 0, 'R', FALSE);    //set border
        $total_row_amount = $this->bill_info[0]['no_sms'] * $this->bill_info[0]['price_per_sms'];
        $this->Cell(30, 11, $total_row_amount. ' '. $this->smarty->translate['skr'] .$total_field_padding, 1, 1, 'R', FALSE);    //set border

        $this->SetX(18);
        $this->Cell(75, 11, utf8_decode($this->smarty->translate['no_sign']), 1, 0, 'C', FALSE);    //set border
        $this->Cell(20, 11, $this->bill_info[0]['no_sign'], 1, 0, 'C', FALSE);    //set border
        $this->Cell(30, 11, utf8_decode($format_bill_date), 1, 0, 'C', FALSE);    //set border
        $this->Cell(25, 11, $this->bill_info[0]['price_per_sign']. ' '. $this->smarty->translate['skr'] .$total_field_padding, 1, 0, 'R', FALSE);    //set border
        $total_row_amount = $this->bill_info[0]['no_sign'] * $this->bill_info[0]['price_per_sign'];
        $this->Cell(30, 11, $total_row_amount. ' '. $this->smarty->translate['skr'] .$total_field_padding, 1, 1, 'R', FALSE);    //set border
        
        $this->tot_amount = $this->bill_info[0]['no_active_customers']*$this->bill_info[0]['price_per_customer'] + $this->bill_info[0]['no_sms']*$this->bill_info[0]['price_per_sms'] + $this->bill_info[0]['no_sign']*$this->bill_info[0]['price_per_sign'];
        $this->SetX(18);
        $this->Cell(140, 11, utf8_decode($this->smarty->translate['total']), 1, 0, 'C', FALSE);    //set border
        $this->Cell(40, 11, $this->tot_amount . ' '. $this->smarty->translate['skr'] .$total_field_padding, 1, 1, 'R', FALSE);    //set border

        $this->Ln(13);
    }

    function P1_Part2() {
        $total_field_padding = "     ";
        $quater_percentage = $this->tot_amount/4;
        $this->SetX(18);
        $this->Cell(140, 11, utf8_decode($this->smarty->translate['moms'].' 25%'), 1, 0, 'C', FALSE);    //set border
        $this->Cell(40, 11, $quater_percentage . ' '. $this->smarty->translate['skr'] .$total_field_padding, 1, 1, 'R', FALSE);    //set border
        
        $this->SetX(18);
        $this->Cell(140, 11, utf8_decode($this->smarty->translate['summa_att_betala']), 1, 0, 'C', FALSE);    //set border
        $this->Cell(40, 11, ($this->tot_amount + $quater_percentage) . ' '. $this->smarty->translate['skr'] .$total_field_padding, 1, 1, 'R', FALSE);    //set border

        $this->Ln(16);
    }

    function P1_Part3() {
        $this->Line(18, $this->GetY() , 198, $this->GetY());    //drew lines      //fortfarande anställd 
        $this->SetX(18);
        $this->Cell(140, 6, utf8_decode('Förfallodagen: '.$this->bill_info[0]['bill_date']), 0, 1, 'L', FALSE);    //set border
        $this->SetX(18);
        $this->Cell(40, 6, utf8_decode('Bankgiro 819-3054'), 0, 1, 'L', FALSE);    //set border
        $this->SetXY(18,  $this->GetY()+3);
        $this->Cell(140, 6, utf8_decode('Time2view regnr. 556872-7324'), 0, 1, 'L', FALSE);    //set border
        $this->SetX(18);
        $this->Cell(40, 6, utf8_decode('Moms och F-skatt finns'), 0, 1, 'L', FALSE);    //set border
        $this->Line(18, $this->GetY() , 198, $this->GetY());    //drew lines      //fortfarande anställd 
        $this->Ln(13);
    }

    function P1_Part3_org() {
        $top_y = $this->GetY();
        $line_height = 6;
        $this->SetX(18);
//        $this->Cell(45, 6, utf8_decode('Adress'), 0, 1, 'C', FALSE);    //set border
        $this->SetFont('Arial', 'B', 9);
        $this->MultiCell(40, $line_height, utf8_decode($this->smarty->translate['address']), 0, 'C', FALSE);
        $this->SetXY(18,$top_y+$line_height);
        $this->SetFont('Arial', '', 9);
        $this->MultiCell(40, $line_height, utf8_decode("Time2view AB\nEriksbergsvägen 10\n692 32 Kumla"), 0, 'C', FALSE);
        
        $this->SetXY(18+40,$top_y);
        $this->SetFont('Arial', 'B', 9);
        $this->MultiCell(45, $line_height, utf8_decode($this->smarty->translate['phone']), 0, 'C', FALSE);
        $this->SetXY(18+40,$top_y+$line_height);
        $this->SetFont('Arial', '', 9);
        $this->MultiCell(45, $line_height, utf8_decode("Support: 0764-210003\nInfo: 0704-434964"), 0, 'C', FALSE);
        
        $this->SetXY(18+85,$top_y);
        $this->SetFont('Arial', 'B', 9);
        $this->MultiCell(45, $line_height, utf8_decode($this->smarty->translate['email']), 0, 'C', FALSE);
        $this->SetXY(18+85,$top_y+$line_height);
        $this->SetFont('Arial', '', 9);
        $this->MultiCell(45, $line_height, utf8_decode("support@time2view.se\nInfo@time2view.se\nwww.time2view.se"), 0, 'C', FALSE);
        
        $this->SetXY(18+130,$top_y);
        $this->SetFont('Arial', '', 9);
        $this->MultiCell(50, $line_height, utf8_decode("\nOrg. Nummer: 556872-7324\nBankgiro: 819-3054\nMomsreg.nr SE556872732401"), 0, 'C', FALSE);
        $this->Ln(13);
    }
    
    function Footer() {
        //Position at 1.5 cm from bottom
        $this->SetY(-15);
        //Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        //Page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
    
    function utf8_special_decoding($string) { 
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * @for: correct swedish converting in pdf files, words like Seglarväge;
         */
        return utf8_decode(utf8_encode($string));
//        return utf8_decode($string);
    }

}

?>
