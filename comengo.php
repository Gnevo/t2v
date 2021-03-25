<?php
// error_reporting(E_ALL);
// error_reporting(E_WARNING);
// ini_set('error_reporting', E_ALL);
// ini_set("display_errors", 1);
require_once('class/setup.php');
require_once('configs/config.inc.php');
require_once('class/employee.php');
require_once('class/company.php');
require_once('class/customer.php');
require_once('class/leave.php');
require_once ('plugins/message.class.php');
$msg = new message();
$smarty = new smartySetup(array("messages.xml" , "gdschema.xml"));
$company_obj = new company();
require_once('class/user.php');
$user = new user();
$obj_emp = new employee();
$obj_customer = new customer();
$leave = new leave();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 5));
$smarty->assign('user_role', $user->user_role($_SESSION['user_id']));
$page = 'employee';
if($_SESSION['user_role'] == '4'){
    $page = 'customer';
}

$user_id = $_SESSION['user_id'];
$candg_start = '';

$company_det = $company_obj->get_company_detail($_SESSION['company_id']);
$candg = $company_det['candg'];
$candg_stop_other_emps = 0;
if($_SESSION['user_role'] != 4){
    $privileges_general = $user->get_privileges($user_id, 2);
    if ($privileges_general['candg_wi'] == 1)
        $candg = 0;
    if ($privileges_general['candg_wo'] == 1)
        $candg = 1;
     $candg_stop_other_emps = $privileges_general['candg_stop_other_emps'];
}
$smarty->assign('candg', $candg);
$smarty->assign('candg_break', $company_det['candg_break']);

