<?php
require_once('class/setup.php');
require_once('class/company.php');
$smarty = new smartySetup(array('company.xml','button.xml', "messages.xml"));
$company = new company();

$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 1));

if($_SESSION['user_id'] == 'root001'){
	$smarty->assign('privilege', TRUE);
	//setting the menu
	if(isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] != ""){
	    $company->company_deactive($_SERVER['QUERY_STRING']);
	}
	$smarty->assign('companies', $company->company_list());
}
else
    $smarty->assign('privilege', FALSE);

$smarty->display('extends:layouts/root_dashboard.tpl|dashboard_company.tpl');
//$smarty->display('extends:layouts/root_dashboard.tpl|company_add.tpl');
?>