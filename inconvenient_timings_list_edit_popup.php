<?php
require_once('class/setup.php');
require_once('class/inconvenient_timing.php');

$smarty = new smartySetup(array("inconvenient_timing.xml", "messages.xml", "button.xml", "month.xml"),FALSE);
$inc_timing = new inconvenient_timing();

$block_master_details = array();
if(isset($_REQUEST['inc_id']) && $_REQUEST['inc_id'] != ''){
    $block_master_details = $inc_timing->get_holiday_blockmaster_details_byId($_REQUEST['inc_id']);
    if(!empty($block_master_details)){
        $block_master_details = $block_master_details[0];
        $local_bm = $inc_timing->get_local_holiday_blockmaster_details_byId($_REQUEST['inc_id']);
        if(!empty($local_bm)){
            $block_master_details['start_time'] = $local_bm[0]['start_time'];
            $block_master_details['end_time'] = $local_bm[0]['end_time'];
        }
    }
//    echo "<pre>".print_r($block_master_details, 1)."</pre>";
}

$smarty->assign('bm_details', $block_master_details);
//echo "<pre>".print_r($leave_details, 1)."</pre>";
//$smarty->assign('emp_alloc', $_SESSION['user_id']);
//$smarty->assign('emp_role', $_SESSION['user_role']); // role of employee logged in

$smarty->display('extends:layouts/ajax_popup.tpl|inconvenient_timings_list_edit_popup.tpl');
?>