require_once('configs/config.inc.php');
global $month, $company;
//echo $_POST['action'];
$show_start = 0;
if(isset($_POST['action']) && $_POST['action'] == "start_stop"){ 
   
    $dur_msg = '';
    $break_duration = 30;//30 minutes       
    $task_id = $_POST['task_id'];
    $status = $_POST['status'];
    $candg_flag = $_POST['candg_flag'];
        $leave->task_id = $_REQUEST['task_id'];
        $stop_time = new DateTime();
        $stop_time->setTimezone(new DateTimeZone('Europe/Stockholm'));
        $stop_time->setTimestamp(time());
        $stop_time = $stop_time->format('Y-m-d G:i:s');
        $break_time = $_REQUEST['candg_break'];
        //echo $user_id.$_REQUEST['status'].$candg. $_REQUEST['customer'], $break_time;
        $obj1 = new stdClass();
        //echo  "hihihihihi".$_REQUEST['customer'];
        if($page == 'employee')
            $obj1->task_id = $leave->update_user_task($user_id, $_REQUEST['status'], $candg, $_REQUEST['customer'], $break_time ,$display_message,'employee');
        elseif($page == 'customer'){
            //echo $_REQUEST['employee'].$_REQUEST['status'].$candg.$user_id.$break_time;
            $obj1->task_id = $leave->update_user_task($_REQUEST['employee'], $_REQUEST['status'], $candg, $user_id, $break_time, $display_message, 'customer');
        }
        $obj1->status = $_REQUEST['status'];
        $obj1->stop_time = $stop_time;
        if ($obj1->status == 1) {
            if($page == 'employee'){
                $obj1->cust_name = $obj_customer->getCustomerName($_REQUEST['customer']);
            }elseif($page == 'customer'){
                $obj1->cust_name = $obj_customer->getCustomerName($_SESSION['user_id']);
            }
            $show_start = 5;
            $data = $leave->get_task_by_id($leave->task_id);
            //$start_time = urldecode($_REQUEST['start_time']); 
            $start_time = $data[0]['dag'] . " " . $data[0]['start_time'];
            $datetime1 = date_create($start_time);
            $datetime2 = date_create($stop_time);
            $interval = date_diff($datetime1, $datetime2);
            $dur = sprintf("%02d", ($interval->days * 24 + $interval->h)) . ":" . sprintf("%02d", $interval->format('%i')) . ":" . sprintf("%02d", $interval->format('%s'));
            $obj1->duration = $dur;
            $smarty->assign('cust_name', $obj1->cust_name);
            $smarty->assign('stop_time', $obj1->stop_time);
            $smarty->assign('duration', $obj1->duration);
            $smarty->assign('date', $data[0]['dag']);
            $smarty->assign('start_time', $data[0]['start_time']);
            $smarty->assign('running_message_customer', $_REQUEST['candg_customer']);
            $smarty->assign('running_message_employee', $_REQUEST['candg_employee']);
            $msg_7 = '<div class="span4">
                        <ul>
                            <li><span style="color: rgb(4, 139, 237);"><strong>'.$smarty->translate['customer'].'   </strong></span>'.$_REQUEST['candg_customer'].'</li>
                            <li><span style="color: rgb(4, 139, 237);"><strong>'.$smarty->translate['employee'].'   </strong></span>'.$_REQUEST['candg_employee'].'</li>
                            <li><span style="color: rgb(4, 139, 237);"><strong>'.$smarty->translate['date'].'   </strong></span>'.$data[0]['dag'].'</li>
                            <li><span style="color: rgb(4, 139, 237);"><strong>'.$smarty->translate['candg_start'].'   </strong></span>'.$start_time.'</li>
                            <li><span style="color: rgb(4, 139, 237);"><strong>'.$smarty->translate['candg_stop'].'   </strong></span>'.$stop_time.'</li>
                        </ul>
                    </div>

                    <div class="span5 pull-right text-right">
                        <span style="margin-left:10px;margin:28px 0px 0px 10px;font-size: 37px; float:right;">'. $dur.'</span><h1 style="font-size: 37px; margin: 28px 0px; float:right;"><small>'.$smarty->translate['candg_duration'].'</small></h1>
                    </div>';
            $msg->set_message_exact('success', $msg_7); 
            header('Location:'.$smarty->url.'comengo_stop/');
        }else{
            header('Location:'.$smarty->url.'comengo/');
        }
    


}elseif(isset($_POST['action']) && $_POST['action'] == "admin_stop"){
    
    $dur_msg = '';
    $break_duration = 30;//30 minutes       
    $task_id = $_POST['task_id'];
    $status = 1;
    $candg_flag = $_POST['candg_flag'];
        $leave->task_id = $_REQUEST['task_id'];
        $stop_time = new DateTime();
        $stop_time->setTimezone(new DateTimeZone('Europe/Stockholm'));
        $stop_time->setTimestamp(time());
        $stop_time = $stop_time->format('Y-m-d G:i:s');
        $break_time = $_REQUEST['candg_break'];
        //echo $user_id.$_REQUEST['status'].$candg. $_REQUEST['customer'], $break_time;
        $obj1 = new stdClass();
        //echo  "hihihihihi".$_REQUEST['customer'];
        $user_id = $_REQUEST['admins_employee'];
        //echo "asaas";
        $customer = $_REQUEST['admins_customer'];
        //echo $user_id.$candg. $customer. $break_time;
        $obj1->task_id = $leave->update_user_task($user_id, 1, $candg, $customer, $break_time);
       
        $obj1->status = 1;
        $obj1->stop_time = $stop_time;
        if ($obj1->status == 1) {
           
            
            $show_start = 7; // admin stopped one employees come and go
            $data = $leave->get_task_by_id($leave->task_id);
        //$start_time = urldecode($_REQUEST['start_time']); 
            $start_time = $data[0]['dag'] . " " . $data[0]['start_time'];
            $datetime1 = date_create($start_time);
            $datetime2 = date_create($stop_time);
            $interval = date_diff($datetime1, $datetime2);
            $dur = sprintf("%02d", ($interval->days * 24 + $interval->h)) . ":" . sprintf("%02d", $interval->format('%i')) . ":" . sprintf("%02d", $interval->format('%s'));
            $msg_7 =   $_REQUEST["msg_7"]."<div class='widget' style='margin: 0px ! important;'>
                            <div class='span12 widget-body-section' style=''>
                                <div class='row-fluid'>
                                    <div class='span4'>
                                        <ul>
                                            <li><span style='color: rgb(4, 139, 237);'><strong>".$smarty->translate["customer"]."   </strong></span>".$_REQUEST["candg_customer"]."</li>
                                            <li><span style='color: rgb(4, 139, 237);'><strong>".$smarty->translate["employee"]."   </strong></span>".$_REQUEST["candg_employee"]."</li>
                                            <li><span style='color: rgb(4, 139, 237);'><strong>".$smarty->translate["date"]."   </strong></span><a href='javascript:void(0);' style='text-decoration:underline' onclick='navigatePage(&#39;".$smarty->url."gdschema_alloc_window.php?date=".$data[0]["dag"]."&employee=$user_id&customer=$customer&return_page=comengo&#39;,1)'>".$data[0]["dag"]."</a></li>
                                            <li><span style='color: rgb(4, 139, 237);'><strong>".$smarty->translate["candg_start"]."   </strong></span>".$start_time."</li>
                                            <li><span style='color: rgb(4, 139, 237);'><strong>".$smarty->translate["candg_stop"]."   </strong></span>".$stop_time."</li>
                                        </ul>
                                    </div>

                                    <div class='span4 pull-right text-right'>
                                        <span style='margin-left:10px;margin:28px 0px 0px 10px;font-size: 37px; float:right;'>". $dur."</span><h1 style='font-size: 37px; margin: 28px 0px; float:right;'><small>".$smarty->translate["candg_duration"]."</small></h1>
                                    </div>
                                </div>
                            </div>
                        </div>";
            $smarty->assign('msg_7', $msg_7);
            //            $smarty->assign('customer', $customer);
            //            $smarty->assign('employee',$user_id);
            //            $smarty->assign('date',$data[0]['dag']);
            //            $smarty->assign('process','admin_stop');
           /* $obj1->duration = $dur;
            $smarty->assign('cust_name', $obj1->cust_name);
            $smarty->assign('stop_time', $obj1->stop_time);
            $smarty->assign('duration', $obj1->duration);
            $smarty->assign('date', $data[0]['dag']);
            $smarty->assign('start_time', $data[0]['start_time']);
            $smarty->assign('running_message_customer', $_REQUEST['candg_customer']);
            $smarty->assign('running_message_employee', $_REQUEST['candg_employee']);*/
        }
}
elseif(isset($_POST['action']) && $_POST['action'] == "cancel_candg"){
    if(isset($_POST['task_id']) && $_POST['task_id'] != ''){
        if($leave->cancell_candg_running($_POST['task_id'])){
            $msg->set_message('success', 'candg_cancelled_successfully'); 
        }else{
            $msg->set_message('success', 'candg_cancel_failed'); 
        }
    }
    $smarty->assign('message', $msg->show_message());
}

