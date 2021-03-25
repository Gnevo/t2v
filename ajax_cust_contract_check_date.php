<?php
require_once('class/setup.php');
require_once('class/customer.php');

$smarty = new smartySetup(array("messages.xml"), FALSE);
$contract = new customer();

$hrs = $_POST['hrs'];
$contract->user = $_POST['user'];
$contract->date_from = $_POST['date_from'];
$contract->date_to = $_POST['date_to'];
//$val = explode('&',$_SERVER['QUERY_STRING']);

if($contract->date_to > $contract->date_from)
{
	$diff = $contract->date_difference($contract->date_from, $contract->date_to);
	$diff_hrs = $diff/(60*60);
	if($diff_hrs >= $hrs)
	{
		if($contract->contract_customer_check($_POST['user_id']))
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