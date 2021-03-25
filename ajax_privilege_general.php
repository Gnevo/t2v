<?php
require_once('class/setup.php');
require_once('class/employee.php');
$employee = new employee();
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml","privilege.xml"), FALSE);
$smarty->assign('tab','4');
$smarty->assign('pre_role',$_POST['role']);
$privileges = $employee->get_privileges_general_employee($_POST['selected']);
// echo "<pre>".print_r($privileges,1)."</pre>";
// exit();
// var_dump($privileges);exit('exit');
// echo " $privilege[33]<pre>".print_r($privileges, 1)."</pre>";
$smarty->assign('privilege_check',$privileges[0]['privilege']);
$no_change = 0;
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
$smarty->display("ajax_privilege_general.tpl");
?>