<?php
require_once('class/setup.php');
require_once('class/user.php');
require_once('class/employee.php');
require_once('class/customer.php');
require_once('plugins/message.class.php');
require_once('class/report_signing.php');
$smarty = new smartySetup(array('messages.xml',"reports.xml","button.xml","mail.xml",'month.xml'), FALSE);
$user = new user();
$employee = new employee();
$obj_msg = new message();
$obj_cus = new customer();
$obj_rpt = new report_signing();

$month  = trim($_POST['month']);
$year   = trim($_POST['year']);
$report_employee = trim($_POST['emp']);
$report_customer = trim($_POST['customer']);

$smarty->assign('report_month', $month);
$smarty->assign('report_year', $year);
$smarty->assign('now_month', date('m'));
$smarty->assign('now_year', date('Y'));

$signin_sutl        = $obj_rpt->get_report_details($year,$month,$report_employee,$report_customer)['signin_sutl'];

$login_user = $_SESSION['user_id'];
$login_user_role = $user->user_role($login_user);
$smarty->assign('login_user', $login_user);
$smarty->assign('login_user_role', $login_user_role);
$smarty->assign('signin_sutl', $signin_sutl);

$isGLorAdmin = FALSE;
if($_SESSION['user_role'] == 1)
    $isGLorAdmin = TRUE;
elseif($_SESSION['user_role'] != 4) {
    $login_emp_role_in_customer = $employee->get_team_role_of_employee($_SESSION['user_id'], $report_customer);
    $isGLorAdmin = (!empty($login_emp_role_in_customer) && $login_emp_role_in_customer['role'] == 7) ? TRUE : FALSE;
}
$smarty->assign('isGLorAdmin', $isGLorAdmin);

