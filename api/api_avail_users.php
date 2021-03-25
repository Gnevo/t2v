<?php
session_name('t2v-cirrus');
session_start('t2v-cirrus');
$app_dir = dirname(dirname( realpath( __FILE__ ) )) ;
chdir ($app_dir);
require_once('class/setup.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
require_once('class/user.php');
require_once('class/employee.php');
require_once('class/leave.php');

$leave = new leave();
$user = new user();
$obj_emp = new employee();
$id = $_REQUEST['slot_id'];
$cust = $_REQUEST['customer'];
$time_from = $_REQUEST['time_from'];
$time_to = $_REQUEST['time_to'];
$date = $_REQUEST['date'];
$i = 0;
if ($_REQUEST['sms_process_status']){
$datas = $obj_emp->get_sms_processed_users($id);
}
else{
    $datas = $obj_emp->get_available_users($cust, $time_from, $time_to, $date);
}
$users = array();
$sms_data = array();
foreach ($datas as $data) {
    if ($employee['username'] != $_REQUEST['user']) {
        $sms_det = $leave->get_leave_sms_details($id, $data['username']);
            if($sms_det){
                if($sms_det['status'] == '3'){
                    $smarty->assign('sms_status', '3');
                }
                $sms_data = array('sms_id' => $sms_det['slot'], 'sms_send' => substr($sms_det['send_time'], 6, 10) , 'sms_status' => $sms_det['status'], 'sms_receive' => substr($sms_det['receive_time'], 6, 10));
                $data = array_merge($data, $sms_data);
            }
            $users[] = $data;



        $i++;
    }
}
echo json_encode($users);
?>