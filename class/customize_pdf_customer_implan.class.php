<?php

require_once('./plugins/F_pdf.class.php');
require_once('./plugins/fpdi/fpdi.php');

class PDF_Customer_insurance extends FPDI {

    var $smarty;
    function __construct() {

        parent::__construct();
        $this->smarty = new smartySetup(array("reports.xml", "user.xml", "messages.xml", "button.xml","month.xml","privilege.xml"), FALSE);
    }

    function Header(){
        $this->AliasNbPages();
        $this->SetXY(10,1);
        $this->SetFont('Arial', '', 9);
        $this->Cell(195, 10, $this->PageNo() . ' ({nb})', 0, 0, 'R');
        $this->SetXY(10,15);
    }
    
    function report_header($company_details){
        global $preference;
        
        if($company_details['logo'] != ''){
            $this->Image($preference['url'].'company_logo/'.$company_details['logo'], 10, 10, 30);
        }
        
        $this->SetXY(10, 20);
        $this->SetFont('Arial', 'B', 24);
        $this->Cell(190, 6, utf8_decode($company_details['name']), 0, 1, 'R');
        $this->Ln(0.5);
        $this->SetFont('Arial', 'I', 9);
        $this->Cell(190, 6, utf8_decode($preference['app_version']), 0, 1, 'R');
            
        $this->SetXY(10, 40);
        $this->SetFont('Arial', 'B', 18);
        $this->Cell(190, 6, utf8_decode($this->smarty->translate['implementation_plan']), '', 1, 'C');
        $this->Ln(7);
    }
    
    function customer_personal_info($customer_details) {
        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0, 50, 50);

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(190, 6, utf8_decode($this->smarty->translate['personal_information']), 1, 1, 'L');

        $this->SetFont('Arial', '', 9);
        $this->Cell(60, 4, utf8_decode($this->smarty->translate['social_security']), 'L', 0, 'L');//Personnummer
        $this->Cell(65, 4, utf8_decode($this->smarty->translate['code']), 'L', 0, 'L');         //Anst.nr
        $this->Cell(65, 4, utf8_decode($this->smarty->translate['username']), 'LR', 1, 'L');    //Användarnamn

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(60, 4, utf8_decode($customer_details['social_security']), 'BL', 0, 'L');
        $this->Cell(65, 4, utf8_decode($customer_details['code']), 'BL', 0, 'L');
        $this->Cell(65, 4, utf8_decode($customer_details['username']), 'LBR', 1, 'L');

        $this->SetFont('Arial', '', 9);
        $this->Cell(60, 4, utf8_decode($this->smarty->translate['first_name']), 'L', 0, 'L');   //Förnamn
        $this->Cell(65, 4, utf8_decode($this->smarty->translate['last_name']), 'L', 0, 'L');    //Efternamn
        $this->Cell(65, 4, utf8_decode($this->smarty->translate['address']), 'LR', 1, 'L');     //Adress
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(60, 6, utf8_decode($customer_details['first_name']), 'LB', 0, 'L');
        $this->Cell(65, 6, utf8_decode($customer_details['last_name']), 'LB', 0, 'L');
        $this->Cell(65, 6, utf8_decode($customer_details['address']), 'LBR', 1, 'L');


        $this->SetFont('Arial', '', 9);
        $this->Cell(60, 6, utf8_decode($this->smarty->translate['city']), 'L', 0, 'L'); //Ort
        $this->Cell(65, 6, utf8_decode($this->smarty->translate['post']), 'L', 0, 'L'); //Postnr
        $this->Cell(65, 6, utf8_decode($this->smarty->translate['phone']), 'LR', 1, 'L');//Telefon
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(60, 6, utf8_decode($customer_details['city']), 'LB', 0, 'L');
        $this->Cell(65, 6, utf8_decode($customer_details['post']), 'LB', 0, 'L');
        $this->Cell(65, 6, utf8_decode($customer_details['phone']), 'LBR', 1, 'L');


