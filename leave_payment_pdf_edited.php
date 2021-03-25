<?php
// ini_set('display_errors', true);
// ini_set('xdebug.var_display_max_depth', 10);
// error_reporting(E_ALL ^ E_NOTICE);

require_once ('configs/config.inc.php');
require_once ('class/setup.php');
require_once ('class/dona.php');
require_once ('class/employee.php');
require_once ('class/equipment.php');
require_once ('class/customer.php');
require_once ('class/newcustomer.php');
require_once ('class/inconvenient.php');
require_once ('class/company.php');
require_once ('class/general.php');
require_once ('class/converter.php');
require_once ('plugins/customize_pdf_financial_payment.class.php');
require_once ('plugins/pdf_emp_cust_work_report_for_sick_rpt.class.php');
require_once ('plugins/pdf_sick_details_report.class.php');
require_once ('plugins/pdf_leave_annex.class.php');
require_once ('plugins/pdf_work_and_sick_details_report.class.php');
require_once ('plugins/pdf_leave_payment_edited.class.php');
$smarty = new smartySetup(array( "gdschema.xml", "user.xml", "messages.xml", "button.xml","month.xml", "forms.xml"),FALSE);
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 8));
$dona            = new dona();
$obj_newcustomer = new newcustomer();
$employee        = new employee();
$equipment       = new equipment();
$obj_customer    = new customer();
$obj_company     = new company();
$obj_general     = new general();
global $customer_kollektivavtal_labels;

//Soc. values dippend on date of birth
define('BELOW_25', '31.42');    //15.49//15.21
define('BTWN_25_65', '31.42');
define('ABOVE_65', '16.36');    //15.49//15.21

//payment amounts  (Ord lön kr/tim assistent section)
define('SICK_PAY', '267.00');     //Kr/tim
define('COMPENSATION_PAID', '99.888-963-321');

$years_combo= $dona->distinct_timetable_years(TRUE);
// $years_combo = $dona->get_distint_leave_years_from_timetable();
$smarty->assign('years_combo',$years_combo);
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);// assigning sort by
$smarty->assign('flag_cust_access', 1);

$selected_all_employees = FALSE;
$selected_all_customers = FALSE;
if(isset($_POST['employee']) && $_POST['employee'] == 'ALL'){
    $_POST['employee'] = NULL;
    $selected_all_employees = TRUE;
}
if(isset($_POST['customer']) && $_POST['customer'] == 'ALL'){
    $_POST['customer'] = NULL;
    $selected_all_customers = TRUE;
}

