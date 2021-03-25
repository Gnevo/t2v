<?php
require_once('class/setup.php');
require_once('plugins/calender.class.php');
$smarty = new smartySetup(array('month.xml'), FALSE);
$calender = new calender();

$months = $calender->get_months();
$smarty->assign('months', $months);
$smarty->assign('weeks', $calender->get_weeks());
$cur_year = date('Y');
$cur_month = date('m');
$cur_day = date('d');
$smarty->assign('cur_year', $cur_year);
$smarty->assign('cur_month', $cur_month);
$smarty->assign('cur_day', $cur_day);
//echo $_SERVER['QUERY_STRING'];
$is_employee_starup_page = FALSE;
if ($_SERVER['QUERY_STRING']) {
    
    $query_string = explode("&", $_SERVER['QUERY_STRING']);
//    if (count($query_string) == 1) {
    if (count($query_string) <= 2) {
        
        $date = explode('-', $query_string[0]);
        $cur_year = $date[0];
        $cur_month = sprintf("%02d", $date[1]);
        $cur_day = $date[2];
        
        if (isset($query_string[1]) && $query_string[1] == 1) {
            $is_employee_starup_page = TRUE;
        }
        
    } else {
        
        if ($query_string[0]) {
            $cur_year = $query_string[0];
        }
        if ($query_string[1]) {
            $cur_month = sprintf("%02d",$query_string[1]);
        }
        if ($query_string[2]) {
            $cur_day = $query_string[2];
        }
        if (isset($query_string[3]) && $query_string[3] == 1) {
            $is_employee_starup_page = TRUE;
        }
    }
}
$smarty->assign('year', $cur_year);
$smarty->assign('month', $cur_month);
$smarty->assign('day', $cur_day);
$prv_month = date("m", strtotime($cur_year . $cur_month . $cur_day . '-1 month'));
$prv_year   = date("Y", strtotime($cur_year . $cur_month . $cur_day . '-1 month'));
$next_month = date("m", strtotime($cur_year . $cur_month . $cur_day . '+1 month'));
$next_year  = date("Y", strtotime($cur_year . $cur_month . $cur_day . '+1 month'));
$smarty->assign('prv_month', $prv_month);
$smarty->assign('prv_year', $prv_year);
$smarty->assign('next_month', $next_month);
$smarty->assign('next_year', $next_year);
$month_label = $months[((int) $cur_month - 1)]['month'];
$smarty->assign('month_label', $month_label);
$smarty->assign('is_employee_starup_page', $is_employee_starup_page);

$smarty->assign('month_weeks', $calender->calender_month($cur_year, $cur_month, $cur_day));
//echo "<pre>\n".print_r($calender->calender_month($cur_year, $cur_month, $cur_day), 1)."</pre>";
//Setting layout and page
$smarty->display('extends:layouts/ajax_popup.tpl|ajax_calender.tpl');
?>