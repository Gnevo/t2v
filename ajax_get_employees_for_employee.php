<?php
require_once('class/setup.php');
$smarty = new smartySetup(array('messages.xml',"forms.xml"), FALSE);
require_once('class/dona.php');
$dona = new dona();

//echo "<script>alert('hi');</script>";
$id = $_POST['eid'];
//echo 'halo';
$customer_names = $dona->get_team_members_details_for_employee($id);
//print_r($customer_names);
if (empty($customer_names))
    $smarty->assign('flg',"false");
else
    $smarty->assign('flg',"true");

$smarty->assign('customers',$customer_names);
//print_r($employee_names);
$smarty->display('ajax_get_employees_for_employee.tpl');
?>