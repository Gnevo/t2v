<?php
require_once('class/setup.php');
require_once('class/company.php');
$company = new company();
$smarty = new smartySetup(array("user.xml", "month.xml","button.xml",'messages.xml','company.xml'));
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 9));
$companies = $company->company_list();
$company_id = $_SESSION['company_id'];
if(isset($_SERVER['QUERY_STRING'])){
    $company_id = $_SERVER['QUERY_STRING'];
}
$conpany_contract = $company->get_company_contract($company_id);
$smarty->assign('company_id',$company_id);
$smarty->assign('companies',$companies);
$smarty->display('extends:layouts/dashboard.tpl|company_contract.tpl');
?>
