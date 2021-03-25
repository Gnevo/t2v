<?php
require_once('class/setup.php');
require_once('class/newcustomer.php');
require_once ('plugins/message.class.php');
$smarty = new smartySetup(array("user.xml","month.xml","messages.xml","button.xml","forms.xml","reports.xml"));
$msg = new message();

$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 9));
$customer = new newcustomer();
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
$CustomerList = $customer->customer_list(NULL);
$smarty->assign('customerlist',$CustomerList);
$msg_updated ="";
if($_POST){
	
	$sdate = $_POST['sdate'];
	$edate = $_POST['edate'];
	$customers_name = $_POST['customer'];
	$ResultArray = $customer->getCustomerScheduleAllData($customers_name, $sdate, $edate);
	
	if($_POST['as_values'] !='' && $_POST['customers_ids'] =='cust' ){
		
			$NewCustomer = explode(",", $_POST['as_values']);
			$NewUniCustomer = array_unique($NewCustomer);
			
			$temp_name = $_POST['new_tempate_name_copy'];
			//$tid = $_POST['template_name'];
			$customer->begin_transaction();
                        $flag = 1;
                        $cust_name = '';
			foreach($NewUniCustomer as $nc){

				if($nc != ''){ 
                                    //$customer->exsitCopyTemplateDataDelete($nc, $temp_id);
				    $temp_id = $customer->AddTemplate($nc, $temp_name, "");
                                    $cust_name = $nc;
                                    if($temp_id){
					 
					foreach($ResultArray as $temp_data){
						$temp_data['customer'] = $nc;
						$temp_data['employee'] = "";
                                                $temp_data['status'] = 0;
						$customer->SaveTemplate($temp_data, $temp_id);
					}
                                    }else{
                                        $flag = 0;
                                        break;
                                    }
			 	} 
				
			}
			if($flag == 1){
                            $msg_updated =1;
                            $customer->commit_transaction();
                        }else{
                            $customer->rollback_transaction();
                            $msg_updated =2;
                            $msg->set_message('fail', 'template_name_exists');
                            $msg->set_message_exact('fail', $cust_name);
                        }
	}
	
	if($_POST['template'] =='save'){
		$temp_name = $_POST['new_tempate_name'];
		$tid = $_POST['template_name'];
		
		if($tid != ''){  $customer->exsitCopyTemplateDataDelete($customers_name, $tid); }
		
		if($tid == ''){ $tid = $customer->AddTemplate($customers_name, $temp_name, $tid); }
                if($tid){
                    foreach($ResultArray as $temp_data){

                            $customer->SaveTemplate($temp_data, $tid);
                    }
                    $msg_updated =1;
                }else{
                    $msg_updated =2;
                    $msg->set_message('fail', 'template_name_exists');
                    $msg->set_message_exact('fail', $customers_name);
                    
                }
	}
	
	$sdate = $_POST['sdate'];
	$edate = $_POST['edate'];
	$cdata = $customer->customer_data($customers_name);
	$name = $cdata["first_name"].' '.$cdata["last_name"];
	$smarty->assign('sdate',$sdate);
	$smarty->assign('username',$customers_name);
	$smarty->assign('edate',$edate);
	$smarty->assign('name',$name);
	
} 
$smarty->assign('msg_updated',$msg_updated);
$smarty->assign('message', $msg->show_message());
$smarty->display('extends:layouts/dashboard.tpl|create_schedule_template.tpl');
?>