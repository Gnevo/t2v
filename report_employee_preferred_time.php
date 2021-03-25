<?php
require_once('configs/config.inc.php');
require_once('class/setup.php');
require_once('class/timetable.php');
require_once('class/customer.php');
require_once('class/employee.php');
require_once('plugins/message.class.php');
require_once('class/employee_ext.php');

$smarty        = new smartySetup(array("messages.xml","month.xml","button.xml", "user.xml","reports.xml","billing.xml","employee.xml"));
$obj_timetable = new timetable();
$obj_customer  = new customer();
$obj_employee  = new employee();
$messages      = new message();
$obj_emp       = new employee_ext();

global $week;
$smarty->assign('week', $week);
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 6));

if($_SESSION['user_role'] != 1 && $_SESSION['user_role'] != 6){
    header('location: ' . $smarty->url.'all/gdschema/l/');
    exit();
}

$search_customers = $obj_customer->customers_list_for_employee_report(-1);
$smarty->assign('search_customers', $search_customers);
$search_employees = $obj_employee->employees_list_for_right_click($_SESSION['user_id']);
$search_employee_ids = array();
if(!empty($search_employees)){
    foreach ($search_employees as $se) {
        $search_employee_ids[] = $se['username'];
    }
}

$transaction_flag = TRUE;
$selected_from_date = $selected_to_date   = date('Y-m-d');
$selected_from_time = $selected_to_time   = $selected_customer  = NULL;

$result = array();
$log_sms_count = NULL;
if(isset($_POST["go"]) && $_POST["go"] != ""){
    $selected_from_date = trim($_POST['from_date']);
    $selected_to_date   = trim($_POST['to_date']) != '' ? trim($_POST['to_date']) : NULL;
    $selected_customer  = trim($_POST['cmb_customer']) != '' ? trim($_POST['cmb_customer']) : NULL;


    $smarty->assign("is_generate", TRUE);
    $result = $obj_emp->get_all_employee_non_prefered_time($selected_customer, $selected_from_date, $selected_to_date, 1);
    
    foreach ($result as $key => $value) {
        $data[$value['employee']]['name'] = $_SESSION['company_sort_by'] == 1 ? $value['first_name'].' '. $value['last_name'] : $value['last_name']. ' '. $value['first_name'];
        $data[$value['employee']]['timings'][$value['group_id']][] =  $value;
    }
    //echo "<pre>".print_r($data,1)."</pre>";exit();
}

function format_mobile($result){
    if (!empty($result)) {
        foreach ($result as $key => $au) {
            if ($au['mobile'] != "") {
                $length_mobile_display = (strlen($au['mobile']) - 5) / 2;
                $temp_mobile = '';
                $pos = 5;
                for ($j = 0; $j < $length_mobile_display; $j++) {
                    $temp_mobile = $temp_mobile . " " . substr($au['mobile'], $pos, 2);
                    $pos = $pos + 2;
                }
                $result[$key]['mobile'] = "+46" . substr($au['mobile'], 0, 3) . " " . substr($au['mobile'], 3, 2) . " " . $temp_mobile;
            }
        }
    }
    return $result;
}

$smarty->assign("selected_from_date", $selected_from_date);
$smarty->assign("selected_to_date", $selected_to_date);
$smarty->assign("selected_customer", $selected_customer);

$smarty->assign("data",$data);
$smarty->assign("available_users_count", $available_users_count);
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
$smarty->assign('message', $messages->show_message());

$smarty->display('extends:layouts/dashboard.tpl|report_employee_preferred_time.tpl');
?>