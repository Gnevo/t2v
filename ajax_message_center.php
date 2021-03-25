<?php 
require_once('class/setup.php');
$smarty = new smartySetup(array("user.xml","messages.xml"), FALSE);
require_once('class/employee.php');
$employee = new employee();

$year = $_REQUEST['year'];
$month = $_REQUEST['month'];
$leave_list = $employee->get_all_employee_leave($_SESSION['user_id'],$year,$month);
for($i=0;$i < count($leave_list);$i++)
{
  $leave_list[$i]['appr_emp'] = $employee->get_employee_name("'".$leave_list[$i]['appr_emp']."'");
}

$emp_name = $employee->get_employee_name("'".$leave_list[0]['employee']."'");

$smarty->assign('leave_list', $leave_list);
$smarty->assign('emp_name', $emp_name);

$smarty->display('ajax_message_center.tpl');
?>