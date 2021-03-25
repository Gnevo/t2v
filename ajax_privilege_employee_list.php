<?php
require_once('class/setup.php');
require_once('class/team.php');
$team = new team();
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml","privilege.xml"), FALSE);
$selected = explode(',', urldecode($_GET['selected']));
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
$employee_autocomplete = $team->get_employee_autocomplete(urldecode($_GET['cust']),urldecode($_GET['role']),1);
$employees_name = $team->get_customer_team_employees(urldecode($_GET['cust']),urldecode($_GET['role']),urldecode($_GET['name']),urldecode($_GET['page']),1);
$employee_count = $team->get_customer_team_employees_count(urldecode($_GET['cust']),urldecode($_GET['role']),urldecode($_GET['name']),1);
if($employee_count % 10 == 0){
    $page_count = intval($employee_count/10);
}else{
    $page_count = 1 + intval($employee_count/10);
}
//echo "<pre>". print_r(, 1)."</pre>";
$smarty->assign('count',$page_count);
$smarty->assign('employees',$employees_name);
$smarty->assign('employees_autocomplete',$employee_autocomplete);
$smarty->assign('selected',$selected);
$smarty->display("ajax_privilege_employee_list.tpl");
?>