<?php
echo "<script>alert('hais');</script>";
require_once('class/setup.php');
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml","privilege.xml"), FALSE);
$effect_from = $_REQUEST['effect_from'];
$effect_to = $_REQUEST['effect_to'];
echo $effect_from." ".$effect_to;
//$smarty->assign('x',$effect_from." ".$effect_to);
$smarty->display('ajax_select_inconvenient_times.tpl');
?>