<?php
//require("db.php");
require_once('class/setup.php');
require_once('class/equipment.php');
require_once('class/newcustomer.php');

$customer = new newcustomer();

$uri = substr($_SERVER['REQUEST_URI'],0,-1);
$pram = explode('/',$uri);
$totparam = count($pram);
$EmployeeList = $pram[$totparam-1];
$CustomerUnm = $pram[$totparam-2];

$EmpArray = explode(',',$EmployeeList);
$TotEmp = count($EmpArray);

for($Employee_Counter = 0 ; $Employee_Counter < $TotEmp ; $Employee_Counter++)
{
	$UpdateOrder = $customer->Change_Customer_Employee_Order($CustomerUnm,$EmpArray[$Employee_Counter],$Employee_Counter);		
}
if($UpdateOrder)
{
	echo '<span style="color:green; padding-left:64px; padding-top:10px;" align="center">Order Updated Successfully</span>';	
}
else
{
	echo '<span style="color:red; padding-left:64px; padding-top:10px;" align="center">Order Updated Fail</span>';	
}
exit;

?>