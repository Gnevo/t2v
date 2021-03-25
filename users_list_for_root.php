<?php

require_once('class/setup.php');
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml"));
require_once('class/user.php');
$user = new user();
require_once('class/company.php');
$company_obj = new company();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 2));

if($_SESSION['user_id'] == 'root001'){
    $smarty->assign('privilege', TRUE);
    $companies = $company_obj->company_list();
    $smarty->assign('companies',$companies);

    $sel_company = isset($_POST['companies']) && $_POST['companies'] != "" ? $_POST['companies'] : "";
    $sel_user_type = isset($_POST['u_type']) && $_POST['u_type'] != "" ? $_POST['u_type'] : "";
    $smarty->assign('selected_company', $sel_company);
    $smarty->assign('selected_user_type', $sel_user_type);

    if($sel_company != "" && $sel_user_type != ""){
        $company_details = $company_obj->get_company_detail($sel_company);
        $user->select_db($company_details['db_name']);
    //    $customer->select_db($company_details['db_name']);
        $user_data = $user->get_users_by_type($sel_user_type, $sel_company);
    //    echo "<pre>".print_r($user_data, 1)."</pre>";
    }
    $smarty->assign('users',$user_data);
    
}else{
    $smarty->assign('privilege', FALSE);
}
    
$smarty->display('extends:layouts/root_dashboard.tpl|users_list_for_root.tpl');
?>