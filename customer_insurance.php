<?php
require_once('class/setup.php');
require_once('plugins/message.class.php');
require_once('class/customer.php');
require_once('class/contract.php');
require_once('class/employee.php');
require_once('class/equipment.php');
require_once('class/user.php');
require_once('class/general.php');
//require_once ('class/equipment.php');
$smarty = new smartySetup(array("user.xml", "customer.xml", "messages.xml", "button.xml", "billing.xml","privilege.xml"));
$customer = new customer();
$employee = new employee();
$contract = new contract();
$messages = new message();
$equipment = new equipment();
$user = new user();
$obj_general = new general();
//$equipment = new equipment();

$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
$query_string = explode('&', $_SERVER['QUERY_STRING']);
$count = count($query_string);

$fkkn = "";
$fkkn_tab_name = "";
if ($query_string[0] == 'fk'){
    $fkkn = "1";
    $fkkn_tab_name = "INSURANCE-FK";
}elseif($query_string[0] == 'kn'){
    $fkkn = "2";
    $fkkn_tab_name = "INSURANCE-KN";
}elseif($query_string[0] == 'te'){
    $fkkn = "3";
    $fkkn_tab_name = "INSURANCE-TE";
}
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 3, 'tabmenu' => $fkkn_tab_name));
$smarty->assign('fkkn', $query_string[0]);


$privilege_general = $employee->get_privileges($_SESSION['user_id'], 2);
$smarty->assign('privilege_general', $privilege_general);
if(($fkkn == 1 && $privilege_general['customer_settings_insurance_fk'] != 1) ||
    ($fkkn == 2 && $privilege_general['customer_settings_insurance_kn'] != 1) ||
    ($fkkn == 3 && $privilege_general['customer_settings_insurance_tu'] != 1) || $fkkn == ''){
    $messages->set_message('fail', 'permission_denied');
    $obj_general->going_to_startup_view($smarty);
    exit();
}

