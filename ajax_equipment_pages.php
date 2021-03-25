<?php
require_once('class/setup.php');
require_once('class/team.php');
$team = new team();
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml","privilege.xml"), FALSE);

$customer   = urldecode($_GET['customer']);
$page       = urldecode($_GET['page']);
$method     = urldecode($_GET['method']);
$year       = urldecode($_GET['year']);
$month      = urldecode($_GET['month']);

if($method == 1)
    $count = $team->list_customer_equipment_count($customer,$method,$month,$year); 
else
    $count = $team->list_customer_equipment_count($customer,$method);

$page_count = intval($count['counts']/12);
if(($count['counts'] % 12) != 0)
    $page_count++;

$smarty->assign('count',$page_count);
$smarty->assign('page',$page);
$smarty->assign('method',$method);
$smarty->display("ajax_equipment_pages.tpl");
?>