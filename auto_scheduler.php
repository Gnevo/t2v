<?php
require_once('class/setup.php');
require_once('class/equipment.php');
require_once('class/newcustomer.php');
require_once('class/newemployee.php');
$smarty = new smartySetup(array("user.xml","month.xml","messages.xml","button.xml","forms.xml","reports.xml"));
$equipment = new equipment();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 9));
$customer = new newcustomer();
$employee = new newemployee();
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
$smarty->assign('employees_username',$Employee_username);
$smarty->assign('employees',$employees);
$years_work = $employee->distinct_years();
$smarty->assign("year_option_values", $years_work);
$smarty->assign('years',$years_work);


$CustomerList = $customer->customer_list(NULL);
$smarty->assign('customerlist',$CustomerList);


//This post values come from ajax_auto_scheduer_process.php
if(isset($_POST['hdn_autoschedule']) && $_POST['hdn_autoschedule'] == 1)
{
	
        
	$AutoschedulerArray = $_POST['emp'];
	/*echo "<pre>";
	print_r($AutoschedulerArray);
	exit;*/
	
	if(count($AutoschedulerArray) > 0)
	{
		//Truncate temp Timetable 
		$TruncTempTimetable = $employee->TruncateTempTimetable(); 
		$insertflag = 0;	//echo "<pre>";print_r($AutoschedulerArray);exit;
		foreach($AutoschedulerArray as $schedule)
		{
			$ChunkData = explode(',',$schedule);
			$Timetable_Id			= $ChunkData[0];
			$Timetable_Employee		= $ChunkData[1];
			$Timetable_Fname		= $ChunkData[2];
			$Timetable_Lname		= $ChunkData[3];	
			$Timetable_Type			= $ChunkData[4];		
			//$UpdateSchedule = $employee->UpdateTimetable($Timetable_Id,$Timetable_Employee,$Timetable_Fname,$Timetable_Lname);
			
			if($TruncTempTimetable)
			{  
				//Insert into temp timetable 

				$InsertTempTimetable = $employee->InsertTempTimetable($Timetable_Id,$Timetable_Employee,$Timetable_Fname,$Timetable_Lname,$Timetable_Type);
			}
			$insertflag = 1;
		}	
		$TimeTableData = $employee->SelectTimetableData();
		//echo "<pre>";print_r($TimeTableData);exit;
		if(count($TimeTableData) > 0)
		{
			foreach($TimeTableData as $scheule)
			{
				$UpdateShceule = $employee->UpdateTimetableData($scheule['id'],$scheule['employee'],$scheule['type']);		
				//echo "data Updated";
				//break;		
			}
			 $smarty->assign('msg_updated',"data_save_success");
      			//echo "data Updated";
				
		}
	}
}

if(isset($_POST)){ 
	$emp_name = $_POST['emp_name'];
	$UserName =  $_POST['Name'];
	$hdn_emp_id = $_POST['hdn_emp_id'];
	$todate = $_POST['ToDate'];
	if($todate !='' && $todate !='0000-00-00'){$todate = $_POST['ToDate'];}else{  $todate ='';}
	$frmdate = $_POST['FromDate'];	if($frmdate !='' && $frmdate !='0000-00-00'){$todate = $_POST['ToDate'];}else{  $frmdate ='';}
}else{
	$emp_name='';
	$hdn_emp_id='';
	$todate = '';
	$frmdate = '';
	$UserName =  '';
}


$smarty->assign('emp_name',$emp_name);
$smarty->assign('UserName',$UserName);
$smarty->assign('hdn_emp_id',$hdn_emp_id);
$smarty->assign('todate',$todate);
$smarty->assign('frmdate',$frmdate);


if(isset($_POST['add'])){
    $emp = $_POST['employee'];  
    $year = $_POST['year'];
    $month = $_POST['month'];
    $month = intval($month);
    $smarty->assign('month',$month);
    $smarty->assign('report_year',$year);
    $smarty->assign('emp',$emp);
    $timetable = $equipment->employee_timetable_month($emp,$month,$year);
    //print_r($timetable);
    $sums = $equipment->employee_week_time_sum($timetable);
    $smarty->assign('reports',$timetable);
    $smarty->assign('sums',$sums);
}
$smarty->display('extends:layouts/dashboard.tpl|auto_scheduler.tpl');
?>