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
$preference_mode = 1;
if(isset($_POST["go"]) && $_POST["go"] != ""){
    $selected_from_date = trim($_POST['from_date']);
    $selected_to_date   = trim($_POST['to_date']) != '' ? trim($_POST['to_date']) : NULL;
    $selected_from_time = trim($_POST['from_time']) != '' ? trim($_POST['from_time']) : NULL;
    $selected_to_time   = trim($_POST['to_time']) != '' ? trim($_POST['to_time']) : NULL;
    $selected_customer  = trim($_POST['cmb_customer']) != '' ? trim($_POST['cmb_customer']) : NULL;

    if($selected_from_date == ''){
        $messages->set_message('fail', 'please_enter_date_from');
        $transaction_flag = FALSE;
    }
    else if($selected_to_date == ''){
        $messages->set_message('fail', 'please_enter_date_to');
        $transaction_flag = FALSE;
    }
    
    if($transaction_flag){
        $smarty->assign("is_generate", TRUE);
        $result = $obj_timetable->get_available_employees_for_avail_report($selected_from_date, $selected_to_date, $selected_from_time, $selected_to_time, $selected_customer, $search_employee_ids);
        $preference_mode = $_POST['pref_selection'];
        
        if($preference_mode == 0){
            $all_emp_with_non_preferred_times = $obj_emp->all_emp_with_non_preferred_times($selected_from_date, $selected_to_date, $selected_from_time, $selected_to_time, $selected_customer);
            $result = format_mobile($result);
            $all_emp_with_non_preferred_times =  format_mobile($all_emp_with_non_preferred_times);
            // echo "<pre>".print_r($all_emp_with_non_preferred_times, 1)."</pre>"; 
            $customized_non_preferd_times = array();

            foreach ($all_emp_with_non_preferred_times as $key => $emp_det) {
                if($emp_det['username'] != $prev_user){
                    $customized_non_preferd_times[$emp_det['username']] = array(
                        'name' => $emp_det['name'],
                        'code' => $emp_det['code'],
                        'mobile' => $emp_det['mobile'],
                        'days' => array(
                            0 =>array(
                                'day' => $emp_det['day'],
                                'time_from' => $emp_det['time_from'],
                                'time_to' => $emp_det['time_to'],
                            ),
                        )
                    );
                }
                else{
                    $customized_non_preferd_times[$emp_det['username']]['days'][] = array(
                                'day' => $emp_det['day'],
                                'time_from' => $emp_det['time_from'],
                                'time_to' => $emp_det['time_to'],
                            );

                }
                $prev_user = $emp_det['username'];
            }
        }elseif($preference_mode == 1){
            $preferred_time_employees = $obj_emp->get_all_employee_non_prefered_time($selected_customer, $selected_from_date, $selected_to_date, 1, $search_employee_ids);
    
            foreach ($preferred_time_employees as $key => $value) {
                $preferred_time_employees_customized[$value['employee']]['name'] = $_SESSION['company_sort_by'] == 1 ? $value['first_name'].' '. $value['last_name'] : $value['last_name']. ' '. $value['first_name'];
                $preferred_time_employees_customized[$value['employee']]['timings'][$value['group_id']][] =  $value;
            }
        }

        // echo "<pre>".print_r($customized_non_preferd_times, 1)."</pre>"; exit();

        $available_users_count = count($result);
    }
    
}
$smarty->assign("preference_mode", $preference_mode);

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
$smarty->assign("selected_from_time", $selected_from_time);
$smarty->assign("selected_to_time", $selected_to_time);
$smarty->assign("selected_customer", $selected_customer);

$smarty->assign("customized_non_preferd_times",$customized_non_preferd_times);
$smarty->assign("preferred_time_employees_customized",$preferred_time_employees_customized);
$smarty->assign("available_users", $result);
$smarty->assign("available_users_count", $available_users_count);
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
$smarty->assign('message', $messages->show_message());

$smarty->display('extends:layouts/dashboard.tpl|report_avail_employees.tpl');
?>