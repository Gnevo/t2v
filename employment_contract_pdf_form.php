<?php

require_once('class/setup.php');
require_once('class/contract.php');
require_once('class/dona.php');
require_once('class/employee.php');
require_once('class/user.php');
require_once('class/equipment.php');
require_once('plugins/message.class.php');
require_once('class/mail.php');
require_once('class/customer.php');
require_once('class/general.php');
$smarty = new smartySetup(array("contract.xml", "mail.xml", "user.xml", "messages.xml", "button.xml", "month.xml"));
$mesages = new message();
$contract = new contract();
$employee = new employee();
$dona = new dona();
$user = new user();
$equipment = new equipment();
$obj_general = new general();

const NORMAL_HOURS_PER_WEEK = 48;
const ONCALL_HOURS_PER_MONTH = 50;

$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 2,'tabmenu'=>'employee_contract_pdf'));
$customers_names = $contract->get_customers();
$query_string = explode('&', $_SERVER['QUERY_STRING']);

$employee_detail = $employee->employee_detail("'" . $query_string[0] . "'");
// echo '<pre>'.print_r($_SESSION, 1).'</pre>'; 
// exit();
$smarty->assign('employee_detail', $employee_detail);
$smarty->assign('count', count($customers_names));
$smarty->assign('customers', $customers_names);
$smarty->assign('employee_username', $query_string[0]);

// assigning  sort by first or last name
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);

$privilege_general = $employee->get_privileges($_SESSION['user_id'], 2);
$smarty->assign('privilege_general', $privilege_general);
if($privilege_general['employee_settings_contract'] != 1){
    $mesages->set_message('fail', 'permission_denied');
    $obj_general->going_to_startup_view($smarty);
    exit();
}


$dates = $contract->employee_contract_dates($query_string[0]);
$smarty->assign('dates', $dates);

