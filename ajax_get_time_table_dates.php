<?php
require_once('configs/config.inc.php');
require_once('class/setup.php');
require_once('class/dona.php');
$smarty = new smartySetup(array("button.xml","messages.xml", "notes.xml","month.xml"), FALSE);
$dona = new dona();
global $month;


if(isset($_REQUEST['action']) && trim($_REQUEST['action']) == 'get_year_month_data'){

    $sel_employee   = trim($_REQUEST['sel_employee']);
    $from_range     = trim($_REQUEST['from_range']);
    $to_range       = trim($_REQUEST['to_range']);

    $result = array();
    if($sel_employee != '' && $from_range != '' && $to_range != ''){

        $period_from = explode('/', $from_range);
        $period_to = explode('/', $to_range);

        $start_year = $period_from[0];
        $end_year = $period_to[0];
        $start_month = $period_from[1];
        $end_month = $period_to[1];

        if(($start_year == $end_year && $start_month <= $end_month) || ($start_year < $end_year)){
            $result = $dona->get_employee_certification_summery_data($sel_employee, $start_year, $start_month, $end_year, $end_month, TRUE);
        }
    }
    $obj_return = new stdClass();
    $obj_return->result = $result;
    echo json_encode($obj_return);
    // echo '<pre>'.print_r($obj_return->result, 1).'</pre>';
    exit();
}
    // last edit sreerag : 05/03/2018

elseif(isset($_REQUEST['action']) && trim($_REQUEST['action']) == 'get_all_year_work_data'){
    $all_year_data = array();
    $obj_contract = new contract();
    $sel_employee   = trim($_REQUEST['sel_employee']);
    $start_year     = trim($_REQUEST['start_year']);
    $___start_month    = trim($_REQUEST['start_month']);
    $end_year       = trim($_REQUEST['end_year']);
    $___end_month      = trim($_REQUEST['end_month']);
    if(($start_year == $end_year && $___start_month <= $___end_month) || ($start_year < $end_year)){
        for($year =$start_year; $year<=$end_year;$year++ ){
            if($year == $start_year){
                $start_month = $___start_month; 
            }
            else{
                $start_month = 1;
            }
            if($year == $end_year){
                $end_month = $___end_month;
            }
            else{
                $end_month = 12;
            }
            $works = $dona->get_work_details_For_certification($sel_employee, $year, $start_month, $end_month, true, true);
            foreach ($works as $value) {
                $index = $value['month'];
                $new_works[$index] = $value;
            }
            if(!empty($new_works)) {
                foreach ($new_works as $w1) {
                    $index = $w1['month'];
                    $this_month_start_date = date('Y-m-01', strtotime($year . "-" . $w1['month'] . "-01"));
                    $this_month_end_date = date('Y-m-t', strtotime($year . "-" . $w1['month'] . "-01"));;
                    /*$cont_hour = $obj_contract->get_employee_contract_between_dates($sel_employee, $this_month_start_date, $this_month_end_date);
                    $hour_sum = isset($cont_hour['contract_hours']) && $cont_hour['contract_hours'] > 0 ? $cont_hour['contract_hours'] : 0;
                    $w_hour = ($hour_sum == 0  || $hour_sum >= $w1['work_hours']) ? $w1['work_hours'] : $hour_sum;
                    $ot_hour = ($hour_sum == 0 || $hour_sum >= $w1['work_hours']) ? 0 : ($w1['work_hours'] - $hour_sum);*/
                    $new_works[$index]['over_time'] = $w1['overtime_hours'];
                    $new_works[$index]['more_time'] = $w1['more_hours'];
                    $new_works[$index]['actual_work_hour'] = number_format((float)($w1['work_hours'] - $w1['overtime_hours'] - $w1['more_hours']), 2, '.', '');
                    //echo 'HS' . $hour_sum . '-W' . $w_hour . '-OT'. $ot_hour;
                }
            }
            //echo '<pre>'.print_r($works, 1).'</pre>';
            $all_year_data[$year] = $new_works;
            $new_works = [];
        }
        echo json_encode($all_year_data);
        exit();
    }
    // print_r($all_year_data);
}
     // last edit sreerag : 05/03/2018

$id = $_POST['id'];
$period = $dona->get_least_and_most_timetable_dates($id);

$i=0;
$dates = array();
$certificates = array();
//$date1 = mktime(0,0,0,$period['least_month'],1,$period['least_year']);
//$date2 = mktime(0,0,0,$period['most_month'],1,$period['most_year']);
if (count($period) && $period["least_month"] != "" && $period["least_year"] != "" && $period["most_month"] != "" && $period["most_year"] != "") {
    
    $startDate = strtotime($period['least_year']."/".$period['least_month']."/01");
    $endDate   = strtotime($period['most_year']."/".$period['most_month']."/01");
    $currentDate = $endDate;
    
//    echo "<pre>".print_r($period, 1)."</pre>";
    
    while ($currentDate >= $startDate) {
        //echo date('Y m',$currentDate);
        $dates[$i]['val']=date('Y/m',$currentDate);
        $dates[$i]['disp']=date('Y',$currentDate). " " . $smarty->translate[$month[date('m',$currentDate)-1]['month']];
        $currentDate = strtotime( date('Y/m/01/',$currentDate).' -1 month');
        $i++;
    }
    
}

$certificates = $dona->get_pdf_certificate($id);
//print_r($dates);
$company = $dona->get_company_directory($_SESSION['company_id']);
$smarty->assign('dates', $dates);
$smarty->assign('certificate', $certificates);
$smarty->assign('company', $company['upload_dir']);

$smarty->display('ajax_get_time_table_dates.tpl');
?>