<?php
require_once('class/setup.php');
require_once('class/company.php');
$smarty = new smartySetup(array('company.xml','user.xml'));
$company = new company();

//setting the menu
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 1));
$smarty->assign('companies', $company->company_list());
//Setting layout and page
$smarty->display('extends:layouts/root_dashboard.tpl|dashboard.tpl');
?>
