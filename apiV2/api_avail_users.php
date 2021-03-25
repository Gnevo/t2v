<?php
require_once('api_common_functions.php');
$session_check = check_user_session();

require_once('class/setup.php');
require_once('class/employee.php');
require_once('class/leave.php');
require_once('class/dona.php');

$smarty = new smartySetup(array("user.xml"), FALSE);
$leave = new leave();
$obj_emp = new employee();
$obj_dona = new dona();

$id         = isset($_REQUEST['slot_id']) && trim($_REQUEST['slot_id']) != '' ? trim($_REQUEST['slot_id']) : NULL;
$cust       = isset($_REQUEST['customer']) && trim($_REQUEST['customer']) != '' ? trim($_REQUEST['customer']) : NULL;
$time_from  = isset($_REQUEST['time_from']) && trim($_REQUEST['time_from']) != '' ? trim($_REQUEST['time_from']) : NULL;
$time_to    = isset($_REQUEST['time_to']) && trim($_REQUEST['time_to']) != '' ? trim($_REQUEST['time_to']) : NULL;
$date       = isset($_REQUEST['date']) && trim($_REQUEST['date']) != '' ? trim($_REQUEST['date']) : NULL;
$except_id  = isset($_REQUEST['except_id']) && trim($_REQUEST['except_id']) != '' ? trim($_REQUEST['except_id']) : NULL;
$user       = isset($_REQUEST['user']) && trim($_REQUEST['user']) != '' ? trim($_REQUEST['user']) : NULL;

$datas = array();

if (isset($_REQUEST['sms_process_status']))
    $datas = $obj_emp->get_sms_processed_users($id);
else if($cust != NULL && $time_from != NULL && $time_to != NULL && $date != NULL){
    $time_from  = $obj_dona->time_to_sixty($time_from);
    $time_to    = $obj_dona->time_to_sixty($time_to);
    if($time_to == 0) $time_to = 24;

    $datas = $obj_emp->get_available_users($cust, $time_from, $time_to, $date, NULL, $except_id);
}

$users = array();
$i = 0;

if(!empty($datas)){
    foreach ($datas as $data) {
        unset($data['name']);
        unset($data['name_ff']);
        
        if ($data['username'] != $user ) {
            $sms_det = $leave->get_leave_sms_details($id, $data['username']);

            if($sms_det){
                // if($sms_det['status'] == '3')
                //     $smarty->assign('sms_status', '3');
                $sms_data = array('sms_id' => $sms_det['slot'], 'sms_send' => substr($sms_det['send_time'], 6, 10) , 'sms_status' => $sms_det['status'], 'sms_receive' => substr($sms_det['receive_time'], 6, 10));
                $data = array_merge($data, $sms_data);
            }
        }
        $users[] = $data;
        $i++;
    }
}

$obj = new stdClass();
$obj->session_status = $session_check;
$obj->data_set = $users;
echo json_encode($obj);
?>