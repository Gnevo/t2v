<!--
	Auther : sreerag
	DAte   : 30/05/2018
 -->
<?php

	require_once ('configs/config.inc.php');
	require_once ('class/setup.php');
	require_once ('class/dona.php');
	require_once ('class/equipment.php');
	require_once ('class/customer.php');
	require_once ('plugins/pdf_sick_details_report.class.php');
	require_once ('plugins/pdf_emp_cust_work_report_for_sick_rpt.class.php');

	$dona         = new dona();
	$equipment    = new equipment();
	$obj_customer = new customer();


	$smarty = new smartySetup(array( "gdschema.xml", "user.xml", "messages.xml", "button.xml","month.xml", "forms.xml"),FALSE);
	
	$years_combo = $dona->distinct_timetable_years(TRUE);
	// $years_combo  = $dona->get_distint_leave_years_from_timetable();
	$smarty->assign('years_combo',$years_combo);

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


	$this_year     = NULL;
	$this_month    = NULL;
	$this_customer = NULL;
	$this_employee = NULL;

	//Soc. values dippend on date of birth
	define('BELOW_25', '31.42');    //15.49//15.21
	define('BTWN_25_65', '31.42');
	define('ABOVE_65', '16.36');    //15.49//15.21

	if($_POST['action'] == "printSickDetailsReport" && $_POST['year'] && $_POST['month']/* && $_POST['customer'] && $_POST['employee']*/){
    	$this_customer      = trim($_POST['customer']);
	    $this_employee      = trim($_POST['employee']);
	    $this_year          = trim($_POST['year']);
	    $this_month         = trim($_POST['month']);


	    if(isset($_POST['customer']) && trim($_POST['customer']) != '' && trim($_POST['customer']) != 'ALL'){
	        if(!$selected_all_employees && $_POST['employee'] != ''){
	            //generate PDF
	            $dona->Customer_employee_vab_details_report($this_customer, $this_employee, $this_year, $this_month);
	            exit();
	        }
	        else{
	            //check multiple employees available
	            $all_employee_details = $equipment->employees_vab_leave_under_customer($_POST['month'], $_POST['year'], $_POST['customer']); 
	            if(count($all_employee_details) > 0){

	                $pdf = new PDF_sick_report();

	                foreach($all_employee_details as $tmp_emp_details){
	                    //generate PDF
	                    $pdf = $dona->Customer_employee_vab_details_report($this_customer, $tmp_emp_details['employee_id'], $this_year, $this_month, FALSE, $pdf);
	                }

	                // $pdf->Output();
	                $pdf->Output(utf8_decode('VAB-Avvikelserapport').'_'.$this_customer.'_'.date('ymdHi').'.pdf', 'D');
	                exit();
	            }
	        }
	    }
	    else if($selected_all_customers){
	        //check multiple customers available
	        $all_customer_details = $equipment->customers_under_vab_leave_employee($_POST['month'], $_POST['year']);
	        if(count($all_customer_details) > 0){

	            $pdf = new PDF_sick_report();

	            foreach($all_customer_details as $tmp_cust_details){
	                //$tmp_cust_details['customer_id']

	                //check multiple employees available
	                $all_employee_details = $equipment->employees_vab_leave_under_customer($_POST['month'], $_POST['year'], $tmp_cust_details['customer_id']); 
	                if(count($all_employee_details) > 0){
	                    foreach($all_employee_details as $tmp_emp_details){
	                        //generate PDF
	                        $pdf = $dona->Customer_employee_vab_details_report($tmp_cust_details['customer_id'], $tmp_emp_details['employee_id'], $this_year, $this_month, FALSE, $pdf);
	                    }
	                }
	            }
	            
	            // $pdf->Output();
	            $pdf->Output(utf8_decode('VAB-Avvikelserapport').'_'.date('ymdHi').'.pdf', 'D');
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
	            $dona->Customer_pdf_work_report_from_vab_report($this_customer, $this_employee, $this_year, $this_month);
	            exit();
	        }
	        else{
	            //check multiple employees available
	            $all_employee_details = $equipment->employees_vab_leave_under_customer($_POST['month'], $_POST['year'], $_POST['customer']); 
	            if(count($all_employee_details) > 0){

	                $pdf = new PDF_work_rpt_from_sick();

	                foreach($all_employee_details as $tmp_emp_details){
	                    //generate PDF
	                    $pdf = $dona->Customer_pdf_work_report_from_vab_report($this_customer, $tmp_emp_details['employee_id'], $this_year, $this_month, FALSE, $pdf);
	                }

	                // $pdf->Output();
	                $pdf->Output(utf8_decode('VAB-Arbetsrapport').'_'.$this_customer.'_'.date('ymdHi').'.pdf', 'D');
	                exit();
	            }
	        }
	    }
		    else if($selected_all_customers){
		        //check multiple customers available
		        $all_customer_details = $equipment->customers_under_vab_leave_employee($_POST['month'], $_POST['year']);
		        if(count($all_customer_details) > 0){

		            $pdf = new PDF_work_rpt_from_sick();

		            foreach($all_customer_details as $tmp_cust_details){
		                //$tmp_cust_details['customer_id']

		                //check multiple employees available
		                $all_employee_details = $equipment->employees_vab_leave_under_customer($_POST['month'], $_POST['year'], $tmp_cust_details['customer_id']); 
		                if(count($all_employee_details) > 0){
		                    foreach($all_employee_details as $tmp_emp_details){
		                        //generate PDF
		                        $pdf = $dona->Customer_pdf_work_report_from_vab_report($tmp_cust_details['customer_id'], $tmp_emp_details['employee_id'], $this_year, $this_month, FALSE, $pdf);
		                    }
		                }
		            }
		            
		            // $pdf->Output();
		            $pdf->Output(utf8_decode('VAB-Arbetsrapport').'_'.date('ymdHi').'.pdf', 'D');
		            exit();
		        }
		    }
	}



	//////////////////////////   start ///////////////////////////////
	$query_string = explode("&", $_SERVER['QUERY_STRING']);

	if(!empty($query_string) && trim($query_string[0])!='' && trim($query_string[0]) != 'NULL') { $this_year = trim($query_string[0]); }
	else {  $this_year = date('Y'); }

	if(!empty($query_string) && trim($query_string[1])!='' && trim($query_string[1]) != 'NULL') { $this_month = trim($query_string[1]); }
	else {  $this_month = date('m'); }

	if(!empty($query_string) && trim($query_string[2])!='' && trim($query_string[2]) != 'NULL') { $this_customer = trim($query_string[2]); }

	if(!empty($query_string) && trim($query_string[3])!='' && trim($query_string[3]) != 'NULL' && $this_customer != NULL) { $this_employee = trim($query_string[3]); }

	if($this_customer == 'ALL'){
	    $this_customer = NULL;
	    $selected_all_customers = TRUE;
	    $smarty->assign('selected_all_customers',$selected_all_customers);
	}

	if($this_employee == 'ALL'){
	    $this_employee = NULL;
	    $selected_all_employees = TRUE;
	    $smarty->assign('selected_all_employees',$selected_all_employees);
	}
	$customers = $equipment->customers_under_vab_leave_employee($this_month,$this_year);
	$smarty->assign('customers',$customers);

	if($this_customer == NULL && $selected_all_customers != TRUE){
    	if(count($customers) == 1) 
        $this_customer = $customers[0]['customer_id'];
	}

	if($this_customer != NULL){
	    $smarty->assign('cust', $this_customer);
	    $smarty->assign('flag_cust_access', ($obj_customer->is_customer_accessible($this_customer) ? 1 : 0));   //prevent manual typing on URL
	    
	    $employees = $equipment->employees_vab_leave_under_customer($this_month,$this_year,$this_customer); 
	    $smarty->assign('employees',$employees);
	}

	//load default customer if a single customer exists
	if($this_employee == NULL && $selected_all_employees != TRUE){
	    if(count($employees) == 1) 
	        $this_employee = $employees[0]['employee_id'];
	}
	
	if($this_employee != NULL){
	    $smarty->assign('emp', $this_employee);
	    $inconvenient_process_obj = new inconvenient();
	    
	    $list_relations 	= $equipment->relations_leave_vab_employee($this_month, $this_year, $this_customer, $this_employee);
	    $updated_relations 	= $dona->attach_employee_age($list_relations);
	    $sel_employee_age 	= $dona->attach_employee_age(array(array('employee_id' => $this_employee)));
	    
	    if(!empty($updated_relations)){
	        $total_vikari_hours = 0;
	        foreach ($updated_relations as $this_relation){
	            $total_vikari_hours = $equipment->time_sum($total_vikari_hours, $equipment->time_difference($this_relation['time_from'], $this_relation['time_to']));
	        }
	        $smarty->assign('total_vikari_hours',$equipment->time_user_format($total_vikari_hours, 100));
	    }
	    
	    $smarty->assign('relations',$updated_relations);
	    
	    $dona->leavePeriod_year = $this_year;
	    $dona->leavePeriod_month = $this_month;
	    $dona->leave_employee = $this_employee;
	    $dona->leave_customer = $this_customer;
	}

	
	$smarty->assign('below_25', BELOW_25);
	$smarty->assign('btwn_25_65', BTWN_25_65);
	$smarty->assign('above_65', ABOVE_65);
	$smarty->assign('month',$this_month);
	$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
	$smarty->assign('report_year',$this_year);
	$smarty->display('leave_vab_pdf_edited.tpl');
?>	