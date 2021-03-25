<?php

require_once('class/setup.php');
require_once('class/employee.php');

$employee = new employee();
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml","privilege.xml"), FALSE);
$smarty->assign('tab','1');
$smarty->assign('pre_role',$_POST['role']);
if(isset($_POST['cust_username']) && $_POST['cust_username'] != ''){
    $privileges = $employee->get_privileges_employee($_POST['selected'],$_POST['cust_username']);
}else{
    $privileges = $employee->get_privileges_employee($_POST['selected']);
}
//echo $_POST['selected'];
$smarty->assign('privilege_check',$privileges[0]['privilege']);
$no_change = 0;
$smarty->assign('tab','1');
for($i=0;$i<count($privileges);$i++){
    $fix = $privileges[0]['privilege'];
    if($fix != $privileges[$i]['privilege']){
        $no_change = 1;
    }
}
if($no_change == 0){
    $privileg = explode(',', $privileges[0]['privilege']);
    $smarty->assign('privilege',$privileg);
    $smarty->assign('change',$no_change);
}else{
    $smarty->assign('change',$no_change);
}

$smarty->assign('select_all',$_SESSION['select_all']);
$smarty->display("ajax_privileges.tpl");

?>