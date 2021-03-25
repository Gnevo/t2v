<?php
require_once('class/setup.php');
require_once('class/customer.php');
require_once('class/customer_ai.php');

//require_once('class/newcustomer.php');
$customer = new customer();
$customer_ai = new customer_ai();
$smarty = new smartySetup(array("user.xml", "reports.xml"), FALSE);
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
$customer_username = $_REQUEST['customer'];


$customer_detail = $customer->customer_detail($customer_username);
$customer_detail['social_security'] = substr($customer_detail['social_security'], 0, -4) . "-" . substr($customer_detail['social_security'], 6);
if($customer_detail['mobile'] != ""){
        $length_mobile_display = (strlen($customer_detail['mobile'])-5)/2;
    //$customer_detail['mobile'] = "0".substr($customer_detail['mobile'], 0,2) . "-" . substr($customer_detail['mobile'], 2,3)." ".substr($customer_detail['mobile'], 5,2)." ".substr($customer_detail['mobile'], 7,2)." ".substr($customer_detail['mobile'],9,2);
        $temp_mobile = '';
        $pos = 5;
        for($i=0;$i<$length_mobile_display;$i++){
            $temp_mobile = $temp_mobile." ".substr($customer_detail['mobile'], $pos,2);
            $pos = $pos +2;
        }
        $customer_detail['mobile'] = "+46".substr($customer_detail['mobile'], 0,3) . " " . substr($customer_detail['mobile'], 3,2)." ".$temp_mobile;
}
if($customer_detail['phone'] != ""){
    $customer_detail['phone'] = "0".substr($customer_detail['phone'], 0,2) . "-" . substr($customer_detail['phone'], 2);
}

$smarty->assign('customer_detail', $customer_detail);
$smarty->assign('customer_relatives', $customer->customer_relatives($customer_username));
$smarty->assign('customer_health', $customer->customer_health($customer_username));
$smarty->assign('customer_guardian', $customer->customer_guardian($customer_username));

$allocated_employees_array = $customer_ai->customer_team_members($customer_username);
$allocated_employees = implode(',', $allocated_employees_array);
$smarty->assign('team_members', $allocated_employees);
$team_leader = $customer_ai->customer_team_leader($customer_username);
$super_team_leader = $customer_ai->customer_super_team_leader($customer_username);
$tl = $stl = '';
for($i=0;$i<count($team_leader);$i++){
     if($tl == ''){
         $tl = $team_leader[$i]['employee'];
     }else{
         $tl = $tl.",".$team_leader[$i]['employee'];
     }
}
for($i=0;$i<count($super_team_leader);$i++){
     if($stl == ''){
         $stl = $super_team_leader[$i]['employee'];
     }else{
         $stl = $stl.",".$super_team_leader[$i]['employee'];
     }
}
//$stl = $super_team_leader['employee'];
$smarty->assign('team_leader', $tl);
$smarty->assign('super_team_leader', $stl);
$smarty->assign('customer_team',$customer_team =  $customer_ai->customer_alocate_employee($allocated_employees_array, $tl,$stl));
$smarty->display('ajax_rpt_cust_profile.tpl');

?>
