
<?php
/*
	Auther : Sreerag
	Date   : 2/08/2018 
 */

require_once('class/employee.php');
require_once('class/user.php');
require_once('class/newemployee.php');
require_once('class/mail.php');
require_once('class/customer.php');
require_once('class/company.php');

$smarty = new smartySetup(array("user.xml", "button.xml","month.xml", "forms.xml", 'company.xml','mail.xml'),FALSE);

$obj_emp     = new employee();
$obj_usr     = new user();
$obj_new_emp = new newemployee();
$obj_return  = new stdclass();
$obj_cus	 = new customer();
$obj_cmp     = new company();

if($_POST['id']){
	$emp_id           = $_POST['id'];
	$emp_basic_det    = $obj_emp->get_employee_detail($emp_id);
	$emp_sign_det     = $obj_new_emp ->check_signed_or_not($emp_id);
	// $emp_sign_det  = $obj_new_emp->check_employee_signed($_SESSION['user_id'],$emp_id);
	$emp_sign_det_all = $obj_new_emp->check_employee_signed($emp_id);

	if($emp_basic_det['social_security'] != ''){
		$emp_basic_det['social_security'] = substr($emp_basic_det['social_security'], 0, 6) . "-" . substr($emp_basic_det['social_security'], 6);
	}
	
	$single_emp_det   = array('emp_basic_det'=>$emp_basic_det, 'emp_sign_det'=>$emp_sign_det, 'emp_sign_det_all'=>$emp_sign_det_all);
	echo json_encode($single_emp_det);
}

else if($_POST['action'] == 'save_sign'){
	$obj_usr->username   = $_SESSION['user_id'];
	$employee_select     = $_POST['employee_select'];
	$termination_date    = $_POST['termination_date'];
	$sign_date           = $_POST['sign_date'];
	$city                = $_POST['city'];
	$date_of_sign 		 = $_POST['date_of_sign'];
	$obj_usr->password   = $_POST['password'];
	$obj_usr->company_id = $_SESSION['company_id'];

	if($obj_usr->validate_secondary_login()){
		if($_SESSION['user_role'] == 1 || $_SESSION['user_role'] == 6){ // insertion of admin termination data
			$data = $obj_new_emp->add_termination_data($_SESSION['user_id'], $termination_date, $sign_date, $city,$employee_select,$date_of_sign);
			$success = array('success'=>'admin_success','date'=>$sign_date);
		}
		else{ // insertion of employee termination data; 
			 $data = $obj_new_emp->add_termination_data($_SESSION['user_id'], $termination_date, $sign_date, $city);
			 if($data){
			 	$success = array('success'=>'employee_success','date'=>$sign_date);
			 	// mail
				$login_emp_detail = $obj_emp->get_employee_detail($_SESSION['user_id']);
				$emp_name         = $_SESSION['user_role'] == 1 ? $login_emp_detail['first_name'].' '.$login_emp_detail['last_name'] : $login_emp_detail['last_name'].' '.$login_emp_detail['first_name']  ;
				$company_detail   = $obj_cus->get_company_detail($_SESSION['company_id']);

				$mail_subject     = $smarty->translate['employee_termination_subject'];
				$mail_msg_header  = $smarty->translate['employee_termination_subject'].'<br><br>';
				$mail_msg_body    = $smarty->translate['employee'].' : '.$emp_name.'<br>';
				$mail_msg_body   .= $smarty->translate['employee_termination_date'].' : '.$termination_date.'<br>';
				$mail_msg_body   .= $smarty->translate['employee_sign_date'].' : '.$sign_date.'<br>';
				$mail_msg_body   .= $smarty->translate['city'].' : '.$city.'<br>';
			 	$mail_msg 		  = $mail_msg_header.$mail_msg_body;
			 	$mailer 		  = new SimpleMail($mail_subject,$mail_msg);
    			$mailer->addSender("cirrus-noreplay@time2view.se");

			 	if($company_detail['mail_send_to_contact_person'] == 1){
			        if($company_detail['contact_person2_email'] != '')
			                $mailer->addRecipient($company_detail['contact_person2_email'], trim($company_detail['contact_person2']));
			        else if($company_detail['contact_person1_email'] != '')
			                $mailer->addRecipient($company_detail['contact_person1_email'], trim($company_detail['contact_person1']));
			    }
			    $mailer->send();
			 	
			 }
		}
		echo json_encode($success);
	}
	else{
		echo json_encode('error_password');
	}
}

