<?php
require_once('./plugins/F_pdf.class.php');
require_once('./plugins/fpdi/fpdi.php');

class PDF_EMP_Contract extends FPDI     //FPDF
{
var $smarty = array();

function __construct() {

    parent::__construct();
    //$this->k=2;
    $this->smarty = new smartySetup(array("month.xml", "reports.xml", "gdschema.xml"),FALSE);
}

function P1_top($contract_details, $company_data){
    // var_dump($company_data);
    $this->SetFillColor(255,255,255);
    $this->SetTextColor(0,50,50);

    //remove default logo
    $this->SetXY(10, 5);
    $this->Cell(190,20, '', 0,0,'C', TRUE);  

    $this->SetXY(10, 5);
    $this->SetFont('Arial','B', 18);  
    $this->Cell(190,15, utf8_decode('ANSTÄLLNINGSAVTAL'), 0, 0,'C', FALSE);  
    $this->SetXY(10, 16);
    $this->SetFont('Arial','B', 13);
    $this->Cell(190,7, utf8_decode('Personliga assistenter'), 0, 0,'C', FALSE);  
    // $this->Image($this->smarty->url.'images/kfo-logo-400x400.png', 165, 1, 33, 30);   
    if($company_data['logo'] != ''){
        // $this->Image($this->smarty->url.'company_logo/'.$company_data['logo'], 10, 5, 70, 30);
        // $this->Image($this->smarty->url.'company_logo/'.$company_data['logo'], 10, 5, 50, 21.42);  
        $this->Image($this->smarty->url.'company_logo/'.$company_data['logo'], 10, 7, 40, 17.13);  
    }
        

    //ANSTÄLLNINGSAVTAL
    //Personliga assistenter
    //$this->SetLineWidth(.0001);
    
    $this->SetXY(140,  25.70);
    //$this->SetFont('Arial','B',13);
    //$this->Cell(10,9,  utf8_decode('Personliga assistenter'),0,0,'L',FALSE); 

    if($contract_details[0]['have_been_agreed'] == "1"){
       $x_ord=78.6;
       $this->Line($x_ord, $this->GetY()+2.4 , $x_ord+3, $this->GetY()+5.3);    //drew lines       //first check box ticked
       $this->Line($x_ord, $this->GetY()+5.3 , $x_ord+3, $this->GetY()+2.4);    //drew lines

    }
    else if($contract_details[0]['have_been_agreed'] == "2"){
    // else if($contract_details[0]['date_from'] != ""){
        $x_ord=111.6;
        $this->Line($x_ord, $this->GetY()+2.4 , $x_ord+3, $this->GetY()+5.3);    //drew lines       //second check box ticked
        $this->Line($x_ord, $this->GetY()+5.3 , $x_ord+3, $this->GetY()+2.4);    //drew lines
   
    }

    if($contract_details[0]['date_from'] != ''){
        
        $this->SetFont('Arial','',12);                           //first fill name
        $this->SetXY(177,  $this->GetY()+1.5);
        $this->Cell(22,5,$contract_details[0]['date_from'],0,0,'C',FALSE);  
    }
    
    // $this->Ln(5);
}

function P1_SubPartA($employee_det,$company_det){   

    //row 1
    $this->SetFont('Arial','',9);                                      //     Arbetsgivare (företag/förening)
    $this->SetXY(11, 42.20125);   
    $this->Cell(100,4,  utf8_decode($company_det['name']),0,0,'L',FALSE);
    

    $this->SetFont('Arial','',9);                                      //  Arbetsgivare (företag/förening)
    $this->SetXY(160, $this->GetY());   
    $this->Cell(30,4,$company_det['phone'],0,0,'L',FALSE);

    
    // row 2
    $this->SetFont('Arial','',9);                                      //      Adress
    $this->SetXY(11, $this->GetY()+8);   
    $this->Cell(70,4,utf8_decode($company_det['address']),0,0,'L',FALSE);
    
    $this->SetFont('Arial','',9);                                      //      Postnr
    $this->SetXY(100, $this->GetY());   
    $this->Cell(20,4,utf8_decode($company_det['zipcode']),0,0,'L',FALSE);
    
    $this->SetFont('Arial','',9);                                      //      Ort
    $this->SetXY(120, $this->GetY());   
    $this->Cell(20,4,utf8_decode($company_det['city']),0,0,'L',FALSE);

    $this->SetFont('Arial','',9);                                      //       Organisationsnummer
    $this->SetXY(160, $this->GetY());   
    if($company_det['org_no'] != '')
        $this->Cell(30,4,substr_replace($company_det['org_no'],'-',6,0),0,0,'L',FALSE);
    
    
    
                    // row 3
    $this->SetFont('Arial','',9);                                      //        Den anställdes efternamn
    $this->SetXY(11, $this->GetY()+8);   
    $this->Cell(70,4,utf8_decode($employee_det['last_name']),0,0,'L',FALSE);
    
    $this->SetFont('Arial','',9);                                      //      Förnamn
    $this->SetXY(100, $this->GetY());   
    $this->Cell(20,4,utf8_decode($employee_det['first_name']),0,0,'L',FALSE);

    $this->SetFont('Arial','',9);                                      //       Tfn (även riktnr)
    $this->SetXY(160, $this->GetY());   
    $this->Cell(30,4,utf8_decode($employee_det['phone']),0,0,'L',FALSE);
    
        
    
    
                    // row 4
    $this->SetFont('Arial','',9);                                      //      Adress
    $this->SetXY(11, $this->GetY()+8);   
    $this->Cell(70,4,utf8_decode($employee_det['address']),0,0,'L',FALSE);
    
    $this->SetFont('Arial','',9);                                      //      Postnr
    $this->SetXY(100, $this->GetY());   
    $this->Cell(20,4,utf8_decode($employee_det['post']),0,0,'L',FALSE);
    
    $this->SetFont('Arial','',9);                                      //      Ort
    $this->SetXY(120, $this->GetY());   
    $this->Cell(20,4,utf8_decode($employee_det['city']),0,0,'L',FALSE);

    $this->SetFont('Arial','',9);                                      //       Personnummer
    $this->SetXY(160, $this->GetY());   
    // echo '<pre>'.print_r($employee_det, 1).'</pre>';
    //$employee_det['century'].
    if($employee_det['social_security'] != '')
        $this->Cell(30,4,substr_replace($employee_det['social_security'],'-',6,0),0,0,'L',FALSE);
}

function P1_SubPartB($contract_details,$cust_details, $obj_smarty){

    $this->SetFont('Arial','',6);                                      //name
    $this->SetXY(63,  78);
    //$this->Cell(35,5,utf8_decode('B. Arbetsuppgifter/arbetsplats'),0,1,'L',true);   
    //$str='SMSDN';
//    $str=$contract_details[0]['customer_name'];
//    $this->Cell(5,5,$str,0,0,'L',FALSE);  
//    
//    
//    $this->SetFont('Arial','',9);                               //SSN         
//    $this->SetXY($this->GetX()+ $this->GetStringWidth($str), $this->GetY());
//    if($str)
//        $this->Cell(35,5,  utf8_decode($contract_details[0]['customer_social_secutrity']),0,1,'L',FALSE);
//    else
//        $this->Cell(35,5, '',0,1,'L',FALSE);$this->GetStringWidth($str)
    $xval = 0;
    $yval = 78;
    $newline = 0;
    if($cust_details){
        $count = count($cust_details);
        for($i=0;$i<$count;$i++){
            if($i==0){
                // $str=utf8_decode($cust_details[$i]['last_name'])." ".utf8_decode($cust_details[$i]['first_name'])."(".$cust_details[$i]['social_security'].")";
                $str_label = $str_value = NULL;
                if(trim($cust_details[$i]['code']) != ''){
                    $str_label=utf8_decode('Kund ID: ');
                    $str_value=utf8_decode($cust_details[$i]['code']);
                }
                else{
                    $str_label=utf8_decode('Kund ID saknas');
                }
                if(($this->GetX()+strlen($str)+3) > 193){
                    $this->Ln(2);
                    $yval = $this->GetY();
                    $newline = 1;
                }
            }
            else{
                // $str=utf8_decode($cust_details[$i]['last_name'])." ".utf8_decode($cust_details[$i]['first_name'])."(".$cust_details[$i]['social_security'].")"; 
                if(trim($cust_details[$i]['code']) != ''){
                    $str_label=utf8_decode('Kund ID: ');
                    $str_value=utf8_decode($cust_details[$i]['code']);
                }
                else{
                    $str_label=utf8_decode('Kund ID saknas');
                }
                $this->SetXY($xval,  $yval);
                if(($this->GetX()+strlen($str)+3) > 193){
                    $this->Ln(2);
                    $yval = $this->GetY();
                    $newline = 1;
                }
            }
            // if($count > 1 && $i != ($count-1))
            //   $str_label =  $str_label.",  ";
            $this->SetFont('Arial','B',6);             
            $this->Cell(10,5,trim($str_label),0,0,'L',FALSE); 
            $this->SetFont('Arial','',6);             
            $this->Cell(5,5,trim($str_value),0,0,'L',FALSE); 
            // $xval = $this->GetX()+strlen(trim($str))-2;
            
        }
    }else{
       $this->Cell(35,5, '',0,0,'L',FALSE); 
    }

    $this->SetXY(140, 79);
    $this->Cell(3.5, 3.5, '',1,0,'R',FALSE); 
    $this->SetXY(143.5, 78.5);
    $this->Cell(5,5, utf8_decode($obj_smarty->translate['other_customer']),0,0,'L',FALSE); 

    if($contract_details[0]['other_customer'] == 1){
        $this->SetXY(140, 76.9);
        $x_ord=140.2;
        $this->Line($x_ord, $this->GetY()+2.4 , $x_ord+3, $this->GetY()+5.3);    //drew lines       //För viss tid så länge assistent-uppdraget varar
        $this->Line($x_ord, $this->GetY()+5.3 , $x_ord+3, $this->GetY()+2.4);    //drew lines
    }

    // if($newline == 1)
    //     $this->SetY($this->GetY()+3.5);
    // else
    //     $this->SetY($this->GetY()+5.5);

    $this->SetY(83.5);

}

function P1_SubPartC($contract_details){

    $this->SetY($this->GetY()+14.6);
    
    if($contract_details[0]['assistanceChecked'] == '1') {
        $x_ord=12.3;
        $this->Line($x_ord, $this->GetY()+2.4 , $x_ord+3, $this->GetY()+5.3);    //drew lines       //För viss tid så länge assistent-uppdraget varar
        $this->Line($x_ord, $this->GetY()+5.3 , $x_ord+3, $this->GetY()+2.4);    //drew lines
    }
    
    $this->SetFont('Arial','',9);
    $this->SetXY(57,  $this->GetY()+4);
    $this->Cell(15,5,utf8_decode($contract_details[0]['tmp_long_assistance_from']),0,0,'C',FALSE);   //fr o m col 1
    
    $this->SetFont('Arial','',9);
    $this->SetXY(91,  $this->GetY());
    $this->Cell(17,5,utf8_decode($contract_details[0]['tmp_long_assistance_to']),0,0,'C',FALSE);   //eventuellt längst t o m col 1

    $this->SetY($this->GetY()-12.4);
    if($contract_details[0]['employmentType'] == "2" )
    {

        $x_ord=112.3;
        $this->Line($x_ord, $this->GetY()+2.4 , $x_ord+3, $this->GetY()+5.3);    //drew lines       //För särskilt avtalade tillfällen, s.k. Timanställning (se bilaga)
        $this->Line($x_ord, $this->GetY()+5.3 , $x_ord+3, $this->GetY()+2.4);    //drew lines
    }
    
    $this->SetY($this->GetY()+6);
    if($contract_details[0]['employmentType'] == "1" )
    {
        $x_ord=112.3;
        $this->Line($x_ord, $this->GetY()+2.4 , $x_ord+3, $this->GetY()+5.3);    //drew lines       //Provanställning
        $this->Line($x_ord, $this->GetY()+5.3 , $x_ord+3, $this->GetY()+2.4);    //drew lines
    }
    
    $this->SetFont('Arial','',9);
    $this->SetXY(151,  $this->GetY()+1);
    $this->Cell(19,4,$contract_details[0]['probationary_from'],0,0,'C',FALSE);   //fr o m   col2
    
    $this->SetFont('Arial','',9);
    $this->SetXY(180,  $this->GetY());
    $this->Cell(19,4,$contract_details[0]['probationary_to'],0,0,'C',FALSE);   //t o m   col2
    
    $this->SetY($this->GetY()+13);
    if($contract_details[0]['tmp_assistance_for'] != "")
    {
        $x_ord=12.3;
        $this->Line($x_ord, $this->GetY()+2.4 , $x_ord+3, $this->GetY()+5.3);    //drew lines       //Vikarie för:       check box
        $this->Line($x_ord, $this->GetY()+5.3 , $x_ord+3, $this->GetY()+2.4);    //drew lines
    }
    
    $this->SetFont('Arial','',9);
    $this->SetXY(34,  $this->GetY()+1);
    $this->Cell(73,4,  utf8_decode($contract_details[0]['tmp_assistance_for']),0,0,'C',FALSE);   //Vikarie för name
    
        
    $this->SetY($this->GetY()-2);
    if($contract_details[0]['open_ended_appointment'] == 1 )
    {
        $x_ord=112.3;
        $this->Line($x_ord, $this->GetY()+2.4 , $x_ord+3, $this->GetY()+5.3);    //drew lines    Tillsvidareanställning     col 2
        $this->Line($x_ord, $this->GetY()+5.3 , $x_ord+3, $this->GetY()+2.4);    //drew lines
    }
    
    $this->SetFont('Arial','',9);
    $this->SetXY(180,  $this->GetY()+1);
    $this->Cell(19,4,  utf8_decode($contract_details[0]['prevailing_collective']),0,0,'C',FALSE);   //Tillträdesdag
    
    $this->SetFont('Arial','',9);
    $this->SetXY(57,  $this->GetY()+5.5);
    $this->Cell(15,5,utf8_decode($contract_details[0]['absence_from']),0,0,'C',FALSE);   //under dennes frånvaro fr o m col 1
    
    $this->SetFont('Arial','',9);
    $this->SetXY(91,  $this->GetY());
    $this->Cell(17,5,utf8_decode($contract_details[0]['absence_to']),0,0,'C',FALSE);   //längst t o m col 1
}

function P1_SubPartD($contract_details)
{
                                    //row 1
    $this->SetY($this->GetY()+18.4);
    if($contract_details[0]['fulltime'] == 1 )
    {
        $x_ord=11.3;
        $this->Line($x_ord, $this->GetY()+2.4 , $x_ord+3, $this->GetY()+5.3);    //drew lines       Heltid 40 tim i genomsnitt per vecka
        $this->Line($x_ord, $this->GetY()+5.3 , $x_ord+3, $this->GetY()+2.4);    //drew lines
    }
    
    $time=array('','');
    $this->SetY($this->GetY()+0.5);
    if($contract_details[0]['part_time'] != "" )
    {
        $x_ord=69.3;
        $this->Line($x_ord, $this->GetY()+2.4 , $x_ord+3, $this->GetY()+5.3);    //drew lines       Deltid
        $this->Line($x_ord, $this->GetY()+5.3 , $x_ord+3, $this->GetY()+2.4);    //drew lines
        
        $time=  explode('.', $contract_details[0]['part_time']);
    }
    
    $this->SetFont('Arial','',9);
    $this->SetXY(86,  $this->GetY()+2);
    $this->Cell(8,4,$time[0],0,0,'C',FALSE);   //tim och
    
    $this->SetFont('Arial','',9);
    $this->SetXY(110,  $this->GetY());
    $this->Cell(8,4,$time[1],0,0,'C',FALSE);   //min i genomsnitt per  vecka
    
    
                    // row 2
        
    $this->SetFont('Arial','',9);
    $this->SetXY(52,  $this->GetY()+12);
    if($contract_details[0]['salary_month'] != "" && $contract_details[0]['salary_month'] > 0 ){
        // $contract_details[0]['salary_month'] = str_replace('.', ',', number_format($contract_details[0]['salary_month'],2));
        $contract_details[0]['salary_month'] = str_replace('.', ',', $contract_details[0]['salary_month']);
        $this->Cell(13,4, $contract_details[0]['salary_month'],0,0,'C',FALSE);   // kronor per månad
    }
        
    $this->SetFont('Arial','',9);
    $this->SetXY(94.3,  $this->GetY());
    if($contract_details[0]['salary_hour'] != "" && $contract_details[0]['salary_hour'] > 0 ){
        // $contract_details[0]['salary_hour'] = str_replace('.', ',', number_format($contract_details[0]['salary_hour'],2));
        $contract_details[0]['salary_hour'] = str_replace('.', ',', $contract_details[0]['salary_hour']);
        $this->Cell(13,4, $contract_details[0]['salary_hour'],0,0,'C',FALSE);   //  kronor per timme
    }

    $this->SetY($this->GetY()-1.9);
    if($contract_details[0]['incl_salary'] == 1 )
    {
        $x_ord=140.3;
        $this->Line($x_ord, $this->GetY()+2.4 , $x_ord+3, $this->GetY()+5.3);    //drew lines      inkl. sem.lön
        $this->Line($x_ord, $this->GetY()+5.3 , $x_ord+3, $this->GetY()+2.4);    //drew lines
    }
    
    $this->SetY($this->GetY());
    if($contract_details[0]['excl_salary'] == 1 )
    {
        $x_ord=171.3;
        $this->Line($x_ord, $this->GetY()+2.4 , $x_ord+3, $this->GetY()+5.3);    //drew lines      exkl. sem.lön
        $this->Line($x_ord, $this->GetY()+5.3 , $x_ord+3, $this->GetY()+2.4);    //drew lines
    }
    
    $this->SetY($this->GetY()+6);
    if($contract_details[0]['incl_wages'] == 1 )
    {
        $x_ord=52.3;
        $this->Line($x_ord, $this->GetY()+2.4 , $x_ord+3, $this->GetY()+5.3);    //drew lines      Lönen inkluderar
        $this->Line($x_ord, $this->GetY()+5.3 , $x_ord+3, $this->GetY()+2.4);    //drew lines
    }
   
    $this->SetFont('Arial','',9);
    $this->SetXY(81,  $this->GetY()+1.5);
    if($contract_details[0]['act_salary'] != "" && $contract_details[0]['act_salary'] != 0)
        $this->Cell(9.5,4,intval($contract_details[0]['act_salary']));   //  års lönerevision
}

function P1_SubPartE($contract_details)
{
        
    $this->SetFont('Arial','',9);
    $this->SetXY(77,  $this->GetY()+13);
    $this->Cell(8,4,$contract_details[0]['leave_per_year'],0,0,'C',FALSE);   //  Semester utges enligt lag och kollektivavtal med
    
    $this->SetY($this->GetY()+3);
    if($contract_details[0]['incl_holiday_pay'] == 1 )
    {
        $x_ord=11.3;
        $this->Line($x_ord, $this->GetY()+2.4 , $x_ord+3, $this->GetY()+5.3);    //drew lines      Semesterlön ingår i överenskommen timlön
        $this->Line($x_ord, $this->GetY()+5.3 , $x_ord+3, $this->GetY()+2.4);    //drew lines
    }
    
    $this->SetY($this->GetY()+5);
    if($contract_details[0]['excl_holiday_pay'] == 1 )
    {
        $x_ord=11.3;
        $this->Line($x_ord, $this->GetY()+2.4 , $x_ord+3, $this->GetY()+5.3);    //drew lines      Semesterlön ingår ej i överenskommen timlön
        $this->Line($x_ord, $this->GetY()+5.3 , $x_ord+3, $this->GetY()+2.4);    //drew lines
    }
}

function P1_SubPartF($contract_details)
{
    $compensations=array();
    
    if($contract_details && $contract_details[0]['incl_salary_compensation'] != "")        
    {
        $compensations = explode(',', $contract_details[0]['incl_salary_compensation']);
    }
    
    $this->SetY($this->GetY()+13.5);
    if(in_array(1, $compensations))
    {
        $x_ord=55.3;
        $this->Line($x_ord, $this->GetY()+2.4 , $x_ord+3, $this->GetY()+5.3);    //drew lines      övertid
        $this->Line($x_ord, $this->GetY()+5.3 , $x_ord+3, $this->GetY()+2.4);    //drew lines
    }
    
    $this->SetY($this->GetY());
    if(in_array(2, $compensations))
    {
        $x_ord=78.3;
        $this->Line($x_ord, $this->GetY()+2.4 , $x_ord+3, $this->GetY()+5.3);    //drew lines      restid
        $this->Line($x_ord, $this->GetY()+5.3 , $x_ord+3, $this->GetY()+2.4);    //drew lines
    }
    
    $this->SetY($this->GetY());
    if(in_array(3, $compensations))
    {
        $x_ord=95.3;
        $this->Line($x_ord, $this->GetY()+2.4 , $x_ord+3, $this->GetY()+5.3);    //drew lines      beredskap
        $this->Line($x_ord, $this->GetY()+5.3 , $x_ord+3, $this->GetY()+2.4);    //drew lines
    }
    
    $this->SetY($this->GetY());
    if(in_array(4, $compensations))
    {
        $x_ord=118.3;
        $this->Line($x_ord, $this->GetY()+2.4 , $x_ord+3, $this->GetY()+5.3);    //drew lines      ob
        $this->Line($x_ord, $this->GetY()+5.3 , $x_ord+3, $this->GetY()+2.4);    //drew lines
    }
    
    $this->SetY($this->GetY());
    if(in_array(5, $compensations))
    {
        $x_ord=131.3;
        $this->Line($x_ord, $this->GetY()+2.4 , $x_ord+3, $this->GetY()+5.3);    //drew lines     jour
        $this->Line($x_ord, $this->GetY()+5.3 , $x_ord+3, $this->GetY()+2.4);    //drew lines
    }
}

function P1_SubPartG($contract_details)
{
        
    $this->SetFont('Arial','',9);
    $this->SetXY(12,  $this->GetY()+16);
    $this->Cell(186,4,  utf8_decode($contract_details[0]['special_condition']),0,0,'L',FALSE);   //  input 1
        
    $this->SetFont('Arial','',9);
    $this->SetXY(12,  $this->GetY()+6);
    $this->Cell(186,4,utf8_decode($contract_details[0]['notes']),0,0,'L',FALSE);   //  input 2
    
}

function P1_SubPartH($contract_details,$employees)
{
        
    $this->SetFont('Arial','',9);
    $this->SetXY(22,  $this->GetY()+51);
    $this->Cell(30,4,utf8_decode($contract_details[0]['alloc_date']),0,0,'L',FALSE);   //  Ort
        
    $this->SetFont('Arial','',9);
    $this->SetXY(77,  $this->GetY());
    $this->Cell(20,4,'',0,0,'L',FALSE);   //  Datum
     
    //$employees = $this->get_employee_name($contract_details[0]['alloc_employee']);
    $this->SetFont('Arial','I',9);
    $this->SetXY(10,  $this->GetY()+11.5);
    $this->Cell(70,4,utf8_decode($employees),0,0,'L',FALSE);   //  Arbetsgivarens underskrift
    
}

function P1_SubPartI($contract_details,$employees, $company_details = array())
{
        
    $this->SetFont('Arial','',9);
    $this->SetXY(122,  $this->GetY()-12);
    $this->Cell(30,4,utf8_decode($contract_details[0]['sign_date']),0,0,'L',FALSE);   //  Ort
        
    $this->SetFont('Arial','',9);
    $this->SetXY(177,  $this->GetY());
    $this->Cell(20,4,'',0,0,'L',FALSE);   //  Datum
    
    //$employees = $this->get_employee_name($contract_details[0]['alloc_employee']);
    $this->SetFont('Arial','I',9);
    $this->SetXY(110,  $this->GetY()+12);
    $this->Cell(70,4,utf8_decode($employees),0,0,'L',FALSE);   //  Den anställdes underskrift
    
    
    $this->SetFont('Arial','I',6);
    // $this->SetX(130);
    // $this->Cell(70,4,'(Signerat via konto i Time2Veiw AB)',0,0,'L',FALSE);
    // $this->Cell(70,4,'(Signerat via ditt konto i Cirrus - "Fyrklöverns Assistans i Dalarna AB")',1,0,'R',FALSE);
    $this->SetXY(130,  268.5);
    $this->MultiCell(70, 4, utf8_decode('(Signerat via ditt konto i Cirrus - 
        "'.$company_details['name'].'")'), 0, 'R');
}

function P4_top()
{    
    
    
    $this->SetFont('Arial','',12);                           //Den anställdes efternamn
    $this->SetXY(10,  $this->GetY()+27);
    $this->Cell(22,5,utf8_decode('SMSDN'),0,0,'L',FALSE);     
    
    $this->SetFont('Arial','',12);                           //Förnamn
    $this->SetXY(105,  $this->GetY());
    $this->Cell(22,5,utf8_decode('SMSDN'),0,0,'L',FALSE);     
    
    $this->SetFont('Arial','',12);                           //Personnummer
    $this->SetXY(162,  $this->GetY());
    $this->Cell(22,5,utf8_decode('SMSDN'),0,0,'L',FALSE);     
    
    $this->Ln(13);
}

function P4_table_body()
{
    $w = array(41,20,25,22,20,62);
    $col_h = 10;
    $this->SetFont('Arial','B',6);
    

    for($i=0 ; $i<22 ; $i++)
    {
        $this->SetX(9);
        $this->Cell($w[0],$col_h,'-',0,0,'C',FALSE);   //table cell 1
        $this->Cell($w[1],$col_h,'-',0,0,'C',FALSE);   //table cell 2
        $this->Cell($w[2],$col_h,'-',0,0,'C',FALSE);   //table cell 3
        $this->Cell($w[3],$col_h,'-',0,0,'C',FALSE);   //table cell 4
        $this->Cell($w[4],$col_h,'-',0,0,'C',FALSE);   //table cell 5
        $this->Cell($w[5],$col_h,'-',0,0,'C',FALSE);   //table cell 6
      
        $this->SetY($this->GetY()+$col_h);
    }


}


}


?>
