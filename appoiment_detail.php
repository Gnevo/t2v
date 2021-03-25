<?php
require_once('configs/config.inc.php');
require_once('class/setup.php');
$smarty = new smartySetup(array("messages.xml","month.xml","button.xml","notes.xml", "customer.xml"));

require_once ('class/customer.php');
$customer = new customer();

$smarty->assign('menu', array('mainmenu' => 1, 'submenu' =>5));

$uri = substr($_SERVER['REQUEST_URI'],0,-1);
$pram = explode('/',$uri);
$totparam = count($pram);
$id = $pram[$totparam-1];

$smarty->assign("customer",$customer);
if($id !=''){
	
	 $appoiments_arr = $customer->get_appoiments("", $id);
	 $smarty->assign("appoiments_arr",$appoiments_arr);
}
$smarty->display('extends:layouts/dashboard.tpl|appoiment_detail.tpl');
?>