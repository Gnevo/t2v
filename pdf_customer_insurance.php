<?php
require_once('class/setup.php');
$smarty = new smartySetup(array("user.xml","month.xml","messages.xml","button.xml","forms.xml"),FALSE);
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 8));
require_once('class/customer_pdf.php');
$customer_pdf = new customer_pdf();
$username = $_GET['username'];
$fkkn= $_GET['fkkn'];
$date= $_GET['date'];

//if($date!='')
$customer_pdf->getCustomerInsuranceDetails($username,$fkkn,$date);

?>