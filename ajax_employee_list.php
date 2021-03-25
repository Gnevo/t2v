<?php
require_once('class/setup.php');
require_once('class/customer.php');
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml","tooltip.xml"), FALSE);
$customer = new customer();

require_once ('class/customer_ai.php');
$customer_ai = new customer_ai();
$smarty->assign('listtype', urldecode($_REQUEST['listtype']));

$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);

$customer_username = urldecode($_REQUEST['customer']);
$key =urldecode( $_REQUEST['searchkey']);
if(urldecode($_REQUEST['listtype']) == 'toadd'){
    
    $employees = explode(',', urldecode($_REQUEST['employees']));
    $smarty->assign('employees', $customer_ai->customer_team_employee($customer_username, $key, 'toadd', $employees));
    $smarty->assign('customer', $_REQUEST['customer']);
    
} else if(urldecode($_REQUEST['listtype']) == 'listed') {
    
    $employees = explode(',', urldecode($_REQUEST['employees']));
    $smarty->assign('employees', $customer_ai->customer_team_employee($customer_username, $key, 'listed', $not, $employees));
    
} else if(urldecode($_REQUEST['listtype']) == 'allocated') {
    
    $employees = array();
    if(urldecode($_REQUEST['employees']) != '') {
        
        $employees = explode(',', urldecode($_REQUEST['employees']));
        $tl = urldecode($_REQUEST['tl']);
        $stl = urldecode($_REQUEST['stl']);
        $smarty->assign('employees', $customer_ai->customer_alocate_employee($employees, $tl,$stl));
    } else {
        
        $smarty->assign('employees', $employees);
    }
    
    $smarty->assign('customer', $_REQUEST['customer']);
    
} else if(urldecode($_REQUEST['listtype']) == 'toalloc') {
    
    $employees = explode(',', urldecode($_REQUEST['employees']));
    $not = explode(',', urldecode($_REQUEST['not']));
    $smarty->assign('employees', $customer_ai->customer_team_employee($customer_username, $key, 'toalloc', $not, $employees));
    
} else {
    
    $smarty->assign('employees', $customer_ai->customer_team_employee('', $key));
}

$smarty->display('extends:layouts/ajax_popup.tpl|ajax_employee_list.tpl');
?>