        $this->SetFont('Arial', '', 9);
        $this->Cell(60, 6, utf8_decode($this->smarty->translate['mobile']), 'L', 0, 'L');   //Mobil
        $this->Cell(65, 6, utf8_decode($this->smarty->translate['email']), 'L', 0, 'L');    //E-post
        $this->Cell(65, 6, utf8_decode($this->smarty->translate['date']), 'LR', 1, 'L');    //Tillträdes dag
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(60, 6, utf8_decode($customer_details['mobile']), 'LB', 0, 'L');
        $this->Cell(65, 6, utf8_decode($customer_details['email']), 'LB', 0, 'L');
        $this->Cell(65, 6, utf8_decode($customer_details['date']), 'LBR', 1, 'L');
        $this->Ln(7);
    }

    function customer_implan($implementation, $dt, $created_by_name, $field_names,$new_implan_details) {

        $this->SetFont('Arial', '', 9);
        $this->Cell(190, 6, utf8_decode($this->smarty->translate['date_self']), 'LTR', 1, 'L');
        $this->SetFont('Arial', 'B', 10);
//        $this->MultiCell(190, 4, utf8_decode($dt), 'LRB', 1, 'L');
        $this->MultiCell(190, 4, utf8_decode($implementation['date']), 'LRB', 1, 'L');

        $this->SetFont('Arial', '', 9);
        $this->Cell(190, 6, utf8_decode($field_names['history']), 'LTR', 1, 'L');
        $this->SetFont('Arial', 'B', 10);
//        $this->MultiCell(190,4,utf8_decode($implementation['history']),'LRB',1,'L');
        $this->MultiCell(190, 4, utf8_decode(strip_tags($this->html_convert($implementation['history']))), 'LBR', 1, 'L');

        $this->SetFont('Arial', '', 9);
        $this->Cell(190, 6, utf8_decode($field_names['diagnosis']), 'LR', 1, 'L');
        $this->SetFont('Arial', 'B', 10);
//        $this->MultiCell(190,4,utf8_decode($implementation['diagnosis']),'LRB',1,'L');
        $this->MultiCell(190, 4, utf8_decode(strip_tags($this->html_convert($implementation['diagnosis']))), 'LBR', 1, 'L');

        $this->SetFont('Arial', '', 9);
        $this->Cell(190, 6, utf8_decode($this->$field_names['mission']), 'LR', 1, 'L');
        $this->SetFont('Arial', 'B', 10);
//        $this->MultiCell(190,4,utf8_decode($implementation['mission']),'LRB',1,'L'); 
        $this->MultiCell(190, 4, utf8_decode(strip_tags($this->html_convert($implementation['mission']))), 'LBR', 1, 'L');

        $this->SetFont('Arial', '', 9);
        $this->Cell(190, 6, utf8_decode($$field_names['email']), 'LR', 1, 'L');
        $this->SetFont('Arial', 'B', 10);
//        $this->MultiCell(190,4,utf8_decode($implementation['email']),'LRB',1,'L'); 
        $this->MultiCell(190, 4, utf8_decode(strip_tags($this->html_convert($implementation['email']))), 'LBR', 1, 'L');

        $this->SetFont('Arial', '', 9);
        $this->Cell(190, 6, utf8_decode($field_names['intervention']), 'LR', 1, 'L');
        $this->SetFont('Arial', 'B', 10);
//        $this->MultiCell(190,4,utf8_decode($implementation['intervention']),'LRB',1,'L'); 
        $this->MultiCell(190, 4, utf8_decode(strip_tags($this->html_convert($implementation['intervention']))), 'LBR', 1, 'L');

        $this->Ln(7);

        $work_array = array('School' => 'Skola', 'Hospital' => 'Sjukhus', 'Bank' => 'Bank');
        $this->SetFont('Arial', '', 9);
        $this->Cell(60, 6, utf8_decode($field_names['work']), 'LT', 0, 'L');
        $this->Cell(130, 6, utf8_decode($field_names['phone']), 'LTR', 1, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(60, 6, (isset($work_array[$implementation['work']]) ? (utf8_decode($work_array[$implementation['work']])) : ''), 'LB', 0, 'L');
        $this->Cell(130, 6, utf8_decode($implementation['phone']), 'LBR', 1, 'L');

        $this->SetFont('Arial', '', 9);
        $this->Cell(190, 6, utf8_decode($field_names['work_comment']), 'LR', 1, 'L');
        $this->SetFont('Arial', 'B', 10);
//        $this->MultiCell(190,4,utf8_decode($implementation['work_comment']),'LRB',1,'L'); 
        $this->MultiCell(190, 4, utf8_decode(strip_tags($this->html_convert($implementation['work_comment']))), 'LBR', 1, 'L');

        $this->Ln(7);

        $this->SetFont('Arial', '', 9);
        $this->Cell(190, 6, utf8_decode($field_names['travel']), 'LTR', 1, 'L');

        $this->SetFont('Arial', 'B', 10);
//        $this->Cell(60,6,utf8_decode(substr($travel,1)),'LB',0,'L');
        $travel_txt = '';
        $travel = $implementation['travel'];
        if (in_array("1", $travel)) {
            $travel_txt .= $this->smarty->translate[$this->smarty->travel_type[1]];
        }
        if (in_array("2", $travel)) {
            $travel_txt .= '   '.$this->smarty->translate[$this->smarty->travel_type[2]];
        }
        if (in_array("3", $travel)) {
            $travel_txt .= '   '.$this->smarty->translate[$this->smarty->travel_type[3]];
        }


        $this->Cell(190, 6, utf8_decode($travel_txt), 'LBR', 1, 'L');

        $this->SetFont('Arial', '', 9);
        $this->Cell(190, 6, utf8_decode($field_names['travel_comment']), 'LR', 1, 'L');
        $this->SetFont('Arial', 'B', 10);
//        $this->MultiCell(190,4,utf8_decode($implementation['travel_comment']),'LRB',1,'L'); 
        $this->MultiCell(190, 4, utf8_decode(strip_tags($this->html_convert($implementation['travel_comment']))), 'LBR', 1, 'L');
        $this->Ln(7);

        foreach ($new_implan_details as $key => $value) {
            
            $this->SetFont('Arial', '', 9);
            $this->Cell(190, 6, utf8_decode($value['name']), 'LTR', 1, 'L');
            $this->SetFont('Arial', 'B', 10);
    //        $this->MultiCell(190,4,utf8_decode($implementation['history']),'LRB',1,'L');
            $this->MultiCell(190, 4, utf8_decode(strip_tags($this->html_convert($value['description']))), 'LBR', 1, 'L');

        }




    }
    
    function footer(){
        global $preference;
        
//        $this->Ln(5);
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 9);
        $this->Cell(190, 4, utf8_decode($this->smarty->translate['printed_on'].': '.$this->timezone_set()), 0, 0, 'L');
        $this->setX(10);
        $this->Cell(190, 4, utf8_decode($this->smarty->translate['printed_by'].': '.$_SESSION['user_name']), 0, 1, 'R');
        $this->setX(10);
//        $this->Cell(190, 4, utf8_decode('time2view.se - Cirrus'), 0, 1, 'R');
        $this->Cell(190, 4, utf8_decode($preference['url']), 0, 1, 'R');
    }

    function html_convert($html){
        $converted = str_replace(array('<br>', '<br/>', '<br >', '<br />', '</p>', '</span>', '</li>', '</ul>', '</ol>', '</div>'), "\n", $html);
        $converted = str_replace('&nbsp;', " ", $converted);
        $converted = strip_tags($converted);
        return $converted;
    }

    function timezone_set(){
        $start_time = new DateTime;
        $start_time->setTimezone(new DateTimeZone('Europe/Stockholm'));
        $start_time->setTimestamp(time());
        $current_date_time = $start_time->format('Y-m-d G:i:s');
        return $current_date_time;
    }

}

?>