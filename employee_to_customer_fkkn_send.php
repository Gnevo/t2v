<?php
// ini_set('display_errors', true);
// ini_set('xdebug.var_display_max_depth', 10);
// error_reporting(E_ALL ^ E_NOTICE);

require_once('configs/config.inc.php');
require_once('class/setup.php');
require_once('class/employee.php');
require_once('class/customer.php');
require_once('class/equipment.php');
require_once('class/dona.php');
require_once('class/company.php');
require_once('class/general.php');
require_once('plugins/message.class.php');
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml", "month.xml", "reports.xml"));
$customer = new customer();
$employee = new employee();
$messages = new message();
$obj_equipment = new equipment();
$obj_dona = new dona();
$obj_company = new company();
$obj_general = new general();
global $month;
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 9));
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);

$privilege_general = $employee->get_privileges($_SESSION['user_id'], 2);
if($privilege_general['administration_fk_export'] != 1){
    $messages->set_message('fail', 'permission_denied');
    $obj_general->going_to_startup_view($smarty);
    exit();
}

$years_combo = $employee->distinct_years();
$smarty->assign("year_option_values", $years_combo);
$month_num = $month_name_full = $month_name_short = array();
foreach ($month as $m_id) {
    $month_num[]=$m_id['id'];
    $month_name_short[] = $smarty->translate[$m_id['label']];
    $month_name_full[]=$smarty->translate[$m_id['month']];
}
$smarty->assign("month_option_values", $month_num);
$smarty->assign("month_option_output_short", $month_name_short);
$smarty->assign("month_option_output_full", $month_name_full);

$search_type = 'all';
//$search_customers = $customer->customer_list();
//$search_employees = $employee->employee_list();
$search_customers = $customer->customers_list_for_employee_report(-1);
$search_employees = $employee->employees_list_for_right_click($_SESSION['user_id'], -1);


$smarty->assign('search_customers', $search_customers);
$smarty->assign('search_employees', $search_employees);

$search_cust_ids = $search_emp_ids = array();
if(!empty($search_customers)){
    foreach($search_customers as $this_customer)
        $search_cust_ids[] = $this_customer['username'];
}
if(!empty($search_employees)){
    foreach($search_employees as $this_employee)
        $search_emp_ids[] = $this_employee['username'];
}

//echo "<pre>".print_r($search_cust_ids, 1)."</pre>";
//echo "<pre>".print_r($search_emp_ids, 1)."</pre>"; exit();

$sel_year = $sel_month = NULL;
$sel_customer = $sel_employee = NULL;
$load_customers = $load_employees = array();
$load_emp_ids = $load_cust_ids = array();

//echo "<pre>".print_r($_POST, 1)."</pre>"; exit();
//set current year-month by default
if(!isset($_POST['cmb_year']) && !isset($_POST['cmb_month']) && !isset($_POST['action'])){
    
    //echo "<pre>".print_r($_POST, 1)."</pre>"; exit();
    $_POST['cmb_year'] = date('Y', strtotime("last day of last month"));
    $_POST['cmb_month'] = (int) date('m', strtotime("last day of last month"));
    //$_POST['action'] = 'GET-SEARCH-DATA';
   // $_POST['action'] = 'GET-DATA';
}

