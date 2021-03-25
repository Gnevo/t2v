<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

require_once('class/setup.php');
require_once('class/user.php');
require_once('class/employee.php');
require_once('class/dona.php');
require_once('configs/config.inc.php');
require_once('class/customer.php');
require_once('class/leave.php');
require_once('class/inconvenient.php');
require_once('class/report_signing.php');
//require_once('class/general.php');

$smarty = new smartySetup(array('messages.xml',"reports.xml","button.xml","month.xml"), FALSE);
$user = new user();
$employee = new employee();
$dona = new dona();
$obj_cust = new customer();
$obj_leave = new leave();
$obj_inconv = new inconvenient();
$obj_rpt    = new report_signing();
//$obj_general = new general();
global $month;
global $bank_id;

$mon  = trim($_REQUEST['month']);
$year   = trim($_REQUEST['year']);
$report_employee = trim($_REQUEST['emp']);
$report_customer = trim($_REQUEST['customer']);
$from_page = $_REQUEST['from_page'];
$fkkn = $_REQUEST['fkkn'];
$bank_id_flag = $_REQUEST['bank_id_flag'];
$smarty->assign('report_month', $mon);
$smarty->assign('report_year', $year);
$smarty->assign('now_month', date('m'));
$smarty->assign('now_year', date('Y'));



// var_dump($signin_sutl);
// exit('df');



$signing_message = '';
$transaction_flag = 'TRUE';

$_SESSION['url_back_back'] = '';
unset($_SESSION['url_back_back']);


