<?php

require_once('class/setup.php');
require_once('class/customer.php');
require_once('class/employee.php');
require_once('class/team.php');
require_once('plugins/pagination.class.php');
require_once('class/user.php');
$customer = new customer();
$employee = new employee();
$team = new team();
$pagination = new pagination();
$user = new user();
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml","tooltip.xml"));
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 3));
$smarty->assign('user_role', $user->user_role($_SESSION['user_id']));
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
$name = explode('&', $_SERVER['QUERY_STRING']);
$no_of_data_per_page = 30;
$sort_by = NULL;
$smarty->assign('sort_by', '');
if(isset($name[1]) && $name[1] == 'CC') //customer code
    $sort_by = 'CC';
else if(isset($name[2]) && $name[2] == 'CC') //customer code
    $sort_by = 'CC';
if($sort_by !== NULL)
    $smarty->assign('sort_by', $sort_by);

$sort_direction = 'asc';
if(isset($name[2]) && $name[2] != 'CC')
    $sort_direction = $name[2];
else if(isset($name[3]) && $name[3] != 'CC')
    $sort_direction = $name[3];

$smarty->assign('sort_direction', $sort_direction == 'asc' ? 'asc' : 'desc');

$filter_charecter = NULL;
$smarty->assign('page_letter', '');
if (isset($name[1]) && !is_numeric($name[1]) && $name[1] != 'CC') {
    $filter_charecter = $name[1];
    $smarty->assign('page_letter', $filter_charecter);
}
//echo $translate.alphabets;
$e_list = array();
if ($name[0] == 'inact')
    $e_list = $customer->customer_list_begin($filter_charecter, $sort_by, $sort_direction);
else
    $e_list = $customer->customer_list($filter_charecter, $sort_by, $sort_direction);

$smarty->assign('action', $name[0]);
$smarty->assign('customer_count', count($e_list));
if ($e_list) $customer_list = $pagination->generate($e_list, $no_of_data_per_page);

$pagination_link = $smarty->url . 'list/customer/' . $name[0] . '/';
if($filter_charecter !== NULL) $pagination_link .= $filter_charecter . '/';
if($sort_by !== NULL) $pagination_link .= $sort_by . '/';
if($sort_by !== NULL) $pagination_link .= $sort_direction . '/';

$smarty->assign('pagination', $pagination->links($pagination_link));

$emp_list = $employee->employee_list();
$smarty->assign('employees',$emp_list);
$list_accessible_employees_modified = array();
if(!empty($emp_list)){
    foreach ($emp_list as $aemp) {
        $list_accessible_employees_modified[] = array( 
            'uname' => $aemp['username'],
            'label' => ($_SESSION['company_sort_by'] == 1 ? $aemp['first_name'].' '.$aemp['last_name'] : $aemp['last_name'].' '.$aemp['first_name']).'('.$aemp['code'].')',
            'code'  => $aemp['code'],
            'ssn'   => $aemp['social_security'],
            'mobile'   => $aemp['mobile'],
            'email'   => $aemp['email']);
    }
}
// echo "<pre>".print_r($list_accessible_employees_modified, 1)."</pre>"; exit();
$smarty->assign('json_employees',  json_encode($list_accessible_employees_modified));

if($name[0] == 'act'){
    $cust = $team->customers_team_employee();
    $smarty->assign('customers',$cust);
}else{
    $cust = $team->customers_team_employee_inact();
    $smarty->assign('customers',$cust);
}
$list_accessible_customers_modified = array();
if(!empty($cust)){
    foreach ($cust as $acustomer) {
        $list_accessible_customers_modified[] = array( 
            'uname' => $acustomer['username'],
            'label' => ($_SESSION['company_sort_by'] == 1 ? $acustomer['first_name'].' '.$acustomer['last_name'] : $acustomer['last_name'].' '.$acustomer['first_name']).'('.$acustomer['code'].')',
            'code'  => $acustomer['code'],
            'ssn'   => $acustomer['social_security'],
            'mobile'   => $acustomer['mobile'],
            'email'   => $acustomer['email']);
    }
}
// echo "<pre>".print_r($list_accessible_customers_modified, 1)."</pre>"; exit();
//$smarty->assign('employees',$obj_employee->employee_list());
$smarty->assign('json_customers',  json_encode($list_accessible_customers_modified));

$customers_list_count = count($customer_list);
for($i=0;$i<$customers_list_count;$i++){
    if($customer_list[$i]['mobile'] != ""){
       $length_mobile_display = (strlen($customer_list[$i]['mobile'])-5)/2;
       //$customer_list[$i]['mobile'] = "0".substr($customer_list[$i]['mobile'], 0,2) . "-" . substr($customer_list[$i]['mobile'], 2,3)." ".substr($customer_list[$i]['mobile'], 5,2)." ".substr($customer_list[$i]['mobile'], 7,2)." ".substr($customer_list[$i]['mobile'],9,2);
       $temp_mobile = '';
       $pos = 5;
       for($j=0;$j<$length_mobile_display;$j++){
           $temp_mobile = $temp_mobile." ".substr($customer_list[$i]['mobile'], $pos,2);
           $pos = $pos +2;
       }
       $customer_list[$i]['mobile'] = "+46".substr($customer_list[$i]['mobile'], 0,3) . " " . substr($customer_list[$i]['mobile'], 3,2)." ".$temp_mobile;

    }
    if($customer_list[$i]['phone'] != ""){
        $customer_list[$i]['phone'] = "0".substr($customer_list[$i]['phone'], 0,2) . "-" . substr($customer_list[$i]['phone'], 2);
    }
    $customer_list[$i]['social_security'] = $customer_list[$i]['century'].' '.substr($customer_list[$i]['social_security'], 0, -4) . "-" . substr($customer_list[$i]['social_security'], 6);
}
$smarty->assign('customer_list', $customer_list);
$smarty->assign('privileges_general', $user->get_privileges($_SESSION['user_id'], 2));
$smarty->display('extends:layouts/dashboard.tpl|customer_list.tpl');
?>