<?php
require_once('configs/config.inc.php');
require_once('class/setup.php');
require_once('class/sms.php');
require_once('class/company.php');

$smarty = new smartySetup(array("messages.xml","month.xml","button.xml", "user.xml","reports.xml","billing.xml"));
$obj_sms = new sms();

$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 6));

if($_SESSION['user_role'] != 1){
    header('location: ' . $smarty->url.'all/gdschema/l/');
    exit();
}
//echo "<pre>".print_r($_SESSION, 1)."</pre>"; exit();
global $month, $company;
$years_combo= $obj_sms->distinct_sms_log_years();
$smarty->assign("year_option_values", $years_combo);

$month_num = $month_name_full = $month_name_short = array();
foreach ($month as $m_id) {
    $month_num[]=$m_id['id'];
    $month_name_short[] = $smarty->translate[$m_id['label']];
    $month_name_full[]=$smarty->translate[$m_id['month']];
}
$obj_company = new company();
$company_det = $obj_company->get_company_detail($_SESSION['company_id']);
$smarty->assign("company_name", $company_det['name']);
$smarty->assign("month_option_values", $month_num);
$smarty->assign("month_option_output_short", $month_name_short);
$smarty->assign("month_option_output_full", $month_name_full);
/* end-- block for finding year values  */
$selected_year = (in_array(date('Y'),$years_combo) ? date('Y') : '');
$selected_month = (int) date('m');
$selected_type = 2;

$log_result = array();
$log_sms_count = NULL;
//echo "<pre>".print_r($_POST, 1)."</pre>"; exit();
if(isset($_POST["cmb_year"]) && $_POST["cmb_year"] != ""){
    $selected_year  = trim($_POST['cmb_year']);
    $selected_month = trim($_POST['cmb_month']);
    $selected_type  = trim($_POST['cmb_type']);
    
    $smarty->assign("is_generate", TRUE);
    
    // GET ALL INCOMING SMS
    if($selected_type == 1){
        $log_result = $obj_sms->get_all_incoming_sms($selected_year, $selected_month);
//        echo "<pre>".print_r($log_result, 1)."</pre>"; exit();
        $log_sms_count = count($log_result);
        if (!empty($log_result)) {
            foreach ($log_result as $key => $log) {
                if ($log['mobile'] != "") {
                    $length_mobile_display = (strlen($log['mobile']) - 5) / 2;
                    $temp_mobile = '';
                    $pos = 5;
                    for ($j = 0; $j < $length_mobile_display; $j++) {
                        $temp_mobile = $temp_mobile . " " . substr($log['mobile'], $pos, 2);
                        $pos = $pos + 2;
                    }
                    $log_result[$key]['mobile'] = "+46" . substr($log['mobile'], 0, 3) . " " . substr($log['mobile'], 3, 2) . " " . $temp_mobile;
                }
            }
        }
    }
    // GET ALL OUTGOING SMS
    else if ($selected_type == 2) {
        $log_result = $obj_sms->get_all_outgoing_sms($selected_year, $selected_month);
        $log_sms_count = count($log_result);
        if (!empty($log_result)) {
            foreach ($log_result as $key => $log) {
                if ($log['to_no'] != "") {
                    $length_mobile_display = (strlen($log['to_no']) - 5) / 2;
                    $temp_mobile = '';
                    $pos = 5;
                    for ($j = 0; $j < $length_mobile_display; $j++) {
                        $temp_mobile = $temp_mobile . " " . substr($log['to_no'], $pos, 2);
                        $pos = $pos + 2;
                    }
                    $log_result[$key]['to_no'] = "+46" . substr($log['to_no'], 0, 3) . " " . substr($log['to_no'], 3, 2) . " " . $temp_mobile;
                }
                $log_result[$key]['message'] = urldecode($log['message']);
            }
        }
//        echo "<pre>".print_r($log_result, 1)."</pre>"; exit();
    }
}
$smarty->assign("selected_year", $selected_year);
$smarty->assign("selected_month", $selected_month);
$smarty->assign("selected_type", $selected_type);
$smarty->assign("log_result", $log_result);
$smarty->assign("log_sms_count", $log_sms_count);
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);

$smarty->display('extends:layouts/dashboard.tpl|report_sms_log.tpl');
?>