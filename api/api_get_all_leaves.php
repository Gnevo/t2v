<?php
session_name('t2v-cirrus');
session_start('t2v-cirrus');
$app_dir = dirname(dirname( realpath( __FILE__ ) )) ;
chdir ($app_dir);
require_once('class/setup.php');
require_once('class/leave.php');
require_once('class/dona.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
$leave = new leave();
$dona = new dona();

$i = 0;
$obj = array();
if(!isset($_REQUEST['start']))
	$_REQUEST['start'] = '0';

$_REQUEST['start'] = (int) $_REQUEST['start'];
$req_year = trim($_REQUEST['year']);
$req_month = trim($_REQUEST['month']);
$sel_year   = ($req_year != "" && $req_year != "NULL" ? $req_year : NULL );
$sel_month  = ($req_month != "" && $req_month != "NULL" ? $req_month : NULL);
$tota_count = ((intval($_REQUEST['total_pages']/10, 10))+1)*10;
if($sel_year != NULL && $sel_month != NULL){
    $data = $leave->get_all_employee_leave($sel_year, $sel_month, $_REQUEST['start'], 1, $tota_count);
//    echo "<pre>".print_r($data, 1)."</pre>";
    if(!empty($data)){
        foreach($data as $leave_details) {

                $j = 0;
                $slot_details = array();
                
                $obj[$i] = new stdClass();
                $obj[$i]->id = $leave_details['id'];// before group_id was passed as id
                $obj[$i]->group_id = $leave_details['group_id'];
                $obj[$i]->type = $leave_details['type'];
                $obj[$i]->start_date = $leave_details['start_date'];
                $obj[$i]->end_date = $leave_details['end_date'];
                $obj[$i]->time_from = $leave_details['time_from'];
                $obj[$i]->time_to = $leave_details['time_to'];
                $obj[$i]->employee = $leave_details['employee'];
                $obj[$i]->empname = $leave_details['empname'];
                $obj[$i]->status = $leave_details['status'];
                $obj[$i]->appr_date = $leave_details['appr_date'];
                $obj[$i]->appr_empname = $leave_details['appr_empname'];
                $obj[$i]->process_status = $leave_details['process_status'];
                $date = $leave_details['start_date'];

                while(strtotime($date) <= strtotime($leave_details['end_date'])){
                    $slots = $leave->employee_get_leave_slot($leave_details['employee'],$date,$leave_details['time_from'],$leave_details['time_to']);
                    foreach($slots as $slot) {

                            //$user_details = $leave->get_customer_detail($slot['customer']);
                            $slot_details[$j] = new stdClass();
                            $slot_details[$j]->slotid = $slot['id'];
                            $slot_details[$j]->customer = $slot['customer'];
                            $slot_details[$j]->employee = $slot['employee'];
                            $slot_details[$j]->status = $slot['status'];
                            $slot_details[$j]->cust_name = $slot['cust_name'];
                            $slot_details[$j]->emp_name = $slot['emp_name'];
                            $slot_details[$j]->date = $slot['date'];
                            $slot_details[$j]->time_from = $slot['time_from'];
                            $slot_details[$j]->time_to = $slot['time_to'];
                            $slot_details[$j]->fkkn = $slot['fkkn'];
                            $slot_details[$j]->type = $slot['type'];
                            $slot_details[$j]->sms_status = $slot['sms_status'];
                            $j++;
                    }
                    $date = date('Y-m-d', strtotime('+1 day', strtotime($date)));
                }
                $obj[$i]->slots = $slot_details;
                $i++;
        }
    }
}
else {
    //check unread year month leaves
    $leave_list = $dona->get_all_employee_leave();
    $unread_leave = $dona->get_unread_leave();
    $updated_list = $dona->get_all_unread_leaves($leave_list,$unread_leave);
    $updated_leave_list = array_slice($updated_list, 0, 10);
    if(!empty($updated_leave_list)){
        foreach($updated_leave_list as $leave_details) {

                $j = 0;
                $slot_details = array();
                
                $leave_start_datetime = explode(' ', $leave_details['From_date']);
                $leave_end_datetime = explode(' ', $leave_details['To_date']);
                
                $obj[$i] = new stdClass();
                $obj[$i]->id = $leave_details['id'];///before gID is passed as group_id
                $obj[$i]->group_id = $leave_details['gID'];
                $obj[$i]->type = $leave_details['type'];
                $obj[$i]->start_date = $leave_start_datetime[0];
                $obj[$i]->end_date = $leave_end_datetime[0];
                $obj[$i]->time_from = $leave_start_datetime[1];
                $obj[$i]->time_to = $leave_end_datetime[1];
                $obj[$i]->employee = $leave_details['employee'];
                $obj[$i]->empname = $leave_details['empname'];
                $obj[$i]->status = $leave_details['status'];
                $obj[$i]->appr_date = $leave_details['appr_date'];
                $obj[$i]->appr_empname = $leave_details['appr_empname'];
                //$obj[$i]->process_status = $leave_details['process_status'];
                $obj[$i]->process_status = 1;
                $date = $leave_start_datetime[0];

                while(strtotime($date) <= strtotime($leave_end_datetime[0])){
                    $slots = $leave->employee_get_leave_slot($leave_details['employee'],$date, $leave_start_datetime[1],$leave_end_datetime[1]);
                    if(!empty($slots)){
                        foreach($slots as $slot) {
                                //$user_details = $leave->get_customer_detail($slot['customer']);
                                $slot_details[$j] = new stdClass();
                                $slot_details[$j]->slotid = $slot['id'];
                                $slot_details[$j]->customer = $slot['customer'];
                                $slot_details[$j]->employee = $slot['employee'];
                                $slot_details[$j]->status = $slot['status'];
                                $slot_details[$j]->cust_name = $slot['cust_name'];
                                $slot_details[$j]->emp_name = $slot['emp_name'];
                                $slot_details[$j]->date = $slot['date'];
                                $slot_details[$j]->time_from = $slot['time_from'];
                                $slot_details[$j]->time_to = $slot['time_to'];
                                $slot_details[$j]->fkkn = $slot['fkkn'];
                                $slot_details[$j]->type = $slot['type'];
                                $slot_details[$j]->sms_status = $slot['sms_status'];
                                $j++;
                        }
                    }
                    $date = date('Y-m-d', strtotime('+1 day', strtotime($date)));
                }
                $obj[$i]->slots = $slot_details;
                $i++;
        }
        
        $dona->set_as_read_leaves($updated_leave_list);
    }
//    echo "<pre>updated_list".print_r($updated_list, 1)."</pre>";
}
//echo "<pre>obj".print_r($obj, 1)."</pre>";


//header("content-type: text/javascript");
//echo "<pre>".print_r($obj, 1)."</pre>";
echo json_encode($obj);
?>