$customer_username = $query_string[1];
$smarty->assign('customer_username', $customer_username);
$smarty->assign('download_folder',$customer->get_folder_name($_SESSION['company_id'])."/document_decision");
if (isset($_POST['username']) && $_POST['action'] == 'save') {
   
    if($_POST['bidrag'] == "" || $_POST['fromdate'] == "" || $_POST['todate'] == ""){
        $errors = "1";
        $messages->set_message('fail', 'starred_data_not_blank');
        //header("location:".$smarty->url."customer/insurance/fk/".$customer_username."/");
    }
    if($fkkn == "1"){
        $customer->b_fname = $_POST['bofname'];
        $customer->b_lname = $_POST['bolname'];
    }else{
        
        $customer->kn_name = $_POST['name'];
        $customer->kn_address = $_POST['address_kn'];
        $customer->kn_postno = $_POST['kn_postno'];
        $customer->b_iss = $_POST['iss'];
        $customer->b_sol = $_POST['sol']; 
        $customer->b_kn_ref_num = $_POST['breference_no']; 
        $customer->b_box = $_POST['bbox']; 
    }
    
    $customer->b_mobile = $_POST['bophone'];
    $customer->b_email = $_POST['boemail'];
    $customer->b_city = $_POST['bocity'];
    $customer->b_oncall = $_POST['oncall'];
    $customer->b_oncall2 = $_POST['oncall2'];
    $customer->b_awake = $_POST['awake'];
    $customer->b_something = $_POST['something'];
    
    $customer->d_fname = $_POST['dofname'];
    $customer->d_lname = $_POST['dolname'];
    $customer->d_mobile = $_POST['dophone'];
    $customer->d_email = $_POST['doemail'];
    $customer->d_comment_other = $_POST['comdecision'];
    $customer->d_comment_time = $_POST['comhours'];
    $customer->d_city = $_POST['docity'];
    $customer->date_from = $_POST['fromdate'];
    $customer->date_to = $_POST['todate'];
    $customer->user = $_POST['username'];
    $hours = $_POST['bidrag'];
    $fromdate = $_POST['fromdate'];
    $todate = $_POST['todate'];
    $customer_username = $_POST['username'];
    $errors = "";
    $error = "";
    
    if($todate  >  $fromdate){
        
	$diff = $contract->date_difference($fromdate, $todate );
	$diff_hrs = $diff/(60*60);
	
        if($customer->contract_customer_check($_POST['date'],$fkkn)){
            $errors = "1";
            $messages->set_message('fail', 'overlapped_contract_period');
        }
	  
    }
    else{
	//from date greater
        $errors = "1";
        $messages->set_message('fail', 'to_date_greaterthan_from_date');
    }
    //upload files
    //echo "error".$error;
    if($errors == ""){
        if ($_POST['date'] != '') {
            $contract_id = $_POST['date'];
            $documents = $customer->customer_decision_documents($contract_id);
            $trustedoc = $_POST['tdocs'];
            $files_deletes = explode(',',$trustedoc); 
            $app_dir = getcwd();
            $upload_path = $app_dir."/".$customer->get_folder_name($_SESSION['company_id'])."/document_decision/";
            for($j=0;$j<count($documents);$j++){
                for($i=0;$i<count($files_deletes);$i++){
                    if($documents[$j]['file']==$files_deletes[$i]){
                        break;
                    }
                }
                if($i == count($files_deletes)){ 
                        @unlink($upload_path.$documents[$j]['file']);

                }
            }
        }
        
        $files_count = $_POST['file_count'];
        if ($files_count > 0) {
            
            $max_size = 50000 * 1024;
            $compony_id = $_SESSION['company_id'];
            $upload_path = $customer->get_folder_name($compony_id)."/document_decision/";            
            //$error = 0;
            
            for ($i = 1; $i <= $files_count; $i++) {
                
                if (isset($_FILES['file_' . $i]['name']) && $_FILES['file_' . $i]['name'] != "") {
                    
                $file_no_change = $_FILES['file_' . $i]['name'];
                   $file_name = $_FILES['file_' . $i]['name'];
                    $size = filesize($_FILES['file_' . $i]['tmp_name']);
                    $str = str_replace(" ", "_", $file_name );
                    
                    if ($size <= $max_size) {
                      
                    
                        $extension = $customer->get_file_extension($str);
                        if ($extension == "doc" || $extension == "docx" || $extension == "pdf" || $extension == "odt") {
                           
                            //$upload_path = "document_decision/";
                           $file_path = $upload_path . $str;
                        
                            if(file_exists($file_path)){
                               // $present = 0;
                               // for($x=0;$x<count($documents);$x++){
                               //     $str1 = explode('.',$documents[$x]['file']);
                               //     $str1[0] = substr($str1[0],0,-2);
                               //     $str1 = $str1[0].".".$str1[1];
                               //     if($documents[$x]['file'] == $str || $str == $str1 ){
                               //         $present = 1;
                               //         break;
                               //     }
                               // }
                                    $num = 1;
                                    $x = 0;
                                    $str1 = explode('.',$str);
                                    $str = $str1[0]."_".$num.".".$str1[1];
                                    $file_path = $upload_path . $str;
                                    while($x == 0){
                                        if(file_exists($file_path)){                                            
                                            $num++;
                                            $str1 = explode('.',$str);
                                            $str1[0] = substr($str1[0],0,-2);
                                            $str = $str1[0]."_".$num.".".$str1[1];
                                            $file_path = $upload_path . $str;
                                        }
                                        else{
                                            $x++;
                                        }
                                    }
                                    if (move_uploaded_file($_FILES['file_' . $i]['tmp_name'], $file_path)) {
                                        //rename($upload_path . $file_no_change, $file_path);
                                        if ($trustedoc != "") {
                                            $trustedoc .= "," . $str;
                                        } else {

                                            $trustedoc = $str;
                                        }
                                        $messages->set_message('success', 'employee_updating_success');

                                    }
                                
                            }
                            
                            
                            else{
                                if (move_uploaded_file($_FILES['file_' . $i]['tmp_name'], $file_path)) {
                                       // rename($upload_path . $file_no_change, $file_path);
                                    if ($trustedoc != "") {

                                        $trustedoc .= "," . $str;
                                    } else {

                                        $trustedoc = $str;
                                    }
                                    $messages->set_message('success', 'employee_updating_success');
                                } else {
                                    $messages->set_message('fail', 'failed_to_post_documents');
                                    $error = "1";
                                }
                                
                            }
                            
                        } else {
                            $messages->set_message('fail', 'file_selected_supported_extension');
                            $error = "1";
                        }
                    } else {
                        $messages->set_message('fail', 'exceeds_the_limit_file_size');
                        $error = "1";
                    }
                }
            }
        }
       $customer->d_document = $trustedoc;
        if($error == ""){
            if ($_POST['date'] != '') {

                $contract_id = $_POST['date'];
                $customer->begin_transaction();

                if ($customer->customer_contract_update($contract_id,$hours, $fromdate, $todate, $fkkn)) {
                    if($customer->customer_id_present_billing($contract_id)){                     
                        $customer->customer_contract_billing_update($contract_id,$fkkn);
                    }
                    else{
                        if($customer->b_fname != "" || $customer->b_lname != "" || $customer->b_mobile!= "" || $customer->b_email!= "" || $customer->b_city!= "" || $customer->b_oncall!= "" || $customer->b_oncall2!= "" || $customer->b_awake!= "" || $customer->b_something!= "" || $customer->b_iss != "" || $customer->b_sol != "" || $customer->kn_name != "" || $customer->kn_address != "" || $customer->kn_postno != "" ||  $customer->b_kn_ref_num != "" || $customer->b_box != ""){                                     
                            $customer->customer_contract_billing_insert($contract_id,$fkkn);
                        } 
                        
                    } 
                    if($customer->customer_id_present_decision($contract_id)){
                            $customer->customer_contract_decision_update($contract_id,$fkkn);
                    }
                    else{
                        if( $customer->d_fname != "" || $customer->d_lname != "" || $customer->d_mobile != "" || $customer->d_email != "" || $customer->d_city != "" || $customer->d_comment_time != "" || $customer->d_comment_other != "" || $customer->d_document != ""){


                            $customer->customer_contract_decision_insert($contract_id,$fkkn);
                        }

                    }                
                    $customer->commit_transaction();
                    $messages->set_message('success', 'employee_updating_success');
                /* if($customer->add_new_documents($trustedoc, $contract_id)) {

                        $customer->commit_transaction();
                        $message = 'employee_updating_success';
                        $type = "success";
                        $messages->set_message($type, $message);

                    } else {

                        $customer->rollback_transaction();
                    }*/
                } else {

                    $customer->rollback_transaction();
                }
            } else {
                $customer->begin_transaction();
                $id = $customer->add_customer_contract($_POST['username'],$hours, $fromdate, $todate, $fkkn);
                if($id){

                    if( $customer->b_fname != "" || $customer->b_lname != "" || $customer->b_mobile!= "" || $customer->b_email!= "" || $customer->b_city!= "" || $customer->b_oncall!= "" || $customer->b_oncall2!= "" || $customer->b_awake!= "" || $customer->b_something!= "" ){

                        $customer->customer_contract_billing_insert($id,$fkkn);              
                    }  

                    if( $customer->d_fname != "" || $customer->d_lname != "" || $customer->d_mobile != "" || $customer->d_email != "" || $customer->d_city != "" || $customer->d_comment_time != "" || $customer->d_comment_other != "" || $customer->d_document != ""){

                        $customer->customer_contract_decision_insert($id,$fkkn);
                    }

                    $customer->commit_transaction();
                    $messages->set_message('success', 'added_successfully');
                    //header("location:".$smarty->url."customer/insurance/".$query_string[0]."/".$query_string[1]."/");
                } else {

                    $customer->rollback_transaction();
                }
            }
        }
        //$smarty->assign('message', $messages->show_message());
    }
    
    
}


