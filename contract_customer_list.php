<?php
require_once('class/setup.php');
$smarty = new smartySetup(array("user.xml","messages.xml","button.xml"));
require_once('class/customer.php');
$contract = new customer();
require_once('plugins/message.class.php');
require_once('plugins/pagination.class.php');
$pagination = new pagination();
$messages = new message();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' =>3));
$contract_username = explode('&', $_SERVER['QUERY_STRING']);
$smarty->assign('contract_username',$contract_username[0]);
$datas=$contract->contract_customer($contract_username[0]);
$paginated_contracts= $pagination->generate($datas, 15);
$smarty->assign('listing', $paginated_contracts);
$smarty->assign('role',$_SESSION['user_role']);
$smarty->assign('pagination', $pagination->links($smarty->url . 'contract/customer/list/'.$contract_username[0].'/'));
$smarty->assign('datas',$datas);
$smarty->display('extends:layouts/dashboard.tpl|contract_customer_list.tpl');

?>