if(isset($_POST['type']) && $_POST['type'] != ""){      //this section is only for remove single sign fields
    $remove_type = $_POST['type'];                      //type --  1 : employee sign, 2 : TL sign, 3: Super TL sign
    $smarty->assign('remove_type', 1);   
    $smarty->assign('remove_emp_type', $remove_type);   
    if($login_user_role == 1 || $isGLorAdmin) {
            $employee->username = $report_employee;
            $employee->rpt_customer = $report_customer;
            $employee->signing_report_date = $year.'-'.$month.'-1';
            if($employee->employee_signing_remove($remove_type))
                $smarty->assign('flg',1);
            else
                $smarty->assign('flg',2);
    }
}else{
    // global $month;
    
    $type_delete        = $_POST['type_delete'];
    
    $employee_detail    = $employee->get_employee_detail($_POST['emp']);
    $employee_name      = $_SESSION['company_sort_by'] == 1 ? $employee_detail['first_name'] . ' ' . $employee_detail['last_name'] : $employee_detail['last_name'] . ' ' . $employee_detail['first_name'];
    
    $deleted_emp_detail = $employee->get_employee_detail($_SESSION['user_id']);
    $deleted_emp_name   = $_SESSION['company_sort_by'] == 1 ? $deleted_emp_detail['first_name'] . ' ' . $deleted_emp_detail['last_name'] : $deleted_emp_detail['last_name'] . ' ' . $deleted_emp_detail['first_name'];
    
    $customer_detail    = $obj_cus->customer_detail($_POST['customer']);
    $customer_name      = $_SESSION['company_sort_by'] == 1 ? $customer_detail['first_name'] . ' ' . $customer_detail['last_name'] : $customer_detail['last_name'] . ' ' . $customer_detail['first_name'];
    
    $signin_sutl        = $obj_rpt->get_report_details($_POST['year'],$_POST['month'],$_POST['emp'],$_POST['customer'])['signin_sutl'];
    $signin_sutl_email  = $employee->get_employee_detail($signin_sutl)['email'];

    $month_name = strtolower(date('F', mktime(0, 0, 0, $_POST['month'], 10))); 

    $start_time = new DateTime;
    $start_time->setTimezone(new DateTimeZone('Europe/Stockholm'));
    $start_time->setTimestamp(time());
    $current_date_time = $start_time->format('Y-m-d H:i:s');
   
    $subject     = $smarty->translate[signed_report_delete_mail_subject];
    $msg_header  = $smarty->translate[signed_report_delete_details].'<br><br><br>';
    $msg         = $smarty->translate[year].': '.$_POST['year'].'<br>';
    $msg        .= $smarty->translate[month].': '.$smarty->translate[$month_name].'<br>';
    $msg        .= $smarty->translate[employee].': '.$employee_name.'<br>';
    $msg        .= $smarty->translate[customer].': '.$customer_name.'<br>';
    $msg        .= $smarty->translate[deleted_by].': '.$deleted_emp_name.'<br>';
    $msg        .= $smarty->translate[date].': '.$current_date_time.'<br>';

    $msg = $msg_header.$msg;

    $smarty->assign('remove_type', 2);   
    $employee->username = $report_employee;
    $employee->rpt_customer = $report_customer;
    $employee->signing_report_date = $year.'-'.$month.'-1';
    if($login_user_role == 1 || $isGLorAdmin) {
        //check employer already sign report
        $employeer_already_signed_flag = FALSE;
        /*$employer_signing_details_fk = $employee->employer_signing_details($report_customer, $month, $year, 1, $report_employee);
        $employer_signing_details_kn = $employee->employer_signing_details($report_customer, $month, $year, 2, $report_employee);
        if ((!empty($employer_signing_details_fk) && !empty($employer_signing_details_fk[0]['employee_data'])) || 
            (!empty($employer_signing_details_kn) && !empty($employer_signing_details_kn[0]['employee_data']))){ 
                $employeer_already_signed_flag = TRUE;
        }*/
//        echo "<pre>".print_r($employer_signing_details_fk, 1)."</pre>"; exit();
        
        if(!$employeer_already_signed_flag){
            if($employee->employee_signing_remove()){
                $smarty->assign('flg',1);
                $obj_msg->set_message('success', 'employee_signing_removed_successfully');
                $smarty->assign('message', $obj_msg->show_message());
                if($type_delete == 'other_delete'){
                    $mailer_upadte = new SimpleMail($subject,$msg);
                    $mailer_upadte->addSender("cirrus-noreplay@time2view.se");
                    $mailer_upadte->addRecipient($signin_sutl_email, trim($signin_sutl_email));
                    $mailer_upadte->send();
                }
            }
            else{
                $smarty->assign('flg',2);
                $obj_msg->set_message('fail', 'employee_signing_remove_failed');
                $smarty->assign('message', $obj_msg->show_message());
            }
        } else {
            $smarty->assign('flg',3);
        }
    }
    else 
        $smarty->assign('flg',2);
    
    $sign_existance_flag = $employee->employee_signing_existance_check();
    if ($sign_existance_flag == 2)
        $smarty->assign('sign_status', "both");
    else if($sign_existance_flag == 1)
        $smarty->assign('sign_status', "true");
    else if ($sign_existance_flag == 0)
        $smarty->assign('sign_status', "false");

    $employee_signing_details = $employee->get_signin_details_by_employee_customer($year, $month, $report_employee, $report_customer);
    $smarty->assign('signing_details', $employee_signing_details[$report_employee]);   
    
    $is_able_to_sign = FALSE;
    if((empty($employee_signing_details) || $employee_signing_details === FALSE || $employee_signing_details[$report_employee]['signin_employee'] == '') && $report_employee == $_SESSION['user_id'])
        $is_able_to_sign = TRUE;
    else if($report_employee != $_SESSION['user_id'] && !empty($employee_signing_details) && (trim($employee_signing_details[$report_employee]['signin_tl']) == '' || trim($employee_signing_details[$report_employee]['signin_sutl']) == ''))
        $is_able_to_sign = TRUE;
    $smarty->assign('is_able_to_sign', $is_able_to_sign);
    
    $have_after_slots = $employee->check_timeslots_after_timestamp_in_the_month($report_employee, $report_customer, $month, $year);
    $smarty->assign('have_after_slots', $have_after_slots);
}


$employee_slots = $employee->get_employee_normal_inconvenient_details_by_month_and_year($month, $year, $report_employee, $report_customer);
$have_fk_slots = FALSE;
if(!empty($employee_slots)){
    foreach($employee_slots as $es){
        if($es['fkkn'] == 1){
            $have_fk_slots = TRUE;
            break;
        }
    }
}
$smarty->assign('allow_ordinary_signing', ($have_fk_slots && $report_employee == $login_user && $login_user_role != 1 ? FALSE : TRUE));


 /*if ($user->check_SuperTL_or_not_from_team($login_user)) 
    $smarty->assign('is_suTL', TRUE);
 else
    $smarty->assign('is_suTL', FALSE);*/
$smarty->display('ajax_employee_signing_remove.tpl');
?>