<?php
require_once('class/setup.php');
$smarty = new smartySetup(array("user.xml","month.xml","messages.xml","button.xml","forms.xml"),FALSE);
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 8));
require_once('class/dona.php');
$dona = new dona();

$id = $_GET['id'];
//if($_POST['cmb_employee'])
    $dona->Employee_info_pdf($id);
//    else
//        $dona->Customer_pdf_work_report($_POST['cust_id'], $_POST['cmb_month'], $_POST['cmb_year'], $_POST['type']);
//    

//$smarty->display('extends:layouts/dashboard.tpl|pdf_customer_work_report.tpl');
 
?>