$smarty->assign('message', $messages->show_message());
/*if($errors == "1"){
    header("location:".$smarty->url."customer/insurance/".$query_string[0]."/".$customer_username."/new/");
}*/

$customer_detail = $customer->customer_detail($customer_username);
$customer_detail['social_security'] = substr($customer_detail['social_security'], 0, -4) . "-" . substr($customer_detail['social_security'], 6);
$smarty->assign('customer_detail', $customer_detail);

$period = $customer->get_date_period($customer_username, $fkkn);
$smarty->assign('periods', $period);

if ($_POST['date'] != '') {


    $contract_id = $_POST['date'];    
    $smarty->assign('contract_id', $contract_id);   
    $ful_details_contract = $customer->get_ful_contract_detail($contract_id);

    $smarty->assign('contract_details', $ful_details_contract);
    $documents = $customer->customer_decision_documents($contract_id);
    $smarty->assign('documents', $documents);
    $smarty->assign('documents_string', $customer->customer_decision_document_string($contract_id));
    //time calculation

    $hrs = $ful_details_contract[0]['hour'];
    
    $diff = $employee->date_difference($ful_details_contract[0]['date_from'], $ful_details_contract[0]['date_to']);
    //    $tot_month = floor($diff / (30 * 24 * 60 * 60)) == 0 ? 1 : floor($diff / (30 * 24 * 60 * 60));
    //    $tot_week = floor($diff / (7 * 24 * 60 * 60)) == 0 ? 1 : floor($diff / (7 * 24 * 60 * 60));
    //    $tot_day = floor($diff / (24 * 60 * 60)) == 0 ? 1 : floor($diff / (24 * 60 * 60));
    $tot_day = abs(floor($diff / (24 * 60 * 60)))+1;    //adding 1 for including count both boudary dates
    $current_date = date('Y-m-d');
    $oncall = $customer->oncall_customer($customer_username,$ful_details_contract[0]['date_from'],$ful_details_contract[0]['date_to']);
    if (strtotime($current_date) < strtotime($ful_details_contract[0]['date_from'])) {

        $remaining_hours = $ful_details_contract[0]['hour'];

    } else if (strtotime($current_date) > strtotime($ful_details_contract[0]['date_to'])) {
        $remaining_hours = "0";

    } else {
        //$total_hours = $customer->get_timetable_customer($customer_username, $ful_details_contract[0]['date_from'], $ful_details_contract[0]['date_to'],$current_date, $fkkn);
        $total_hours = $customer->customer_timetable_time_between_dates($customer_username, $ful_details_contract[0]['date_from'], $ful_details_contract[0]['date_to'], $fkkn, FALSE, TRUE);
       // $remaining_hours = $hrs-$total_hours;
       $remaining_hours = $customer->time_difference($hrs, $equipment->time_user_format($total_hours,60), 100,'exact');

    }
    
    //    $smarty->assign('monthly_hrs', round($hrs / $tot_month,1));
    //    $smarty->assign('weekly_hrs', round($hrs / $tot_week,1));
    $smarty->assign('no_of_days', $tot_day);
    $smarty->assign('monthly_hrs', round(($hrs/$tot_day) * 30,2));
    $smarty->assign('weekly_hrs', round(($hrs/$tot_day)*7,2));
    $smarty->assign('remaining_hrs', number_format(round($remaining_hours, 2),2));
    $smarty->assign('hrs', $equipment->time_user_format($ful_details_contract[0]['hour'],100));
    $smarty->assign('oncall', $oncall);
}

