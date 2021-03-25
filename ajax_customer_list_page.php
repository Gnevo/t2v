<?php
require_once('class/setup.php');
require_once('class/team.php');
$team = new team();
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml","privilege.xml"), FALSE);
$search = urldecode($_GET['search']);
$employee = urldecode($_GET['emp']);
$page = urldecode($_GET['page']);
$action = urldecode($_GET['action']);
$no_of_data_per_page = 30;
$count = $team->list_customer_count($employee, $search, $action);
if($count['count'] % $no_of_data_per_page == 0){
    $page_count = intval($count['count']/$no_of_data_per_page);
}else{
    $page_count = 1 + intval($count['count']/$no_of_data_per_page);
}
$smarty->assign('count',$page_count);
$smarty->assign('page',$page);
$smarty->display("ajax_customer_list_page.tpl");
?>