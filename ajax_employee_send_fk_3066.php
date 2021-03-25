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
$customer_nw = new customer();
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
$smarty->assign('privilege_general', $privilege_general);
if($privilege_general['customer_settings_3066'] != 1){
    $messages->set_message('fail', 'permission_denied');
    $obj_general->going_to_startup_view($smarty);
    exit();
}


    if(isset($_POST['emps'])){
        $customer = $_POST['customer'];
        //if($sel_year != '' && $sel_month != ''){
            $transaction_flag = TRUE;
            if($transaction_flag){
                //echo "<pre>".print_r($_POST, 1)."</pre>"; exit();
                
                                //header('Content-type: text/xml');           
                //$wsdl           = 'https://time2view.se/cirrus-r/cache/SkickaTidredovisningInteraction_1.0_shsbp10.wsdl';
                $wsdl           = dirname(__FILE__) . '/cache/SkickaAnmalanFranArbetsgivareInteraction_1.0_shsbp10.wsdl';
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
                
                //echo "<pre>";print_r($options);exit();
                
                $soap_flag = TRUE;
                
                try {
                    $client = new SoapClient($wsdl, $options);
                    //echo "<pre>";print_r($client);exit();
                    $employees = explode(',',$_POST['emps']);
                    foreach($employees as $emp){
                        if(!empty($emp)){
                            $emp_data_set = $employee->get_employee_detail($emp);
                            
                            //foreach($emp_cust_set as $cust_key => $cust_val){
                              //  if($cust_val != ''){
                                    $sel_year = date('Y');
                                    $sel_month = date('m');
                                    $data_set_to_send = $obj_dona->make_3066_export_xml($sel_year, $sel_month, $customer, $emp_data_set['username']);
                                    //echo "<pre>".print_r($emp_data_set['username'], 1)."</pre>"; exit();
                                    
                                    $signing = $employee->get_signing_detail($customer, $emp_data_set['username']);
                                    $xml = $signing[0]['xml'];
                                    $signature = $signing[0]['employee_sign'];
                                    //echo base64_decode($signature);exit();
                                    $ocspResponse = $signing[0]['employee_ocs'];
                                    $date = $signing[0]['date'];
                    
                                    try {
                                        $parameters = array(
                                            
                                            'underskrift' => array(
                                                              'signaturtyp' => 'ANORDNARE',
                                                              'signatur' => base64_decode($signature),
                                                              'ocspresponse' => base64_decode($ocspResponse),
                                                              'signaturdatum' => date('Y-m-d', strtotime($date))
                                                         ),
                                                         'anmalanfranarbetsgivare' => $xml,
                                        );
                                        //echo '<pre>'.print_r($parameters, 1).'</pre>'; exit();
                                        $return = $client->SkickaAnmalanFranArbetsgivare($parameters);

                                        //echo("<br/>Returning value of __soapCall() call: ");
                                        //echo "<pre>ghgjhg";print_r($return->{'tx-id'})."</pre><br/><br/><br/>";
                                        
                                        $return_id = $return->{'tx-id'};   //e682ffc0-744c-45d3-a7dc-7a4283b5d9c9
                                        
                                        //Save details
                                        if($return_id != ''){
                                            $transaction_flag = $customer_nw->fk_export_3066_add($sel_year, $sel_month, $customer, $emp, $data_set_to_send['uuid'], $data_set_to_send['xml'], $return_id);
                                            //echo $transaction_flag;
                                            
                                        }
                                        
                                        // sleep(1); // sleep for 1 seconds, because of service provider's system overload
                                    }
                                    catch (SoapFault $exception) {
                                        //echo 'exception<pre>'.print_r($exception, 1).'</pre>';
                
                                        $soap_flag = FALSE;
                                        $messages->set_message('fail', 'error_while_processing_fk_export');
                                        //echo "<pre>";print_r($messages);
                                        if(isset($exception->detail->XmlValidationError)){
                                            $messages->set_message('fail', '<br/>'.$exception->detail->XmlValidationError->message);
                                            $msgs = $exception->detail->XmlValidationError->message;
                                            $ms_er = true;
                                        }
                                        if(isset($exception->detail->SignatureValidationError)){
                                            $messages->set_message('fail', '<br/>'.$exception->detail->SignatureValidationError->message);
                                            $msgs = $exception->detail->SignatureValidationError->message;
                                            $ms_er = true;
                                            
                                        }
                                        
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
                                    //}
                                //}
                            }
                            if(!$transaction_flag) break;
                        }
                        if(!$transaction_flag) break;
                    }
                    
                    if($soap_flag){
                        if($transaction_flag){
                            //$customer->commit_transaction();
                            $messages->set_message('success', 'fk_export_success');
                        }else {
                            //$customer->rollback_transaction();
                            $messages->set_message('fail', 'fk_export_fail');
                        }
                    }
                    if($ms_er){
                        $arr['status'] = 'fail';
                        $arr['message'] = $msgs;
                    }else{
                        $arr['status'] = 'success';
                    }
                    echo json_encode($arr);
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
   // }
    
?>