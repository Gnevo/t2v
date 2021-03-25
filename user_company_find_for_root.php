<?php

require_once('class/setup.php');
require_once('class/company.php');
//require_once('class/user.php');
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml"));
//$user = new user();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 3));

if($_SESSION['user_id'] == 'root001'){
    $smarty->assign('privilege', TRUE);
    $company_obj = new company();
    $companies = $company_obj->company_list();

    $search_name = isset($_POST['search_name']) && trim($_POST['search_name']) != "" ? trim($_POST['search_name']) : "";
    $smarty->assign('search_name', $search_name);

    if($search_name !="" && !empty($companies)){
        foreach($companies as $key => $this_company){
            $new_company_obj = new company();
//            $new_company_obj->flush();
            $new_company_obj->select_db($this_company['db_name']);
//            echo $new_company_obj->con ? 'SUCCESS' : 'FAILS';
            $employees_data = $new_company_obj->find_employees_by_name($search_name);
            $customers_data = $new_company_obj->find_customers_by_name($search_name);
//            echo "$key<pre>".print_r($companies[$key], 1)."</pre>";
            $companies[$key]['customers'] = $customers_data;
            $companies[$key]['employees'] = $employees_data;
        }
    }
//    echo "<pre>".print_r($companies, 1)."</pre>";
    $smarty->assign('companies',$companies);
    
}else
    $smarty->assign('privilege', FALSE);
    
$smarty->display('extends:layouts/root_dashboard.tpl|user_company_find_for_root.tpl');
?>