<?php
require_once('class/setup.php');
require_once('class/team.php');
$team = new team();
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml","privilege.xml","tooltip.xml"), FALSE);
$search = urldecode($_GET['search']);
$customer = urldecode($_GET['cust']);
$page = urldecode($_GET['page']);
$action = urldecode($_GET['action']);
$sort_by = urldecode($_GET['sort_by']);
$sort_direction = urldecode(trim($_GET['sort_direction']));
$sort_direction = $sort_direction == '' || $sort_direction == 'asc' ? 'asc' : 'desc';
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
$employees_list = $team->list_employee($customer, $search, $action, $page,$sort_by, $sort_direction);
$employees = $team->list_employee_full($customer,'', $action, $page);
$count_log = 0;
foreach($employees AS $empls){
   if($empls['login'] == 1){
       $count_log++;
   }
}
for($i=0;$i<count($employees_list);$i++){
    if($employees_list[$i]['mobile'] != ""){
       $length_mobile_display = (strlen($employees_list[$i]['mobile'])-5)/2;       
       $temp_mobile = '';
       $pos = 5;
       for($j=0;$j<$length_mobile_display;$j++){
           $temp_mobile = $temp_mobile." ".substr($employees_list[$i]['mobile'], $pos,2);
           $pos = $pos +2;
       }
       $employees_list[$i]['mobile'] = "+46".substr($employees_list[$i]['mobile'], 0,3) . " " . substr($employees_list[$i]['mobile'], 3, 2)." ".$temp_mobile;

    }
    $employees_list[$i]['social_security'] = $employees_list[$i]['century'].' '.substr($employees_list[$i]['social_security'], 0, -4) . "-" . substr($employees_list[$i]['social_security'], 6);
}
$smarty->assign('count_log',$count_log);
$smarty->assign('employee_list',$employees_list);
$smarty->assign('employees',$employees);

$list_accessible_employees_modified = array();
if(!empty($employees)){
    foreach ($employees as $aemp) {
        $list_accessible_employees_modified[] = array( 
            'uname' => $aemp['username'],
            'label' => ($_SESSION['company_sort_by'] == 1 ? $aemp['first_name'].' '.$aemp['last_name'] : $aemp['last_name'].' '.$aemp['first_name']).'('.$aemp['code'].')',
            'code'  => $aemp['code'],
            'ssn'   => $aemp['social_security'],
            'mobile'=> $aemp['mobile'],
            'email' => $aemp['email']);
    }
}
// echo "<pre>".print_r($list_accessible_employees_modified, 1)."</pre>"; exit();
$smarty->assign('json_employees',  json_encode($list_accessible_employees_modified));
$smarty->assign('action',  $action);


$smarty->display("ajax_employee_listing.tpl");
?>