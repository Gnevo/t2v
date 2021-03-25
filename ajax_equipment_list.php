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
   $equipments = $team->list_customer_equipment($customer,$method,$page,$month,$year); 
else
    $equipments = $team->list_customer_equipment($customer,$method,$page);

$smarty->assign('equipments',$equipments);
$smarty->assign('page',$page);
$smarty->assign('method',$method);
$smarty->display("ajax_equipment_list.tpl");
?>