if($_POST['action'] == "print" && $_POST['year'] && $_POST['month']/* && $_POST['customer'] && $_POST['employee']*/){
	
    if(isset($_POST['customer']) && trim($_POST['customer']) != '' && trim($_POST['customer']) != 'ALL'){

        if(!$selected_all_employees && $_POST['employee'] != ''){
            $emp_detail     = $employee->get_employee_incov_detail($_POST["employee"]);
            $GlobalSetting  = $obj_newcustomer->GetGlobalSetting();
            
            $col_6_txts = array();
            for($i=0 ; $i< $_POST['tot_rows'] ; $i++)
                $col_6_txts[] = $_POST['time_'.$i];
            $dona->Hourly_times         = $col_6_txts;
            $dona->leavePeriod_month    = $_POST['month'];
            $dona->leavePeriod_year     = $_POST['year'];
            $dona->leave_customer       = $_POST['customer'];
            $dona->leave_employee       = $_POST['employee'];
            $dona->assignment           = trim($_POST['txtUppdrag']);    //Uppgifter om anställning section
            
            $dona->proxies      = $_POST['chkFullmaktBifogas'];
            $dona->submission   = $_POST['chkFullmaktTidigareInsant'];
            
            $dona->comp_paid_to_account = $_POST['txtErsattningBetalasTillKonto'];
            $dona->reference            = isset($_POST['txtReferensnummer']) && !empty($_POST['txtReferensnummer']) ? $_POST['txtReferensnummer'] : array();
            $dona->collective           = $_POST['txtKollektivavtal'];
            
            $dona->sick_leave_reg   = $_POST['chkBifogas1'];
            $dona->copy_of_payroll  = $_POST['chkBifogas2'];
            $dona->time_sheet_h_service = $_POST['chkBifogas3'];            
            $dona->additional_cost  = $_POST['chkBifogas4'];
            
            $dona->words_pay        = $_POST['txtAssistentOrdLon'];            
            $dona->kr_h             = $_POST['txtTotalKostnadPerTim'];            
            $dona->insurance_word_person    = $_POST['txtForsakring_Ord'];            
            $dona->insurance_substitute     = $_POST['txtForsakring_Vikarie'];           
            $dona->SS_contibution   = $_POST['txtSocialaAvgifter_Ord'];  
            $dona->soc_replace_emp  = $_POST['soc'];  
            
            $dona->inconvinient_week_holiday= $GlobalSetting[0]["inconvinient_week_holiday"];
            $dona->on_call                  = $emp_detail['on_call']!='' && $emp_detail['on_call']!='0.00' ? $emp_detail['on_call'] : $GlobalSetting[0]['on_call'];
            $dona->oncall_holiday           = $emp_detail['on_call_holiday']!='' && $emp_detail['on_call_holiday']!='0.00' ? $emp_detail['on_call_holiday'] : $dona->oncall_holiday = $GlobalSetting[0]['on_call_holiday'];
            $dona->oncall_bigholiday        = $emp_detail['on_call_bigholiday']!='' && $emp_detail['on_call_bigholiday']!='0.00' ? $emp_detail['on_call_bigholiday'] : $dona->oncall_bigholiday = $GlobalSetting[0]['on_call_bigholiday'];
            $dona->inconvinient_evening     = $emp_detail['inconvinient_evening']!='' && $emp_detail['inconvinient_evening']!='0.00' ? $emp_detail['inconvinient_evening'] : $dona->inconvinient_evening = $GlobalSetting[0]['inconvinient_evening'];
            $dona->inconvinient_night       = $emp_detail['inconvinient_night']!='' && $emp_detail['inconvinient_night']!='0.00' ? $emp_detail['inconvinient_night'] : $GlobalSetting[0]['inconvinient_night'];
            $dona->inconvinient_holiday     = $emp_detail['inconvinient_holiday']!='' && $emp_detail['inconvinient_holiday']!='0.00' ? $emp_detail['inconvinient_holiday'] : $GlobalSetting[0]['inconvinient_holiday'];

            //save form defaults
            $check_box_values = $fullmakt = array();
            $check_box_values['value1'] = (isset($_POST['chkBifogas1']) && trim($_POST['chkBifogas1']) == 1 ? 1 : 0);
            $check_box_values['value2'] = (isset($_POST['chkBifogas2']) && trim($_POST['chkBifogas2']) == 1 ? 1 : 0);
            $check_box_values['value3'] = (isset($_POST['chkBifogas3']) && trim($_POST['chkBifogas3']) == 1 ? 1 : 0);
            $check_box_values['value4'] = (isset($_POST['chkBifogas4']) && trim($_POST['chkBifogas4']) == 1 ? 1 : 0);
            
            $fullmakt['value1'] = (isset($_POST['chkFullmaktBifogas']) && trim($_POST['chkFullmaktBifogas']) == 1 ? 1 : 0);
            $fullmakt['value2'] = (isset($_POST['chkFullmaktTidigareInsant']) && trim($_POST['chkFullmaktTidigareInsant']) == 1 ? 1 : 0);
            
            $ref_number_to_be_save = empty($dona->reference) ? NULL : $dona->reference[0];
            $obj_customer->save_sick_form_defaults($dona->leave_customer, $dona->assignment, $fullmakt, $ref_number_to_be_save, $check_box_values);
            
            $dona->Financial_payment_pdf();
            exit();
        }
        else{
            //check multiple employees available
            $all_employee_details = $equipment->employees_leave_under_customer($_POST['month'], $_POST['year'], $_POST['customer']); 
            if(count($all_employee_details) > 0){

                //get sick form defaults
                $sick_form_defaults = $obj_customer->get_sick_form_defaults($_POST['customer']);
                if(!empty($sick_form_defaults)){
                    $sick_form_defaults = $sick_form_defaults[0];
                    $check_box_values   = explode('||', $sick_form_defaults['check_values']);
                    $fullmakt_values    = explode('||', $sick_form_defaults['fullmakt']);
                    $sick_form_defaults['checkbox_values'] = array('chkBifogas1' => $check_box_values[0], 'chkBifogas2' => $check_box_values[1], 'chkBifogas3' => $check_box_values[2], 'chkBifogas4' => $check_box_values[3]);
                    $sick_form_defaults['fullmakt_values'] = array('fullmakt1' => $fullmakt_values[0], 'fullmakt2' => $fullmakt_values[1]);
                }

                $company_details        = $obj_company->get_company_detail($_SESSION['company_id']);
                $customer_details       = $obj_customer->customer_detail($_POST['customer']);
                $customer_gardian_details = $obj_customer->customer_guardian($_POST['customer']);
                $form_reference_number  = $form_reference_number_base = $customer_details['code']. ' : ';
                $GlobalSetting          = $obj_newcustomer->GetGlobalSetting();

                $pdf = new PDF_Fin_Payment();
                $inconvenient_process_obj = new inconvenient();
                $obj_convertor = new Converter(array(),array(), $_POST['year']);
                
                $dona->leavePeriod_month    = $_POST['month'];
                $dona->leavePeriod_year     = $_POST['year'];
                $dona->leave_customer       = $_POST['customer'];

                foreach($all_employee_details as $tmp_emp_details){

                    $dona->leave_employee       = $tmp_emp_details['employee_id'];

                    $fkkn_form_defaults = $dona->check_exists_fkkn_form_defaults($_POST['customer'], $tmp_emp_details['employee_id'], TRUE);
                    $this_customer_Kollectival_name = '';
                    if(!empty($fkkn_form_defaults)){
                        $this_customer_Kollectival_id = $fkkn_form_defaults[0]['bargaining'];
                        if($this_customer_Kollectival_id == 6)  //other collectival
                            $this_customer_Kollectival_name = $fkkn_form_defaults[0]['other_bargaining_text'];
                        else    //get it from config by using kollectival id
                            $this_customer_Kollectival_name = $customer_kollektivavtal_labels[$this_customer_Kollectival_id];
                    }

                    // $all_leave_works = $dona->get_employee_leaved_timetable_works($tmp_emp_details['employee_id'], $_POST['year'], $_POST['month'], $_POST['customer']);
                    $all_leave_works        = $dona->get_employee_leaved_timetable_works($tmp_emp_details['employee_id'], $_POST['year'], $_POST['month']);

                    $all_leave_works_grouped= $obj_general->grouping_array_by_attribute($all_leave_works, 'date');
                    //exit();
                    $karense_dataset        = $obj_convertor->get_karens_data($tmp_emp_details['employee_id'], null, $all_leave_works_grouped, $date_type='YEAR_MONTH', $_POST['month'], $_POST['year'], null, 0.00, 24.00, FALSE,'FROM_FORM');
                    if($karense_dataset) $karense_dataset = array_values($karense_dataset);

                    $Q_work_dates = array();
                    if($karense_dataset){
                        foreach ($karense_dataset as $karense_data){
                            if(isset($karense_data['karens']) && !empty($karense_data['karens']))
                                $Q_work_dates[] = key($karense_data['karens']); //get first key name from the array
                        }
                    }
                    // foreach ($qualifying_leave_works as $Qworks)
                    //     $Q_work_dates[] = $Qworks['date'];
                    if (!empty($Q_work_dates))
                        $form_reference_number .= date('m-d', strtotime($Q_work_dates[0]));
                    

                    $reference_numbers_set = array();
                    $reference_numbers_ref_set = array();
                    if(!empty($all_leave_works) && !empty($Q_work_dates)){
                        if($Q_work_dates[0] != $all_leave_works[0]['date']){
                            $reference_numbers_set[] = array('date' => '', 'ref' => $form_reference_number_base);
                            $reference_numbers_ref_set[] = $form_reference_number_base;
                        }
                        
                        foreach($Q_work_dates as $qd){
                            $reference_numbers_set[] = array('date' => $qd, 'ref' => $form_reference_number_base . date('m-d', strtotime($qd)));
                            $reference_numbers_ref_set[] = $form_reference_number_base . date('m-d', strtotime($qd));
                        }
                    } else {
                        $reference_numbers_set[] = array('date' => '', 'ref' => $form_reference_number_base);
                        $reference_numbers_ref_set[] = $form_reference_number_base;
                    }
                    
                    $day = $_POST['year'].'-'.$_POST['month'].'-01';
                    $nomal_salary = $inconvenient_process_obj->get_salary($day, $tmp_emp_details['employee_id'], 'normal');
                    $insurance = $inconvenient_process_obj->get_salary($day, $tmp_emp_details['employee_id'], 'insurance');
                    
                    $emp_detail = $employee->get_employee_incov_detail($tmp_emp_details['employee_id']);
                    $sel_employee_age = $dona->attach_employee_age(array(array('employee_id' => $tmp_emp_details['employee_id'])));
                    $sel_employees_age = $sel_employee_age[0]['age'];

                    $dona->Hourly_times = array();
                    // $dona->leave_employee       = $tmp_emp_details['employee_id'];
                    $dona->assignment           = trim($sick_form_defaults['uppdrag']); //trim($_POST['txtUppdrag']);    //Uppgifter om anställning section
                    
                    $dona->proxies              = $sick_form_defaults['fullmakt_values']['fullmakt1'] == 1 ? 1 : 0 ; //$_POST['chkFullmaktBifogas'];
                    $dona->submission           = $sick_form_defaults['fullmakt_values']['fullmakt2'] == 1 ? 1 : 0 ; //$_POST['chkFullmaktTidigareInsant'];
                    
                    $dona->comp_paid_to_account = $company_details['bank_account']; //$_POST['txtErsattningBetalasTillKonto'];
                    $dona->reference            = !empty($reference_numbers_ref_set) ? $reference_numbers_ref_set : array();
                    $dona->collective           = $this_customer_Kollectival_name; //$_POST['txtKollektivavtal'];
                    
                    $dona->sick_leave_reg       = $sick_form_defaults['checkbox_values']['chkBifogas1'] == 1 ? 1 : 0 ; //$_POST['chkBifogas1'];
                    $dona->copy_of_payroll      = $sick_form_defaults['checkbox_values']['chkBifogas2'] == 1 ? 1 : 0 ; //$_POST['chkBifogas2'];
                    $dona->time_sheet_h_service = $sick_form_defaults['checkbox_values']['chkBifogas3'] == 1 ? 1 : 0 ; //$_POST['chkBifogas3'];            
                    $dona->additional_cost      = $sick_form_defaults['checkbox_values']['chkBifogas4'] == 1 ? 1 : 0 ; //$_POST['chkBifogas4'];
                    
                    $dona->words_pay            = $nomal_salary; //$_POST['txtAssistentOrdLon'];            
                    $dona->kr_h                 = $company_details['fk_kr_per_time']; //$_POST['txtTotalKostnadPerTim'];            
                    $dona->insurance_word_person= $insurance; //$_POST['txtForsakring_Ord'];            
                    $dona->insurance_substitute = ''; //$_POST['txtForsakring_Vikarie'];           
                    $dona->SS_contibution       = ''; //$_POST['txtSocialaAvgifter_Ord'];  
                    if($sel_employees_age < 25) $dona->SS_contibution = BELOW_25;
                    else if($sel_employees_age < 65)  $dona->SS_contibution = BTWN_25_65;
                    else if($sel_employees_age >= 65) $dona->SS_contibution = ABOVE_65; 
                    $dona->soc_replace_emp      = ''; //$_POST['soc'];

                    $dona->inconvinient_week_holiday= $GlobalSetting[0]["inconvinient_week_holiday"];
                    $dona->on_call                  = ($emp_detail['on_call']!='' && $emp_detail['on_call']!='0.00' ?  $emp_detail['on_call'] : $GlobalSetting[0]["on_call"]);
                    $dona->oncall_holiday           = ($emp_detail['on_call_holiday']!='' && $emp_detail['on_call_holiday']!='0.00' ? $emp_detail['on_call_holiday'] : $GlobalSetting[0]["on_call_holiday"]);
                    $dona->oncall_bigholiday        = ($emp_detail['on_call_bigholiday']!='' && $emp_detail['on_call_bigholiday']!='0.00' ? $emp_detail['on_call_bigholiday'] : $GlobalSetting[0]["on_call_bigholiday"]);
                    $dona->inconvinient_evening     = ($emp_detail['inconvinient_evening']!='' && $emp_detail['inconvinient_evening']!='0.00' ? $emp_detail['inconvinient_evening'] : $GlobalSetting[0]["inconvinient_evening"]);
                    $dona->inconvinient_night       = ($emp_detail['inconvinient_night']!='' && $emp_detail['inconvinient_night']!='0.00' ? $emp_detail['inconvinient_night'] : $GlobalSetting[0]["inconvinient_night"]);
                    $dona->inconvinient_holiday     = ($emp_detail['inconvinient_holiday']!='' && $emp_detail['inconvinient_holiday']!='0.00' ? $emp_detail['inconvinient_holiday'] : $GlobalSetting[0]["inconvinient_holiday"]);
                    
                    //generate PDF
                    $pdf = $dona->Financial_payment_pdf($company_details, $customer_details, $customer_gardian_details, $pdf, FALSE);
                }

                $pdf->Output(utf8_decode('sjukfaktura').'_'.$dona->leave_customer.'_'.date('Ymd').'.pdf', 'I');
                exit();
            }
        }
    }
    else if($selected_all_customers){
        //check multiple customers available
        $all_customer_details = $equipment->customers_under_leave_employee($_POST['month'], $_POST['year']);
        if(count($all_customer_details) > 0){

            $company_details = $obj_company->get_company_detail($_SESSION['company_id']);
            $GlobalSetting = $obj_newcustomer->GetGlobalSetting();

            $pdf = new PDF_Fin_Payment();
            $inconvenient_process_obj = new inconvenient();
            $obj_convertor = new Converter(array(),array(), $_POST['year']);

            foreach($all_customer_details as $tmp_cust_details){
                //$tmp_cust_details['customer_id']

                //check multiple employees available
                $all_employee_details = $equipment->employees_leave_under_customer($_POST['month'], $_POST['year'], $tmp_cust_details['customer_id']); 
                if(count($all_employee_details) > 0){

                    //get sick form defaults
                    $sick_form_defaults = $obj_customer->get_sick_form_defaults($tmp_cust_details['customer_id']);
                    if(!empty($sick_form_defaults)){
                        $sick_form_defaults = $sick_form_defaults[0];
                        $check_box_values = explode('||', $sick_form_defaults['check_values']);
                        $fullmakt_values = explode('||', $sick_form_defaults['fullmakt']);
                        $sick_form_defaults['checkbox_values'] = array('chkBifogas1' => $check_box_values[0], 'chkBifogas2' => $check_box_values[1], 'chkBifogas3' => $check_box_values[2], 'chkBifogas4' => $check_box_values[3]);
                        $sick_form_defaults['fullmakt_values'] = array('fullmakt1' => $fullmakt_values[0], 'fullmakt2' => $fullmakt_values[1]);
                    }

                    $customer_details = $obj_customer->customer_detail($tmp_cust_details['customer_id']);
                    $customer_gardian_details = $obj_customer->customer_guardian($tmp_cust_details['customer_id']);
                    $form_reference_number = $form_reference_number_base = $customer_details['code']. ' : ';

                    
                    $dona->leavePeriod_month    = $_POST['month'];
                    $dona->leavePeriod_year     = $_POST['year'];
                    $dona->leave_customer       = $tmp_cust_details['customer_id'];

                    foreach($all_employee_details as $tmp_emp_details){

                        $dona->leave_employee       = $tmp_emp_details['employee_id'];

                        $fkkn_form_defaults = $dona->check_exists_fkkn_form_defaults($tmp_cust_details['customer_id'], $tmp_emp_details['employee_id'], TRUE);
                        $this_customer_Kollectival_name = '';
                        if(!empty($fkkn_form_defaults)){
                            $this_customer_Kollectival_id = $fkkn_form_defaults[0]['bargaining'];
                            if($this_customer_Kollectival_id == 6)  //other collectival
                                $this_customer_Kollectival_name = $fkkn_form_defaults[0]['other_bargaining_text'];
                            else    //get it from config by using kollectival id
                                $this_customer_Kollectival_name = $customer_kollektivavtal_labels[$this_customer_Kollectival_id];
                        }

                        // $all_leave_works = $dona->get_employee_leaved_timetable_works($tmp_emp_details['employee_id'], $_POST['year'], $_POST['month'], $tmp_cust_details['customer_id']);
                        $all_leave_works = $dona->get_employee_leaved_timetable_works($tmp_emp_details['employee_id'], $_POST['year'], $_POST['month']);
                        $all_leave_works_grouped = $obj_general->grouping_array_by_attribute($all_leave_works, 'date');
                        $karense_dataset = $obj_convertor->get_karens_data($tmp_emp_details['employee_id'], null, $all_leave_works_grouped, $date_type='YEAR_MONTH', $_POST['month'], $_POST['year'], null, 0.00, 24.00, FALSE,'FROM_FORM');
                        if($karense_dataset) $karense_dataset = array_values($karense_dataset);

                        $Q_work_dates = array();
                        if($karense_dataset){
                            foreach ($karense_dataset as $karense_data){
                                if(isset($karense_data['karens']) && !empty($karense_data['karens']))
                                    $Q_work_dates[] = key($karense_data['karens']); //get first key name from the array
                            }
                        }
                        // foreach ($qualifying_leave_works as $Qworks)
                        //     $Q_work_dates[] = $Qworks['date'];
                        if (!empty($Q_work_dates))
                            $form_reference_number .= date('m-d', strtotime($Q_work_dates[0]));
                        

                        $reference_numbers_set = array();
                        $reference_numbers_ref_set = array();
                        if(!empty($all_leave_works) && !empty($Q_work_dates)){
                            if($Q_work_dates[0] != $all_leave_works[0]['date']){
                                $reference_numbers_set[] = array('date' => '', 'ref' => $form_reference_number_base);
                                $reference_numbers_ref_set[] = $form_reference_number_base;
                            }
                            
                            foreach($Q_work_dates as $qd){
                                $reference_numbers_set[] = array('date' => $qd, 'ref' => $form_reference_number_base . date('m-d', strtotime($qd)));
                                $reference_numbers_ref_set[] = $form_reference_number_base . date('m-d', strtotime($qd));
                            }
                        } else {
                            $reference_numbers_set[] = array('date' => '', 'ref' => $form_reference_number_base);
                            $reference_numbers_ref_set[] = $form_reference_number_base;
                        }
                        
                        $day = $_POST['year'].'-'.$_POST['month'].'-01';
                        $nomal_salary = $inconvenient_process_obj->get_salary($day, $tmp_emp_details['employee_id'], 'normal');
                        $insurance = $inconvenient_process_obj->get_salary($day, $tmp_emp_details['employee_id'], 'insurance');
                        
                        $emp_detail = $employee->get_employee_incov_detail($tmp_emp_details['employee_id']);
                        $sel_employee_age = $dona->attach_employee_age(array(array('employee_id' => $tmp_emp_details['employee_id'])));
                        $sel_employees_age = $sel_employee_age[0]['age'];

                        $dona->Hourly_times = array();
                        // $dona->leave_employee       = $tmp_emp_details['employee_id'];
                        $dona->assignment           = trim($sick_form_defaults['uppdrag']); //trim($_POST['txtUppdrag']);    //Uppgifter om anställning section
                        
                        $dona->proxies              = $sick_form_defaults['fullmakt_values']['fullmakt1'] == 1 ? 1 : 0 ; //$_POST['chkFullmaktBifogas'];
                        $dona->submission           = $sick_form_defaults['fullmakt_values']['fullmakt2'] == 1 ? 1 : 0 ; //$_POST['chkFullmaktTidigareInsant'];
                        
                        $dona->comp_paid_to_account = $company_details['bank_account']; //$_POST['txtErsattningBetalasTillKonto'];
                        $dona->reference            = !empty($reference_numbers_ref_set) ? $reference_numbers_ref_set : array();
                        $dona->collective           = $this_customer_Kollectival_name; //$_POST['txtKollektivavtal'];
                        
                        $dona->sick_leave_reg       = $sick_form_defaults['checkbox_values']['chkBifogas1'] == 1 ? 1 : 0 ; //$_POST['chkBifogas1'];
                        $dona->copy_of_payroll      = $sick_form_defaults['checkbox_values']['chkBifogas2'] == 1 ? 1 : 0 ; //$_POST['chkBifogas2'];
                        $dona->time_sheet_h_service = $sick_form_defaults['checkbox_values']['chkBifogas3'] == 1 ? 1 : 0 ; //$_POST['chkBifogas3'];            
                        $dona->additional_cost      = $sick_form_defaults['checkbox_values']['chkBifogas4'] == 1 ? 1 : 0 ; //$_POST['chkBifogas4'];
                        
                        $dona->words_pay            = $nomal_salary; //$_POST['txtAssistentOrdLon'];            
                        $dona->kr_h                 = $company_details['fk_kr_per_time']; //$_POST['txtTotalKostnadPerTim'];            
                        $dona->insurance_word_person= $insurance; //$_POST['txtForsakring_Ord'];            
                        $dona->insurance_substitute = ''; //$_POST['txtForsakring_Vikarie'];           
                        $dona->SS_contibution       = ''; //$_POST['txtSocialaAvgifter_Ord'];  
                        if($sel_employees_age < 25) $dona->SS_contibution = BELOW_25;
                        else if($sel_employees_age < 65)  $dona->SS_contibution = BTWN_25_65;
                        else if($sel_employees_age >= 65) $dona->SS_contibution = ABOVE_65; 
                        $dona->soc_replace_emp      = ''; //$_POST['soc'];

                        $dona->inconvinient_week_holiday= $GlobalSetting[0]["inconvinient_week_holiday"];
                        $dona->on_call                  = ($emp_detail['on_call']!='' && $emp_detail['on_call']!='0.00' ?  $emp_detail['on_call'] : $GlobalSetting[0]["on_call"]);
                        $dona->oncall_holiday           = ($emp_detail['on_call_holiday']!='' && $emp_detail['on_call_holiday']!='0.00' ? $emp_detail['on_call_holiday'] : $GlobalSetting[0]["on_call_holiday"]);
                        $dona->oncall_bigholiday        = ($emp_detail['on_call_bigholiday']!='' && $emp_detail['on_call_bigholiday']!='0.00' ? $emp_detail['on_call_bigholiday'] : $GlobalSetting[0]["on_call_bigholiday"]);
                        $dona->inconvinient_evening     = ($emp_detail['inconvinient_evening']!='' && $emp_detail['inconvinient_evening']!='0.00' ? $emp_detail['inconvinient_evening'] : $GlobalSetting[0]["inconvinient_evening"]);
                        $dona->inconvinient_night       = ($emp_detail['inconvinient_night']!='' && $emp_detail['inconvinient_night']!='0.00' ? $emp_detail['inconvinient_night'] : $GlobalSetting[0]["inconvinient_night"]);
                        $dona->inconvinient_holiday     = ($emp_detail['inconvinient_holiday']!='' && $emp_detail['inconvinient_holiday']!='0.00' ? $emp_detail['inconvinient_holiday'] : $GlobalSetting[0]["inconvinient_holiday"]);
                        
                        //generate PDF
                        $pdf = $dona->Financial_payment_pdf($company_details, $customer_details, $customer_gardian_details, $pdf, FALSE);
                    }
                }
            }
            
            $pdf->Output(utf8_decode('sjukfaktura').'_'.date('Ymd').'.pdf', 'I');
            exit();
        }
    }
}
else if($_POST['action'] == "printAnnexReport" /*&& $_SESSION['company_id'] == 8*/ && $_POST['year'] && $_POST['month']/* && $_POST['customer']*/){
	
    if(isset($_POST['customer']) && trim($_POST['customer']) != '' && trim($_POST['customer']) != 'ALL'){

        // echo "<pre>".print_r($_POST, 1)."<pre>"; exit();
        if(!$selected_all_employees && $_POST['employee'] != ''){
            $emp_detail     = $employee->get_employee_incov_detail($_POST["employee"]);
            $GlobalSetting  = $obj_newcustomer->GetGlobalSetting();
            
            $col_6_txts = array();
            for($i=0 ; $i< $_POST['tot_rows'] ; $i++)
                $col_6_txts[]            = $_POST['time_'.$i];
            $dona->Hourly_times      = $col_6_txts;
            $dona->leavePeriod_month = $_POST['month'];
            $dona->leavePeriod_year  = $_POST['year'];
            $dona->leave_customer    = $_POST['customer'];
            $dona->leave_employee    = $_POST['employee'];
            $dona->assignment        = trim($_POST['txtUppdrag']);    //Uppgifter om anställning section
            
            $dona->proxies          = $_POST['chkFullmaktBifogas'];
            $dona->submission       = $_POST['chkFullmaktTidigareInsant'];
            
            $dona->comp_paid_to_account     = $_POST['txtErsattningBetalasTillKonto'];
            $dona->reference        = isset($_POST['txtReferensnummer']) && !empty($_POST['txtReferensnummer']) ? $_POST['txtReferensnummer'] : array();
            $dona->collective       = $_POST['txtKollektivavtal'];
            
            $dona->sick_leave_reg   = $_POST['chkBifogas1'];
            $dona->copy_of_payroll  = $_POST['chkBifogas2'];
            $dona->time_sheet_h_service     = $_POST['chkBifogas3'];            
            $dona->additional_cost  = $_POST['chkBifogas4'];
            
            $dona->words_pay        = $_POST['txtAssistentOrdLon'];            
            $dona->kr_h             = $_POST['txtTotalKostnadPerTim'];            
            $dona->insurance_word_person    = $_POST['txtForsakring_Ord'];            
            $dona->insurance_substitute     = $_POST['txtForsakring_Vikarie'];           
            $dona->SS_contibution   = $_POST['txtSocialaAvgifter_Ord'];  
            $dona->soc_replace_emp  = $_POST['soc'];  
            
            $dona->inconvinient_week_holiday= $GlobalSetting[0]["inconvinient_week_holiday"];
            $dona->on_call                  = $emp_detail['on_call']!='' && $emp_detail['on_call']!='0.00' ? $emp_detail['on_call'] : $GlobalSetting[0]['on_call'];
            $dona->oncall_holiday           = $emp_detail['on_call_holiday']!='' && $emp_detail['on_call_holiday']!='0.00' ? $emp_detail['on_call_holiday'] : $dona->oncall_holiday = $GlobalSetting[0]['on_call_holiday'];
            $dona->oncall_bigholiday        = $emp_detail['on_call_bigholiday']!='' && $emp_detail['on_call_bigholiday']!='0.00' ? $emp_detail['on_call_bigholiday'] : $dona->oncall_bigholiday = $GlobalSetting[0]['on_call_bigholiday'];
            $dona->inconvinient_evening     = $emp_detail['inconvinient_evening']!='' && $emp_detail['inconvinient_evening']!='0.00' ? $emp_detail['inconvinient_evening'] : $dona->inconvinient_evening = $GlobalSetting[0]['inconvinient_evening'];
            $dona->inconvinient_night       = $emp_detail['inconvinient_night']!='' && $emp_detail['inconvinient_night']!='0.00' ? $emp_detail['inconvinient_night'] : $GlobalSetting[0]['inconvinient_night'];
            $dona->inconvinient_holiday     = $emp_detail['inconvinient_holiday']!='' && $emp_detail['inconvinient_holiday']!='0.00' ? $emp_detail['inconvinient_holiday'] : $GlobalSetting[0]['inconvinient_holiday'];

            //generate PDF
            $dona->leave_annex_pdf();
            exit();
        }
        else{
            //check multiple employees available
            $all_employee_details = $equipment->employees_leave_under_customer($_POST['month'], $_POST['year'], $_POST['customer']); 
            if(count($all_employee_details) > 0){

                //get sick form defaults
                $sick_form_defaults = $obj_customer->get_sick_form_defaults($_POST['customer']);
                if(!empty($sick_form_defaults)){
                    $sick_form_defaults = $sick_form_defaults[0];
                    $check_box_values = explode('||', $sick_form_defaults['check_values']);
                    $fullmakt_values = explode('||', $sick_form_defaults['fullmakt']);
                    $sick_form_defaults['checkbox_values'] = array('chkBifogas1' => $check_box_values[0], 'chkBifogas2' => $check_box_values[1], 'chkBifogas3' => $check_box_values[2], 'chkBifogas4' => $check_box_values[3]);
                    $sick_form_defaults['fullmakt_values'] = array('fullmakt1' => $fullmakt_values[0], 'fullmakt2' => $fullmakt_values[1]);
                }

                $company_details = $obj_company->get_company_detail($_SESSION['company_id']);
                $customer_details = $obj_customer->customer_detail($_POST['customer']);
                // $customer_gardian_details = $obj_customer->customer_guardian($_POST['customer']);
                $form_reference_number = $form_reference_number_base = $customer_details['code']. ' : ';
                $GlobalSetting = $obj_newcustomer->GetGlobalSetting();

                $pdf = new PDF_leave_annex();
                $inconvenient_process_obj = new inconvenient();
                
                $dona->leavePeriod_month    = $_POST['month'];
                $dona->leavePeriod_year     = $_POST['year'];
                $dona->leave_customer       = $_POST['customer'];

                $first_day_of_month = $dona->leavePeriod_year.'-'.$dona->leavePeriod_month.'-01';
                $contract_start_date = date("Y-m-01", strtotime($first_day_of_month));
                $contract_end_date = date("Y-m-t", strtotime($first_day_of_month));
                $customer_contract_details = $obj_customer->get_customer_contract_within_a_month($dona->leave_customer, $contract_start_date, $contract_end_date, 2);
                if(empty($customer_contract_details))
                    $customer_contract_details = $obj_customer->get_customer_contract_within_a_month($dona->leave_customer, $contract_start_date, $contract_end_date, 3);
                if(!empty($customer_contract_details)) $customer_contract_details = $customer_contract_details[0];
                if(empty($customer_contract_details)) $customer_contract_details = NULL;

                foreach($all_employee_details as $tmp_emp_details){

                    $dona->leave_employee       = $tmp_emp_details['employee_id'];

                    $fkkn_form_defaults = $dona->check_exists_fkkn_form_defaults($_POST['customer'], $tmp_emp_details['employee_id'], TRUE);
                    $this_customer_Kollectival_name = '';
                    if(!empty($fkkn_form_defaults)){
                        $this_customer_Kollectival_id = $fkkn_form_defaults[0]['bargaining'];
                        if($this_customer_Kollectival_id == 6)  //other collectival
                            $this_customer_Kollectival_name = $fkkn_form_defaults[0]['other_bargaining_text'];
                        else    //get it from config by using kollectival id
                            $this_customer_Kollectival_name = $customer_kollektivavtal_labels[$this_customer_Kollectival_id];
                    }
                    
                    $day               = $_POST['year'].'-'.$_POST['month'].'-01';
                    $nomal_salary      = $inconvenient_process_obj->get_salary($day, $tmp_emp_details['employee_id'], 'normal');
                    $insurance         = $inconvenient_process_obj->get_salary($day, $tmp_emp_details['employee_id'], 'insurance');
                    
                    $emp_detail        = $employee->get_employee_incov_detail($tmp_emp_details['employee_id']);
                    $sel_employee_age  = $dona->attach_employee_age(array(array('employee_id' => $tmp_emp_details['employee_id'])));
                    $sel_employees_age = $sel_employee_age[0]['age'];
                    
                    $dona->Hourly_times = array();
                    // $dona->leave_employee       = $tmp_emp_details['employee_id'];
                    $dona->assignment           = trim($sick_form_defaults['uppdrag']); //trim($_POST['txtUppdrag']);    //Uppgifter om anställning section
                    
                    $dona->proxies              = $sick_form_defaults['fullmakt_values']['fullmakt1'] == 1 ? 1 : 0 ; //$_POST['chkFullmaktBifogas'];
                    $dona->submission           = $sick_form_defaults['fullmakt_values']['fullmakt2'] == 1 ? 1 : 0 ; //$_POST['chkFullmaktTidigareInsant'];
                    
                    $dona->comp_paid_to_account = $company_details['bank_account']; //$_POST['txtErsattningBetalasTillKonto'];
                    // $dona->reference            = !empty($reference_numbers_ref_set) ? $reference_numbers_ref_set : array();
                    $dona->collective           = $this_customer_Kollectival_name; //$_POST['txtKollektivavtal'];
                    
                    $dona->sick_leave_reg       = $sick_form_defaults['checkbox_values']['chkBifogas1'] == 1 ? 1 : 0 ; //$_POST['chkBifogas1'];
                    $dona->copy_of_payroll      = $sick_form_defaults['checkbox_values']['chkBifogas2'] == 1 ? 1 : 0 ; //$_POST['chkBifogas2'];
                    $dona->time_sheet_h_service = $sick_form_defaults['checkbox_values']['chkBifogas3'] == 1 ? 1 : 0 ; //$_POST['chkBifogas3'];            
                    $dona->additional_cost      = $sick_form_defaults['checkbox_values']['chkBifogas4'] == 1 ? 1 : 0 ; //$_POST['chkBifogas4'];
                    
                    $dona->words_pay            = $nomal_salary; //$_POST['txtAssistentOrdLon'];            
                    $dona->kr_h                 = $company_details['fk_kr_per_time']; //$_POST['txtTotalKostnadPerTim'];            
                    $dona->insurance_word_person= $insurance; //$_POST['txtForsakring_Ord'];            
                    $dona->insurance_substitute = ''; //$_POST['txtForsakring_Vikarie'];           
                    $dona->SS_contibution       = ''; //$_POST['txtSocialaAvgifter_Ord'];  
                    if($sel_employees_age < 25) $dona->SS_contibution = BELOW_25;
                    else if($sel_employees_age < 65)  $dona->SS_contibution = BTWN_25_65;
                    else if($sel_employees_age >= 65) $dona->SS_contibution = ABOVE_65; 
                    $dona->soc_replace_emp      = ''; //$_POST['soc'];

                    $dona->inconvinient_week_holiday = $GlobalSetting[0]["inconvinient_week_holiday"];
                    $dona->on_call                   = ($emp_detail['on_call']!='' && $emp_detail['on_call']!='0.00' ?  $emp_detail['on_call'] : $GlobalSetting[0]["on_call"]);
                    $dona->oncall_holiday            = ($emp_detail['on_call_holiday']!='' && $emp_detail['on_call_holiday']!='0.00' ? $emp_detail['on_call_holiday'] : $GlobalSetting[0]["on_call_holiday"]);
                    $dona->oncall_bigholiday         = ($emp_detail['on_call_bigholiday']!='' && $emp_detail['on_call_bigholiday']!='0.00' ? $emp_detail['on_call_bigholiday'] : $GlobalSetting[0]["on_call_bigholiday"]);
                    $dona->inconvinient_evening      = ($emp_detail['inconvinient_evening']!='' && $emp_detail['inconvinient_evening']!='0.00' ? $emp_detail['inconvinient_evening'] : $GlobalSetting[0]["inconvinient_evening"]);
                    $dona->inconvinient_night        = ($emp_detail['inconvinient_night']!='' && $emp_detail['inconvinient_night']!='0.00' ? $emp_detail['inconvinient_night'] : $GlobalSetting[0]["inconvinient_night"]);
                    $dona->inconvinient_holiday      = ($emp_detail['inconvinient_holiday']!='' && $emp_detail['inconvinient_holiday']!='0.00' ? $emp_detail['inconvinient_holiday'] : $GlobalSetting[0]["inconvinient_holiday"]);
                    
                    //generate PDF
                    $pdf = $dona->leave_annex_pdf($company_details, $customer_details, $customer_contract_details, $pdf, FALSE);
                }

                $pdf->Output(utf8_decode('sjukfaktura').'_'.date('Ymd').'.pdf', 'I');
                exit();
            }
        }
    }
    else if($selected_all_customers){
        //check multiple customers available
        $all_customer_details = $equipment->customers_under_leave_employee($_POST['month'], $_POST['year']);
        if(count($all_customer_details) > 0){

            $company_details = $obj_company->get_company_detail($_SESSION['company_id']);
            $GlobalSetting = $obj_newcustomer->GetGlobalSetting();

            $pdf = new PDF_leave_annex();
            $inconvenient_process_obj = new inconvenient();

            foreach($all_customer_details as $tmp_cust_details){
                //$tmp_cust_details['customer_id']

                //check multiple employees available
                $all_employee_details = $equipment->employees_leave_under_customer($_POST['month'], $_POST['year'], $tmp_cust_details['customer_id']); 
                if(count($all_employee_details) > 0){

                    //get sick form defaults
                    $sick_form_defaults = $obj_customer->get_sick_form_defaults($tmp_cust_details['customer_id']);
                    if(!empty($sick_form_defaults)){
                        $sick_form_defaults = $sick_form_defaults[0];
                        $check_box_values = explode('||', $sick_form_defaults['check_values']);
                        $fullmakt_values = explode('||', $sick_form_defaults['fullmakt']);
                        $sick_form_defaults['checkbox_values'] = array('chkBifogas1' => $check_box_values[0], 'chkBifogas2' => $check_box_values[1], 'chkBifogas3' => $check_box_values[2], 'chkBifogas4' => $check_box_values[3]);
                        $sick_form_defaults['fullmakt_values'] = array('fullmakt1' => $fullmakt_values[0], 'fullmakt2' => $fullmakt_values[1]);
                    }

                    $customer_details = $obj_customer->customer_detail($tmp_cust_details['customer_id']);

                    // $customer_gardian_details = $obj_customer->customer_guardian($tmp_cust_details['customer_id']);
                    $form_reference_number = $form_reference_number_base = $customer_details['code']. ' : ';

                    
                    $dona->leavePeriod_month    = $_POST['month'];
                    $dona->leavePeriod_year     = $_POST['year'];
                    $dona->leave_customer       = $tmp_cust_details['customer_id'];

                    $first_day_of_month = $dona->leavePeriod_year.'-'.$dona->leavePeriod_month.'-01';
                    $contract_start_date = date("Y-m-01", strtotime($first_day_of_month));
                    $contract_end_date = date("Y-m-t", strtotime($first_day_of_month));
                    $customer_contract_details = $obj_customer->get_customer_contract_within_a_month($dona->leave_customer, $contract_start_date, $contract_end_date, 2);
                    if(empty($customer_contract_details))
                        $customer_contract_details = $obj_customer->get_customer_contract_within_a_month($dona->leave_customer, $contract_start_date, $contract_end_date, 3);
                    if(!empty($customer_contract_details)) $customer_contract_details = $customer_contract_details[0];
                    if(empty($customer_contract_details)) $customer_contract_details = NULL;
                    

                    foreach($all_employee_details as $tmp_emp_details){

                        $dona->leave_employee       = $tmp_emp_details['employee_id'];

                        $fkkn_form_defaults = $dona->check_exists_fkkn_form_defaults($tmp_cust_details['customer_id'], $tmp_emp_details['employee_id'], TRUE);
                        $this_customer_Kollectival_name = '';
                        if(!empty($fkkn_form_defaults)){
                            $this_customer_Kollectival_id = $fkkn_form_defaults[0]['bargaining'];
                            if($this_customer_Kollectival_id == 6)  //other collectival
                                $this_customer_Kollectival_name = $fkkn_form_defaults[0]['other_bargaining_text'];
                            else    //get it from config by using kollectival id
                                $this_customer_Kollectival_name = $customer_kollektivavtal_labels[$this_customer_Kollectival_id];
                        }
                        
                        $day = $_POST['year'].'-'.$_POST['month'].'-01';
                        $nomal_salary = $inconvenient_process_obj->get_salary($day, $tmp_emp_details['employee_id'], 'normal');
                        $insurance = $inconvenient_process_obj->get_salary($day, $tmp_emp_details['employee_id'], 'insurance');
                        
                        $emp_detail = $employee->get_employee_incov_detail($tmp_emp_details['employee_id']);
                        $sel_employee_age = $dona->attach_employee_age(array(array('employee_id' => $tmp_emp_details['employee_id'])));
                        $sel_employees_age = $sel_employee_age[0]['age'];

                        $dona->Hourly_times = array();
                        // $dona->leave_employee       = $tmp_emp_details['employee_id'];
                        $dona->assignment           = trim($sick_form_defaults['uppdrag']); //trim($_POST['txtUppdrag']);    //Uppgifter om anställning section
                        
                        $dona->proxies              = $sick_form_defaults['fullmakt_values']['fullmakt1'] == 1 ? 1 : 0 ; //$_POST['chkFullmaktBifogas'];
                        $dona->submission           = $sick_form_defaults['fullmakt_values']['fullmakt2'] == 1 ? 1 : 0 ; //$_POST['chkFullmaktTidigareInsant'];
                        
                        $dona->comp_paid_to_account = $company_details['bank_account']; //$_POST['txtErsattningBetalasTillKonto'];
                        // $dona->reference            = !empty($reference_numbers_ref_set) ? $reference_numbers_ref_set : array();
                        $dona->collective           = $this_customer_Kollectival_name; //$_POST['txtKollektivavtal'];
                        
                        $dona->sick_leave_reg       = $sick_form_defaults['checkbox_values']['chkBifogas1'] == 1 ? 1 : 0 ; //$_POST['chkBifogas1'];
                        $dona->copy_of_payroll      = $sick_form_defaults['checkbox_values']['chkBifogas2'] == 1 ? 1 : 0 ; //$_POST['chkBifogas2'];
                        $dona->time_sheet_h_service = $sick_form_defaults['checkbox_values']['chkBifogas3'] == 1 ? 1 : 0 ; //$_POST['chkBifogas3'];            
                        $dona->additional_cost      = $sick_form_defaults['checkbox_values']['chkBifogas4'] == 1 ? 1 : 0 ; //$_POST['chkBifogas4'];
                        
                        $dona->words_pay            = $nomal_salary; //$_POST['txtAssistentOrdLon'];            
                        $dona->kr_h                 = $company_details['fk_kr_per_time']; //$_POST['txtTotalKostnadPerTim'];            
                        $dona->insurance_word_person= $insurance; //$_POST['txtForsakring_Ord'];            
                        $dona->insurance_substitute = ''; //$_POST['txtForsakring_Vikarie'];           
                        $dona->SS_contibution       = ''; //$_POST['txtSocialaAvgifter_Ord'];  
                        if($sel_employees_age < 25) $dona->SS_contibution = BELOW_25;
                        else if($sel_employees_age < 65)  $dona->SS_contibution = BTWN_25_65;
                        else if($sel_employees_age >= 65) $dona->SS_contibution = ABOVE_65; 
                        $dona->soc_replace_emp      = ''; //$_POST['soc'];

                        $dona->inconvinient_week_holiday = $GlobalSetting[0]["inconvinient_week_holiday"];
                        $dona->on_call                   = ($emp_detail['on_call']!='' && $emp_detail['on_call']!='0.00' ?  $emp_detail['on_call'] : $GlobalSetting[0]["on_call"]);
                        $dona->oncall_holiday            = ($emp_detail['on_call_holiday']!='' && $emp_detail['on_call_holiday']!='0.00' ? $emp_detail['on_call_holiday'] : $GlobalSetting[0]["on_call_holiday"]);
                        $dona->oncall_bigholiday         = ($emp_detail['on_call_bigholiday']!='' && $emp_detail['on_call_bigholiday']!='0.00' ? $emp_detail['on_call_bigholiday'] : $GlobalSetting[0]["on_call_bigholiday"]);
                        $dona->inconvinient_evening      = ($emp_detail['inconvinient_evening']!='' && $emp_detail['inconvinient_evening']!='0.00' ? $emp_detail['inconvinient_evening'] : $GlobalSetting[0]["inconvinient_evening"]);
                        $dona->inconvinient_night        = ($emp_detail['inconvinient_night']!='' && $emp_detail['inconvinient_night']!='0.00' ? $emp_detail['inconvinient_night'] : $GlobalSetting[0]["inconvinient_night"]);
                        $dona->inconvinient_holiday      = ($emp_detail['inconvinient_holiday']!='' && $emp_detail['inconvinient_holiday']!='0.00' ? $emp_detail['inconvinient_holiday'] : $GlobalSetting[0]["inconvinient_holiday"]);

                        //generate PDF
                        $pdf = $dona->leave_annex_pdf($company_details, $customer_details, $customer_contract_details, $pdf, FALSE);
                    }
                }
            }
            
            $pdf->Output(utf8_decode('sjukfaktura').'_'.date('Ymd').'.pdf', 'I');
            exit();
        }
    }
}
else if($_POST['action'] == "printWorkReport" && $_POST['year'] && $_POST['month']/* && $_POST['customer'] && $_POST['employee']*/){
    
    $this_customer      = trim($_POST['customer']);
    $this_employee      = trim($_POST['employee']);
    $this_year          = trim($_POST['year']);
    $this_month         = trim($_POST['month']);

    if(isset($_POST['customer']) && trim($_POST['customer']) != '' && trim($_POST['customer']) != 'ALL'){
        if(!$selected_all_employees && $_POST['employee'] != ''){
            //generate PDF
            $dona->Customer_pdf_work_report_from_sick_report($this_customer, $this_employee, $this_year, $this_month);
            exit();
        }
        else{
            //check multiple employees available
            $all_employee_details = $equipment->employees_leave_under_customer($_POST['month'], $_POST['year'], $_POST['customer']); 
            if(count($all_employee_details) > 0){

                $pdf = new PDF_work_rpt_from_sick();

                foreach($all_employee_details as $tmp_emp_details){
                    //generate PDF
                    $pdf = $dona->Customer_pdf_work_report_from_sick_report($this_customer, $tmp_emp_details['employee_id'], $this_year, $this_month, FALSE, $pdf);
                }

                // $pdf->Output();
                $pdf->Output(utf8_decode('Arbetsrapport').'_'.$this_customer.'_'.date('ymdHi').'.pdf', 'D');
                exit();
            }
        }
    }
    else if($selected_all_customers){
        //check multiple customers available
        $all_customer_details = $equipment->customers_under_leave_employee($_POST['month'], $_POST['year']);
        if(count($all_customer_details) > 0){

            $pdf = new PDF_work_rpt_from_sick();

            foreach($all_customer_details as $tmp_cust_details){
                //$tmp_cust_details['customer_id']

                //check multiple employees available
                $all_employee_details = $equipment->employees_leave_under_customer($_POST['month'], $_POST['year'], $tmp_cust_details['customer_id']); 
                if(count($all_employee_details) > 0){
                    foreach($all_employee_details as $tmp_emp_details){
                        //generate PDF
                        $pdf = $dona->Customer_pdf_work_report_from_sick_report($tmp_cust_details['customer_id'], $tmp_emp_details['employee_id'], $this_year, $this_month, FALSE, $pdf);
                    }
                }
            }
            
            // $pdf->Output();
            $pdf->Output(utf8_decode('Arbetsrapport').'_'.date('ymdHi').'.pdf', 'D');
            exit();
        }
    }
}
else if($_POST['action'] == "printSickDetailsReport" && $_POST['year'] && $_POST['month']/* && $_POST['customer'] && $_POST['employee']*/){
    
    $this_customer      = trim($_POST['customer']);
    $this_employee      = trim($_POST['employee']);
    $this_year          = trim($_POST['year']);
    $this_month         = trim($_POST['month']);
    
    if(isset($_POST['customer']) && trim($_POST['customer']) != '' && trim($_POST['customer']) != 'ALL'){
        if(!$selected_all_employees && $_POST['employee'] != ''){
            //generate PDF
            $dona->Customer_employee_sick_details_report($this_customer, $this_employee, $this_year, $this_month);
            exit();
        }
        else{
            //check multiple employees available
            $all_employee_details = $equipment->employees_leave_under_customer($_POST['month'], $_POST['year'], $_POST['customer']); 
            if(count($all_employee_details) > 0){

                $pdf = new PDF_sick_report();

                foreach($all_employee_details as $tmp_emp_details){
                    //generate PDF
                    $pdf = $dona->Customer_employee_sick_details_report($this_customer, $tmp_emp_details['employee_id'], $this_year, $this_month, FALSE, $pdf);
                }

                // $pdf->Output();
                $pdf->Output(utf8_decode(' Avvikelserapport').'_'.$this_customer.'_'.date('ymdHi').'.pdf', 'D');
                exit();
            }
        }
    }
    else if($selected_all_customers){
        //check multiple customers available
        $all_customer_details = $equipment->customers_under_leave_employee($_POST['month'], $_POST['year']);
        //echo "<pre>".print_r($all_customer_details,1)."</pre>";exit();
        if(count($all_customer_details) > 0){

            $pdf = new PDF_sick_report();

            foreach($all_customer_details as $tmp_cust_details){
                //$tmp_cust_details['customer_id']

                //check multiple employees available
                $all_employee_details = $equipment->employees_leave_under_customer($_POST['month'], $_POST['year'], $tmp_cust_details['customer_id']); 

                
                if(count($all_employee_details) > 0){
                    foreach($all_employee_details as $tmp_emp_details){

                        //generate PDF
                        $pdf = $dona->Customer_employee_sick_details_report($tmp_cust_details['customer_id'], $tmp_emp_details['employee_id'], $this_year, $this_month, FALSE, $pdf);
                    }
                }
            }
            
            // $pdf->Output();
            $pdf->Output(utf8_decode(' Avvikelserapport').'_'.date('ymdHi').'.pdf', 'D');
            exit();
        }
    }
}
else if($_POST['action'] == "printSickDetailsAndWorkReport" && $_POST['year'] && $_POST['month']/* && $_POST['customer'] && $_POST['employee']*/){
    
    $this_customer      = trim($_POST['customer']);
    $this_employee      = trim($_POST['employee']);
    $this_year          = trim($_POST['year']);
    $this_month         = trim($_POST['month']);
    

    if(isset($_POST['customer']) && trim($_POST['customer']) != '' && trim($_POST['customer']) != 'ALL'){
        if(!$selected_all_employees && $_POST['employee'] != ''){
            //generate PDF
            $dona->Customer_employee_sick_details_and_work_report($this_customer, $this_employee, $this_year, $this_month);
            exit();
        }
        else{
            //check multiple employees available
            $all_employee_details = $equipment->employees_leave_under_customer($_POST['month'], $_POST['year'], $_POST['customer']); 
            if(count($all_employee_details) > 0){

                $pdf = new PDF_work_and_sick_details_report();

                foreach($all_employee_details as $tmp_emp_details){
                    //generate PDF
                    $pdf = $dona->Customer_employee_sick_details_and_work_report($this_customer, $tmp_emp_details['employee_id'], $this_year, $this_month, FALSE, $pdf);
                }

                // $pdf->Output();
                $pdf->Output(utf8_decode('Arbetsrapport-Avvikelserapport').'_'.$this_customer.'_'.date('ymdHi').'.pdf', 'D');
                exit();
            }
        }
    }
    else if($selected_all_customers){
        //check multiple customers available
        $all_customer_details = $equipment->customers_under_leave_employee($_POST['month'], $_POST['year']);
        if(count($all_customer_details) > 0){

            $pdf = new PDF_work_and_sick_details_report();

            foreach($all_customer_details as $tmp_cust_details){
                //$tmp_cust_details['customer_id']

                //check multiple employees available
                $all_employee_details = $equipment->employees_leave_under_customer($_POST['month'], $_POST['year'], $tmp_cust_details['customer_id']); 
                if(count($all_employee_details) > 0){
                    foreach($all_employee_details as $tmp_emp_details){
                        //generate PDF
                        $pdf = $dona->Customer_employee_sick_details_and_work_report($tmp_cust_details['customer_id'], $tmp_emp_details['employee_id'], $this_year, $this_month, FALSE, $pdf);
                    }
                }
            }
            
            // $pdf->Output();
            $pdf->Output(utf8_decode('Arbetsrapport-Avvikelserapport').'_'.date('ymdHi').'.pdf', 'D');
            exit();
        }
    }
}
else if($_POST['action'] == "printFKWorkReport" && $_POST['year'] && $_POST['month'] && $_POST['customer'] && $_POST['employee']){
    
    $this_customer      = trim($_POST['customer']);
    $this_employee      = trim($_POST['employee']);
    $this_year          = trim($_POST['year']);
    $this_month         = trim($_POST['month']);
    
    $this_fkkn          = 1;
    $this_bargaining = NULL;
    $this_agreement = array();
    $defaults = $dona->check_exists_fkkn_form_defaults($this_customer, $this_employee, TRUE);
    if(!empty($defaults)){        //only for admin 
        $this_bargaining    = $defaults[0]['bargaining_new'];
        $provider_of_pa = 2;
        $agreement_type = $company_cp_name = $company_cp_phone = $agreement_type2_company = $agreement_type2_orgno = NULL;
        if($provider_of_pa == 2){
            $company_cp_name = $defaults[0]['company_cp_name'];
            $company_cp_phone = $defaults[0]['company_cp_phone'];
            if($company_cp_phone != NULL)
                $company_cp_phone = str_replace(array("-", " ", ",", ".", "_"), "", strip_tags($company_cp_phone));
        }

        $this_agreement['type'] = $defaults[0]['agreement_types_new'];
        $this_agreement['type2_company'] = $defaults[0]['agreement_type2_company'];
        $this_agreement['type2_orgno'] = $defaults[0]['agreement_type2_orgNo'];
        $this_agreement['company_cp_name'] = $company_cp_name;
        $this_agreement['company_cp_phone'] = $obj_general->format_mobile($company_cp_phone);
    }
    // $dona->Customer_pdf_work_report($this_customer, $this_month, $this_year, $this_fkkn, $this_bargaining, NULL, $this_agreement, $this_employee, NULL, $provider_of_pa);
    

    exit('Coming soon');
}
else if($_POST['action'] == "printFKDeviationReport" && $_POST['year'] && $_POST['month'] && $_POST['customer'] && $_POST['employee']){
    
    $this_customer      = trim($_POST['customer']);
    $this_employee      = trim($_POST['employee']);
    $this_year          = trim($_POST['year']);
    $this_month         = trim($_POST['month']);
    
    //generate PDF
    // $dona->Customer_employee_sick_details_and_work_report($this_customer, $this_employee, $this_year, $this_month);
    exit('Coming soon');
}
// replacement employee report
else if($_POST['action'] == "printVikarieListReport" && $_POST['year'] && $_POST['month']){
    $customer_data    = array();
    $this_customer    = trim($_POST['customer']);
    $this_employee    = trim($_POST['employee']);
    $this_year        = trim($_POST['year']);
    $this_month       = trim($_POST['month']);
    
    if(isset($_POST['customer']) && trim($_POST['customer']) != '' && trim($_POST['customer']) != 'ALL'){
        if(!$selected_all_employees && $_POST['employee'] != ''){
            // single customer and employee
            $pdf              = new PDF_replacement_employee_report();
            $employee_details = $employee->get_employee_detail($this_employee);
            $customer_data  = $dona->customer_data($this_customer);
            $emp_name       = $_SESSION['company_sort_by'] == 1 ? $employee_details['first_name']. ' '. $employee_details['last_name'] : $employee_details['last_name']. ' '. $employee_details['first_name'];
            $cust_name      = $_SESSION['company_sort_by'] == 1 ? $customer_data['first_name']. ' '. $customer_data['last_name'] : $customer_data['last_name']. ' '. $customer_data['first_name'];
            $mon_short_name = strtolower(date("F", mktime(0, 0, 0, $this_month, 10)));
            $basic_details  = array('customer'=>$cust_name,'employee'=>$emp_name,'year'=>$this_year,'month'=>$mon_short_name);
            $company_details= $obj_company->get_company_detail($_SESSION['company_id']); 

            // $list_relations = $equipment->relations_leave_employee($this_month, $this_year, $this_customer, $this_employee);
            $all_leave_works        = $dona->get_employee_leaved_timetable_works($this_employee, $this_year, $this_month, $this_customer);
            $all_leave_works_grouped= $obj_general->grouping_array_by_attribute($all_leave_works, 'date');
            $vikaries               = $equipment->relations_leave_employee($this_month, $this_year, $this_customer, $this_employee);
            $list_relations         = $dona->crop_vikarie_slots_based_on_its_parent($vikaries, $all_leave_works_grouped, $this_customer);
            $relations              = $dona->attach_employee_age($list_relations); 
            if (!empty($relations)){
                $tot_time_sum       = 0;
                foreach ($relations as $key => $value){
                    $tot_time_sum += $value['tot_time'];
                    // $tot_time_sum = $equipment->time_sum($tot_time_sum, $equipment->time_difference($value['time_from'], $value['time_to']));
                }
                $pdf = $dona->Customer_pdf_vikarie_details_report($relations, $company_details, $basic_details, $tot_time_sum, $pdf);
            }
            else{
                $pdf->AddPage();
                $pdf->no_data_avialable();
            }
            $pdf->Output('Vikarierapport_'.date('ymdHi').'.pdf', 'D');
            // $pdf->Output();
            exit();
        }
        else{
            $print = FALSE;
            // multiple employee of single customer.
            $customer_emp_replace_employee = array();
            $all_employee_details = $equipment->employees_leave_under_customer($_POST['month'], $_POST['year'], $_POST['customer']); 

            if(count($all_employee_details) > 0){
                $customer_data   = $dona->customer_data($this_customer);
                $company_details = $obj_company->get_company_detail($_SESSION['company_id']); 
                $cus_id          = $customer_data['username'];
                $cust_name       = $_SESSION['company_sort_by'] == 1 ? $customer_data['first_name']. ' '. $customer_data['last_name'] : $customer_data['last_name']. ' '. $customer_data['first_name'];
                $mon_short_name  =  strtolower(date("F", mktime(0, 0, 0, $this_month, 10)));
                $pdf             = new PDF_replacement_employee_report();
                foreach ($all_employee_details as $key => $emp_det) {
                    $emp_name        = $_SESSION['company_sort_by'] == 1 ? $emp_det['employee_ff'] : $emp_det['employee'];
                    $emp_id          = $emp_det['employee_id'];
                    $basic_details   = array('customer'=> $cust_name,'employee'=> $emp_name,'year'=> $this_year,'month'=> $mon_short_name);

                    // $list_relations         = $equipment->relations_leave_employee($this_month, $this_year, $this_customer, $emp_id); 
                    $all_leave_works        = $dona->get_employee_leaved_timetable_works($emp_id, $this_year, $this_month, $this_customer);
                    $all_leave_works_grouped= $obj_general->grouping_array_by_attribute($all_leave_works, 'date');
                    $vikaries               = $equipment->relations_leave_employee($this_month, $this_year, $this_customer, $emp_id);
                    $list_relations         = $dona->crop_vikarie_slots_based_on_its_parent($vikaries, $all_leave_works_grouped, $this_customer);
                    $relations              = $dona->attach_employee_age($list_relations);

                    if (!empty($relations)){
                        $tot_time_sum       = 0;
                        foreach ($relations as $key => $value) {
                            $tot_time_sum += $value['tot_time'];
                            // $tot_time_sum = $equipment->time_sum($tot_time_sum, $equipment->time_difference($value['time_from'], $value['time_to']));
                        }

                        $print = TRUE;
                        // $customer_emp_replace_employee[$cus_id][$emp_id][] = $relations;
                        $pdf = $dona->Customer_pdf_vikarie_details_report($relations,$company_details,$basic_details,$tot_time_sum,$pdf);
                    }
                }
                if($print === TRUE)
                    $pdf->Output('Vikarierapport_'.date('ymdHi').'.pdf', 'D');
                    // $pdf->Output();
                else{
                    $pdf->AddPage();
                    $pdf->no_data_avialable();
                    $pdf->Output('Vikarierapport_'.date('ymdHi').'.pdf', 'D');
                    // $pdf->Output();
                }
            }
        }
    }
    else if($selected_all_customers){
        $print = FALSE;
        $all_customer_details = $equipment->customers_under_leave_employee($_POST['month'], $_POST['year']);
        
        if(count($all_customer_details) > 0){
            
            $mon_short_name  = date("F", mktime(0, 0, 0, $this_month, 10));
            $mon_short_name  =  strtolower($mon_short_name);
            $company_details = $obj_company->get_company_detail($_SESSION['company_id']); 
            $pdf             = new PDF_replacement_employee_report();
            foreach ($all_customer_details as $key => $customer) {
                $customer_data   = $dona->customer_data($customer['customer_id']);
                $cus_id          = $customer['customer_id'];
                $cust_name       = $_SESSION['company_sort_by'] == 1 ? $customer['cust_ff'] : $customer['cust'];
                $all_employee_details = $equipment->employees_leave_under_customer($_POST['month'], $_POST['year'], $customer['customer_id']); 
                if(count($all_employee_details) > 0){
                    foreach ($all_employee_details as $key => $emp_det) {
                        $emp_name        = $_SESSION['company_sort_by'] == 1 ? $emp_det['employee_ff'] : $emp_det['employee'];
                        $emp_id          = $emp_det['employee_id'];
                        $basic_details   = array('customer'=>$cust_name,'employee'=>$emp_name,'year'=>$this_year,'month'=>$mon_short_name);

                        // $list_relations         = $equipment->relations_leave_employee($this_month, $this_year, $customer['customer_id'], $emp_id); 
                        $all_leave_works        = $dona->get_employee_leaved_timetable_works($emp_id, $this_year, $this_month, $customer['customer_id']);
                        $all_leave_works_grouped= $obj_general->grouping_array_by_attribute($all_leave_works, 'date');
                        $vikaries               = $equipment->relations_leave_employee($this_month, $this_year, $customer['customer_id'], $emp_id);
                        $list_relations         = $dona->crop_vikarie_slots_based_on_its_parent($vikaries, $all_leave_works_grouped, $customer['customer_id']);
                        $relations              = $dona->attach_employee_age($list_relations);

                        if(!empty($relations)){
                            $tot_time_sum       = 0;
                            foreach ($relations as $key => $value) {
                                $tot_time_sum += $value['tot_time'];
                            }

                            $print = TRUE;
                            $pdf = $dona->Customer_pdf_vikarie_details_report($relations,$company_details,$basic_details,$tot_time_sum,$pdf);
                        }
                    }
                }
            }
            if($print === TRUE)
                $pdf->Output('Vikarierapport_'.date('ymdHi').'.pdf', 'D');
                // $pdf->Output();
            else{
                $pdf->AddPage();
                $pdf->no_data_avialable();
                $pdf->Output('Vikarierapport_'.date('ymdHi').'.pdf', 'D');
                // $pdf->Output();
            }
        }
    }
}
else if($_POST['action'] == "printVikarie3059Report" && $_POST['year'] && $_POST['month']){
    
    $this_customer      = trim($_POST['customer']);
    $this_employee      = trim($_POST['employee']);
    $this_year          = trim($_POST['year']);
    $this_month         = trim($_POST['month']);

    if(isset($_POST['customer']) && trim($_POST['customer']) != '' && trim($_POST['customer']) != 'ALL'){
        if(!$selected_all_employees && $_POST['employee'] != ''){
            //generate PDF
            $dona->Customer_pdf_vikarie_3059_from_sick_report($this_customer, $this_employee, $this_year, $this_month);
            exit();
        }
        else{
            //check multiple employees available
            $all_employee_details = $equipment->employees_leave_under_customer($_POST['month'], $_POST['year'], $_POST['customer']); 
            if(count($all_employee_details) > 0){

                $pdf = new PDF_customer();

                foreach($all_employee_details as $tmp_emp_details){
                    //generate PDF
                    $pdf = $dona->Customer_pdf_vikarie_3059_from_sick_report($this_customer, $tmp_emp_details['employee_id'], $this_year, $this_month, FALSE, $pdf);
                }

                // $pdf->Output();
                $pdf->Output(utf8_decode('Vikarie_3057').'_'.$this_customer.'_'.date('ymdHi').'.pdf', 'D');
                exit();
            }
        }
    }
    else if($selected_all_customers){
        //check multiple customers available
        $all_customer_details = $equipment->customers_under_leave_employee($_POST['month'], $_POST['year']);
        if(count($all_customer_details) > 0){

            $pdf = new PDF_customer();

            foreach($all_customer_details as $tmp_cust_details){
                //$tmp_cust_details['customer_id']

                //check multiple employees available
                $all_employee_details = $equipment->employees_leave_under_customer($_POST['month'], $_POST['year'], $tmp_cust_details['customer_id']); 
                if(count($all_employee_details) > 0){
                    foreach($all_employee_details as $tmp_emp_details){
                        //generate PDF
                        $pdf = $dona->Customer_pdf_vikarie_3059_from_sick_report($tmp_cust_details['customer_id'], $tmp_emp_details['employee_id'], $this_year, $this_month, FALSE, $pdf);
                    }
                }
            }
            
            // $pdf->Output();
            $pdf->Output(utf8_decode('Vikarie_3057').'_'.date('ymdHi').'.pdf', 'D');
            exit();
        }
    }
}

