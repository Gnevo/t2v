<?php
require_once('class/setup.php');
require_once('class/newemployee.php');
require_once('class/employee.php');
require_once ('plugins/message.class.php');
require_once('class/user.php');
require_once('class/general.php');
$smarty = new smartySetup(array("user.xml","month.xml","messages.xml","button.xml","forms.xml","reports.xml"));
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 2 , 'tabmenu'=>'employee_preference'));
//$customer = new newcustomer();
$employee = new employee();
$msg = new message();
$obj_new_employee = new newemployee();
$user = new user();
$obj_general = new general();


$privilege_general = $employee->get_privileges($_SESSION['user_id'], 2);
$smarty->assign('privilege_general', $privilege_general);
if($privilege_general['employee_settings_preference'] != 1){
    $msg->set_message('fail', 'permission_denied');
    $obj_general->going_to_startup_view($smarty);
    exit();
}

$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
$query_string = $_SERVER['QUERY_STRING'];
$smarty->assign('employee_username', $query_string);
if (!empty($query_string)) {

    $employee->username = $query_string;
    $employee_detail = $employee->employee_detail("'" . $query_string . "'");	
    $Employee_username = $employee_detail[0]['username'];
    $smarty->assign('employee_detail', $employee_detail);

    if(isset($_POST['action']) && $_POST['action'] == 'newentry'){
		$from_date = $_POST['from_date'];
		$to_date = $_POST['to_date'];
		$leave_comment = $_POST['leave_comment'];
		$w_days = array("mon", "tue", "wed", "thu", "fri", "sat", "sun");  // checkbox name
	    $w_days_count = count($w_days);
	    $days = '';
		for ($i = 0; $i < $w_days_count; $i++) {
	        if (isset($_POST[$w_days[$i]]) && !empty($_POST[$w_days[$i]]))
	            $days .= $_POST[$w_days[$i]] . ',';
	    }
	    
	    $days = preg_replace('/,$/', '', $days);
	    $days_for_sql_1 = array();
	    if($days)
	    	$days_for_sql_1 = explode(",", $days);
	    $days_for_sql = array();
	    foreach ($days_for_sql_1 as $day) {
	    	if($day == 7)
	    		$days_for_sql[] = 1;
	    	else
	    		$days_for_sql[] = $day +1;
	    }

	    //echo "<pre>".print_r($days_for_sql_1,1)."</pre>";
	    if($obj_new_employee->check_employee_special_leave_possibility($Employee_username, $from_date, $to_date,implode(",", $days_for_sql))){
    		$insert_array = make_insert_array_for_special_leave($days_for_sql_1, $from_date, $to_date, $Employee_username, $leave_comment);
    		//	echo "<pre>".print_r($insert_array,1)."</pre>";exit();
    		if($obj_new_employee->add_special_leave($insert_array)){
    			$msg->set_message('success', 'special_leave_saved');
    			$smarty->assign('message', $msg->show_message());
    		}else{
    			$msg->set_message('error', 'error_in_creating_special_leave');
    			$smarty->assign('message', $msg->show_message());
    		}
	    }else{
	    	$smarty->assign('message', $msg->show_message());
	    }
		$from_date = $_POST['frmdate'];
		$to_date = $_POST['todate'];
	}
	elseif(isset($_POST['action']) && $_POST['action'] == 'list'){
		$from_date = $_POST['frmdate'];
		$to_date = $_POST['todate'];
		
	}elseif(isset($_POST['action']) && $_POST['action'] == 'del_id'){
		if($obj_new_employee->delete_special_leave($_POST['action_val'])){
			$msg->set_message('success', 'special_leave_deleted');
			$smarty->assign('message', $msg->show_message());
		}else{
			$msg->set_message('error', 'error_special_leave_deletion');
			$smarty->assign('message', $msg->show_message());
		}
		$from_date = $_POST['frmdate'];
		$to_date = $_POST['todate'];
	}elseif(isset($_POST['action']) && $_POST['action'] == 'del_grp_id'){
		if($obj_new_employee->delete_special_leave_group($_POST['action_val'])){
			$msg->set_message('success', 'special_leave_grp_deleted');
			$smarty->assign('message', $msg->show_message());
		}else{
			$msg->set_message('error', 'error_special_leave_grp_deletion');
			$smarty->assign('message', $msg->show_message());
		}
		$from_date = $_POST['frmdate'];
		$to_date = $_POST['todate'];

	}elseif(!isset($_POST['action'])){
		$from_date = date('Y-m-01',strtotime('this month'));
		$to_date = date('Y-m-t',strtotime('this month'));		
	}
	
	$smarty->assign('frmdate', $from_date);
	$smarty->assign('todate', $to_date);
	$special_leaves = $obj_new_employee->get_special_leave($Employee_username, $from_date, $to_date);
	//echo "<pre>".print_r($special_leaves,1)."</pre>";
	$smarty->assign('special_leaves', $special_leaves);
    $smarty->assign('employee_role', $user->user_role($Employee_username));

}

$smarty->assign('user_roles_login', $user->user_role($_SESSION['user_id']));
$smarty->display('extends:layouts/dashboard.tpl|employee_time_preference.tpl|layouts/sub_layout_employee_tabs.tpl');


function make_insert_array_for_special_leave($day_array, $start_date, $end_date, $employee, $comment){
	$obj_new_employee = new newemployee();
	$new_group_id = $obj_new_employee->get_new_leave_group_id();
	$w_days = array("monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday");
	$next_week_start = strtotime("-1 day", strtotime($start_date));
	$insert_array = array();
	//echo "<pre>".print_r($day_array,1)."<pre>";
	if(count($day_array) == 7 || empty($day_array)){
		//echo date('Y-m-d', strtotime('+1 day', strtotime($end_date)));
		$period = new DatePeriod(
		     new DateTime($start_date),
		     new DateInterval('P1D'),
		     new DateTime(date('Y-m-d', strtotime('+1 day', strtotime($end_date))))
		);


		foreach($period as $date){
			$insert_array[] = array(
	            $new_group_id, 
	            $employee,
	            $date->format("Y-m-d"), 
	            '0.00', 
	            '24.00',
	            9,//type
	            $comment,
	            $_SESSION['user_id'],
	            1 //status
	        );
	    	
	    }



	}else{
		while($next_week_start < strtotime($end_date)){
			for($day = 1; $day <= 7; $day++){
				if(in_array($day, $day_array)){
					$next_day = strtotime("next ".$w_days[$day-1], $next_week_start);
					//echo date('Y-m-d', $next_day)."<br>";
					if($next_day <= strtotime($end_date)){
						$insert_array[] = array(
				            $new_group_id, 
				            $employee,
				            date('Y-m-d', $next_day), 
				            '0.00', 
				            '24.00',
				            9,//type
				            $comment,
				            $_SESSION['user_id'],
				            1//status
				        );

					}
				}
				
			}
			$next_week_start = strtotime("+7 days", $next_week_start);
		}
		array_multisort (array_column($insert_array, 2), SORT_ASC, $insert_array);
		//echo "<pre>".print_r($insert_array,1)."</pre>";
	}
	return $insert_array;
}

?>