if(isset($_POST) && !empty($_POST)){
    //echo "<pre>".print_r($_POST, 1)."</pre>";
    if(isset($_POST['action']) && (trim($_POST['action']) == 'GET-SEARCH-DATA' || trim($_POST['action']) == 'GET-DATA' || trim($_POST['action']) == 'SEND-DATA')){
        $sel_year   = isset($_POST['cmb_year']) && trim($_POST['cmb_year']) != '' ? trim($_POST['cmb_year']) : NULL;
        $sel_month  = isset($_POST['cmb_month']) && trim($_POST['cmb_month']) != '' ? trim($_POST['cmb_month']) : NULL;
        
        if($sel_year != '' && $sel_month != ''){
            $load_customers = $customer->get_bank_signed_timetable_customers($sel_month, $sel_year, $search_cust_ids);
            $load_employees = $customer->get_bank_signed_timetable_employees($sel_month, $sel_year, $search_emp_ids);
            //echo "<pre>".print_r($load_employees, 1)."</pre>"; exit();
            
            
            if($_POST['search_type'] == 1) $search_type = 'customer';
            else if($_POST['search_type'] == 2) $search_type = 'employee';
            else $search_type = 'all';
        }
        
    }
  //  echo "here ";exit;
    $load_emp_ids = $load_cust_ids = array();
    if(!empty($load_employees)){
        foreach($load_employees as $le)
            $load_emp_ids[] = $le['employee_id'];
    }
    if(!empty($load_customers)){
        foreach($load_customers as $lc)
            $load_cust_ids[] = $lc['customer_id'];
    }
    
    //echo "<pre>".print_r($load_cust_ids, 1)."</pre>"; exit();
    if(isset($_POST['action']) && (trim($_POST['action']) == 'GET-DATA' || trim($_POST['action']) == 'SEND-DATA')){
        $sel_customer  = $search_type == 'customer' && isset($_POST['cmb_customer']) && trim($_POST['cmb_customer']) != '' ? trim($_POST['cmb_customer']) : NULL;
        $sel_employee  = $search_type == 'employee' && isset($_POST['cmb_employee']) && trim($_POST['cmb_employee']) != '' ? trim($_POST['cmb_employee']) : NULL;
        
        if($sel_year != '' && $sel_month != ''){
            
            if($sel_customer == '') {
                $exact_employees_group = $obj_equipment->employee_export_group_bank_signed($_SESSION['user_id'], $sel_month, $sel_year, $sel_employee, $load_emp_ids, $load_cust_ids, $privilege_general);
            }
            else {
                $exact_employees_group = $obj_equipment->customer_export_group_bank_signed($_SESSION['user_id'], $sel_month, $sel_year, $sel_customer, $load_emp_ids, $load_cust_ids, $privilege_general);
            }
            //echo "<pre>".print_r($_POST, 1)."</pre>"; exit();
            // echo "<pre>".print_r($exact_employees_group, 1)."</pre>"; exit();
        }
    }
    
    if(isset($_POST['action']) && trim($_POST['action']) == 'SEND-DATA'){
        if($sel_year != '' && $sel_month != ''){
            $transaction_flag = TRUE;
            if(!isset($_POST['send_data_set']) || empty($_POST['send_data_set'])){
                $messages->set_message('fail', 'select_atleast_one_user');
                $transaction_flag = FALSE;
            }
            if($transaction_flag){
                // echo "<pre>".print_r($_POST, 1)."</pre>"; exit();
                
                                //header('Content-type: text/xml');           
                //$wsdl           = 'https://time2view.se/cirrus-r/cache/SkickaTidredovisningInteraction_1.0_shsbp10.wsdl';
                $wsdl           = dirname(__FILE__) . '/cache/SkickaTidredovisningInteraction_1.0_shsbp10.wsdl';
                $certificate    = dirname(__FILE__) . '/cache/Certifikat_2020-2021.pem';
                $password       = '2626946172126295';
                $opts = array(
                    'ssl' => array('verify_peer'=> false, 'verify_peer_name'=> false),
                    'https'=> array(
                        'user_agent' => 'PHPSoapClient',
                        'header' => 'Content-Type: text/xml; Accept-Encoding: gzip,deflate;'
                    )
                );
                $context = stream_context_create($opts);
                $options = array (
                    //'uri' => $wsdl,
                    //'location' => $endpoint,
                    'encoding' => 'UTF-8',
                    'soap_version' => SOAP_1_1, 
                    'trace' => 1, 
                    'exceptions' => 1, 
                    'connection_timeout' => 180, 
                    'keep_alive'    => true,
                    'stream_context' => stream_context_create($opts),
                    'local_cert'    => $certificate,
                    'passphrase'    => $password,
                    'authentication'=> SOAP_AUTHENTICATION_BASIC,
                    'cache_wsdl'    => WSDL_CACHE_NONE
                );
                
                $soap_flag = TRUE;
                
                try {
                    $client = new SoapClient($wsdl, $options);
                    
                    //$customer->begin_transaction();
                    
                    foreach($_POST['send_data_set'] as $emp_key => $emp_cust_set){
                        if(!empty($emp_cust_set)){
                            $emp_data_set = $employee->get_employee_detail($emp_key);
                            foreach($emp_cust_set as $cust_key => $cust_val){
                                if($cust_val != ''){

                                    $data_set_to_send = $obj_dona->make_fk_export_xml($sel_year, $sel_month, $cust_key, $emp_key);
                                    // echo "<pre>".print_r($data_set_to_send, 1)."</pre>"; exit();
                                    $xml = $data_set_to_send['xml'];
                                    $signature = $data_set_to_send['employee_signing'][0]['employee_sign'];
                                    $ocspResponse = $data_set_to_send['employee_signing'][0]['employee_ocs'];
                                    $signature2 = $data_set_to_send['employer_signing'][0]['employee_data'][0]['employer_sign'];
                                    $ocspResponse2 = $data_set_to_send['employer_signing'][0]['employee_data'][0]['employer_ocs'];
                                    
                                    //echo "<xmp>".$xml."</xmp>"."END";
                                    //echo '<br/><br/>*******************<br/><br/>';
                                    //$doc = new DOMDocument();
                                    //$doc->loadXML($xml);
                                    //echo hash('sha256', $doc->C14N());
                                    //exit();

                                    try {
                                        $parameters = array(
                                            'tidredovisning' => $xml,
                                            'assistent-signatur' => array(
                                                              'signature' => base64_decode($signature),
                                                              'ocspResponse' => base64_decode($ocspResponse),
                                                              'datumForSignatur' => date('Y-m-d', strtotime($data_set_to_send['employee_signing'][0]['signin_date']))
                                                             ),
                                            'anordnare-signatur' => array(
                                                              'signature' => base64_decode($signature2),
                                                              'ocspResponse' => base64_decode($ocspResponse2),
                                                              'datumForSignatur' => date('Y-m-d', strtotime($data_set_to_send['employer_signing'][0]['employee_data'][0]['signing_date']))
                                                             )
                                            );
                                        // echo '<pre>'.print_r($parameters, 1).'</pre>'; exit();
                                        $return = $client->SkickaTidredovisning($parameters);

                                        //echo("<br/>Returning value of __soapCall() call: ");
                                        //echo "<pre>".print_r($return, 1)."</pre><br/><br/><br/>";
                                        
                                        $return_id = $return->{'tx-id'};   //e682ffc0-744c-45d3-a7dc-7a4283b5d9c9
                                        
                                        //Save details
                                        if($return_id != ''){
                                            $transaction_flag = $customer->fk_export_add($sel_year, $sel_month, $cust_key, $emp_key, $data_set_to_send['uuid'], $data_set_to_send['xml'], $return_id);
                                        }
                                        
                                        // sleep(1); // sleep for 1 seconds, because of service provider's system overload
                                    }
                                    catch (SoapFault $exception) {
                                        // echo 'exception<pre>'.print_r($exception, 1).'</pre>'; exit();
                                        $soap_flag = FALSE;
                                        $messages->set_message('fail', 'error_while_processing_fk_export');
                                        if(isset($exception->detail->XmlValidationError))
                                            $messages->set_message_exact('fail', '<br/>'.$exception->detail->XmlValidationError->message);
                                        if(isset($exception->detail->SignatureValidationError))
                                            $messages->set_message_exact('fail', '<br/>'.$exception->detail->SignatureValidationError->message);
                                        /*echo 'Exception2 : '. $exception->getMessage();
                                            echo 'Exception2 : '. $exception->detail->SignatureValidationError->message;
                                            echo "<br/>Exception2 :<pre>".print_r($exception, 1)."</pre>";exit();

                                            echo("<br/>Dumping request headers:<br/>");
                                            echo '<pre>'.print_r($client->__getLastRequestHeaders(), 1).'</pre>';

                                            echo("<br/>Dumping request:<br/>");
                                            echo '<code>' . nl2br(htmlspecialchars($client->__getLastRequest(), true)) . '</code>' . "<br/>\n";
                                            //echo '<code>' . highlight_string($client->__getLastRequest(), true) . '</code>' . "<br/>\n";

                                            echo("<br/>Dumping response headers:<br/>");
                                            echo '<pre>'.print_r($client->__getLastResponseHeaders(), 1).'</pre>';

                                            echo("<br/>Dumping response:<br/>");
                                            echo '<code>' . nl2br(htmlspecialchars($client->__getLastResponse(), true)) . '</code>' . "<br/>\n";*/
                                    }
                                }
                            }
                            if(!$transaction_flag) break;
                        }
                        if(!$transaction_flag) break;
                    }
                    
                    if($soap_flag){
                        if($transaction_flag){
                            //$customer->commit_transaction();
                            $messages->set_message('success', 'fk_export_success');
                        }
                        else {
                            //$customer->rollback_transaction();
                            $messages->set_message('fail', 'fk_export_fail');
                        }
                    }
                } 
                catch (SoapFault $exception) {
                    $soap_flag = FALSE;
                    $messages->set_message('fail', 'soap_server_connection_error');
                    /*echo 'Exception1 : '.$exception->getMessage();
                        echo "<br/>Exception1 :<pre>".print_r($exception, 1)."</pre>";

                        echo("<br/>Dumping request headers:<br/>");
                        echo '<pre>'.print_r($client->__getLastRequestHeaders(), 1).'</pre>';

                        echo("<br/>Dumping request:<br/>");
                        echo '<code>' . nl2br(htmlspecialchars($client->__getLastRequest(), true)) . '</code>' . "<br/>\n";
                        //echo '<code>' . highlight_string($client->__getLastRequest(), true) . '</code>' . "<br/>\n";

                        echo("<br/>Dumping response headers:<br/>");
                        echo '<pre>'.print_r($client->__getLastResponseHeaders(), 1).'</pre>';

                        echo("<br/>Dumping response:<br/>");
                        echo '<code>' . nl2br(htmlspecialchars($client->__getLastResponse(), true)) . '</code>' . "<br/>\n";*/

                }
                //exit();
            }
        }
    }
    
    if(isset($_POST['action']) && (trim($_POST['action']) == 'GET-DATA' || trim($_POST['action']) == 'SEND-DATA')){
        //find previous exported details
        $total_send_users_count = 0;
        $total_users_count = 0;
        if(!empty($exact_employees_group)){
            foreach($exact_employees_group as $emp_indx => $emp_entry){
                if(!empty($emp_entry['employee_customers'])){
                    foreach($emp_entry['employee_customers'] as $cust_indx => $cust_entry){
                        $total_users_count++;
                        $previous_export_details = $customer->get_fk_export($sel_year, $sel_month, $cust_entry['customer'], $emp_entry['employee_username']);
                        $exact_employees_group[$emp_indx]['employee_customers'][$cust_indx]['exported_count'] = count($previous_export_details);
                        $exact_employees_group[$emp_indx]['employee_customers'][$cust_indx]['last_exported_date'] = !empty($previous_export_details) ? $previous_export_details[0]['created_date'] : NULL;
                        
                        if(count($previous_export_details) > 0) $total_send_users_count++;
                    }
                }
            }
        }
        // echo "<pre>".print_r($exact_employees_group, 1)."</pre>"; exit();
        $exact_employees_group_chunked = array_chunk($exact_employees_group, 3);
        $smarty->assign('employees_group', $exact_employees_group_chunked);
        $smarty->assign('total_send_users_count', $total_send_users_count);
        $smarty->assign('total_users_count', $total_users_count);
        $smarty->assign('total_unsend_users_count', $total_users_count-$total_send_users_count);
        //echo "<pre>".print_r($exact_employees_group, 1)."</pre>"; exit();
    }
    
    if(isset($_POST['action']) && trim($_POST['action']) == 'GET-DATA' && empty($exact_employees_group)){
        $messages->set_message('WARNING', 'no_data_available');
    }
}

