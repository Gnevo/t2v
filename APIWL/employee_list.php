<?php
// error_reporting(E_ALL);
// error_reporting(E_WARNING);
// ini_set('error_reporting', E_ALL);
// ini_set("display_errors", 1);

require_once('class/setup.php');
require_once('class/customer.php');
require_once('class/employee.php');
require_once('class/user.php');
require_once('plugins/pagination.class.php');
require_once('class/employee_ext.php');

$smarty     = new smartySetup(array("user.xml", "messages.xml", "button.xml","tooltip.xml"));
$customer   = new customer();
$employee   = new employee();
$user       = new user();
$pagination = new pagination();
$obj_emp    = new employee_ext();

$no_of_data_per_page = 30;

$all_employee_checklist = $obj_emp->get_all_employee_checklist();
$smarty->assign('all_employee_checklist',$all_employee_checklist);
// var_dump($all_employee_checklist);exit('df');

$smarty->assign('user_role', $user->user_role($_SESSION['user_id']));
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 2));
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
$name = explode('&', $_SERVER['QUERY_STRING']);
$sort_by = "n";
$search_alph = "";
if ($name[0] == 'act') {
    $e_list = $employee->employee_list($name[1],$sort_by);
    $smarty->assign('action', $name[0]);
} else {
    $e_list = $employee->employee_list_begin($name[1],$sort_by);
    $smarty->assign('action', $name[0]);
}
$smarty->assign('employee_autocomplete', $e_list);
// echo '<pre>'.print_r($e_list, 1).'</pre>';
$list_accessible_employees_modified = array();
if(!empty($e_list)){
    foreach ($e_list as $aemp) {
        $list_accessible_employees_modified[] = array( 
            'uname' => $aemp['username'],
            'label' => ($_SESSION['company_sort_by'] == 1 ? $aemp['first_name'].' '.$aemp['last_name'] : $aemp['last_name'].' '.$aemp['first_name']).'('.$aemp['code'].')',
            'code'  => $aemp['code'],
            'ssn'   => $aemp['social_security'],
            'mobile'   => $aemp['mobile'],
            'email'   => $aemp['email']
        );
    }
}
//echo "<pre>".print_r($list_accessible_employees_modified, 1)."</pre>"; exit();
$smarty->assign('json_employees',  json_encode($list_accessible_employees_modified));

if (isset($name[1]) && !is_numeric($name[1]) && !empty($_SERVER['QUERY_STRING'])) {
    //echo "hi";
    if(!isset($name[2]) || $name[2] == ""){
       $sort_by = "n" ;
    }else{
        $sort_by = $name[2];
    }
    $search_alph = $name[1];
   
    

    if ($e_list) {
        $employee_list = $pagination->generate($e_list, $no_of_data_per_page);
        $smarty->assign('employee_autocomplete', $e_list);
    }
    $count = count($e_list);
    if($count % $no_of_data_per_page == 0){
        $page_count = intval($count/$no_of_data_per_page);
    }else{
        $page_count = 1 + intval($count/$no_of_data_per_page);
    }
    $smarty->assign('count',$page_count);
    $smarty->assign('page',"1");
   // $smarty->assign('pagination', $pagination->links($smarty->url . 'list/employee/' . $name[0] . '/' . $name[1] . '/'.$sort_by.'/'));
} else {
    if(!isset($name[2]) || $name[2] == ""){
       $sort_by = "n" ;
    }else{
        $sort_by = $name[2];
    }
    if ($name[0] == 'act') {
        $e_list = $employee->employee_list('',$sort_by);
        $employee_list = $pagination->generate($employee->employee_list('',$sort_by), $no_of_data_per_page);
        $count = count($e_list);
        if($count % $no_of_data_per_page == 0){
            $page_count = intval($count/$no_of_data_per_page);
        }else{
            $page_count = 1 + intval($count/$no_of_data_per_page);
        }
        $smarty->assign('count',$page_count);
        $smarty->assign('page',"1");
        $smarty->assign('action', $name[0]);
    } else {
        $e_list = $employee->employee_list('',$sort_by);
        $employee_list = $pagination->generate($employee->employee_list_begin('',$sort_by), $no_of_data_per_page);
        $count = count($e_list);
        if($count % $no_of_data_per_page == 0){
            $page_count = intval($count/$no_of_data_per_page);
        }else{
            $page_count = 1 + intval($count/$no_of_data_per_page);
    }
        $smarty->assign('count',$page_count);
        $smarty->assign('page',"1");
        $smarty->assign('action', $name[0]);
    }
}
$count_log = 0;
foreach($e_list AS $empls){
   if($empls['login'] == 1){
       $count_log++;
   }
}
for($i=0;$i<count($employee_list);$i++){
    if($employee_list[$i]['mobile'] != ""){
       $length_mobile_display = (strlen($employee_list[$i]['mobile'])-5)/2;
       //$employee_list[$i]['mobile'] = "0".substr($employee_list[$i]['mobile'], 0,2) . "-" . substr($employee_list[$i]['mobile'], 2,3)." ".substr($employee_list[$i]['mobile'], 5,2)." ".substr($employee_list[$i]['mobile'], 7,2)." ".substr($employee_list[$i]['mobile'],9,2);
       $temp_mobile = '';
       $pos = 5;
       for($j=0;$j<$length_mobile_display;$j++){
           $temp_mobile = $temp_mobile." ".substr($employee_list[$i]['mobile'], $pos,2);
           $pos = $pos +2;
       }
       $employee_list[$i]['mobile'] = "+46".substr($employee_list[$i]['mobile'], 0,3) . " " . substr($employee_list[$i]['mobile'], 3,2)." ".$temp_mobile;
    }
    $employee_list[$i]['social_security'] = $employee_list[$i]['century'].' '.substr($employee_list[$i]['social_security'], 0, -4) . "-" . substr($employee_list[$i]['social_security'], 6);
}

//////////////////     ajax block for checklist start here    //////////////






///////////////////////////       end        ///////////////////////////////



$smarty->assign('count_log',$count_log);
$smarty->assign('emp_count',count($e_list));
$smarty->assign('sort_by',$sort_by);
$smarty->assign('search_alph',$search_alph);
$smarty->assign('privileges_general', $user->get_privileges($_SESSION['user_id'], 2));
$smarty->assign('employee_list', $employee_list);

// var_dump($user->get_privileges($_SESSION['user_id'], 2)); exit('dsfds');


$customers = $customer->customer_list();
$smarty->assign('customers', $customers);
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
$smarty->assign('json_customers',  json_encode($list_accessible_customers_modified));

$smarty->display('extends:layouts/dashboard.tpl|employee_list.tpl');
?>