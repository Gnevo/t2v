<?php
session_start();
require_once('class/setup.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
require_once('class/user.php');
require_once('class/employee.php');
require_once('class/leave.php');
$leave = new leave();
$user = new user();
$employee = new employee();

$leave->tables = array('leave_sms');
$leave->fields = array('id', 'employee');
$leave->conditions = array('AND','slot = ?', 'status = ?');
$leave->condition_values = array($_REQUEST['slot_id'], 1);
$leave->query_generate();
$leave_sms_status = $leave->query_fetch();
$i = 0;
$obj = array();
if (empty($leave_sms_status)) {
//    echo $_REQUEST['customer'];
//    echo $_REQUEST['time_from'];
//    echo $_REQUEST['time_to'];
//    echo $_REQUEST['date'];
    $data = $employee->get_available_users($_REQUEST['customer'], $_REQUEST['time_from'], $_REQUEST['time_to'], $_REQUEST['date']);
    //echo "<pre>\n".print_r($data, 1)."</pre>";
    foreach ($data as $employee) {
        if ($employee['username'] != $_REQUEST['user']) {
            $mobile_no = "";
            if ($employee['mobile'] != "") {
                if (substr($employee['mobile'], 0, 1) != '0')
                    $mobile_no = '0' . $employee['mobile'];
                else
                    $mobile_no = $employee['mobile'];
            }
            if ($mobile_no != "")
                $mobile_no = substr($mobile_no, 0, 4) . "-" . substr($mobile_no, 4);

            $obj[$i]->username = $employee['username'];
            $obj[$i]->name = $employee['name'];
            $obj[$i]->code = $employee['code'];
    //	$obj[$i]->mobile = $employee['mobile'];
            $obj[$i]->mobile = $mobile_no;
            $obj[$i]->contract_hour = $employee['contract_hour'];
            $obj[$i]->worked_hour = $employee['worked_hour'];
            $obj[$i]->role = $user->user_role($employee['username']);

            $sms_det = $leave->get_leave_sms_details($_REQUEST['slot_id'], $employee['username']);
            if($sms_det){
                $obj[$i]->sms_status = $sms_det['status'];
            }



            $i++;
        }
    }
}else{
    
    $emp_det = $employee->get_employee_detail($leave_sms_status[0]['employee']);
    $obj[$i]->username = $emp_det['username'];
    $obj[$i]->name = $emp_det['first_name']." ".$emp_det['last_name'];
    $obj[$i]->code = $emp_det['code'];
    $obj[$i]->mobile = $emp_det['mobile'];
    $obj[$i]->contract_hour = $employee->employee_contract_week_hour($emp_det['username'], date('Y', strtotime($_REQUEST['date'])) . '|' . date('W', strtotime($_REQUEST['date'])));
    $obj[$i]->worked_hour = $employee->employee_timetable_week_time($emp_det['username'], date('Y', strtotime($_REQUEST['date'])) . '|' . date('W', strtotime($_REQUEST['date'])));
    $obj[$i]->role = $user->user_role($emp_det['username']);
    $obj[$i]->sms_status = 1;
    
}
//echo "<pre>\n".print_r($obj, 1)."</pre>";
header("content-type: text/javascript");
echo $data = $_GET['callback'] . '(' . json_encode($obj) . ');';
?>