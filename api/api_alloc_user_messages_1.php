<?php
session_start();
$app_dir = dirname(dirname( realpath( __FILE__ ) )) ;
chdir ($app_dir);
require_once('class/setup.php');
require_once('class/leave.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
$leave = new leave();

$i = 0;
$data = $leave->get_alloc_user_messages(TRUE);
//$data = $leave->get_alloc_user_messages();
$row['reciever_ids'] = rawurldecode($row['reciever_ids']);
$obj = array();
foreach($data as $row) {

	$tmp = explode(",",$row["read"]);
	$remaining = $row['reciever_ids'];
	if(sizeof($tmp) < 1) {

		$remaining = str_replace($tmp[$j].",","",$remaining);
		$remaining = str_replace($tmp[$j],"",$remaining);
	}
	for($j=0;$j < sizeof($tmp) - 1;$j++) {

		$remaining = str_replace($tmp[$j].",","",$remaining);
		$remaining = str_replace($tmp[$j],"",$remaining);
	}

	$seen = $row["read"];
	
	if($row['employee'] == "") {
		$obj[$i]->con_status = $row['con_status'];
		$obj[$i]->employee = $row['employee'];
		$obj[$i]->id = $row['id'];
		$obj[$i]->message_id = $row['message_id'];
		$obj[$i]->sender = $row["senderid"];
                
                $rejet_names_args = explode(',', $row["rejet"]);
                $rejet_names = "";
                foreach($rejet_names_args as $uid){
                    if($uid != ""){
                        $re_name = $leave->get_employee_detail($uid);
                        $rejet_names .= $re_name['first_name'].' '.substr($re_name['last_name'], 0, 1). ",";
                    }
                }
		$obj[$i]->rejet = $row["rejet"];
		$obj[$i]->rejet_names = $rejet_names;
                
                $accept_names_args = explode(',', $row["accept"]);
                $accept_names = "";
                foreach($accept_names_args as $uid){
                    if($uid != ""){
                        $ae_name = $leave->get_employee_detail($uid);
                        $accept_names .= $ae_name['first_name'].' '.substr($ae_name['last_name'], 0, 1). ",";
                    }
                }
		$obj[$i]->accept = $row["accept"];
		$obj[$i]->accept_names = $accept_names;
                
		$obj[$i]->apt_time = $row["apt_time"];
		$obj[$i]->rej_time = $row["rej_time"];
		$obj[$i]->read_time = $row["read_time"];
		
                $seen_names_args = explode(',', $seen);
                $seen_names = "";
                foreach($seen_names_args as $uid){
                    if($uid != ""){
                        $e_name = $leave->get_employee_detail($uid);
                        $seen_names .= $e_name['first_name'].' '.substr($e_name['last_name'], 0, 1). ",";
                    }
                }
                $obj[$i]->seen = $seen;
                $obj[$i]->seen_names = $seen_names;
                
                $remaining_names_args = explode(',', $remaining);
                $remaining_names = "";
                foreach($remaining_names_args as $uid){
                    if($uid != ""){
                        $ree_name = $leave->get_employee_detail($uid);
                        $remaining_names .= $ree_name['first_name'].' '.substr($ree_name['last_name'], 0, 1). ",";
                    }
                }
		$obj[$i]->remaining = $remaining;
		$obj[$i]->remaining_names = $remaining_names;
                
		$obj[$i]->status = $row['status'];
                $leave_dt = $leave->get_leave_details($row['relation_id']);
		$obj[$i]->leave_sender_id = $leave_dt['employee'];
		$emp_name = $leave->get_employee_detail($leave_dt['employee']);
		$obj[$i]->leave_sender = $emp_name['first_name'].' '.$emp_name['last_name'];
		$obj[$i]->leave_date = $leave_dt['date'];
		$obj[$i]->leave_status = $leave_dt['status'];
		$obj[$i]->leave_from = $row['time_from'];
		$obj[$i]->leave_to = $row['time_to'];
		$obj[$i]->leave_hours = $row['time_to'] - $row['time_from'];
		$i++;
	}
}

//echo "<pre>\n".print_r($data, 1)."</pre>";
//echo "<pre>\n".print_r($obj, 1)."</pre>";
//exit();
//header("content-type: text/javascript");
echo json_encode($obj);
?>