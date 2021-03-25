<?php
require_once('class/setup.php');
require_once('class/team.php');
$team = new team();
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml","privilege.xml","tooltip.xml"), FALSE);
$search = urldecode($_GET['search']);
$employee = urldecode($_GET['emp']);
$page = urldecode($_GET['page']);
$action = urldecode($_GET['action']);
$sort_by = isset($_GET['sort_by']) && trim($_GET['sort_by']) != '' ? urldecode($_GET['sort_by']) : NULL;
$sort_direction = urldecode(trim($_GET['sort_direction']));
$sort_direction = $sort_direction == '' || $sort_direction == 'asc' ? 'asc' : 'desc';
$customers_list = $team->list_customer($employee, $search, $action, $page, $sort_by, $sort_direction);
$customers = $team->list_customer_full($employee,'', $action, $page);
//echo "<pre>".print_r($customers_list, 1)."</pre>"; exit();
for($i=0;$i<count($customers_list);$i++){
    if($customers_list[$i]['mobile'] != ""){
       $length_mobile_display = (strlen($customers_list[$i]['mobile'])-5)/2;
       //$customer_list[$i]['mobile'] = "0".substr($customer_list[$i]['mobile'], 0,2) . "-" . substr($customer_list[$i]['mobile'], 2,3)." ".substr($customer_list[$i]['mobile'], 5,2)." ".substr($customer_list[$i]['mobile'], 7,2)." ".substr($customer_list[$i]['mobile'],9,2);
       $temp_mobile = '';
       $pos = 5;
       for($j=0;$j<$length_mobile_display;$j++){
           $temp_mobile = $temp_mobile." ".substr($customers_list[$i]['mobile'], $pos,2);
           $pos = $pos +2;
       }
       $customers_list[$i]['mobile'] = "0".substr($customers_list[$i]['mobile'], 0,2) . "-" . substr($customer_list[$i]['mobile'], 2,3)." ".$temp_mobile;

    }
    if($customers_list[$i]['phone'] != ""){
        $customers_list[$i]['phone'] = "0".substr($customers_list[$i]['phone'], 0,2) . "-" . substr($customers_list[$i]['phone'], 2);
    }
    $customers_list[$i]['social_security'] = $customers_list[$i]['century'].' '. substr($customers_list[$i]['social_security'], 0, -4) . "-" . substr($customers_list[$i]['social_security'], 6);
}
$smarty->assign('customer_list',$customers_list);
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
$smarty->assign('customers',$customers);
$smarty->assign('action',$action);

$list_accessible_customers_modified = array();
if(!empty($customers)){
    foreach ($customers as $acustomer) {
        $list_accessible_customers_modified[] = array( 
            'uname' => $acustomer['username'],
            'label' => ($_SESSION['company_sort_by'] == 1 ? $acustomer['first_name'].' '.$acustomer['last_name'] : $acustomer['last_name'].' '.$acustomer['first_name']).'('.$acustomer['code'].')',
            'code'  => $acustomer['code'],
            'ssn'   => $acustomer['social_security'],
            'mobile'=> $acustomer['mobile'],
            'email' => $acustomer['email']);
    }
}
// echo "<pre>".print_r($list_accessible_customers_modified, 1)."</pre>"; exit();
//$smarty->assign('employees',$obj_employee->employee_list());
$smarty->assign('json_customers',  json_encode($list_accessible_customers_modified));

$smarty->display("ajax_customer_listing.tpl");
?>