$query_string = explode("&", $_SERVER['QUERY_STRING']);
///////////////////////////////////////start//////////////////////////////////////////////////////
$sicks =  '';
$this_year = NULL;
$this_month = NULL;
$this_customer = NULL;
$this_employee = NULL;
if(!empty($query_string) && trim($query_string[0])!='' && trim($query_string[0]) != 'NULL') { $this_year = trim($query_string[0]); }
else {  $this_year = date('Y'); }

if(!empty($query_string) && trim($query_string[1])!='' && trim($query_string[1]) != 'NULL') { $this_month = trim($query_string[1]); }
else {  $this_month = date('m'); }

if(!empty($query_string) && trim($query_string[2])!='' && trim($query_string[2]) != 'NULL') { $this_customer = trim($query_string[2]); }

if(!empty($query_string) && trim($query_string[3])!='' && trim($query_string[3]) != 'NULL' && $this_customer != NULL) { $this_employee = trim($query_string[3]); }

// $selected_all_customers_for_tpl = FALSE;
if($this_customer == 'ALL'){
    $this_customer = NULL;
    $selected_all_customers = TRUE;
    $smarty->assign('selected_all_customers',$selected_all_customers);
}
// $selected_all_employees_for_tpl = FALSE;
if($this_employee == 'ALL'){
    $this_employee = NULL;
    $selected_all_employees = TRUE;
    $smarty->assign('selected_all_employees',$selected_all_employees);
}