else if($query_string[$count -1] != "new" && $errors != "1"){

    $period = $customer->get_date_period($customer_username, $fkkn);
    
    $contract_id = $period[0]['id'];
    //echo "<pre>".print_r($period, 1)."</pre>";
    foreach($period as $period_data){
        //echo "hi<br>";
        if(strtotime(date('Y-m-d')) >= strtotime($period_data['date_from']) && strtotime(date('Y-m-d')) <= strtotime($period_data['date_to'])){
            $contract_id = $period_data['id'];
        }
    }
   // $count1 = count($period);
   // $contract_id = $period[$count1-1]['id'];
    
    $smarty->assign('contract_id', $contract_id);
    $ful_details_contract = $customer->get_ful_contract_detail($contract_id);
    $smarty->assign('contract_details', $ful_details_contract);
    $documents = $customer->customer_decision_documents($contract_id);
    $smarty->assign('documents', $documents);
    $smarty->assign('documents_string', $customer->customer_decision_document_string($contract_id));
    //time calculation
    $hrs = $ful_details_contract[0]['hour'];
    $diff = $employee->date_difference($ful_details_contract[0]['date_from'], $ful_details_contract[0]['date_to']);
   // $tot_month = floor($diff / (30 * 24 * 60 * 60)) == 0 ? 1 : floor($diff / (30 * 24 * 60 * 60));
   // $tot_week = floor($diff / (7 * 24 * 60 * 60)) == 0 ? 1 : floor($diff / (7 * 24 * 60 * 60));
   // $tot_day = floor($diff / (24 * 60 * 60)) == 0 ? 1 : floor($diff / (24 * 60 * 60));
    $tot_day = abs(floor($diff / (24 * 60 * 60)))+1;    //adding 1 for including count both boudary dates
   // echo "<pre>".print_r($ful_details_contract, 1)."</pre>";
   // echo $tot_day; exit();
    $current_date = date('Y-m-d');
    $oncall = $customer->oncall_customer($customer_username,$ful_details_contract[0]['date_from'],$ful_details_contract[0]['date_to']);
   
    if (strtotime($current_date) < strtotime($ful_details_contract[0]['date_from'])) {
        $remaining_hours = $ful_details_contract[0]['hour'];

    } else if (strtotime($current_date) > strtotime($ful_details_contract[0]['date_to'])) {
        $remaining_hours = "0";

    } else {
        // $total_hours = $customer->get_timetable_customer($customer_username, $ful_details_contract[0]['date_from'], $ful_details_contract[0]['date_to'],$current_date, $fkkn,1);
        // $remaining_hours = $customer->time_difference($hrs, $total_hours, 100, 'exact');
        $total_hours = $customer->customer_timetable_time_between_dates($customer_username, $ful_details_contract[0]['date_from'], $ful_details_contract[0]['date_to'], $fkkn, FALSE, TRUE);
        $remaining_hours = $customer->time_difference($hrs, $equipment->time_user_format($total_hours,60), 100,'exact');
    }
    
    $smarty->assign('no_of_days', $tot_day);
    $smarty->assign('monthly_hrs', round(($hrs / $tot_day) * 30,2));
    $smarty->assign('weekly_hrs', round(($hrs / $tot_day) * 7,2));
    $smarty->assign('remaining_hrs', number_format(round($remaining_hours, 2),2));
    $smarty->assign('hrs', $equipment->time_user_format($ful_details_contract[0]['hour'],100));
    $smarty->assign('oncall', $oncall);
}
else{
    $smarty->assign('new','new');
}

$cust_emp_team_details = $employee->get_team_role_of_employee($_SESSION['user_id'], $customer_username);
$customer_kn_details   = $customer->customer_get_kn($query_string[1]);

$smarty->assign('customer_kn_details',$customer_kn_details[0]);
$smarty->assign('emp_role_in_customer', !empty($cust_emp_team_details) ? $cust_emp_team_details['role'] : 0);
$smarty->assign('login_user', $_SESSION['user_id']);
$smarty->assign('user_roles_login', $user->user_role($_SESSION['user_id']));
$smarty->assign('access_flag',($customer->is_customer_accessible($customer_username) ? 1 : 0));
$smarty->display('extends:layouts/dashboard.tpl|customer_insurance.tpl|layouts/sub_layout_customer_tabs.tpl');
?>