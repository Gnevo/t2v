<?php
require_once('class/setup.php');
$smarty = new smartySetup(array(), FALSE);
require_once('class/employee.php');
$employee = new employee();
$current_team = strip_tags($_POST['id']);
$available_team = $employee->get_available_team($current_team);
for($i = 0;$i < count($available_team);$i++)
		{ 
			$available_team[$i]['tl'] = "'".$available_team[$i]['tl']."'";
			$employee_detail = $employee->employee_detail($available_team[$i]['tl']);
			$available_team[$i]['tl'] = $employee_detail[0]['first_name'].' '.$employee_detail[0]['last_name'];
		}
$smarty->assign('available_team', $available_team);
$smarty->display('ajax_get_team.tpl');
?>