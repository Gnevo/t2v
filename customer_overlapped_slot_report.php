<?php
require_once('class/setup.php');
require_once('class/timetable.php');
require_once('class/customer.php');
require_once('class/dona.php');
require_once('plugins/calender.class.php');

$timetablee_obj = new timetable();
$obj_calender   = new calender();
$obj_customer   = new customer();
$dona = new dona();

$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml","month.xml","privilege.xml","reports.xml"));
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 6));

$months = $obj_calender->get_months();
$smarty->assign('weeks', $obj_calender->get_weeks());
$smarty->assign('months', $months);
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
$month = date("m");
$year = date("Y");
$selected_customer = '';
$fk_option = $kn_option = $tu_option = TRUE;
// echo "<pre>".print_r($_POST, 1)."<pre>"; exit();
if(isset($_POST['months']) &&  isset($_POST['year']) &&  isset($_POST['cmb_customer'])){
    $month             = $_POST['months'];
    $year              = $_POST['year'];
    $star_date         = $year.'-'.$month.'-01';
    $end_date          = date("Y-m-t",strtotime($star_date));
    $selected_customer = $_POST['cmb_customer'];
    $fk_option         = (isset($_POST['fk_check']) && trim($_POST['fk_check']) == 1 ? TRUE : FALSE);
    $kn_option         = (isset($_POST['kn_check']) && trim($_POST['kn_check']) == 1 ? TRUE : FALSE);
    $tu_option         = (isset($_POST['tu_check']) && trim($_POST['tu_check']) == 1 ? TRUE : FALSE);
}

$filter_insurance = array();
if($fk_option) $filter_insurance[] = 1;
if($kn_option) $filter_insurance[] = 2;
if($tu_option) $filter_insurance[] = 3;

// echo "<pre>".print_r($filter_insurance, 1)."<pre>"; exit();
for($i=0;$i<count($months);$i++){
    if($months[$i]['id'] == $month){
        $smarty->assign('month_label',$months[$i]['month']);
        break;
    }
}
$customer_details = $obj_customer->customer_data($selected_customer);
$search_customers = $obj_customer->customers_list_for_employee_report();
//echo "<pre>". print_r($search_customers, 1)."</pre>";
$smarty->assign('search_customers', $search_customers);
//$data = $timetablee_obj->get_overlapped_slots_of_customer($selected_customer,$month,$year);
$month_weeks = $obj_calender->calender_month($year, $month, 01);
// echo "<pre>".print_r($month_weeks, 1)."<pre>"; exit();
$tot_colliding_hours = 0;
if(!empty($month_weeks)){
    foreach($month_weeks AS $mkey => $months){
        foreach($months['days'] AS $dkey => $day){
            $data = $timetablee_obj->get_overlapped_slots_of_customer($selected_customer,$day['date'], $filter_insurance, $star_date, $end_date);
            $month_weeks[$mkey]['days'][$dkey]['slots'] = array_sort($data['result'],'time_from');
            $tot_colliding_hours += $data['time_collide'];
            
        }
        
    }
}
$years_combo = $dona->distinct_timetable_years('all_year');
$smarty->assign("tot_colliding_hours", $tot_colliding_hours);
$smarty->assign("year_option_values", $years_combo);
$smarty->assign('report_month', sprintf("%1d",$month));
$smarty->assign('report_year', $year);
$smarty->assign('select_customer', $_POST['cmb_customer']);
// echo "<pre>". print_r($month_weeks, 1)."</pre>"; exit();
$smarty->assign('month_weeks', $month_weeks);
$smarty->assign('selected_month', $month);
$smarty->assign('selected_year', $year);
$smarty->assign('selected_cust', $selected_customer);
$smarty->assign('filter_insurance', $filter_insurance);
$smarty->display('extends:layouts/dashboard.tpl|customer_overlapped_slot_report.tpl');



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