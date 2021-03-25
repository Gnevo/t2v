<?php
require_once('class/setup.php');
require_once('class/customer.php');
require_once('class/employee.php');
require_once('class/material.php');
require_once('plugins/pagination.class.php');
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml"), FALSE);
$employee = new employee();
$customer = new customer();
$material = new material();
//echo "alert(".$_REQUEST['term'].")";
$item_id = $material->get_item_id($_REQUEST['item']);

$price_item = $material->get_price_item($item_id[0][0]);

$price = $_REQUEST['qty'] * $price_item[0]['price'];


//$available = $material->get_items_present($_REQUEST['term']);
//$available = $material->get_items_present('br');
//print_r($available);
$smarty->assign('price',$price);
$smarty->display('ajax_items_present.tpl');      
?>