<?php
require_once('class/setup.php');
require_once('class/customer.php');
$smarty = new smartySetup(array('messages.xml'), FALSE);
$soc_sec        = strip_tags($_POST['social_security']);
$except_uname   = isset($_POST['except_uname']) && trim($_POST['except_uname']) != '' ? strip_tags(trim($_POST['except_uname'])) : NULL;
$customer = new customer();
if($customer->employee_social_security_check($soc_sec, $except_uname)) {
   echo $smarty->translate['social_security_exist'];
}
?>