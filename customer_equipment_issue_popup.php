<?php
require_once('class/equipment.php');
require_once('class/customer.php');
require_once('class/setup.php');
require_once('plugins/message.class.php');
$equipment = new equipment();
$customer = new customer();
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml"),FALSE);
$obj_msg = new message();
$equipments_names = $customer->get_equipments();
$smarty->assign('serial_numbers',$customer->get_serial_number());
$customers_names = $customer->customer_view();
$smarty->assign('customers',$customers_names);
$smarty->assign('equipments',$equipments_names);
$name = "";
$serial = "";
$issue = "";
$return = "";
$ids = "";
$employee = $_SESSION['user_id'];
if(isset($_REQUEST['addnew']))
{
    $customers = $_REQUEST['customers'];
    $smarty->assign('cust',$customers);
}
if(isset($_POST['method']) && $_POST['method'] == "add")
{
    $name_sub = $_POST['equipment_names'];
    $num_sub = $_POST['equipment_nums'];
    $issue_sub = $_POST['issued_dates'];
    $return_sub = $_POST['returned_dates'];
    $id_eqp = $_POST['id_equipment'];
    $customers = $_POST['username'];
//    echo "<pre>". print_r($_POST, 1)."</pre>";
    $datas = $customer->add_equipment_issue(1,$name_sub,$num_sub, $issue_sub,$return_sub,$customers,$employee,$id_eqp);
    $obj_msg->set_message('success', 'equipment_added_successfully');
    header("location:".$smarty->url."customer/equipment/".$customers."/");
}
if(isset($_POST['method']) && $_POST['method'] == "edit")
{
    $name_sub = $_POST['equipment_names'];
    $num_sub = $_POST['equipment_nums'];
    $issue_sub = $_POST['issued_dates'];
    $return_sub = $_POST['returned_dates'];
    $customers = $_POST['username'];
    $id_eqp = $_POST['id_equipment'];
    
    $datas = $customer->add_equipment_issue(2,$name_sub,$num_sub, $issue_sub,$return_sub,$customers,$employee,$id_eqp);
    $obj_msg->set_message('success', 'equipment_edited_successfully');
    header("location:".$smarty->url."customer/equipment/".$customers."/");
}
if(isset($_REQUEST['name']))
{
    $name = $_REQUEST['name'];
    $serial = $_REQUEST['serial'];
    $issue = $_REQUEST['issue'];
    $return = $_REQUEST['return'];
    $ids = $_REQUEST['id'];
    $customerss = $_REQUEST['cust'];
    $smarty->assign('ids',$ids);
    $smarty->assign('cust',$customerss);
    $smarty->assign('names',$name);
    $smarty->assign('serials',$serial);
    $smarty->assign('issues',$issue);
    $smarty->assign('returns',$return);
}
$smarty->display('extends:layouts/ajax_popup.tpl|customer_equipment_issue_popup.tpl');
?>
