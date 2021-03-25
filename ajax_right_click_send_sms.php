<?php
require_once('class/setup.php');
require_once('class/employee.php');
//require_once('class/customer.php');
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml","privilege.xml","month.xml","gdschema.xml","mail.xml"), FALSE);
$employee = new employee();
//$customer = new customer();
$ids = $_REQUEST['ids'];
$slots = explode("-", $ids);
$count_slots = count($slots);
$slot_ids = "";
for($i=0;$i < $count_slots;$i++){
    if($slots[$i] != ""){
        if($slot_ids == ""){
            $slot_ids = $slots[$i];
        }else{
           $slot_ids = $slot_ids.",".$slots[$i]; 
        }
    }
}
$empl = $employee->get_available_employees_for_selected_slots($slot_ids);
$smarty->assign('employees',$empl);
$smarty->assign('slot_id',$slot_ids);
$smarty->assign('user_role',$_SESSION['user_role']);
//echo "<pre>". print_r($empl, 1)."</pre>";
$smarty->display("ajax_right_click_send_sms.tpl");
?>