$customers = $equipment->customers_under_leave_employee($this_month,$this_year);
// echo "<pre>".print_r($customers, 1)."<pre>"; exit();
$smarty->assign('customers',$customers);

//load default customer if a single customer exists
if($this_customer == NULL && $selected_all_customers != TRUE){
    if(count($customers) == 1) 
        $this_customer = $customers[0]['customer_id'];
}

if($this_customer != NULL){
    $smarty->assign('cust', $this_customer);
    $smarty->assign('flag_cust_access', ($obj_customer->is_customer_accessible($this_customer) ? 1 : 0));   //prevent manual typing on URL
    
    $employees = $equipment->employees_leave_under_customer($this_month,$this_year,$this_customer); 
    $smarty->assign('employees',$employees);
    // echo "<pre>".print_r($employees, 1)."<pre>"; exit();
    
    $this_employee__ = $this_employee;
    if($this_employee == NULL && $selected_all_employees != TRUE){
        if(count($employees) == 1) $this_employee__ = $employees[0]['employee_id'];
    }

    //get Kollectival details from fkkn form (section 5 - table 'fkkn_form_defaults')
    $fkkn_form_defaults = $dona->check_exists_fkkn_form_defaults($this_customer, $this_employee__, TRUE);
    if(!empty($fkkn_form_defaults)){
        $this_customer_Kollectival_id = $fkkn_form_defaults[0]['bargaining'];
        $this_customer_Kollectival_name = '';
        if($this_customer_Kollectival_id == 6)  //other collectival
            $this_customer_Kollectival_name = $fkkn_form_defaults[0]['other_bargaining_text'];
        else    //get it from config by using kollectival id
            $this_customer_Kollectival_name = $customer_kollektivavtal_labels[$this_customer_Kollectival_id];
        $smarty->assign('customer_Kollectival_name',$this_customer_Kollectival_name);
    }
    
    //get sick form defaults
    $sick_form_defaults = $obj_customer->get_sick_form_defaults($this_customer);
    if(!empty($sick_form_defaults)){
        $sick_form_defaults = $sick_form_defaults[0];
        $check_box_values = explode('||', $sick_form_defaults['check_values']);
        $fullmakt_values = explode('||', $sick_form_defaults['fullmakt']);
        $sick_form_defaults['checkbox_values'] = array('chkBifogas1' => $check_box_values[0], 'chkBifogas2' => $check_box_values[1], 'chkBifogas3' => $check_box_values[2], 'chkBifogas4' => $check_box_values[3]);
        $sick_form_defaults['fullmakt_values'] = array('fullmakt1' => $fullmakt_values[0], 'fullmakt2' => $fullmakt_values[1]);
        
        $smarty->assign('sick_form_defaults',$sick_form_defaults);
    }
}


