<?php
require_once('class/setup.php');
require_once('class/employee.php');

$smarty = new smartySetup(array("messages.xml"), FALSE);
$contr = new employee();

$hrs = $_POST['hrs'];
$contr->user = $_POST['user'];
$contr->date_from = $_POST['date_from'];
$contr->date_to = $_POST['date_to'];
if($contr->date_to > $contr->date_from)
{
	$diff = $contr->date_difference($contr->date_from, $contr->date_to);
	$diff_hrs = $diff/(60*60);
	if($diff_hrs >= $hrs)
	{
		if($contr->contract_employee_check($_POST['user_id']))
                {
                        $smarty->assign('error',1);
		}
	}else
	$smarty->assign('error',3);
}
else
	$smarty->assign('error',2);
$smarty->display('ajax_emp_contract_check_date.tpl');
?>