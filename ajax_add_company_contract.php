<?php
require_once('class/setup.php');
require_once('class/company.php');
require_once('plugins/message.class.php');
$company = new company();
$messages = new message();
$smarty = new smartySetup(array('company.xml','button.xml','user.xml','month.xml','messages.xml'), FALSE);
$company_id = $_REQUEST['company_id'];
$action = $_REQUEST['action'];
$contract_id = $_REQUEST['contract_id'];
$smarty->assign('company_id',$company_id);
$smarty->assign('contract_id',$contract_id);
$smarty->assign('action',$action);
if($action == 'edit' || $action == 'delete'){
    $smarty->assign('contract_detail',$company->get_contract_detail($contract_id));
}
if(isset($_POST['action'])){
    $company->contract_from = $_POST['contract_from'];
    $company->contract_to = $_POST['contract_to'];
    $company->price = $_POST['price_cust'];
    $company->price_per_sms = $_POST['price_sms'];
    $company->price_per_sign = $_POST['price_sign'];
    if($_POST['action'] == 'edit'){
        $msg = $company->edit_company_contract($_POST['contract_id'],$_POST['company']);
    }else if($_POST['action'] == 'add'){
        $msg = $company->add_company_contract($_POST['company']);
    }else if($_POST['action'] == 'delete'){
        $msg = $company->delete_company_contract($_POST['contract_id']);
    }
    $message = $msg['msg'];
    $type = $msg['type'];
    $messages->set_message($type, $message);
    header("location:".$smarty->url."company/add/".$_POST['company']."/");
    exit();
}
$smarty->display('extends:layouts/ajax_popup.tpl|ajax_add_company_contract.tpl');
?>