if($from_page == ''){
    $untreated_leaves = $obj_leave->check_untreated_employee_leave_in_a_customer($report_employee, $year, $mon, $report_customer);
    $untreated_candg_slots = $obj_inconv->check_untreated_candg_slots($report_employee, $report_customer, $mon, $year);
    $have_after_slots = $employee->check_timeslots_after_timestamp_in_the_month($report_employee, $report_customer, $mon, $year);
    if($untreated_leaves){
        $signing_message = $smarty->translate['untreated_leave_exists_contact_TL'];
        $transaction_flag = 'FALSE';
    }elseif($untreated_candg_slots){
        echo $signing_message = $smarty->translate['untreated_candg_slot_exists'];
        $transaction_flag = 'FALSE';
    }elseif($have_after_slots){
        echo $signing_message = $smarty->translate['future_slots_exist_in_this_month'];
        $transaction_flag = 'FALSE';
    }
    else{
        if($bank_id_flag != 1){
            $user->username = strip_tags($_POST['UN']);
            $user->password = strip_tags($_POST['PW']);
        }
        $user->company_id = strip_tags($_SESSION['company_id']);

        $employee->username = $report_employee;
        $employee->rpt_customer = $report_customer;
        $employee->signing_report_date = $year.'-'.$mon.'-1';

        //        $cur_user = $user->validate_login();
        $cur_user = array();
        if($bank_id_flag != 1)
            $cur_user = $user->validate_secondary_login();
        if(($_SESSION['user_id'] == $user->username && !empty($cur_user)) || $bank_id_flag == 1){
            if($bank_id_flag == 1){
                $data_obj_array = json_decode($_REQUEST['consolidated']);
                $string_data = $smarty->translate['bank_id_display_head']. " ".$smarty->translate[$month[$mon-1]['month']]."-". $year."\n";
                $string_data .= $smarty->translate['bank_id_total_working'].$data_obj_array->$report_employee->work_hours->total_working."\n";
                $string_data .= $smarty->translate['bank_id_total_leave'].$data_obj_array->$report_employee->work_hours->total_leave."\n";
                
                //                $uuid = $obj_general->generate_custom_uuid($year, $mon, $report_customer, $report_employee, 1);
                $data_set_to_send = $dona->make_fk_export_xml($year, $mon, $report_customer, $report_employee);
                $doc = new DOMDocument();
                $doc->loadXML($data_set_to_send['xml']);
        
                //                $string_non_visible = "91eb5e00-abcd-2016-0002-69fada001111,d0e0b2aff0c6303ecb869059ccfa5b9d029cdfcbdc7de29a3bf8d5583889b336";
                $string_non_visible = $data_set_to_send['uuid'].','.hash('sha256', $doc->C14N());
                
                $string_data = base64_encode($string_data);
                $string_non_visible = base64_encode($string_non_visible);
                
                
                $url_send = $bank_id['url'];
               //$url_send ="https://api.diglias.com/rp-sapi-auth/v1.1/rest/signRP/time2view";
                  //$url_send ="https://test.diglias.com/doc-rp/sapi/resource_RestSigningsRP#GET";
                //$url_send ="https://time2view.se/cirrus-r/testshaju.php";
                //$url_send ="https://test.diglias.com/rp-sapi-auth/v1.1/rest/signRP/time2view";
                            
                $data = array(
                            "toBeSigned" =>
                            array(
                                "data" => $string_data,
                                "hiddenData" => $string_non_visible
                            )
                        );
                $str_data = json_encode($data);
                file_put_contents('sign.txt', $url_send.$str_data);
                $headers =  sendPostData($url_send, $str_data);
                
                if($headers[1]['X-Diglias-Location']){
                    $_SESSION['url_back_back'] = $_SERVER['HTTP_REFERER'];
                    echo '<script>window.location.href="'.$headers[1]['X-Diglias-Location'].'&sign_returnurl='.$smarty->url.'sign_back_url.php"</script>';
                }
                else{
                    echo $smarty->translate['can_not_connect_to_bank_id'];
                }
            }else{
                if($employee->employee_signing_Transaction()){
                    $signing_message = $smarty->translate['signing_done_sucessfully'];
                    $signin_sutl        = $obj_rpt->get_report_details($year,$mon,$report_employee,$report_customer)['signin_sutl'];
                    
                }else{
                //                    echo "<pre>".print_r($employee->query_error_details, 1)."</pre>"; exit();
                    $signing_message = $smarty->translate['error_occured_in_signing_try_again'];
                    $transaction_flag = 'FALSE';
                }
                $smarty->assign('uname',$_POST['UN']);
                $smarty->assign('pword',$_POST['PW']);
                $smarty->assign('transaction_flag', $transaction_flag);
                $smarty->assign('signing_message',$signing_message);
                $smarty->assign('signin_sutl', $signin_sutl);

                $sign_existance_flag = $employee->employee_signing_existance_check();
                if ($sign_existance_flag == 2)
                    $smarty->assign('sign_status', "both");
                else if($sign_existance_flag == 1)
                    $smarty->assign('sign_status', "true");
                else if ($sign_existance_flag == 0)
                    $smarty->assign('sign_status', "false");

                $employee_signing_details = $employee->get_signin_details_by_employee_customer($year, $mon, $report_employee, $report_customer);
                $smarty->assign('signing_details', $employee_signing_details[$report_employee]);
                //                echo "<pre>".print_r($employee_signing_details, 1)."</pre>";
                $login_user = $_SESSION['user_id'];
                $smarty->assign('login_user', $login_user);
                $login_user_role = $user->user_role($login_user);
                $smarty->assign('login_user_role', $login_user_role);
                $smarty->assign('sort_by_name', $_SESSION['company_sort_by']);

                 /*if ($user->check_SuperTL_or_not_from_team($login_user)) 
                    $smarty->assign('is_suTL', TRUE);
                 else
                    $smarty->assign('is_suTL', FALSE);*/
    
                $is_able_to_sign = FALSE;
                if((empty($employee_signing_details) || $employee_signing_details === FALSE || $employee_signing_details[$report_employee]['signin_employee'] == '') && $report_employee == $_SESSION['user_id'])
                    $is_able_to_sign = TRUE;
                else if($report_employee != $_SESSION['user_id'] && !empty($employee_signing_details) && (trim($employee_signing_details[$report_employee]['signin_tl']) == '' || trim($employee_signing_details[$report_employee]['signin_sutl']) == ''))
                    $is_able_to_sign = TRUE;
                $smarty->assign('is_able_to_sign', $is_able_to_sign);

                $employee_slots = $employee->get_employee_normal_inconvenient_details_by_month_and_year($mon, $year, $report_employee, $report_customer);
                $have_fk_slots = FALSE;
                if(!empty($employee_slots)){
                    foreach($employee_slots as $es){
                        if($es['fkkn'] == 1 && $es['status'] == 1){
                            $have_fk_slots = TRUE;
                            break;
                        }
                    }
                }
                $smarty->assign('allow_ordinary_signing', ($have_fk_slots && $report_employee == $login_user && $login_user_role != 1 ? FALSE : TRUE));

                $isGLorAdmin = FALSE;
                if($_SESSION['user_role'] == 1)
                    $isGLorAdmin = TRUE;
                elseif($_SESSION['user_role'] != 4) {
                    $login_emp_role_in_customer = $employee->get_team_role_of_employee($_SESSION['user_id'], $report_customer);
                    $isGLorAdmin = (!empty($login_emp_role_in_customer) && $login_emp_role_in_customer['role'] == 7) ? TRUE : FALSE;
                }
                $smarty->assign('isGLorAdmin', $isGLorAdmin);

                $smarty->display('ajax_employee_signing.tpl');            
            }

        }else{
            echo $signing_message = $smarty->translate['invalid_username_or_password'];
            $transaction_flag = 'FALSE';
        }
    }
 
}
else{
    $cust_details = $obj_cust->customer_detail($report_customer);
    $Cust_FullName = $cust_details['last_name']." ".$cust_details['first_name'];
    if($_SESSION['company_sort_by'] == 1)
        $Cust_FullName = $cust_details['first_name']." ".$cust_details['last_name'];
    
    $string_data = $smarty->translate['bank_id_display_head_employer'];
    $string_data .= $Cust_FullName."\n";
    
    $string_data .= $smarty->translate['bank_id_month_year'].": ".$smarty->translate[$month[$mon-1]['month']]."-". $year."\n";
    $string_data .= $smarty->translate['bank_id_employees_employer'];
   
    
    $string_non_visible_array = array();
    $employee_self_sign_violated_flag = FALSE;
    if($report_employee == ''){
        
        $string_data .= "\n";
        $permitted_employees = $employee->employees_list_for_right_click($_SESSION['user_id']);
        
        $permitted_employees_ids = array();
        $all_employee_names = array();
        $employee_names = array();
        if (!empty($permitted_employees)) {
            foreach ($permitted_employees as $p_employee) {
                $permitted_employees_ids[] = $p_employee['username'];
            }
            
            //checking employee is signed to sign for employer
            
            
            //echo "<pre>".print_r($employee_names, 1)."</pre>";
            
            
                $empoyee_names_signed = array();
                $all_employee_names = $dona->get_all_Member_details_for_customer_with_no_trainee($report_customer, $fkkn, $mon, $year, $permitted_employees_ids);
                foreach ($all_employee_names as $temp_emp){
                    $employee_names[] = $temp_emp['empID'];
                    $empoyee_names_signed[$temp_emp['empID']] = $temp_emp;
                }
                

                if (!empty($employee_names)){ 
                    foreach ($employee_names as $emp) {
                        $employee_signing_details = $employee->get_signin_details_by_employee_customer($year, $mon, $emp, $report_customer);
                        if(empty($employee_signing_details) || $employee_signing_details === FALSE || $employee_signing_details[$emp]['signin_employee'] == ''){
                            if (($key = array_search($emp, $employee_names)) !== false) {
                                unset($employee_names[$key]);
                                unset($empoyee_names_signed[$emp]);
                            }
                        }
                    }
                }
                
                if(empty($employee_names)){
                    $employee_self_sign_violated_flag = TRUE;
                }
                
                if(!$employee_self_sign_violated_flag){
                    $i = 0;
                    if (!empty($empoyee_names_signed)) {
                        foreach ($empoyee_names_signed as $employee_s) {
                            $i++;
                            if($_SESSION['company_sort_by'] == 1){
                                $string_data .= $i.". ".$employee_s['empName_ff']."\n";
                            }
                            else{
                                $string_data .= $i.". ".$employee_s['empName']."\n";
                            }

                            $data_set_to_send = $dona->make_fk_export_xml($year, $mon, $report_customer, $employee_s['empID']);
                            $doc = new DOMDocument();
                            $doc->loadXML($data_set_to_send['xml']);
                            $string_non_visible_array[] = $data_set_to_send['uuid'].','.hash('sha256', $doc->C14N());
                        }
                    }else{
                         $_SESSION['url_back_back'] = 2;
                         echo "<script>parent.window.close()</script>";
                    }
                }
           
        }
    
    }
    else{
        $employee_det = $employee->employee_detail_main($report_employee);
        
         //checking employee is signed to sign for employer
        $employee_names = array($report_employee);
        if (!empty($employee_names)){ 
            foreach ($employee_names as $emp) {
                $employee_signing_details = $employee->get_signin_details_by_employee_customer($year, $mon, $emp, $report_customer);
                if(empty($employee_signing_details) || $employee_signing_details === FALSE || $employee_signing_details[$emp]['signin_employee'] == ''){
                    $employee_self_sign_violated_flag = TRUE;
                    break;
                }
            }
        }
        
        if(!$employee_self_sign_violated_flag){
            //echo "<pre>".print_r($employee_det,1)."</pre>";
            $EmpFullname = $employee_det[0]['last_name']." ".$employee_det[0]['first_name']."\n";
            if($_SESSION['company_sort_by'] == 1)
                $EmpFullname = $employee_det[0]['first_name']." ".$employee_det[0]['last_name']."\n";

            $string_data .= $EmpFullname;

            $data_set_to_send = $dona->make_fk_export_xml($year, $mon, $report_customer, $report_employee);
            $doc = new DOMDocument();
            $doc->loadXML($data_set_to_send['xml']);
            $string_non_visible_array[] = $data_set_to_send['uuid'].','.hash('sha256', $doc->C14N());
        }
    }
    
    if(!$employee_self_sign_violated_flag){
    
        $string_data = base64_encode($string_data);

    //    $string_non_visible = "91eb5e00-0010-2016-0001-69fada001002,d0e0b2aff0c6303ecb869059ccfa5b9d029cdfcbdc7de29a3bf8d5583889b336";
        $string_non_visible = implode(';', $string_non_visible_array);
        $string_non_visible = base64_encode($string_non_visible);
        //echo "<pre>".print_r($string_non_visible_array)."</pre>";

        $url_send = $bank_id['url'];
        //$url_send ="https://api.diglias.com/rp-sapi-auth/v1.1/rest/signRP/time2view";
        //$url_send ="https://time2view.se/cirrus-r/testshaju.php";
        //$url_send ="https://test.diglias.com/rp-sapi-auth/v1.1/rest/signRP/time2view";
        $data = array(
                    "toBeSigned" =>
                    array(
                        "data" => $string_data,
                        "hiddenData" => $string_non_visible
                    )
                );
        $str_data = json_encode($data);

        

        $headers =  sendPostData($url_send, $str_data);
        if($headers[count($headers)-1]['X-Diglias-Location']){
            //echo '<script>document.location.href="'.$headers[1]['X-Diglias-Location'].'&sign_returnurl='.$smarty->url.'sign_back_url.php"</script>';
            //header('location:'.$headers[1]['X-Diglias-Location'].'&sign_returnurl='.$smarty->url.'sign_back_url.php');
          //  echo '<iframe width="500", height="500" src="'.$headers[count($headers)-1]['X-Diglias-Location'].'&sign_returnurl='.$smarty->url.'sign_back_url.php"</iframe>';
           echo '<script>window.location.href="'.$headers[1]['X-Diglias-Location'].'&sign_returnurl='.$smarty->url.'sign_back_url.php"</script>';
        }
        else
            echo $smarty->translate['can_not_connect_to_bank_id'];
    }else{
            echo $smarty->translate['employees_doesnt_sign_self'];
    }
    
}


