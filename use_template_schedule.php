<?php
require_once('class/setup.php');
require_once ('class/employee.php');
require_once('class/newcustomer.php');
require_once ('class/company.php');
require_once('plugins/message.class.php');
$smarty = new smartySetup(array("user.xml","month.xml","messages.xml","button.xml","forms.xml","reports.xml","gdschema.xml"));

$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 9));
$customer = new newcustomer();
$obj_employee = new employee();
$obj_company = new company();
$msg = new message();
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
$msg_updated = "";

if($_POST['postdata']){
	
  if(sizeof($_POST['postdata']) > 0){
 	if($_POST['action'] == 'delete'){
            $customer->DeleteSceduleTimetable($_POST['template_id'], $_POST['customer']);
            $msg_updated = 2;
            $msg->set_message('success', 'schedule_delete_success');
            $smarty->assign('message', $msg->show_message()); //messages of actions
        }else{
            $postdataDate = array_unique($_POST['postdataDate']);
            $customer_name = $_POST["customer"];

//            echo "<pre>\n".print_r($_POST, 1)."</pre>";
            $customer->begin_transaction();
            $transaction_flag = TRUE;
//            echo "<pre>".print_r($postdataDate, 1)."</pre>";
            
            // check employee signed or not from previous schedules
            // and perform delete operation on previous slot schedules for that customer
            /*$previous_slot_schedules = array();     //this for atl checking only
            foreach($postdataDate as $date){
                    $date_slot_details = $customer->get_timeslots_by_customer_date($customer_name, $date);
                    $previous_slot_schedules = array_merge($previous_slot_schedules, $date_slot_details);
                    //checks employee signed or not?
                    if(!empty($date_slot_details)){
                        foreach($date_slot_details as $slot_detail){
                            if($slot_detail['employee'] != ''){
                                if($obj_employee->chk_employee_rpt_signed($slot_detail['employee'], $slot_detail['date'])){ //check already signed
                                    $emp_details = $obj_employee->employee_detail('\''.$slot_detail['employee'].'\'');
                                    $emp_name = $emp_details[0]['last_name']. ' '. $emp_details[0]['first_name'];
                                    $msg->set_message('fail', 'employee_signed_in');
                                    $msg->set_message_exact('fail', $emp_name . ' => ' . $slot_detail['date']);
                                    $transaction_flag = FALSE;
                                    break;
                                }
                            }
                        }
                    }
                    if(!$transaction_flag) break;
                    //delete all the previous schedule
                    if(!$customer->DeleteCustomerPreviousSetSchedule($date, $customer_name)){
                            $transaction_flag = FALSE;
                            break;
                    }
            }*/
            
            
            // check employee signed or collide for new schedules 
            if($transaction_flag){
                foreach($_POST['postdata'] as $postdata){
                    
                    //checks employee signed or not?
                    if($postdata != ''){
                        $data_values = explode(",",$postdata);
                        $process_params = array(
                            'employee'      =>  $data_values[0],
                            'customer'      =>  $data_values[1], 
                            'date'          =>  $data_values[2], 
                            'type'          =>  $data_values[5], 
                            'time_from'     =>  $data_values[3], 
                            'time_to'       =>  $data_values[4]); 

                        if(!$obj_employee->findout_slot_alteration_bug($process_params)){
                            $transaction_flag = FALSE;
                            break;
                        }
                        /*if($data_values[0] != ''){  //employee is not null
                            if($obj_employee->chk_employee_rpt_signed($data_values[0], $data_values[2])){ //check already signed
                                $emp_details = $obj_employee->employee_detail('\''.$data_values[0].'\'');
                                $emp_name = $emp_details[0]['last_name']. ' '. $emp_details[0]['first_name'];
                                $msg->set_message('fail', 'employee_signed_in');
                                $msg->set_message_exact('fail', $emp_name . ' => ' . $data_values[2]);
                                $transaction_flag = FALSE;
                                break;
                            } else {
                                //check the employee available or not for new schedules -  slot collides
                                $available_user = $obj_employee->get_available_users($data_values[1], $data_values[3], $data_values[4], $data_values[2], $data_values[0]);
                                if (empty($available_user)){
                                    $transaction_flag = FALSE;
                                    $emp_details = $obj_employee->employee_detail('\''.$data_values[0].'\'');
                                    $emp_name = $emp_details[0]['last_name']. ' '. $emp_details[0]['first_name'];
                                    $collided_slots = $obj_employee->get_collide_slots($data_values[0], $data_values[3], $data_values[4], $data_values[2]); // for getting exact collide slot values
                                    $msg->set_message('fail', 'slot_collide');
                                    $msg->set_message_exact('fail', $emp_name . ' ' . $data_values[2] . ' ' . str_pad($collided_slots[0]['time_from'], 5, '0', STR_PAD_LEFT) . '-' . str_pad($collided_slots[0]['time_to'], 5, '0', STR_PAD_LEFT));
                                    break;
                                }
                            }
                        }*/
                    }
                }
            }
            
            
            //finally process transactions
            if($transaction_flag){
                foreach($_POST['postdata'] as $postdata){
                    //postdataDate
                    if(!$customer->SaveSceduleTimetable($postdata)){
                        $transaction_flag = FALSE;
                        break;
                    }
                }
            }
            
            if($transaction_flag){
                $customer->commit_transaction();
                $msg->set_message('success', 'schedule_save_success');
                if(isset($_POST["atl_warnings"]) && trim($_POST["atl_warnings"]) != ''){
                    $atl_response_decoded = json_decode(trim($_POST["atl_warnings"]), true);
                    if(is_array($atl_response_decoded) && !empty($atl_response_decoded)){
                        $obj_employee->saveATL($atl_response_decoded['employee'], $atl_response_decoded['date'], $atl_response_decoded['timefrom'], $atl_response_decoded['timeto'], $atl_response_decoded['customer'], $atl_response_decoded['exceed_hours']);
                    }
//                    echo "<pre>".print_r($atl_response_decoded, 1)."</pre>";
                }
            }else{
                $customer->rollback_transaction();
            }
            $smarty->assign('message', $msg->show_message()); //messages of actions
            $msg_updated = 1;
        }
        
  }
	unset($_POST['postdata']);
	
}


$smarty->assign('privilages', $obj_employee->get_privileges($_SESSION['user_id'], 1));
/* ------------------- getting company details - for getting contract hour flag---------------------- */
$company_data = $obj_company->get_company_detail($_SESSION['company_id']);
$smarty->assign('company_contract_checking_flag', $company_data['contract_exceed_check']);
$smarty->assign('company_atl_checking_flag', $company_data['atl_check']);
/* ------------------- getting company details - for getting contract hour flag-----------endz----------- */

$CustomerList = $customer->customer_list(NULL);
$smarty->assign('customerlist',$CustomerList);
$smarty->assign('msg_updated',$msg_updated);
$smarty->display('extends:layouts/dashboard.tpl|use_template_schedule.tpl');
?>