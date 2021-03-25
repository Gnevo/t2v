<?php
require_once('class/setup.php');
require_once('class/customer.php');
require_once('class/employee.php');
require_once('class/material.php');
require_once('plugins/pagination.class.php');
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml"));
$employee = new employee();
$customer = new customer();
$material = new material();
$employee_lists = $employee->employee_list();
$material_names = $material->get_name_material();
$orders = $material->get_orders();
$customer_lists = $customer->customer_list();
$smarty->assign('items_names',$material_names);
$length = count($material_names);
$smarty->assign('length',$length);
$smarty->assign('customers',$customer_lists);
$smarty->assign('employees',$employee_lists);
$smarty->assign('items',$orders);

if(isset($_POST['saves']))
{
    $material->employee=$_POST['employee'];
    $item = $material->get_item_id($_POST['item']);
    $material->item=$item[0][0];
    $material->qty=$_POST['qty'];
    $material->customer=$_POST['customer'];
    $material->date=date("Y-m-d");
    $material->add_order();
    header("location:material_order.php");
}
$smarty->display('extends:layouts/dashboard.tpl|material_order.tpl');
?>