function sendPostData($url, $post){
  global $bank_id;  
  $headers= array('Accept: application/json',
      'Content-Type: application/json',
      'Connection: keep-alive',
      'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.65 Safari/537.36'
      ); 
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
  curl_setopt($ch, CURLOPT_USERPWD, $bank_id['userpaswd']);
  //curl_setopt($ch, CURLOPT_USERPWD, "time2view:iFDAY7FM+7mZsLhzfBjBSA==");//test server
  curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
  curl_setopt($ch, CURLOPT_POSTFIELDS,$post);    
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
  curl_setopt($ch, CURLOPT_VERBOSE, 1);
  curl_setopt($ch, CURLOPT_HEADER, 1);
  $response = curl_exec($ch);
  $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
  $header = substr($response, 0, $header_size);
  $headers = get_headers_from_curl_response($header);
  //echo "<pre>".  print_r($headers,1)."</pre>";
  //file_put_contents('sign.txt', print_r($headers, true));
  curl_close($ch);
  return $headers;
}



function get_headers_from_curl_response($headerContent){
    $headers = array();
    $arrRequests = explode("\r\n\r\n", $headerContent);

  
    for ($index = 0; $index < count($arrRequests) -1; $index++) {

        foreach (explode("\r\n", $arrRequests[$index]) as $i => $line)
        {
            if ($i === 0)
                $headers[$index]['http_code'] = $line;
            else
            {
                list ($key, $value) = explode(': ', $line);
                $headers[$index][$key] = $value;
            }
        }
    }

    return $headers;
}

?>