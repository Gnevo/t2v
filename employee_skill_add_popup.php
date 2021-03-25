<?php
require_once('class/setup.php');
require_once('class/customer.php');
require_once('class/employee.php');
$customer = new customer();
$employee = new employee();
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml"),FALSE);
$smarty->assign('method',$_GET['method']);
$smarty->assign('employee',$_GET['employee']);
if(isset($_POST['add_skills'])){
    $skill = $_POST['skills'];
    $description = $_POST['description'];
    $emp = $_SESSION['user_id'];
    $data = $employee->employee_skill_add($skill,$description,$emp);
    header("location:".$smarty->url."employee/administration/02/");
}
$smarty->display('extends:layouts/ajax_popup.tpl|employee_skill_add_popup.tpl');
?>
