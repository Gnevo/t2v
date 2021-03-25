<?php
require_once('class/setup.php');
require_once('class/company.php');
$smarty = new smartySetup(array('company.xml','button.xml'));
$company = new company();
//setting the menu
if(isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] != ""){
    $company->company_deactive($_SERVER['QUERY_STRING']);
    header("location:".$smarty->url."dashboard/");
}
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 1));
$smarty->assign('companies', $company->company_list());
//Setting layout and page
$smarty->display('extends:layouts/root_dashboard.tpl|dashboard_company.tpl');
//$smarty->display('extends:layouts/root_dashboard.tpl|company_add.tpl');
?>