//load default customer if a single customer exists
if($this_employee == NULL && $selected_all_employees != TRUE){
    if(count($employees) == 1) 
        $this_employee = $employees[0]['employee_id'];
}

$form_reference_number = '';

if($this_employee != NULL){
    $obj_convertor = new Converter(array(),array(), $this_year);

    $smarty->assign('emp', $this_employee);
    $inconvenient_process_obj = new inconvenient();

    // $month_start_date   = date('Y-m-01', strtotime("$this_year-$this_month-01")); 
    // $month_end_date     = date('Y-m-t', strtotime($month_start_date)); 
    
    // $all_leave_works    = $dona->get_employee_leaved_timetable_works($this_employee, $this_year, $this_month, $this_customer);
    $all_leave_works    = $dona->get_employee_leaved_timetable_works($this_employee, $this_year, $this_month);
    $all_leave_works_grouped = $obj_general->grouping_array_by_attribute($all_leave_works, 'date');
    $vikaries           = $equipment->relations_leave_employee($this_month, $this_year, $this_customer, $this_employee, FALSE);    //for vikarie table in html
    // $vikaries           = $dona->get_all_vikaries_btwn_dates($month_start_date, $month_end_date, $this_customer, $this_employee);
    $list_relations     = $dona->crop_vikarie_slots_based_on_its_parent($vikaries, $all_leave_works_grouped, $this_customer);
    $updated_relations  = $dona->attach_employee_age($list_relations);
    $sel_employee_age   = $dona->attach_employee_age(array(array('employee_id' => $this_employee)));
    $sicks              = $dona->get_pdf_sicks($this_employee, $this_customer);

    if(!empty($updated_relations)){ //to calculate total vikarie hours
        $total_vikari_hours = 0;
        foreach ($updated_relations as $key => $this_relation){
            // $updated_relations[$key]['tot_time'] = $equipment->time_user_format($equipment->time_difference($this_relation['time_from'], $this_relation['time_to']), 100);
            $total_vikari_hours = $equipment->time_sum($total_vikari_hours, $equipment->time_difference($this_relation['time_from'], $this_relation['time_to']));
        }
        $smarty->assign('total_vikari_hours',$equipment->time_user_format($total_vikari_hours, 100));
    }
    //echo "<pre>";print_r($list_relations);exit();
    $smarty->assign('sel_employees_age',$sel_employee_age[0]['age']);
    $smarty->assign('relations', $updated_relations);
    // exit('fdfg');
    $company = $dona->get_company_directory($_SESSION['company_id']);
    $smarty->assign('company', $company['upload_dir']);
    
    $day = $this_year.'-'.$this_month.'-01';
    $nomal_salary = $inconvenient_process_obj->get_salary($day, $this_employee, 'normal');
    $insurance = $inconvenient_process_obj->get_salary($day, $this_employee, 'insurance');
    $smarty->assign('employee_normal_salary', $nomal_salary);
    $smarty->assign('insurance_ordinary', $insurance);
    
    $dona->leavePeriod_year = $this_year;
    $dona->leavePeriod_month = $this_month;
    $dona->leave_employee = $this_employee;
    $dona->leave_customer = $this_customer;
    
    //calculate form reference number
    $selected_customer_detail = $obj_customer->customer_detail($this_customer);
    $form_reference_number = $form_reference_number_base = $selected_customer_detail['code']. ' : ';
   
    // $all_leave_works_grouped= $obj_general->grouping_array_by_attribute($all_leave_works, 'date');
    $karense_dataset        = $obj_convertor->get_karens_data($this_employee, null, $all_leave_works_grouped, $date_type='YEAR_MONTH', $this_month, $this_year, null, 0.00, 24.00, FALSE,'FROM_FORM');
    if($karense_dataset) $karense_dataset = array_values($karense_dataset);
    // echo "<pre>".print_r($karense_dataset, 1)."</pre>"; exit();
    $actual_karens = 0;
    $Q_work_dates = array();
    if($karense_dataset)
    {
        $actual_karens = $karense_dataset[0]['actual_karens'];
        foreach ($karense_dataset as $karense_data){
            if(isset($karense_data['karens']) && !empty($karense_data['karens']))
                $Q_work_dates[] = key($karense_data['karens']); //get first key name from the array
        }
    }

    // $qualifying_leave_works = $qualifying_leave_works__['Qualifying_days'];
    // foreach ($qualifying_leave_works as $Qworks)
    //     $Q_work_dates[] = $Qworks['date'];


    if (!empty($Q_work_dates))
        $form_reference_number .= date('m-d', strtotime($Q_work_dates[0]));
   // echo "<pre>".print_r($all_leave_works, 1)."</pre>";
    
    $reference_numbers_set = array();
    if(!empty($all_leave_works) && !empty($Q_work_dates)){
        if($Q_work_dates[0] != $all_leave_works[0]['date']){
            $reference_numbers_set[] = array('date' => '', 'ref' => $form_reference_number_base);
        }
        
        foreach($Q_work_dates as $qd){
            $reference_numbers_set[] = array('date' => $qd, 'ref' => $form_reference_number_base . date('m-d', strtotime($qd)));
        }
    } else {
        $reference_numbers_set[] = array('date' => '', 'ref' => $form_reference_number_base);
    }
   // echo "<pre>".print_r($reference_numbers_set, 1)."</pre>";
}
$ker_str = "";
if(count($karense_dataset) > 0)
{
    foreach($karense_dataset as $kKey1 => $karense_days)
    {
       
        if($karense_days['karens']){
            $ker_str.= key($karense_days['karens']).'&nbsp;&nbsp;<span class="label">'.'('.number_format($karense_days['actual_karens'],2).')</span>&nbsp;&nbsp;';
        }

    }
}
   