$smarty->assign('employee_role', $user->user_role($query_string[0]));
if (isset($_POST['date'])) {

    $form_action = trim($_POST['action']);
    //if($user->social_security_check($_POST['txtpersonalnummer'])){
    $contract->user = trim($query_string[0]);

    $contract->have_been_agreed = trim($_POST['have_been_agreed']) == 2 ? 2 : 1;
    $contract->date_from = trim($_POST['txtOverenskommelseBefDatum']);
    $contract->date_to = trim($_POST['to_date']) != '' ? trim($_POST['to_date']) : NULL;
    // $contract->customer_name = trim($_POST['txtnamn']) != '' ? trim($_POST['txtnamn']) : NULL;

    $contract->customer_name = trim($_POST['customer_group']) != '' ? trim($_POST['customer_group']) : NULL;
    $contract->customer_social_secutrity = trim($_POST['txtpersonalnummer']);
    $contract->assistanceChecked = isset($_POST['assistanceChecked']) && trim($_POST['assistanceChecked']) == 1 ? trim($_POST['assistanceChecked']) : NULL;
    $contract->other_customer = isset($_POST['other_customer']) && trim($_POST['other_customer']) == 1 ? trim($_POST['other_customer']) : NULL;


    $contract->employmentType = isset($_POST['assistance']) && trim($_POST['assistance']) != '' ? trim($_POST['assistance']) : NULL;
    // echo '<pre>'.print_r($_POST, 1).'</pre>'; exit();
    // if ($_POST['assistance'] == 1) {
    if ($_POST['assistance'] == 1 || $_POST['assistance'] == 2) {
        $contract->probationary_from = trim($_POST['txtAnstFormProvanstallningFrom']) != '' ? trim($_POST['txtAnstFormProvanstallningFrom']) : NULL;
        $contract->probationary_to = trim($_POST['txtAnstFormProvanstallningTom']) != '' ? trim($_POST['txtAnstFormProvanstallningTom']) : NULL;
        /*if ($_POST['txtAnstFormProvanstallningFrom'] == '') {
            $contract->date_from = trim($_POST['txtOverenskommelseBefDatum']) != '' ? trim($_POST['txtOverenskommelseBefDatum']) : NULL;
            $contract->date_to = trim($_POST['to_date']) != '' ? trim($_POST['to_date']) : NULL;
        } else {
            $contract->special_appointment = 1;
            $contract->date_from = trim($_POST['txtAnstFormProvanstallningFrom']) != '' ? trim($_POST['txtAnstFormProvanstallningFrom']) : NULL;
            $contract->date_to = trim($_POST['txtAnstFormProvanstallningTom']) != '' ? trim($_POST['txtAnstFormProvanstallningTom']) : NULL;
        }*/
        if ($_POST['txtAnstFormProvanstallningFrom'] != '' && $contract->have_been_agreed == 1) {
            $contract->special_appointment = 1;
            $contract->date_from = trim($_POST['txtAnstFormProvanstallningFrom']) != '' ? trim($_POST['txtAnstFormProvanstallningFrom']) : NULL;
            $contract->date_to = trim($_POST['txtAnstFormProvanstallningTom']) != '' ? trim($_POST['txtAnstFormProvanstallningTom']) : NULL;
        }
        else if ($_POST['txtAnstFormProvanstallningFrom'] != '' && $contract->have_been_agreed == 2 && $contract->date_from == '') {
            $contract->date_from = trim($_POST['txtAnstFormProvanstallningFrom']) != '' ? trim($_POST['txtAnstFormProvanstallningFrom']) : NULL;
            $contract->date_to = trim($_POST['txtAnstFormProvanstallningTom']) != '' ? trim($_POST['txtAnstFormProvanstallningTom']) : NULL;
        }
    } else
        $contract->probationary_from = $contract->probationary_to = NULL;

    if ($_POST['assistanceChecked'] == 1) {
        $contract->tmp_long_assistance_from = trim($_POST['txtAnstFormVisstidFrom']) != '' ? trim($_POST['txtAnstFormVisstidFrom']) : NULL;
        $contract->tmp_long_assistance_to = trim($_POST['txtAnstFormVisstidTom']) != '' ? trim($_POST['txtAnstFormVisstidTom']) : NULL;
        /*if ($_POST['txtAnstFormVisstidFrom'] == "" || $_POST['txtAnstFormVisstidFrom'] == "0000-00-00") {
            $contract->date_from = trim($_POST['txtOverenskommelseBefDatum']) != '' ? trim($_POST['txtOverenskommelseBefDatum']) : NULL;
            $contract->date_to = trim($_POST['to_date']) != '' ? trim($_POST['to_date']) : NULL;
        } else {
            $contract->date_from = trim($_POST['txtAnstFormVisstidFrom']) != '' ? trim($_POST['txtAnstFormVisstidFrom']) : NULL;
            $contract->date_to = trim($_POST['txtAnstFormVisstidTom']) != '' ? trim($_POST['txtAnstFormVisstidTom']) : NULL;
        }*/
        if ($_POST['txtAnstFormVisstidFrom'] != '' && $contract->have_been_agreed == 1) {
            $contract->special_appointment = 1;
            $contract->date_from = trim($_POST['txtAnstFormVisstidFrom']) != '' ? trim($_POST['txtAnstFormVisstidFrom']) : NULL;
            $contract->date_to = trim($_POST['txtAnstFormVisstidTom']) != '' ? trim($_POST['txtAnstFormVisstidTom']) : NULL;
        }
        else if ($_POST['txtAnstFormVisstidFrom'] != '' && $contract->have_been_agreed == 2 && $contract->date_from == '') {
            $contract->date_from = trim($_POST['txtAnstFormVisstidFrom']) != '' ? trim($_POST['txtAnstFormVisstidFrom']) : NULL;
            $contract->date_to = trim($_POST['txtAnstFormVisstidTom']) != '' ? trim($_POST['txtAnstFormVisstidTom']) : NULL;
        }
    } else
        $contract->tmp_long_assistance_from = $contract->tmp_long_assistance_to = NULL;

    if ($_POST['chkAnstFormVikarieFor'] == 1) {
        $contract->tmp_assistance_for = trim($_POST['txtAnstFormVikarieNamn']);
        $contract->absence_from = trim($_POST['txtAnstFormVikarieFranvaroFrom']);
        $contract->absence_to = trim($_POST['txtAnstFormVikarieFranvaroTom']);
    } else
        $contract->tmp_assistance_for = $contract->absence_from = $contract->absence_to = NULL;

    $contract->open_ended_appointment = trim($_POST['chkAnstFormTillsvidareanstallning']);
    $contract->prevailing_collective = trim($_POST['txtAnstFormTillsvidareanstallningTilltradesdag']);
    $contract->fulltime = in_array(trim($_POST['work_type']), array(1,2)) ? trim($_POST['work_type']) : NULL;
    $contract->part_time = NULL;
    $contract->hours = 0;   // by default
    $contract->monthly_oncall_hours = 0;    // by default
    if ($_POST['work_type'] == 1) {
        /* $nwd = $contract->get_working_days($contract->date_from, $contract->date_to);
          $workin_hours = $nwd * 8;
          $contract->hours = $workin_hours; */
        $contract->hours = 40; //$_POST['normal_week_hr'];
        $contract->monthly_oncall_hours = 0; //$_POST['oncall_hr'];
    } else if ($_POST['work_type'] == 2) {
        //$contract->part_time = $dona->time_to_sixty((float) (trim($_POST['txtArbetstidDeltidTim']).".".trim($_POST['txtArbetstidDeltidMin'])));
        $contract->part_time = (float) (trim($_POST['txtArbetstidDeltidTim']) . "." . trim($_POST['txtArbetstidDeltidMin']));
        /* $diff = $employee->date_difference($contract->date_from, $contract->date_to);
          $tot_week = round($diff / (7 * 24 * 60 * 60)) == 0 ? 1 : round($diff / (7 * 24 * 60 * 60));
          $workin_hours = floor($tot_week * $contract->part_time);
          $contract->hours = $workin_hours; */
        $persentage_of_normal_hours = 0;
        // if($_POST['normal_week_hr'])  {
            $persentage_of_normal_hours = $contract->part_time * 100 / 40; //$_POST['normal_week_hr'];
        // }
        $contract->hours = $contract->part_time;
        $contract->monthly_oncall_hours = 0; //$_POST['oncall_hr'] * $persentage_of_normal_hours / 100;
        $contract->normal_week_hr = 40; //$_POST['normal_week_hr'];
        $contract->oncall_week_hr = 0; //$_POST['oncall_hr'];
    }
    
    if($contract->date_from == ''){
        $contract->date_from = date('Y-m-d');
    }


    $contract->salary_month = trim($_POST['txtArbetstidLonPerManad']);
    $contract->salary_hour = trim($_POST['txtArbetstidLonPerTimme']);
    $contract->incl_salary = trim($_POST['chkArbetstidLonInklSemLon']);
    $contract->excl_salary = trim($_POST['chkArbetstidLonExklSemLon']);
    $contract->incl_wages = trim($_POST['chkArbetstidLonUtbetalasManadsvis']);
    $contract->act_salary = trim($_POST['txtArbetstidLonInkluderarLonerevision']);
    $contract->bank_account = trim($_POST['txtBankkonto']);
    $contract->leave_per_year = trim($_POST['txtSemesterSemesterdagar']);
    $contract->incl_holiday_pay = trim($_POST['chkSemesterLonIngarTimlon']);
    $contract->excl_holiday_pay = trim($_POST['chkSemesterLonIngarEjTimlon']);
    // echo '<pre>'.print_r($_POST, 1).'</pre>'; exit();
    if ($_POST['chkOvrigtOvertid'] == 1)
        $contract->incl_salary_compensation = "1";
    if ($_POST['chkOvrigtRestid'] == 1)
        $contract->incl_salary_compensation .= ",2";
    if ($_POST['chkOvrigtBeredskap'] == 1)
        $contract->incl_salary_compensation .= ",3";
    if ($_POST['chkOvrigtOb'] == 1)
        $contract->incl_salary_compensation .= ",4";
    if ($_POST['chkOvrigtJour'] == 1)
        $contract->incl_salary_compensation .= ",5";
    // $contract->incl_salary_compensation= $_POST['chkOvrigtOvertid'].",".$_POST['chkOvrigtRestid'].",".$_POST['chkOvrigtBeredskap'].",".$_POST['chkOvrigtOb'].",".$_POST['chkOvrigtJour'];
    $contract->special_condition = trim($_POST['txtNotering1']);
    $contract->notes = trim($_POST['txtNotering2']);
    if ($form_action == "save") {

        if($contract->customer_name == NULL){
            $mesages->set_message('fail', 'select_a_customer');
            if (!isset($_POST['date']) || trim($_POST['date']) == "") {   //for redirecting as new entry page
                header('Location: ' . $smarty->url . 'employment/contract/pdf/' . $contract->user . '/new/');
                exit();
            }
        }
        else {
            $exceptional_ids = array();
            if (isset($_POST['date']) && trim($_POST['date']) != "")
                $exceptional_ids[] = trim($_POST['date']);
            // $collided_contracts = $contract->get_collided_contracts($contract->user, $contract->date_from, $contract->date_to, $exceptional_ids, $contract->customer_name);
            $collided_contracts = array();
            if (!empty($collided_contracts)) {
                // echo "<pre>".print_r($collided_contracts, 1)."</pre>"; exit();
                $mesages->set_message('fail', 'contract_collides');
                if (!isset($_POST['date']) || trim($_POST['date']) == "") {   //for redirecting as new entry page
                    header('Location: ' . $smarty->url . 'employment/contract/pdf/' . $contract->user . '/new/');
                    exit();
                }
            } 
            else {
                //echo "<pre>".print_r($contract, 1)."</pre>"; exit();
                if (isset($_POST['date']) && trim($_POST['date']) != "") {
                    if ($contract->employee_contract_full_detail_update($_POST['date'], $_POST['txtpersonalnummer'])){
                        $mesages->set_message('success', 'contract_update_sucess');
                        //**********mail sending ********
                        $obj_customer = new customer();
                        $company_detail = $obj_customer->get_company_detail($_SESSION['company_id']);
                        $login_emp_details = $employee->employee_detail("'" . $_SESSION['user_id'] . "'");
                        // echo '<pre>'.print_r($login_emp_details, 1).'</pre>'; 
                        // echo "<pre>".print_r($employee_detail, 1)."<pre>";
                        // echo "<pre>".print_r($company_detail, 1)."<pre>";
                        // exit();
                        $subject = $smarty->translate[mail_subject_contract_edit];
                        $msg = $smarty->translate[mail_body_contract_edit].' <br> ';
                        $msg .= $smarty->translate[employee].' : ' . trim($employee_detail[0]['last_name']) . ' ' . trim($employee_detail[0]['first_name']) . '<br>';
                        $msg .= $smarty->translate[contract_period].' : ' . $contract->date_from . ' '.$smarty->translate[to].' ' . $contract->date_to ;
                        $msg .= '<br><br>'.$smarty->translate[click_here_to_see_more_details].' : <br> '.$smarty->url . 'employment/contract/pdf/' . $contract->user . '/'.$_POST['date'].'/';
                        $msg .= '<br><br>'.$smarty->translate[click_here_to_read_attached_file].' : <br> '.$smarty->url . 'documents/archive/';
                        $mailer = new SimpleMail($subject, $msg);
                        $mailer->addSender("cirrus-noreplay@time2view.se");
                        // if($employee_detail[0]['email'] != '')
                        //     $mailer->addRecipient($employee_detail[0]['email'], trim($employee_detail[0]['last_name']) . ' ' . trim($employee_detail[0]['first_name']));
                        if($login_emp_details[0]['email'] != '')
                            $mailer->addRecipient($login_emp_details[0]['email'], trim($login_emp_details[0]['last_name']) . ' ' . trim($login_emp_details[0]['first_name']));
                        if($company_detail['contact_person2_email'] != '')
                            $mailer->addRecipient($company_detail['contact_person2_email'], trim($company_detail['contact_person2']));
                        else if($company_detail['contact_person1_email'] != '')
                            $mailer->addRecipient($company_detail['contact_person1_email'], trim($company_detail['contact_person1']));
                        if(/*$employee_detail[0]['email'] != '' || */$login_emp_details[0]['email'] != '' || $company_detail['contact_person2_email'] != '' || $company_detail['contact_person1_email'] != ''){
                            $mailer->send();
                        }

                        $employee_notification = $equipment->get_notification_employee($query_string[0]);
                        if($employee_notification['employee_contract_mail']) {

                            if($employee_detail[0]['email'] != ''){
                                $msg1 = $smarty->translate[mail_body_contract_edit].' <br> ';
                                $msg1 .= $smarty->translate[employee].' : ' . trim($employee_detail[0]['last_name']) . ' ' . trim($employee_detail[0]['first_name']) . '<br>';
                                $msg1 .= $smarty->translate[contract_period].' : ' . $contract->date_from . ' '.$smarty->translate[to].' ' . $contract->date_to ;
                                // $msg1 .= '<br><br>'.$smarty->translate[click_here_to_see_more_details].' : <br> '.$smarty->url . 'employee/administration/';
                                $msg1 .= '<br><br>'.$smarty->translate[click_here_to_see_more_details].' : <br> '.$smarty->url . 'employee/administration/4/'.$_POST['date'].'/' . $contract->user . '/print/';
                                $msg1 .= '<br><br>'.$smarty->translate[click_here_to_read_attached_file].' : <br> '.$smarty->url . 'documents/archive/';

                                $mailer1 = new SimpleMail($subject, $msg1);
                                $mailer1->addRecipient($employee_detail[0]['email'], trim($employee_detail[0]['last_name']) . ' ' . trim($employee_detail[0]['first_name']));
                                $mailer1->send();
                            }
                        }
                    }else
                        $mesages->set_message('fail', 'contract_edit_fail');
                } else {
                    $transaction_flag = TRUE;
                    $contract->begin_transaction();
                    $new_contract_id = '';
                    if ($contract->employee_contract_add()) {
                        $new_contract_id = $contract->get_id();
                        $mesages->set_message('success', 'contract_add_sucess');
                        /*$just_previous_contract = $contract->get_just_previous_contract($contract->customer_name);
                        if (!empty($just_previous_contract)) {
                                //echo "<pre>".print_r($just_previous_contract, 1)."</pre>";
                            if ($just_previous_contract['date_to'] == '') {
                                if (!$contract->update_contract_time_to($just_previous_contract['id']))
                                    $transaction_flag = FALSE;
                            }
                        }*/
                    } else
                        $transaction_flag = FALSE;

                    if ($transaction_flag) {
                        $contract->commit_transaction();

                        //**********mail sending ********
                        $obj_customer = new customer();
                        $company_detail = $obj_customer->get_company_detail($_SESSION['company_id']);
                        $login_emp_details = $employee->employee_detail("'" . $_SESSION['user_id'] . "'");
                        $subject = $smarty->translate[mail_subject_contract_add];
                        $msg = $smarty->translate[mail_body_contract_add].' <br> ';
                        $msg .= $smarty->translate[employee].' : ' . trim($employee_detail[0]['last_name']) . ' ' . trim($employee_detail[0]['first_name']) . '<br>';
                        $msg .= $smarty->translate[contract_period].' : ' . $contract->date_from . ' '.$smarty->translate[to].' ' . $contract->date_to ;
                        $msg .= '<br><br>'.$smarty->translate[click_here_to_see_more_details].' : <br> '.$smarty->url . 'employment/contract/pdf/' . $contract->user . '/'.$new_contract_id.'/';
                        $msg .= '<br><br>'.$smarty->translate[click_here_to_read_attached_file].' : <br> '.$smarty->url . 'documents/archive/';
                        $mailer = new SimpleMail($subject, $msg);
                        $mailer->addSender("cirrus-noreplay@time2view.se");
                        if($login_emp_details[0]['email'] != '')
                            $mailer->addRecipient($login_emp_details[0]['email'], trim($login_emp_details[0]['last_name']) . ' ' . trim($login_emp_details[0]['first_name']));
                        if($company_detail['contact_person2_email'] != '')
                            $mailer->addRecipient($company_detail['contact_person2_email'], trim($company_detail['contact_person2']));
                        else if($company_detail['contact_person1_email'] != '')
                            $mailer->addRecipient($company_detail['contact_person1_email'], trim($company_detail['contact_person1']));
                        if(/*$employee_detail[0]['email'] != '' || */$login_emp_details[0]['email'] != '' || $company_detail['contact_person2_email'] != '' || $company_detail['contact_person1_email'] != ''){
                            $mailer->send();
                        }

                        $employee_notification = $equipment->get_notification_employee($query_string[0]);
                        if($employee_notification['employee_contract_mail']) {
                            if($employee_detail[0]['email'] != ''){
                                $msg1 = $smarty->translate[mail_body_contract_add].' <br> ';
                                $msg1 .= $smarty->translate[employee].' : ' . trim($employee_detail[0]['last_name']) . ' ' . trim($employee_detail[0]['first_name']) . '<br>';
                                $msg1 .= $smarty->translate[contract_period].' : ' . $contract->date_from . ' '.$smarty->translate[to].' ' . $contract->date_to ;
                                $msg1 .= '<br><br>'.$smarty->translate[click_here_to_see_more_details].' : <br> '.$smarty->url . 'employee/administration/4/'.$new_contract_id.'/' . $contract->user . '/print/';
                                $msg1 .= '<br><br>'.$smarty->translate[click_here_to_read_attached_file].' : <br> '.$smarty->url . 'documents/archive/';
                                $mailer1 = new SimpleMail($subject, $msg1);
                                $mailer1->addRecipient($employee_detail[0]['email'], trim($employee_detail[0]['last_name']) . ' ' . trim($employee_detail[0]['first_name']));
                                $mailer1->send();
                            }
                        }
                        header('Location: ' . $smarty->url . 'employment/contract/pdf/' . $contract->user . '/' . $new_contract_id . '/');
                        exit();
                    } else {
                        $contract->rollback_transaction();
                        $mesages->set_message('fail', 'contract_add_fail');
                        header('Location: ' . $smarty->url . 'employment/contract/pdf/' . $contract->user . '/new/');
                        exit();
                    }
                }
            }
        }
    }
    else if ($form_action == "print") {
        // echo $query_string[0].':'. $query_string[1];
        // exit();
        $dona->Employee_contract_pdf($query_string[0], $query_string[1]);
    } 
    else if ($form_action == "unsign") {
        $contract->remove_sign_contract($query_string[1]);
        $datas = $contract->employee_contract_detail($query_string[1]);
        $smarty->assign('contracts', $datas);
        $smarty->assign('opt', explode(',', $datas['incl_salary_compensation']));
    } 
    else {
        $datas = $contract->employee_contract_detail($query_string[1]);
        $smarty->assign('contracts', $datas);
        $smarty->assign('opt', explode(',', $datas['incl_salary_compensation']));
    }
}
$smarty->assign('employee_username', $query_string[0]);
$dates = $contract->employee_contract_dates($query_string[0]);
$smarty->assign('dates', $dates);
// echo '<pre>'.print_r($dates, 1).'</pre>'; exit();
if (isset($query_string[1]) && trim($query_string[1]) != "new") {
    $details = $contract->employee_contract_detail($query_string[1]);
//    $assigned_customers = $details['customer_name'];
    // $assigned_customers_details = $contract->get_customer_details_assigned_customers($details['customer_name']);
    $assigned_customers_details = $equipment->assigned_customers_to_employee($query_string[0]);
    $smarty->assign('assigned_customers', $assigned_customers_details);
    $smarty->assign('contracts', $details);
    $smarty->assign('opt', explode(',', $details['incl_salary_compensation']));
    $smarty->assign('date_from', $query_string[1]);
} else if (!isset($query_string[1])) {
//    $count =count($dates);
//    $last_date = $dates[$count - 1]['id'];    
    $last_date = $dates[0]['id'];
    $details = $contract->employee_contract_detail($last_date);
    $assigned_customers_details = $contract->get_customer_details_assigned_customers($details['customer_name']);
    $smarty->assign('assigned_customers', $assigned_customers_details);
    $smarty->assign('contracts', $details);
    $smarty->assign('opt', explode(',', $details['incl_salary_compensation']));
    $smarty->assign('date_from', $last_date);
} else {
    $assigned_customers_details = $equipment->assigned_customers_to_employee($query_string[0]);
    $smarty->assign('assigned_customers', $assigned_customers_details);
}
$cust_names = '';
for ($i = 0; $i < count($assigned_customers_details); $i++) {
    if ($cust_names == '')
        $cust_names = $assigned_customers_details[$i]['username'];
    else
        $cust_names = $cust_names . "," . $assigned_customers_details[$i]['username'];
}
$smarty->assign('cust_name', $cust_names);
$access_flag = 1;
if ($query_string[0])
    $access_flag = ($employee->is_employee_accessible($query_string[0]) ? 1 : 0);

if(count($dates) == 0 && $query_string[1] == null){
    header('Location: new/');
    exit();
}
$smarty->assign('access_flag', $access_flag);
$smarty->assign('user_roles_login', $user->user_role($_SESSION['user_id']));
$smarty->assign('message', $mesages->show_message());
$smarty->display('extends:layouts/dashboard.tpl|employment_contract_pdf_form.tpl|layouts/sub_layout_employee_tabs.tpl');
?>