else if($_POST['action'] == 'get_signed_det'){
	$sign_terminaton_details = $obj_new_emp->get_sign_terminaton_details($_POST['sign_id']);
	$sign_terminaton_details['date'] = timezone_set();
	echo json_encode($sign_terminaton_details);
}

else if($_POST['action'] == 'print_pdf'){
	$obj_new_emp->print_termination_pdf();
	// $employee       = $_POST['employee'];
	// $employer       = $_POST['employer'];

	// $emp_basic_det  = $obj_emp->get_employee_detail($emp_id);
	// $company_detail = $obj_cmp->get_company_detail($_SESSION['company_id']);
	// require_once('plugins/pdf_employee_termination.class.php');
	//  ob_start ();
 //        $pdf      = new PDF_employee_termination();

 //        $pdf->company_details = $company_detail;
 //        $pdf->employee_details = $emp_basic_det; 
 //        $pdf->AddPage();
 // //        // $pdf->main_part();
 //        $pdf->Output(utf8_decode('fty.pdf'),'D');
 // ob_end_flush(); 

}

else if($_POST['action'] == 'reject_save'){
	$employee_select     = $_POST['employee_select'];
	$termination_date    = $_POST['termination_date'];
	$sign_date           = $_POST['sign_date'];
	$city                = $_POST['city'];
	$date_of_sign 		 = $_POST['date_of_sign'];
	$reject_reason   	 = $_POST['reject_reason'];

	// var_dump($company_detail   = $obj_cus->get_company_detail($_SESSION['company_id']));
	// exit('fgfdg');


	if($_SESSION['user_role'] == 1 || $_SESSION['user_role'] == 6){ 
		$data = $obj_new_emp->rejection_data_save($_SESSION['user_id'], $termination_date, $sign_date, $city,$reject_reason,$employee_select,$date_of_sign);
		if($data){
			
			$success = array('success'=>'reject_success','date'=>$sign_date,'reject_reason'=>$reject_reason);
			$login_emp_detail = $obj_emp->get_employee_detail($_SESSION['user_id']);
			$emp_name         = $_SESSION['user_role'] == 1 ? $login_emp_detail['first_name'].' '.$login_emp_detail['last_name'] : $login_emp_detail['last_name'].' '.$login_emp_detail['first_name']  ;
			$company_detail   = $obj_cus->get_company_detail($_SESSION['company_id']);

			$mail_subject     = $smarty->translate['employee_rejection_subject'];
			$mail_msg_header  = $smarty->translate['employee_rejection_subject'].'<br><br>';
			$mail_msg_body    = $smarty->translate['employee'].' : '.$emp_name.'<br>';
			$mail_msg_body   .= $smarty->translate['employee_rejection_date'].' : '.$termination_date.'<br>';
			$mail_msg_body   .= $smarty->translate['employee_sign_date'].' : '.$sign_date.'<br>';
			$mail_msg_body   .= $smarty->translate['city'].' : '.$city.'<br>';
		 	$mail_msg 		  = $mail_msg_header.$mail_msg_body;
		 	$mailer 		  = new SimpleMail($mail_subject,$mail_msg);
			$mailer->addSender("cirrus-noreplay@time2view.se");

		 	if($company_detail['mail_send_to_contact_person'] == 1){

		        if($company_detail['contact_person2_email'] != '')
		                $mailer->addRecipient($company_detail['contact_person2_email'], trim($company_detail['contact_person2']));
		        else if($company_detail['contact_person1_email'] != '')
		                $mailer->addRecipient($company_detail['contact_person1_email'], trim($company_detail['contact_person1']));
		    }
		    $mailer->send();
		}
		echo json_encode($success);
	}
}

function timezone_set(){
	$start_time = new DateTime;
	$start_time->setTimezone(new DateTimeZone('Europe/Stockholm'));
	$start_time->setTimestamp(time());
	$current_date_time = $start_time->format('Y-m-d G:i:s');
	return $current_date_time;
} 
exit();
