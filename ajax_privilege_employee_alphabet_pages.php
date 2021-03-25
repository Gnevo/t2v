<?php
require_once('class/setup.php');
require_once('class/team.php');
$team = new team();
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml","privilege.xml"), FALSE);

$employee_count = $team->get_customer_team_employees_count(urldecode($_GET['name']),urldecode($_GET['role']),urldecode($_GET['name']),1);
if($employee_count % 10 == 0){
    $page_count = intval($employee_count/10);
}else{
    $page_count = 1 + intval($employee_count/10);
}
$page = urldecode($_GET['page']);
$total = $page_count;
$smarty->assign('total',$total);
$smarty->assign('page',$page);
$smarty->assign('alph',urldecode($_GET['name']));
$smarty->display("ajax_privilege_employee_alphabet_pages.tpl");
?>