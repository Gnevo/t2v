<?php
// error_reporting(E_ALL);
//                         error_reporting(E_WARNING);
//                         ini_set('error_reporting', E_ALL);
//                         ini_set("display_errors", 1);
require_once('class/setup.php');
$smarty = new smartySetup(array("user.xml","messages.xml","button.xml","month.xml","reports.xml", "forms.xml"),FALSE);
//require_once('class/contract.php');
require_once('class/dona.php');
require_once('class/employee.php');
//require_once('class/user.php');
//require_once('plugins/message.class.php');
$employee= new employee();
$dona= new dona();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 8));
$employee_combo=$employee->employee_list_exact();
$smarty->assign('E_combo', $employee_combo);

//$period = $dona->get_least_and_most_timetable_dates();
if($_POST['action'] == "print" && $_POST['lstTidStart'] && $_POST['lstTidSlut']){
    // echo "<pre>".print_r($_POST, 1)."</pre>"; exit();
    $dona->employee_id              = $_POST['cmb_employee'];
    $dona->Certification_period_from= $_POST['lstTidStart'];
    $dona->Certification_period_to  = $_POST['lstTidSlut'];
    $dona->employment_period_from   = $_POST['txtAnstTidStart'];    //Uppgifter om anställning section
    $dona->employment_period_to     = $_POST['txtAnstTidSlut'];
    $dona->still_employed           = $_POST['chkFortfarandeAnstalld'];
    $dona->post_held                = $_POST['txtAnstBefatt'];
    $dona->leave_effective_from     = $_POST['txTjanstledigStart'];
    $dona->leave_effective_to       = $_POST['txTjanstledigSlut'];
    $dona->coverage_in              = $_POST['txtOmfattning'];
    $dona->open_ended               = $_POST['chkAnstallningsformTillsvidareanstallning'];            // Anställningsform section
    
    $dona->probationary_to          = ($_POST['chkAnstallningsformProvanstallning'] == 1 ? $_POST['txtAnstallningsformProvanstallningDatum'] : '');
    $dona->temporary_employement    = ($_POST['chkAnstallningsformTidsbegransad'] == 1 ? $_POST['txtAnstallningsformTidsbegransadDatum'] : '');
    $dona->Intermittent_employement = $_POST['chkAnstallningsformIntermittent'];
    $dona->Arbetstid_open_ended     = ($_POST['chkArbetstidHeltid'] == 1 ? $_POST['txtArbetstidHeltid'] : '');            // Arbetstid Section        
    $dona->parttime                 = $_POST['chkArbetstidDeltid'];            
    $dona->hours_per_week           = $_POST['txtArbetstidDeltid'];            
    $dona->full_time_position_in_perc=$_POST['txtArbetstidUtgorProcent'];            
    $dona->working_hours            = $_POST['chkArbetstidVarierande'];
    $dona->employed_by_agency       = $_POST['chkBemanningsforetag'];            // Särskilda upplysningar om anställningen
    $dona->employment_termination   = ($_POST['chkOpphortArbetsbrist'] == 1 ? $_POST['txtOpphortArbetsbrist'] : '');            // Uppgifter om anställning
    $dona->temporary_employment_closed = ($_POST['chkOpphortTidsbegransad'] == 1 ? $_POST['txtOpphortTidsbegransad'] : '');
    $dona->own_request              = $_POST['chkOpphortEgenBegaran'];
    $dona->other_reason             = ($_POST['chkOpphortAnnanOrsak'] == 1 ? $_POST['txtOpphortAnnanOrsak'] : '');     
    $dona->termination_compensation = $_POST['chkAvgangsvederlag'];            // Ersättning med anledning av anställningens upphörande
    $dona->future_work_offer        = $_POST['chkErbjudande'];            // Erbjudande om fortsatt arbete
    $dona->future_work_From         = $_POST['txtErbjudandeFrom'];            
    $dona->future_work_to           = $_POST['txtErbjudandeTom'];          
    $dona->to_further               = $_POST['txtErbjudandeTillsvidare']; 
    $dona->full_time_per_week       = ($_POST['chkErbjudandeHeltid'] == 1 ? $_POST['txtErbjudandeHeltidTimmar'] : '');   
    
    $dona->part_time_per_week       = ($_POST['chkErbjudandeDeltid'] == 1 ? $_POST['txtErbjudandeDeltidTimmar'] : '');     
    $dona->full_time_position_in_perc_Erbjudande =$_POST['txtErbjudandeDeltidProcent'];   
    $dona->variable_time            = $_POST['chkErbjudandeVarierande'];   
    $dona->employer_accepted        = $_POST['chkErbjudandeAccepterat'];   
    $dona->employer_accepted_date_when_no =$_POST['txtErbjudandeAccepteratDatum'];   
    
    $dona->salary_to_year           = $_POST['txtLonAr'];            // Uppgifter om lönen
    $dona->salary_type              = $_POST['salary_type'];            //eg:Månadslön   Veckolön   Daglön   Timlön
    $dona->amount_in_sek            = $_POST['txtLonKronor'];            
    $dona->hourly_rate_varied       = $_POST['chkTimlonOvertidMertid'];            
    $dona->overtime_state           = $_POST['txtLonOvertid'];            
    $dona->additional_hours         = $_POST['txtLonMertid'];            
    $dona->not_included_salary      = $_POST['chkLonOtover'];            
    $dona->Employed_with_uppehållslön= $_POST['chkAnstalldOppenhollslon'];            //Anställd med uppehållslön
    $dona->Set_earned_uppehållslön  = $_POST['chkAnstalldOppenhollslonIntjanad'];            
    $dona->Employed_with_ferielön   = $_POST['chkAnstallFerielon'];            
    $dona->no_of_beta_barn_holidays = $_POST['chkAnstallFerielonDagar']; 
    $dona->Set_earned_ferielön      = $_POST['chkAnstallFerielonKronor']; 
    $dona->other_information_1      = $_POST['txtOvrigt1'];
    $dona->other_information_2      = $_POST['txtOvrigt2'];
    $dona->oncall_kr_times          = isset($_POST['oncall_kr_time']) && is_array($_POST['oncall_kr_time']) ? $_POST['oncall_kr_time'] : array();
    $dona->ob_kr_times              = isset($_POST['ob_kr_time']) && is_array($_POST['ob_kr_time']) ? $_POST['ob_kr_time'] : array();
    $dona->timers                   = isset($_POST['timer']) && is_array($_POST['timer']) ? $_POST['timer'] : array();
    $dona->angearts                 = isset($_POST['angeart']) && is_array($_POST['angeart']) ? $_POST['angeart'] : array();
    $dona->work_hour                = isset($_POST['work_hour']) && is_array($_POST['work_hour']) ? $_POST['work_hour'] : array();
    $dona->leave_hours              = isset($_POST['leave_hours']) && is_array($_POST['leave_hours']) ? $_POST['leave_hours'] : array();
    $dona->filling_hours            = isset($_POST['filling_hours']) && is_array($_POST['filling_hours']) ? $_POST['filling_hours'] : array();
    $dona->over_time                = isset($_POST['over_time']) && is_array($_POST['over_time']) ? $_POST['over_time'] : array();
    
    $dona->Employment_certificate_pdf();
}
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);// assigning sort by
$smarty->display('employment_certification_pdf_form.tpl');
//$smarty->display('extends:layouts/dashboard.tpl|employment_certification_pdf_form.tpl');
?>