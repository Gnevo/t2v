<?php
require_once('class/setup.php');
$smarty = new smartySetup(array("user.xml","month.xml","messages.xml","button.xml","forms.xml"),FALSE);
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 8));
require_once('class/customer_pdf.php');
$customer_pdf = new customer_pdf();
$username = $_GET['username'];
$year= $_GET['year'];
$month= $_GET['month'];
$month_txt= $_GET['month_txt'];

$customer_pdf->getCustomerEquipment($username,$year,$month,$month_txt);

?>