//echo "<pre>";print_r($karense_dataset);

$smarty->assign('actual_karens', $actual_karens);   //$actual_karens
$smarty->assign('ker_str', $ker_str);   //$karense_dataset
$smarty->assign('form_reference_number', $form_reference_number);   //contains only first karense date
$smarty->assign('form_reference_number_set', $reference_numbers_set);

$show_work_report_button = ($this_customer != NULL && $this_employee != NULL ? TRUE : FALSE);
$smarty->assign('show_work_report_button',$show_work_report_button);


$company_details = $obj_company->get_company_detail($_SESSION['company_id']);
$smarty->assign('company_fk_kr_per_time',$company_details['fk_kr_per_time']);
$smarty->assign('company_bank_account',$company_details['bank_account']);
    
$smarty->assign('report_year',$this_year);
$smarty->assign('month',$this_month);
$smarty->assign('login_company_id', $_SESSION['company_id']);
//$smarty->assign('login_company_id', 8); //optimal

/////////////////////////////////////////end////////////////////////////////////////////////////

$smarty->assign('below_25', BELOW_25);
$smarty->assign('btwn_25_65', BTWN_25_65);
$smarty->assign('above_65', ABOVE_65);
//$smarty->assign('sick_pay', SICK_PAY);
//$smarty->assign('compensation_paid', COMPENSATION_PAID);

$smarty->assign('sicks', $sicks);
$smarty->display('leave_payment_pdf_edited.tpl');
//$smarty->display('extends:layouts/dashboard.tpl|leave_payment_pdf_edited.tpl');
?>