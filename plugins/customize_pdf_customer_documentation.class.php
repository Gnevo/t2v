<?php

require_once('./plugins/F_pdf.class.php');
require_once('./plugins/fpdi/fpdi.php');

class PDF_Customer_insurance extends FPDI {

    var $smarty;
    function __construct() {

        parent::__construct();
        $this->smarty = new smartySetup(array("reports.xml", "user.xml", "messages.xml", "button.xml","month.xml", "notes.xml","privilege.xml"), FALSE);
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
        $this->Cell(190, 6, utf8_decode($this->smarty->translate['documentation']), '', 1, 'C');
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

    function customer_documentation($data, $date, $employees, $created_by_name = NULL) {
        
//        echo "<pre>".print_r($data, 1)."</pre>";
        $this->SetFont('Arial', '', 9);
        $this->Cell(190, 4, utf8_decode($this->smarty->translate['date_self']), 'LTR', 1, 'L');
        $this->SetFont('Arial', 'B', 10);
//        $this->Cell(190, 4, utf8_decode($date), 'LBR', 1, 'L');
        $this->Cell(190, 4, utf8_decode($data[0]['created_date']), 'LBR', 1, 'L');

        $this->SetFont('Arial', '', 9);
        $this->Cell(95, 4, utf8_decode($this->smarty->translate['employed']), 'L', 0, 'L');
        $this->Cell(95, 4, utf8_decode(''), 'LR', 1, 'L');
        $this->SetFont('Arial', 'B', 10);
        $empname = '';
        foreach ($employees as $employee) {
            if ($data[0]['employee'] == $employee['username'])
                $empname = $employee['first_name'] . ' ' . $employee['last_name'];
        }
        $note_type_name = NULL;
        switch ($data[0]['note_type']){
            case 'dokumentation' : $note_type_name = $this->smarty->translate['documentation']; break;
            case 'protokoll' : $note_type_name = $this->smarty->translate['protocol']; break;
            case 'minnesanteckning' : $note_type_name = $this->smarty->translate['note_to_self']; break;
        }
        $this->Cell(95, 4, utf8_decode($empname), 'BL', 0, 'L');
        $this->Cell(95, 4, utf8_decode($note_type_name), 'LBR', 1, 'L');
        
        $this->SetFont('Arial', '', 9);
        $this->Cell(190, 4, utf8_decode($this->smarty->translate['subject']), 'LR', 1, 'L');

        $this->SetFont('Arial', 'B', 10);
//        $this->Cell(190, 4, utf8_decode($data[0]['subject']), 'BL', 1, 'L');
        $this->MultiCell(190, 4, utf8_decode($data[0]['subject']), 'LBR', 1, 'L');

        $this->SetFont('Arial', '', 9);
        $this->Cell(190, 4, utf8_decode($this->smarty->translate['note']), 'LR', 1, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->MultiCell(190, 4, utf8_decode(strip_tags($this->html_convert($data[0]['notes']))), 'LBR', 1, 'L');
        
//        echo $data[0]['notes'].'<br/><br/>--------<br/>';
//        echo $this->html_convert($data[0]['notes']);
//        echo utf8_decode(strip_tags(str_replace('<br>', "\n",$data[0]['notes'])));
//        $this->MultiCell(190, 4, $this->WriteHTML($data[0]['notes']), 'LBR', 1, 'L');
//        $this->MultiCell(190, 4, $this->WriteHTML(utf8_decode($data[0]['notes'])), 'LBR', 1, 'L');
//        $this->WriteHTML($data[0]['notes']);
//        echo "<pre>".print_r($data[0]['notes'], 1)."</pre>";
        $this->Ln(7);

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(190, 6, utf8_decode($this->smarty->translate['action_list']), 'LTBR', 1, 'L');

        $this->SetFont('Arial', '', 9);
        $this->Cell(70, 4, utf8_decode($this->smarty->translate['date_created']), 'L', 0, 'L');
        $this->Cell(65, 4, utf8_decode($this->smarty->translate['date_completed']), 'L', 0, 'L');
        $this->Cell(55, 4, utf8_decode(''), 'R', 1, 'L');

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(70, 4, utf8_decode($data[0]['created_date'] != '0000-00-00 00:00:00' ? $data[0]['created_date'] : ''), 'BL', 0, 'L');
        $this->Cell(65, 4, utf8_decode($data[0]['completed_date'] != '0000-00-00 00:00:00' ? $data[0]['completed_date'] : ''), 'BL', 0, 'L');
        $this->Cell(55, 4, utf8_decode(''), 'BR', 1, 'L');

        $this->SetFont('Arial', '', 9);
        $this->Cell(70, 4, utf8_decode($this->smarty->translate['priority']), 'L', 0, 'L');
        $this->Cell(65, 4, utf8_decode($this->smarty->translate['status']), 'L', 0, 'L');
        $this->Cell(55, 4, utf8_decode(''), 'R', 1, 'L');

        $priority_name = NULL;
        switch ($data[0]['priority']){
            case 'Låg' : $priority_name = $this->smarty->translate['low']; break;
            case 'Medel' : $priority_name = $this->smarty->translate['medium']; break;
            case 'Hög' : $priority_name = $this->smarty->translate['high']; break;
        }
        
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(70, 4, utf8_decode($priority_name), 'BL', 0, 'L');


        if ($data[0]['status'] == 'paborjad')
            $this->Cell(65, 4, utf8_decode($this->smarty->translate['begun']), 'BL', 0, 'L');
        else if ($data[0]['status'] == 'slutfort')
            $this->Cell(65, 4, utf8_decode($this->smarty->translate['completed']), 'BL', 0, 'L');
        else
            $this->Cell(65, 4, '', 'BL', 0, 'L');

        $this->Cell(55, 4, utf8_decode(''), 'BR', 1, 'L');

        $this->SetFont('Arial', '', 9);
        $this->Cell(190, 4, utf8_decode($this->smarty->translate['note']), 'LR', 1, 'L');
        $this->SetFont('Arial', 'B', 10);
//        $this->MultiCell(190, 4, utf8_decode($data[0]['description']), 'LBR', 1, 'L');
        $this->MultiCell(190, 4, utf8_decode(strip_tags($this->html_convert($data[0]['description']))), 'LBR', 1, 'L');
    }
    
    function footer(){
        global $preference;
        
//        $this->Ln(5);
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 9);
        $this->Cell(190, 4, utf8_decode($this->smarty->translate['printed_on'].': '.date('Y-m-d H:i:s')), 0, 0, 'L');
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

}
?>