if($show_start != 5){
    $flag = 1;
    if(isset($_POST['action']) && $_POST['action'] == "UserAdd"){
        if($page == 'employee'){
            $show_start = 6;
            $user_id = $_SESSION['user_id'];
            //$i = 0;
            if($obj_emp->employee_add_to_slot($_REQUEST['action_id'], $user_id, $user_id))
                $flag = 1;
            else
                $flag = 0;
        }
        
    }
    
    if($flag == 1){
        $user_id = $_SESSION['user_id'];
        $data = $leave->get_running_tasks($user_id, $page);
        $all_running = array();
        if($candg_stop_other_emps == 1){
            $all_running = $leave->get_running_tasks();
            //echo "<pre>\n".print_r($all_running , 1)."</pre>";
            $smarty->assign('all_running', $all_running);
        }
        
        //echo "<pre>\n".print_r($data , 1)."</pre>";
        $obj = array();
        $i = 0;
        if (!empty($data)) {

            $obj['running']['count'] = count($data);
            foreach ($data as $slots) {
                //$leave->employee_get_task_slots()
                $obj['running'][$i] = $slots;
                $i++;
            }
            $obj['complete']['count'] = 0;
            $obj['incomplete']['count'] = 0;
        } else {
            $obj['running']['count'] = 0;
            
            $data = $leave->get_slots_closer_to_current_time($user_id, 1, $page);
            if (!empty($data)) {

                $obj['complete']['count'] = count($data);
                $i = 0;
                foreach ($data as $slots) {

                    $obj['complete'][$i] = $slots;
                    $i++;
                }
                $obj['incomplete']['count'] = 0;
            } else {
                $obj['running']['count'] = 0;
                $obj['complete']['count'] = 0;
                $data = $leave->get_slots_closer_to_current_time($user_id, 0);
                //echo "<pre>\n".print_r($data , 1)."</pre>";
                if (!empty($data)) {
                    $obj['incomplete']['count'] = count($data);
                    $i = 0;
                    foreach ($data as $slots) {

                        $obj['incomplete'][$i] = $slots;
                        $i++;
                    }
                } else {
                    $obj['incomplete']['count'] = 0;
                }
            }
        }
        $data = $obj;
        $start = 0;
        $stop = 0;
        $cutomer_list = 0;

        $candg_flag = 0;

        //echo "<pre>\n".print_r($data , 1)."</pre>";
        if ($data['running']['count'] == 0 && $data['complete']['count'] == 0 && $data['incomplete']['count'] == 0) {

            if ($candg == 1) {

                $start = 1;

                $stop = 0;
                $task_id = null;

                $cutomer_list = 1;
                if($_SESSION['user_role'] != 4){
                    $customers = $obj_customer->customer_list();
                    //$customers = $obj_emp->customers_list_for_right_click($user_id);
                    $smarty->assign('customers', $customers);
                    if(count($customers)){
                        $show_start = 1;//there is customers
                    }
                    //echo "<pre>".print_r($customers,1)."</pre>";
                    //$smarty->assign('customers', $customers);
                }elseif($_SESSION['user_role'] == 4){
                    $employees = $obj_emp->get_available_users($_SESSION['user_id'], date('H.i'), date('H.i', strtotime("+15 minutes")), date('Y-m-d'));

                    $smarty->assign('employees', $employees);
                    if(count($employees)){
                        $show_start = 6;//there is employees as customer is logged in
                    }
                    //echo "<pre>".print_r($employees,1)."</pre>";
                }
            } else {

                $start = 0;

                $stop = 0;
            }
        } else {

            $tye_class = array(
                0 => 'normal',
                1 => 'travel',
                2 => 'break',
                3 => 'oncall',
                4 => 'over-time',
                5 => 'qualtiy-overtime',
                6 => 'more-time',
                7 => 'some-other-time',
                8 => 'training',
                9 => 'call-training',
                10 => 'personal-meeting',
                11 => 'voluntary',
                12 => 'complimentary',
                13 => 'complimentary-oncall',
                14 => 'oncall-moretime',
                15 => 'standby',
            );

            if ($data['running']['count'] != 0) {
                $show_start = 2;//running
                $stop = 1;

                $start = 0;

                for ($i = 0; $i < $data['running']['count']; $i++) {

                    $slots = $data['running'][$i]['slotids'];

                    $task_id = $data['running'][$i]['id'];

                    $rumming_message = "<center><p><b>Kunder: </b>" + $data['running'][$i]['cust_name'] . "</p><p><b>Dat.: </b>" . $data['running'][$i]['dag'] . "</p><p><b>Starttiden: </b>" . $data['running'][$i]['start_time'] . "</p><div id='dur_div'></div></center>";


                    $candg_start = $data['running'][$i]['dag'] . " " . $data['running'][$i]['start_time'];

                    //$d = new Date($data['running'][$i]['dur']);





                    $l = $data['running'][$i]['details_count'];
                    $slot_dets = $data['running'][$i]['details'];


                }
                $smarty->assign('running_message_flag', 1);
                if($data['running'][0]['cust_name'] != '')
                    $smarty->assign('running_message_customer', $data['running'][0]['cust_name']);
                else
                    $smarty->assign('running_message_customer', $data['running'][0]['details'][0]['cust_name']);
                if($data['running'][0]['emp_name'] != '')
                    $smarty->assign('running_message_employee', $data['running'][0]['emp_name']);
                else
                    $smarty->assign('running_message_employee', $data['running'][0]['details'][0]['emp_name']);
                $smarty->assign('running_message_date', $data['running'][0]['dag']);
                $smarty->assign('running_message_start_time', $data['running'][0]['start_time']);
                
            }else if ($data['complete']['count'] != 0) {

                $show_start = 3; //complete count

                $candg_flag = 1;

                $stop = 0;

                $start = 1;

                $task_id = null;

                $l = $data['complete']['count'];

                $slot_dets = array_slice($data['complete'],1);
                //echo "<pre>\n".print_r($slot_dets , 1)."</pre>";
                $week = 0;


            }else if ($data['incomplete']['count'] != 0) {

                $candg_flag = 1;
                $show_start = 4;
                $task_id = null;

                $stop = 0;

                $start = 0;

                $l = $data['incomplete']['count'];
                $week = 0;
                $slot_dets = array_slice($data['incomplete'],1);

            }
            $smarty->assign('slot_dets', $slot_dets);
            $smarty->assign('type_class', $tye_class);
        }
    }
}
$smarty->assign('start', $start);
$smarty->assign('stop', $stop);
$smarty->assign('show_start', $show_start);
$smarty->assign('task_id', $task_id);
$smarty->assign('candg_flag', $candg_flag);
$smarty->assign('candg_start', $candg_start);




$smarty->display('extends:layouts/dashboard.tpl|comengo.tpl');
?>