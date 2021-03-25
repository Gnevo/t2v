<?php
	/*	
	 * @auther : sreerag
	 * date    : 27-02-2019
	*/

	require_once('class/setup.php');
	require_once('class/dona.php');
	require_once('class/employee_ext.php');
	require_once('class/customer.php');

	$dona     = new dona();
	$obj_emp  = new employee_ext();
	$customer = new customer();
	$employee = new employee();

	$smarty       = new smartySetup(array("messages.xml", 'forms.xml',"user.xml","button.xml", "reports.xml", "tooltip.xml"));
	$EmployeeList = $obj_emp->employee_with_skills();
	// var_dump($EmployeeList);exit();
	$smarty->assign('employeeslist',$EmployeeList);
	$years_combo = $obj_emp->distinct_timetable_years();
	// var_dump($years_combo);
	// exit();
	$smarty->assign('years_combo',$years_combo);
	$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 6));
	$query_string = explode("&", $_SERVER['QUERY_STRING']);
	if(isset($_POST['show_cv'])){
		$employee_name  = strtolower(trim($_POST['employee_name']));
		$cv_title       = strtolower(trim($_POST['cv_title']));
		// $cv_description = strtolower(trim($_POST['cv_description']));
		$cv_year		= $_POST['cv_year'];
		if($employee_name != '' || $cv_title != '' || $cv_year != ''){
			$all_cv_details = $obj_emp->get_all_cv($employee_name,$cv_title,$cv_year);
		}
		$smarty->assign('all_cv_details',$all_cv_details);
	}
	
	$smarty->assign('employee_name',$employee_name);
	$smarty->assign('cv_title',$cv_title);
	$smarty->assign('cv_description',$cv_description);
	$smarty->assign('cv_year',$cv_year);
	$smarty->assign('company_sort_by',$_SESSION['company_sort_by']);
	$smarty->assign('download_folder',$customer->get_folder_name($_SESSION['company_id'])."/skills");
	$smarty->display('extends:layouts/dashboard.tpl|employee_cv_report.tpl');


?>