$smarty->assign('list_year', $sel_year);
$smarty->assign("list_month", $sel_month);

$smarty->assign('load_customers', $load_customers);
$smarty->assign('load_employees', $load_employees);

$smarty->assign('sel_customer', $sel_customer);
$smarty->assign("sel_employee", $sel_employee);

$smarty->assign('search_type', $search_type);

if(($sel_year == '' && $sel_month == '') || ($sel_year == null && $sel_month == null))
{
    $month = date('m'); 
    $year = date('Y');
    $month = $month-1%12;
    $last_month = ($month==0?12:$month);
    $last_year = ($last_month==12?($year-1):$year);
    $smarty->assign("list_month", $last_month);
    $smarty->assign("list_year", $last_year);
    
    if(!isset($_POST['action'])){
        $exact_employees_group = $obj_equipment->customer_export_group_bank_signed_dt($_SESSION['user_id'], $last_month, $last_year, $sel_customer, NULL, NULL, $privilege_general);
        $total_send_users_count = 0;
        $total_users_count = 0;
        if(!empty($exact_employees_group)){
            foreach($exact_employees_group as $emp_indx => $emp_entry){
                if(!empty($emp_entry['employee_customers'])){
                    foreach($emp_entry['employee_customers'] as $cust_indx => $cust_entry){
                        $total_users_count++;
                        $previous_export_details = $customer->get_fk_export($sel_year, $sel_month, $cust_entry['customer'], $emp_entry['employee_username']);
                        
                        if(count($previous_export_details) > 0) $total_send_users_count++;
                    }
                }
            }
        }
        // echo "<pre>".print_r($exact_employees_group, 1)."</pre>"; exit();
        $smarty->assign('get_page',1);
        $smarty->assign('total_send_users_count', $total_send_users_count);
        $smarty->assign('total_users_count', $total_users_count);
        $smarty->assign('total_unsend_users_count', $total_users_count-$total_send_users_count);
        
    }
}

$params = explode('&', $_SERVER['QUERY_STRING']);

$params_count = count($params);


//echo "<pre>".print_r($report_list, 1)."</pre>";
//$smarty->assign("selected_month_pg_label", $selected_month_pg_label);
//$smarty->assign('now_month', date('m'));
//$smarty->assign('now_year', date('Y'));
//echo "<pre>".print_r($report_list, 1)."</pre>";
//$smarty->assign('report_list', $report_list);
$smarty->assign('user_role',$_SESSION['user_role']);
$smarty->assign('message', $messages->show_message());
$smarty->display('extends:layouts/dashboard.tpl|employee_to_customer_fkkn_send.tpl');
?>