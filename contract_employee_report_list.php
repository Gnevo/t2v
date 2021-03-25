<!--
	Auther : Sreerag
	Date   : 25/7/2018  
 -->

<?php

require_once('class/setup.php');
require_once('configs/config.inc.php');
require_once('class/contract.php');
require_once('class/employee.php');

$obj_con = new contract();
$obj_emp = new employee();

$smarty           = new smartySetup(array("messages.xml","month.xml","button.xml", "user.xml","reports.xml","contract.xml"));
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 6));
$type_of_contract = 1;
$current_date     = date('Y-m-d');


if($_POST['action'] == 'show_contract'){

	$obj_con->type_of_contract = $type_of_contract = $_POST['contract_employee'];
	$obj_con->expiry_date      = $current_date =  $_POST['expiry_date'];
	$contract_details          = $obj_con->get_all_employee_contract_details();
	if($contract_details['active_contract'] != null){
		foreach ($contract_details['active_contract'] as $key => $value) {
			$count = count_of_employee($value['employee'],$contract_details['active_contract'] );
			$contract_details['active_contract'][$key]['count'] =  $count;
		}
	}
	$smarty->assign('contract_details',$contract_details);
	// echo "<pre>".print_r($contract_details,1)."</pre>";
	// exit('fgf');
}



else if($_POST['action'] == 'print_pdf'){
	$obj_con->type_of_contract = $type_of_contract = $_POST['contract_employee'];
	$obj_con->expiry_date      = $_POST['expiry_date'];
	$contract_details          = $obj_con->get_all_employee_contract_details();
	if($contract_details['active_contract'] != null){
		foreach ($contract_details['active_contract'] as $key => $value) {
			$count = count_of_employee($value['employee'],$contract_details['active_contract'] );
			$contract_details['active_contract'][$key]['count'] =  $count;
		}
	}
	$obj_con->print_pdf($contract_details,$_POST['expiry_date']);
}

function count_of_employee($employee,$active_contract){
	$count = 0;
	foreach ($active_contract as $key => $value) {
		if($employee == $value['employee']){
			$count++;
		}
	}
	return $count;
}

$privilege_general = $obj_emp->get_privileges($_SESSION['user_id'], 2);
$smarty->assign('contract_privilege',$privilege_general['employee_settings_contract']);

$smarty->assign('type_of_contract',$type_of_contract);
$smarty->assign('current_date',$current_date);
$smarty->assign('company_sort_by',$_SESSION['company_sort_by']);
$smarty->display('extends:layouts/dashboard.tpl|contract_employee_report_list.tpl');



?>