<?php
require_once('class/setup.php');
require_once('class/team.php');
$team = new team();
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml","privilege.xml"), FALSE);
$selected = explode(',', urldecode($_GET['selected']));
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
$employees_name = $team->get_customer_team_employees_alphabet(urldecode($_GET['cust']),urldecode($_GET['role']),urldecode($_GET['name']),urldecode($_GET['page']),1);
$employee_count = $team->get_customer_team_employees_count(urldecode($_GET['cust']),urldecode($_GET['role']),urldecode($_GET['name']),1);
$smarty->assign('count',count($employee_count));
if($employee_count % 10 == 0){
    $page_count = intval($employee_count/10);
}else{
    $page_count = 1 + intval($employee_count/10);
}
$smarty->assign('count',$page_count);
$smarty->assign('employees',$employees_name);
$smarty->assign('selected',$selected);
$smarty->display("ajax_privilege_employee_list.tpl");
?>