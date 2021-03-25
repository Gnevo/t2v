<?php
require_once('class/setup.php');
require_once('class/timetable.php');
$timetablee_obj = new timetable();
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml","month.xml","privilege.xml","reports.xml"), FALSE);
$cust = $_REQUEST['cust'];
$date = $_REQUEST['date'];
$selected_insurances = isset($_REQUEST['insurances']) && trim($_REQUEST['insurances']) != '' ? explode(',', trim($_REQUEST['insurances'])) : array();
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
$overlapped_slots =  $timetablee_obj->get_overlapped_slots_of_customer($cust, $date, $selected_insurances);
$smarty->assign('overlapped_slots',array_sort($overlapped_slots['result'],'time_from'));
$smarty->assign('time_collide',$overlapped_slots['time_collide']);
//echo "<pre>". print_r($overlapped_slots, 1)."</pre>";
$smarty->display("ajax_customer_overlap_report.tpl");




function array_sort($array, $on, $order=SORT_ASC){

    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
                break;
            case SORT_DESC:
                arsort($sortable_array);
                break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}
?>