<?php
require_once('class/setup.php');
require_once('class/company.php');
require_once('class/dona.php');
require_once('class/customer.php');
require_once('plugins/message.class.php');
$smarty = new smartySetup(array('company.xml','button.xml','user.xml','month.xml','messages.xml','tooltip.xml', 'gdschema.xml'));

$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 9));
$company = new company();
$dona = new dona();
$customer = new customer();
$messages = new message();

$detail= $company->get_company_detail($_SESSION['company_id']);
// echo "<pre>". print_r($detail, 1)."</pre>";
// exit('fg');
$company->logo = $detail['logo'];
$thisdir = getcwd();
$upload_path = $thisdir."/company_logo/";
$error = 0;
if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != "") {

    $file_name = $_FILES['file']['name'];
    $company->logo = $file_name;
    $size = filesize($_FILES['file']['tmp_name']);
    $str = str_replace(" ", "_", $file_name );
        
    $extension = $customer->get_file_extension($str);
    if ($extension == "jpg" || $extension == "png" ) {

        //$upload_path = "document_decision/";
        $file_path = $upload_path . $str;

        if(file_exists($file_path)){
                $num = 1;
                $x = 0;
                $str1 = explode('.',$str);
                $str = $str1[0]."_".$num.".".$str1[1];
                $file_path = $upload_path . $str;
                while($x == 0){
                    if(file_exists($file_path)){                                            
                        $num++;
                        $str1 = explode('.',$str);
                        $str1[0] = substr($str1[0],0,-2);
                        $str = $str1[0]."_".$num.".".$str1[1];
                        $file_path = $upload_path . $str;
                    }
                    else{
                        $x++;
                    }
                }
                $company->logo = $str;
                move_uploaded_file($_FILES['file']['tmp_name'], $file_path);
        }
        else{
            $company->logo = $str;
            move_uploaded_file($_FILES['file']['tmp_name'], $file_path);
        }
    } else {
        $messages->set_message('fail', 'file_selected_supported_extension');
        $error = "1";
    }
}
if($error == 0){
    if(isset($_POST['name'])){
        if($_POST['sort_by'] == 1)
            $sort_by = 1;
        else {
            $sort_by = 2;
        }
        $company->name = $_POST['name'];
        //$company->org_no = str_replace("-", "", $_POST['org_no']);
        $company->org_no = str_replace(array("-", " ", ",", ".", "_"), "", strip_tags($_POST['org_no']));
        $company->address = $_POST['address'];
        $company->box = trim($_POST['company_box']);
        $company->city = $_POST['city'];
        $company->email = $_POST['email'];
        $company->phone = $_POST['phone'];
        $company->comp_city = $_POST['city'];
        $company->zipcode = $_POST['zipcode'];
        $company->mobile = $_POST['mobile'];
        $company->website = $_POST['website'];
        $company->land_code = $_POST['land_code'];
        $company->contact_person1 = $_POST['contact_person1'];
        $company->contact_person2 = $_POST['contact_person2'];
        $company->contact_person1_email = $_POST['contact_person1_email'];
        $company->contact_person2_email = $_POST['contact_person2_email'];
        $company->salary_system= $_POST['salary_system'];
        $company->bill_status = $detail['billing_status'];
        $company->upload_dir = $detail['upload_dir'];
//        $company->price = $detail['price_per_customer'];
//        $company->price_per_sms = $detail['price_per_sms'];
        $company->weekly_hour = (float) trim($_POST['weekly_hour']);
        $company->max_daily_hour = (float) $dona->time_to_sixty($_POST['max_daily_hour']);
        $company->min_daily_rest = (float) $dona->time_to_sixty($_POST['min_daily_rest']);
        $company->montly_oncall_hour = (float) trim($_POST['montly_oncall_hour']);
        $company->check_atl = (isset($_POST['check_atl']) && trim($_POST['check_atl']) == 1 ? 1 : 0);
        $company->check_contract = (isset($_POST['check_contract']) && trim($_POST['check_contract']) == 1 ? 1 : 0);
        $company->signing_mail = (isset($_POST['signing_mail']) && trim($_POST['signing_mail']) == 1 ? 1 : 0);
        $company->bank_account = (trim($_POST['bank_account']) != '' ? trim($_POST['bank_account']) : NULL);
        $company->fk_kr_per_time = (trim($_POST['fk_kr_per_time']) != '' ? ((float) trim($_POST['fk_kr_per_time'])) : NULL);
        $company->kn_kr_per_time = (trim($_POST['kn_kr_per_time']) != '' ? ((float) trim($_POST['kn_kr_per_time'])) : NULL);
        $company->leave_in_advance = $_POST['leave_in_advance'];
        if($_POST['leave_in_advance'] == 1){
        $company->sem_year_start_month = $_POST['sem_start_month'] != "" ? $_POST['sem_start_month'] : NULL;
        }else{
         $company->sem_year_start_month = NULL;   
        }
        $company->sem_year_start_month = $_POST['sem_start_month'] != "" ? $_POST['sem_start_month'] : NULL;
        $company->use_inconvenient = (isset($_POST['chk_inconvenient_on']) && trim($_POST['chk_inconvenient_on']) == 1 ? 1 : 0);
        $company->candg = (isset($_POST['candg']) && trim($_POST['candg']) == 1 ? 1 : 0);
        $company->candg_on = (isset($_POST['candg_on']) && trim($_POST['candg_on']) == 1 ? 1 : 0);
        $company->include_karense_salary = (isset($_POST['chk_include_karense_salary']) && trim($_POST['chk_include_karense_salary']) == 1 ? 1 : 0);
        $company->include_sem_2_14_oncall_salary = (isset($_POST['chk_include_sem_2_14_oncall_salary']) && (trim($_POST['chk_include_sem_2_14_oncall_salary']) === 0 || trim($_POST['chk_include_sem_2_14_oncall_salary']) === '0') ? 0 : 1);
        $start_time = $_POST['start_time']; 
        if($_POST['start_time'] == null || $_POST['start_time'] == "")
            $start_time = 0.00;
        $company->company_start_day             = $_POST['start_day'].$dona->time_to_sixty($start_time);
        $company->candg_break                   = (isset($_POST['candg_break_switch']) && trim($_POST['candg_break_switch']) == 1 ? $_POST['slider_txt_candg_break'] : 0);
        $company->apply_max_karens              = (isset($_POST['apply_max_karens']) && trim($_POST['apply_max_karens']) == 1 ? 1 : 0);
        $company->day_light_saving              = (isset($_POST['day_light_saving']) && trim($_POST['day_light_saving']) == 1 ? 1 : 0);
        $company->sms_pw_recovery               = (isset($_POST['sms_pw_recovery']) && trim($_POST['sms_pw_recovery']) == 1 ? 1 : 0);
        $company->sick_15_90_oncall             = (isset($_POST['sick_15_90_oncall']) && trim($_POST['sick_15_90_oncall']) == 1 ? 1 : 0);
        $company->contract_auto_renewal         = (isset($_POST['contract_auto_renewal']) && trim($_POST['contract_auto_renewal']) == 1 ? 1 : 0);
        $company->contract_auto_renewal_mail    = ($company->contract_auto_renewal == 1 && isset($_POST['contract_auto_renewal_mail']) && trim($_POST['contract_auto_renewal_mail']) != '' ? trim($_POST['contract_auto_renewal_mail']) : NULL);
        $company->employee_contract_start_month = $_POST['contract_start_month'] != "" ? $_POST['contract_start_month'] : NULL;
        $company->employee_contract_month_start_date    = ($_POST['contract_month_start_date'] != "" &&  $_POST['contract_start_month'] != "") ? $_POST['contract_month_start_date'] : NULL;
        $company->employee_contract_period_length       = $_POST['emp_contract_period_length'] != "" ? $_POST['emp_contract_period_length'] : 6;
        $company->sort_name_by                  = $sort_by;
        $company->vacation_percentage           = ($_POST['vacation_perc'] != "" &&  $_POST['vacation_perc'] != "") ? $_POST['vacation_perc'] : NULL;
        $company->vacation_percentage_slots     = $_POST['vacation_perc_slots'] ? implode('|', array_keys($_POST['vacation_perc_slots'])) : NULL;
        $company->sem_leave_days                = $_POST['sem_leave_days'];
        $company->vab_leave_days                = $_POST['vab_leave_days'];
        $company->fp_leave_days                 = $_POST['fp_leave_days'];
        $company->nopay_leave_days              = $_POST['nopay_leave_days'];
        $company->other_leave_days              = $_POST['other_leave_days'];
        $company->include_sick                  = $_POST['include_sick'];
        $company->sick_annex_calculation_mode   = $_POST['sick_annex_calculation_mode'];
        $company->fkkn_split                    = $_POST['fkkn_split'];
        $company->contact_mail_send             = (isset($_POST['contact_mail_send']) && trim($_POST['contact_mail_send']) == 1 ? 1 : 0);
        $company->kfo                           = $_POST['kfo'];
        $company->karens_full                   = $_POST['karens_full'];
        $company->karens                        = $_POST['karens'];
        $company->begin_transaction();
        //echo "<pre>".print_r($_POST, 1)."</pre>";
        if($company->company_update($_SESSION['company_id'],1)){
            //echo "<pre>".print_r($company->query_error_details, 1)."</pre>";
            $employee_update_field = array();
            $employee_update_values = array();

            $privilege_general_update_field = array();
            $privilege_general_update_values = array();

            if($company->sem_leave_days != $detail['sem_leave_days']){
                $employee_update_field[] = 'sem_leave_days';
                $employee_update_values[] = $company->sem_leave_days;
            }
            if($company->vab_leave_days != $detail['vab_leave_days']){
                $employee_update_field[] = 'vab_leave_days';
                $employee_update_values[] = $company->vab_leave_days;
            }
            if($company->fp_leave_days != $detail['fp_leave_days']){
                $employee_update_field[] = 'fp_leave_days';
                $employee_update_values[] = $company->fp_leave_days;
            }
            if($company->nopay_leave_days != $detail['nopay_leave_days']){
                $employee_update_field[] = 'nopay_leave_days';
                $employee_update_values[] = $company->nopay_leave_days;
            }
            if($company->other_leave_days != $detail['other_leave_days']){
                $employee_update_field[] = 'other_leave_days'; 
                $employee_update_values[] = $company->other_leave_days;
            }
            if($company->candg_on != $detail['candg_on']){
                
                $privilege_general_update_field[] = 'candg_on'; 
                $privilege_general_update_values[] = $company->candg_on;
                if($company->candg == $detail['candg']){    
                    if($company->candg_on == 1){
                        if($company->candg == 0){
                            $privilege_general_update_field[] = 'candg_wi';
                            $privilege_general_update_field[] = 'candg_wo';
                            $privilege_general_update_values[] = 1;
                            $privilege_general_update_values[] = 0;
                        }else{
                            $privilege_general_update_field[] = 'candg_wi';
                            $privilege_general_update_field[] = 'candg_wo';
                            $privilege_general_update_values[] = 0;
                            $privilege_general_update_values[] = 1;
                        }
                    }
                }
            }
            if($company->candg != $detail['candg_on']){
                if($company->candg == 0){
                    $privilege_general_update_field[] = 'candg_wi';
                    $privilege_general_update_field[] = 'candg_wo';
                    $privilege_general_update_values[] = 1;
                    $privilege_general_update_values[] = 0;
                }else{
                    $privilege_general_update_field[] = 'candg_wi';
                    $privilege_general_update_field[] = 'candg_wo';
                    $privilege_general_update_values[] = 0;
                    $privilege_general_update_values[] = 1;
                }
            }
            $emp_flag = 0;
            
            if(!empty($employee_update_field)){
                if($company->update_employee_against_company($employee_update_field, $employee_update_values))
                    $emp_flag = 1;
            }else{
                $emp_flag = 1;
            }

            if($emp_flag == 1){
                if(!empty($privilege_general_update_field)){
                    if($company->update_privilege_against_company('general', $privilege_general_update_field, $privilege_general_update_values))
                        $emp_flag = 1;
                    else
                        $emp_flag = 0;
                }else{
                    $emp_flag = 1;
                }
            }


            if($emp_flag){
                $week_day = array($smarty->translate['monday'],$smarty->translate['tuesday'],$smarty->translate['wednesday'],$smarty->translate['thursday'],$smarty->translate['friday'],$smarty->translate['saturday'],$smarty->translate['sunday']);
                $vacation_index = explode('|', $company->vacation_percentage_slots);
                $old_vacation_index = explode('|',$detail['vacation_percentage_slots']);
                $vacation_slots = array($smarty->translate['normal'],$smarty->translate['travel'],$smarty->translate['break'],$smarty->translate['oncall'],$smarty->translate['overtime'],$smarty->translate['qual_overtime'],$smarty->translate['more_time'],$smarty->translate['some_other_time'],$smarty->translate['training_time'],$smarty->translate['call_training'],$smarty->translate['personal_meeting'],$smarty->translate['voluntary'],$smarty->translate['complementary'],$smarty->translate['complementary_oncall'],$smarty->translate['more_oncall'],$smarty->translate['oncall_standby'],$smarty->translate['work_for_dismissal'],$smarty->translate['work_for_dismissal_oncall']);
                $salary_system = array($smarty->translate['salary_type1'],$smarty->translate['salary_type2'],$smarty->translate['salary_type3'],$smarty->translate['salary_type4'],$smarty->translate['salary_type5'],$smarty->translate['salary_type6'],$smarty->translate['salary_type7']);
                $month = array($smarty->translate['january'],$smarty->translate['february'],$smarty->translate['march'],$smarty->translate['april'],$smarty->translate['may'],$smarty->translate['june'],$smarty->translate['july'],$smarty->translate['august'],$smarty->translate['september'],$smarty->translate['october'],$smarty->translate['november'],$smarty->translate['december']);
                $_SESSION['company_sort_by'] = $company->sort_name_by;
                $messages->set_message('success', 'company_detail_editted_successfully');

                $msg  = $company->name != $detail['name'] ? $smarty->translate['company_name']. ' : ' .$company->name. ($detail['name'] != '' ? '('.$detail['name'].')' : '' ).'<br>' : '';
                $msg .= $company->org_no != $detail['org_no'] ? $smarty->translate['organization_number']. ' : ' .$company->org_no. ($detail['org_no'] != '' ? '('.$detail['org_no'].')' : '' ).'<br>' : '';
                $msg .= $company->address != $detail['address'] ? $smarty->translate['company_address_new']. ' : ' .$company->address. ($detail['address'] != '' ? '('.$detail['address'].')' : '' ).'<br>' : '';
                $msg .= $company->box != $detail['box'] ? $smarty->translate['company_box']. ' : ' .$company->box. ($detail['box'] != '' ? '('.$detail['box'].')' : '' ).'<br>' : '';
                $msg .= $company->city != $detail['city'] ? $smarty->translate['city']. ' : ' .$company->city. ($detail['city'] != '' ? '('.$detail['city'].')' : '' ).'<br>' : '';
                $msg .= $company->email != $detail['email'] ? $smarty->translate['company_email_new']. ' : ' .$company->email. ($detail['email'] != '' ? '('.$detail['email'].')' : '' ).'<br>' : '';
                $msg .= $company->phone != $detail['phone'] ? $smarty->translate['company_phone_new']. ' : ' .$company->phone. ($detail['phone'] != '' ? '('.$detail['phone'].')' : '' ).'<br>' : '';
                $msg .= $company->comp_city != $detail['city'] ? $smarty->translate['city']. ' : ' .$company->comp_city. ($detail['city'] != '' ? '('.$detail['city'].')' : '' ).'<br>' : '';
                $msg .= $company->zipcode != $detail['zipcode'] ? $smarty->translate['company_zipcode_new']. ' : ' .$company->zipcode. ($detail['zipcode'] != '' ? '('.$detail['zipcode'].')' : '' ).'<br>' : '';
                $msg .= $company->mobile != $detail['mobile'] ? $smarty->translate['company_mobile_new']. ' : ' .$company->mobile. ($detail['mobile'] != '' ? '('.$detail['mobile'].')' : '' ).'<br>' : '';
                $msg .= $company->website != $detail['website'] ? $smarty->translate['company_website']. ' : ' .$company->website. ($detail['website'] != '' ? '('.$detail['website'].')' : '' ).'<br>' : '';
                $msg .= $company->land_code != $detail['land_code'] ? $smarty->translate['company_land_code_new']. ' : ' .$company->land_code. ($detail['land_code'] != '' ? '('.$detail['land_code'].')' : '' ).'<br>' : '';
                $msg .= $company->contact_person1 != $detail['contact_person1'] ? $smarty->translate['contact_person_1']. ' : ' .$company->contact_person1. ($detail['contact_person1'] != '' ? '('.$detail['contact_person1'].')' : '' ).'<br>' : '';
                $msg .= $company->contact_person2 != $detail['contact_person2'] ? $smarty->translate['contact_person_2']. ' : ' .$company->contact_person2. ($detail['contact_person2'] != '' ? '('.$detail['contact_person2'].')' : '' ).'<br>' : '';
                $msg .= $company->contact_person1_email != $detail['contact_person1_email'] ? $smarty->translate['contact_person_email_1']. ' : ' .$company->contact_person1_email. ($detail['contact_person1_email'] != '' ? '('.$detail['contact_person1_email'].')' : '' ).'<br>' : '';
                $msg .= $company->contact_person2_email != $detail['contact_person2_email'] ? $smarty->translate['contact_person_email_2']. ' : ' .$company->contact_person2_email. ($detail['contact_person2_email'] != '' ? '('.$detail['contact_person2_email'].')' : '' ).'<br>' : '';
                
                $msg .= $company->salary_system != $detail['salary_system'] ? $smarty->translate['salary_system']. ' : ' .$salary_system[$company->salary_system-1]. ($detail['salary_system'] != '' ? '('.$salary_system[$detail['salary_system']-1].')' : '' ).'<br>' : '';
                $msg .= $company->weekly_hour != $detail['weekly_hour'] ? $smarty->translate['weekly_hour']. ' : ' .$company->weekly_hour. ($detail['weekly_hour'] != '' ? '('.$detail['weekly_hour'].')' : '' ).'<br>' : '';
                $msg .= $company->max_daily_hour != $detail['max_daily_hour'] ? $smarty->translate['max_daily_hour']. ' : ' .$company->max_daily_hour. ($detail['max_daily_hour'] != '' ? '('.$detail['max_daily_hour'].')' : '' ).'<br>' : '';
                $msg .= $company->min_daily_rest != $detail['min_daily_rest'] ? $smarty->translate['min_daily_rest']. ' : ' .$company->min_daily_rest. ($detail['min_daily_rest'] != '' ? '('.$detail['min_daily_rest'].')' : '' ).'<br>' : '';
                $msg .= $company->montly_oncall_hour != $detail['monthly_oncall_hour'] ? $smarty->translate['monthly_oncall_hour']. ' : ' .$company->montly_oncall_hour. ($detail['monthly_oncall_hour'] != '' ? '('.$detail['monthly_oncall_hour'].')' : '' ).'<br>' : '';
                $msg .= $company->check_atl != $detail['atl_check'] ? $smarty->translate['check_atl']. ' : ' .($company->check_atl == 1 ? $smarty->translate['on'] : $smarty->translate['off']) . ($detail['atl_check'] != '' ? ($detail['atl_check'] == 1 ? '('.$smarty->translate['on'].')' : '('.$smarty->translate['off'] .')') : '' ).'<br>' : '';

                $msg .= $company->check_contract != $detail['contract_exceed_check'] ? $smarty->translate['check_contract']. ' : ' .($company->check_contract  == 1 ? $smarty->translate['on'] : $smarty->translate['off']). ($detail['contract_exceed_check'] != '' ? ($detail['contract_exceed_check'] == 1 ? '('.$smarty->translate['on'].')' : '('.$smarty->translate['off'] .')') : '' ).'<br>' : '';
                $msg .= $company->signing_mail != $detail['signing_mail'] ? $smarty->translate['signing_mail']. ' : ' .($company->signing_mail == 1 ? $smarty->translate['on'] : $smarty->translate['off']). ($detail['signing_mail'] != '' ? ($detail['signing_mail'] == 1 ? '('.$smarty->translate['on'].')' : '('.$smarty->translate['off'] .')') : '' ).'<br>' : '';
                $msg .= $company->bank_account != $detail['bank_account'] ? $smarty->translate['bank_account']. ' : ' .$company->bank_account. ($detail['bank_account'] != '' ? '('.$detail['bank_account'].')' : '' ).'<br>' : '';
                $msg .= $company->fk_kr_per_time != $detail['fk_kr_per_time'] ? $smarty->translate['kr_per_time']. ' : ' .$company->fk_kr_per_time. ($detail['fk_kr_per_time'] != '' ? '('.$detail['fk_kr_per_time'].')' : '' ).'<br>' : '';
                $msg .= $company->kn_kr_per_time != $detail['kn_kr_per_time'] ? $smarty->translate['kr_per_time']. ' : ' .$company->kn_kr_per_time. ($detail['kn_kr_per_time'] != '' ? '('.$detail['kn_kr_per_time'].')' : '' ).'<br>' : '';
                $msg .= $company->leave_in_advance != $detail['leave_in_advance'] ? $smarty->translate['leave_in_advance']. ' : ' .($company->leave_in_advance  == 1 ? $smarty->translate['on'] : $smarty->translate['off']). ($detail['leave_in_advance'] != '' ? ($detail['leave_in_advance'] == 1 ? '('.$smarty->translate['on'].')' : '('.$smarty->translate['off'] .')') : '' ).'<br>' : '';
                $msg .= $company->sem_year_start_month != $detail['sem_year_start_month'] ? $smarty->translate['sem_start_month']. ' : ' .$month[$company->sem_year_start_month-1]. ($detail['sem_year_start_month'] != '' ? '('.$month[$detail['sem_year_start_month']-1].')' : '' ).'<br>' : '';
                $msg .= $company->use_inconvenient != $detail['inconvenient_on'] ? $smarty->translate['use_inconvenient']. ' : ' .($company->use_inconvenient == 1 ? $smarty->translate['on'] : $smarty->translate['off']). ($detail['inconvenient_on'] != '' ? ($detail['inconvenient_on'] == 1 ? '('.$smarty->translate['on'].')' : '('.$smarty->translate['off'] .')') : '' ).'<br>' : '';
                $msg .= $company->candg != $detail['candg'] ? $smarty->translate['candg_with_slots']. ' : ' .($company->candg == 1 ? $smarty->translate['on'] : $smarty->translate['off']). ($detail['candg'] != '' ? ($detail['candg'] == 1 ? '('.$smarty->translate['on'].')' : '('.$smarty->translate['off'] .')') : '' ).'<br>' : '';
                $msg .= $company->candg_on != $detail['candg_on'] ? $smarty->translate['candg_on_off']. ' : ' .($company->candg_on == 1 ? $smarty->translate['on'] : $smarty->translate['off']). ($detail['candg_on'] != '' ? ($detail['candg_on']  == 1 ? '('.$smarty->translate['on'].')' : '('.$smarty->translate['off'] .')') : '' ).'<br>' : '';
                $msg .= $company->include_karense_salary != $detail['include_karense_salary'] ? $smarty->translate['include_karense_salary']. ' : ' .($company->include_karense_salary == 1 ? $smarty->translate['on'] : $smarty->translate['off']). ($detail['include_karense_salary'] != '' ? ($detail['include_karense_salary']  == 1 ? '('.$smarty->translate['on'].')' : '('.$smarty->translate['off'] .')')  : '' ).'<br>' : '';
                $msg .= $company->include_sem_2_14_oncall_salary != $detail['include_sem_2_14_oncall_salary'] ? $smarty->translate['include_sem_2_14_oncall_salary']. ' : ' .($company->include_sem_2_14_oncall_salary == 1 ? $smarty->translate['on'] : $smarty->translate['off']). ($detail['include_sem_2_14_oncall_salary'] != '' ? ($detail['include_sem_2_14_oncall_salary']  == 1 ? '('.$smarty->translate['on'].')' : '('.$smarty->translate['off'] .')') : '' ).'<br>' : '';
                
                if($_POST['start_time'] == null || $_POST['start_time'] == "")
                    $start_time = 0.00;


                $msg .= $company->company_start_day != $detail['start_day'] ? $smarty->translate['company_start_day']. ' : ' .$week_day[$company->company_start_day[0]-1].':'.substr($company->company_start_day,1) . ($detail['start_day'] != '' ? '('.$week_day[$detail['start_day'][0]-1].':'.substr($company->company_start_day,1).')' : '' ).'<br>' : '';

                $msg .= $company->candg_break != $detail['candg_break'] ? $smarty->translate['come_and_go_break']. ' : ' .($company->candg_break == 0 ? $smarty->translate['off'] : $smarty->translate['on'].':'.$company->candg_break). ($detail['candg_break'] != '' ? ($detail['candg_break']  == 0 ? '('.$smarty->translate['off'].')' : '('.$smarty->translate['on'].':'.$detail['candg_break'].')') : '' ).'<br>' : '';
                $msg .= $company->apply_max_karens != $detail['apply_max_karens'] ? $smarty->translate['apply_max_karens']. ' : ' .($company->apply_max_karens == 1 ? $smarty->translate['on'] : $smarty->translate['off']). ($detail['apply_max_karens'] != '' ? ($detail['apply_max_karens'] == 1 ? '('.$smarty->translate['on'].')' : '('.$smarty->translate['off'] .')') : '' ).'<br>' : '';
                $msg .= $company->day_light_saving != $detail['day_light_saving'] ? $smarty->translate['day_light_saving']. ' : ' .($company->day_light_saving == 1 ? $smarty->translate['on'] : $smarty->translate['off']). ($detail['day_light_saving'] != '' ? ($detail['day_light_saving'] == 1 ? '('.$smarty->translate['on'].')' : '('.$smarty->translate['off'] .')') : '' ).'<br>' : '';

                $msg .= $company->sms_pw_recovery != $detail['recovery_pw_by_mobile'] ? $smarty->translate['sms_pw_recovery']. ' : ' .($company->city == 1 ? $smarty->translate['on'] : $smarty->translate['off']). ($detail['recovery_pw_by_mobile'] != '' ? ($detail['recovery_pw_by_mobile'] == 1 ? '('.$smarty->translate['on'].')' : '('.$smarty->translate['off'] .')') : '' ).'<br>' : '';
                
                $msg .= $company->sick_15_90_oncall != $detail['sick_15_90_oncall'] ? $smarty->translate['sick_15_90_oncall']. ' : ' .($company->sick_15_90_oncall == 1 ? $smarty->translate['on'] : $smarty->translate['off']). ($detail['sick_15_90_oncall'] != '' ? ($detail['sick_15_90_oncall'] == 1 ? '('.$smarty->translate['on'].')' : '('.$smarty->translate['off'] .')') : '' ).'<br>' : '';
                $msg .= $company->contract_auto_renewal != $detail['contract_auto_renewal'] ? $smarty->translate['contract_auto_renewal']. ' : ' .($company->contract_auto_renewal == 1 ? $smarty->translate['on'] : $smarty->translate['off']). ($detail['contract_auto_renewal'] != '' ? ($detail['contract_auto_renewal']  == 1 ? '('.$smarty->translate['on'].')' : '('.$smarty->translate['off'] .')') : '' ).'<br>' : '';
                if($company->contract_auto_renewal == 1){
                    $msg .= $company->contract_auto_renewal_mail != $detail['contract_auto_renewal_mail'] ? $smarty->translate['contract_auto_renewal'].' '.$smarty->translate['email']. ' : ' .$company->contract_auto_renewal_mail. ($detail['contract_auto_renewal_mail'] != '' ? '('.$detail['contract_auto_renewal_mail'].')' : '' ).'<br>' : '';
                }
                $msg .= $company->employee_contract_start_month != $detail['employee_contract_start_month'] ? $smarty->translate['employee_contract_start_month']. ' : ' .$month[$company->employee_contract_start_month-1]. ($detail['employee_contract_start_month'] != '' ? '('.$month[$detail['employee_contract_start_month']-1].')' : '' ).'<br>' : '';
                $msg .= $company->employee_contract_month_start_date != $detail['employee_contract_period_date'] ? $smarty->translate['employee_contract_start_month'].' '.$smarty->translate['date']. ' : ' .$company->employee_contract_month_start_date. ($detail['employee_contract_period_date'] != '' ? '('.$detail['employee_contract_period_date'].')' : '' ).'<br>' : '';
                $msg .= $company->employee_contract_period_length != $detail['employee_contract_period_length'] ? $smarty->translate['employee_contract_period_length']. ' : ' .$company->employee_contract_period_length. ($detail['employee_contract_period_length'] != '' ? '('.$detail['employee_contract_period_length'].')' : '' ).'<br>' : '';

                $msg .= $company->sort_name_by != $detail['sort_name_by'] ? $smarty->translate['sort_by']. ' : ' .($company->sort_name_by == 1 ? $smarty->translate['first_name'] : $smarty->translate['last_name']). ($detail['sort_name_by'] != '' ? ($detail['sort_name_by'] == 1 ? '('.$smarty->translate['first_name'].')' : '('.$smarty->translate['last_name'] .')') : '' ).'<br>' : '';
                $msg .= $company->vacation_percentage != $detail['vacation_percentage'] ? $smarty->translate['vacation_percentage']. ' : ' .$company->vacation_percentage. ($detail['vacation_percentage'] != '' ? '('.$detail['vacation_percentage'].')' : '' ).'<br>' : '';
                
                $flag = array_diff($old_vacation_index,$vacation_index) === array_diff($vacation_index,$old_vacation_index);
                if(!$flag){
                    if(sizeof($vacation_index)>1){
                        $msg .= $smarty->translate['vacation_percentage_slots'].':<br>';
                        foreach ($vacation_index as $key => $value) {
                            $msg .= ' * '.$vacation_slots[$value].'<br>';
                        }
                    }
                }

                $msg .= $company->sem_leave_days != $detail['sem_leave_days'] ? $smarty->translate['SEM_in_days']. ' : ' .($company->sem_leave_days  == 1 ? $smarty->translate['on'] : $smarty->translate['off']). ($detail['sem_leave_days'] != '' ? ($detail['sem_leave_days'] == 1 ? '('.$smarty->translate['on'].')' : '('.$smarty->translate['off'] .')')   : '' ).'<br>' : '';
                $msg .= $company->vab_leave_days != $detail['vab_leave_days'] ? $smarty->translate['VAB_in_days']. ' : ' .($company->vab_leave_days == 1 ? $smarty->translate['on'] : $smarty->translate['off']). ($detail['vab_leave_days'] != '' ? ($detail['vab_leave_days'] == 1 ? '('.$smarty->translate['on'].')' : '('.$smarty->translate['off'] .')') : '' ).'<br>' : '';
                $msg .= $company->fp_leave_days != $detail['fp_leave_days'] ? $smarty->translate['FP_in_days']. ' : ' .($company->fp_leave_days == 1 ? $smarty->translate['on'] : $smarty->translate['off']). ($detail['fp_leave_days'] != '' ? ($detail['fp_leave_days'] == 1 ? '('.$smarty->translate['on'].')' : '('.$smarty->translate['off'] .')') : '' ).'<br>' : '';
                $msg .= $company->nopay_leave_days != $detail['nopay_leave_days'] ? $smarty->translate['NOPAY_in_days']. ' : ' .($company->nopay_leave_days == 1 ? $smarty->translate['on'] : $smarty->translate['off']). ($detail['nopay_leave_days'] != '' ? ($detail['nopay_leave_days'] == 1 ? '('.$smarty->translate['on'].')' : '('.$smarty->translate['off'] .')') : '' ).'<br>' : '';
                $msg .= $company->other_leave_days != $detail['other_leave_days'] ? $smarty->translate['OTHER_in_days']. ' : ' .($company->other_leave_days == 1 ? $smarty->translate['on'] : $smarty->translate['off']). ($detail['other_leave_days'] != '' ? ($detail['other_leave_days']  == 1 ? '('.$smarty->translate['on'].')' : '('.$smarty->translate['off'] .')') : '' ).'<br>' : '';
                $msg .= $company->include_sick != $detail['include_sick'] ? $smarty->translate['include_sick_in_sem_calculation']. ' : ' .($company->include_sick  == 1 ? $smarty->translate['on'] : $smarty->translate['off']). ($detail['include_sick'] != '' ? ($detail['include_sick'] == 1 ? '('.$smarty->translate['on'].')' : '('.$smarty->translate['off'] .')') : '' ).'<br>' : '';
                $msg .= $company->sick_annex_calculation_mode != $detail['sick_annex_calculation_mode'] ? $smarty->translate['sick_annex_calculation_mode']. ' : ' .($company->sick_annex_calculation_mode == 1 ? $smarty->translate['calculation_mode_1'] : $smarty->translate['calculation_mode_2']). ($detail['sick_annex_calculation_mode'] != '' ? ($detail['sick_annex_calculation_mode']== 1 ? '('.$smarty->translate['calculation_mode_1'].')' : '('.$smarty->translate['calculation_mode_2'] .')') : '' ).'<br>' : '';
                $msg .= $company->fkkn_split != $detail['fkkn_split'] ? $smarty->translate['split_fkkn_for_export']. ' : ' .($company->fkkn_split  == 1 ? $smarty->translate['on'] : $smarty->translate['off']). ($detail['fkkn_split'] != '' ? ($detail['fkkn_split'] == 1 ? '('.$smarty->translate['on'].')' : '('.$smarty->translate['off'] .')') : '' ).'<br>' : '';
                $msg .= $company->contact_mail_send != $detail['mail_send_to_contact_person'] ? $smarty->translate['contact_mail_send']. ' : ' .($company->contact_mail_send  == 1 ? $smarty->translate['on'] : $smarty->translate['off']). ($detail['mail_send_to_contact_person'] != '' ? ($detail['mail_send_to_contact_person'] == 1 ? '('.$smarty->translate['on'].')' : '('.$smarty->translate['off'] .')') : '' ).'<br>' : '';
                $mail_subject     = $smarty->translate['mail_subject_company_information_deatails'];
                $msg != '' ? $msg_header = $smarty->translate['mail_body_company_information_deatails_start'].'<br><br>' : '';
                $msg = $msg_header.$msg.'<br>'.$smarty->translate['mail_body_company_information_deatails_end'];


                if($msg){
                    $mailer = new SimpleMail($mail_subject,$msg);
                    $mailer->addSender("cirrus-noreplay@time2view.se");
                    if($detail['mail_send_to_contact_person'] == 1){
                        if($detail['contact_person2_email'] != ''){
                            $mailer->addRecipient($detail['contact_person2_email'], trim($detail['contact_person2']));
                            if($company->contact_person2_email !=  $detail['contact_person2_email']){
                                $mailer->addRecipient($company->contact_person2_email, trim($company->contact_person2_email));
                            }
                            
                        }
                        else if($company_detail['contact_person1_email'] != ''){
                            $mailer->addRecipient($detail['contact_person1_email'], trim($detail['contact_person1']));
                            if($company->contact_person1_email !=  $detail['contact_person1_email']){
                                $mailer->addRecipient($company->contact_person1_email, trim($company->contact_person1_email));
                            }
                        }
                    }
                    $mailer->send();
                }
                $company->commit_transaction();
            }else{
                $messages->set_message('fail', 'company_detail_editting_fail');
                //echo "<pre>2".print_r($company->query_error_details, 1)."</pre>";
                $company->rollback_transaction();
            }
        }else{
            $messages->set_message('fail', 'company_detail_editting_fail');
            //echo "<pre>1".print_r($company->query_error_details, 1)."</pre>";
            $company->rollback_transaction();
        }
    }
}

$smarty->assign('message', $messages->show_message());
$data = $company->get_company_detail($_SESSION['company_id']);
// echo "<pre>".print_r($data,1)."</pre>"; exit();
if(!empty($data) && trim($data['org_no']) != ''){
    $data['org_no'] = str_replace(array("-", " ", ",", ".", "_"), "", strip_tags($data['org_no']));
    $data['org_no'] = substr($data['org_no'], 0, 6) . "-" . substr($data['org_no'], 6);
}
//echo "<pre>".print_r($data, 1)."</pre>"; exit();
$smarty->assign('company_detail', $data);
$smarty->assign('vacation_percentage_slots', trim($data['vacation_percentage_slots']) != '' ? explode('|', $data['vacation_percentage_slots']) : array());
$smarty->assign('setup','1');
$val[0] = substr($data['start_day'],0,1);
$val[1] = substr($data['start_day'],1,5);
$smarty->assign('vals',$val);
$smarty->display('extends:layouts/dashboard.tpl|company_edit.tpl');
//$smarty->display('extends:layouts/dashboard.tpl|temp.tpl');
?>