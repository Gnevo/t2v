<?php
session_id($_REQUEST['my_session']);
session_name('t2v-cirrus');
session_start('t2v-cirrus');
$app_dir = dirname(dirname( realpath( __FILE__ ) )) ;
chdir ($app_dir);
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
require_once('class/setup.php');
require_once('class/user.php');
require_once('class/employee.php');
require_once('class/dona.php');
require_once('configs/config.inc.php');
require_once('class/customer.php');
require_once('class/leave.php');
require_once('class/inconvenient.php');
//require_once('class/general.php');

$smarty = new smartySetup(array('messages.xml',"reports.xml","button.xml","month.xml"), FALSE);
$user = new user();
$employee = new employee();
$dona = new dona();
$obj_cust = new customer();
$obj_leave = new leave();
$obj_inconv = new inconvenient();
//$obj_general = new general();
global $month;
global $bank_id;

$mon  = trim($_REQUEST['month']);
$year   = trim($_REQUEST['year']);
$report_employee = trim($_REQUEST['emp']);
$report_customer = trim($_REQUEST['customer']);

$total_working = $_REQUEST['total_working'];
$total_leave = $_REQUEST['total_leave'];
$total_working_days = $_REQUEST['total_working_days'];


$signing_message = '';
$transaction_flag = 'TRUE';


$untreated_leaves = $obj_leave->check_untreated_employee_leave_in_a_customer($report_employee, $year, $mon, $report_customer);
$untreated_candg_slots = $obj_inconv->check_untreated_candg_slots($report_employee, $report_customer, $mon, $year);
if($untreated_leaves){
    $signing_message = $smarty->translate['untreated_leave_exists_contact_TL'];
    $transaction_flag = 'FALSE';
}elseif($untreated_candg_slots){
    $signing_message = $smarty->translate['untreated_candg_slot_exists'];
    $transaction_flag = 'FALSE';
}else if($employee->check_timeslots_after_timestamp_in_the_month($report_employee, $report_customer, $mon, $year)){
    $signing_message = $smarty->translate['future_slots_exist_in_this_month'];
    $transaction_flag = 'FALSE';
}
else{
    //echo $_SESSION['user_id'];
    $user->username = strip_tags($_REQUEST['UN']);
    $user->password = strip_tags($_REQUEST['PW']);
    $user->company_id = strip_tags($_SESSION['company_id']);

    $employee->username = $report_employee;
    $employee->rpt_customer = $report_customer;
    $employee->signing_report_date = $year.'-'.$mon.'-1';

    //        $cur_user = $user->validate_login();
    //$cur_user = $user->validate_secondary_login();
    //echo "<pre>".  print_r($cur_user,1)."</pre>";
    //if($_SESSION['user_id'] == $user->username && !empty($cur_user)){
            $data_obj_array = json_decode($_REQUEST['consolidated']);
            $string_data = $smarty->translate['bank_id_display_head']. " ".$smarty->translate[$month[$mon-1]['month']]."-". $year."\n";
            $string_data .= $smarty->translate['bank_id_total_working'].$total_working."\n";
            $string_data .= $smarty->translate['bank_id_total_leave'].$total_leave."\n";
            
            //                $uuid = $obj_general->generate_custom_uuid($year, $mon, $report_customer, $report_employee, 1);
            $data_set_to_send = $dona->make_fk_export_xml($year, $mon, $report_customer, $report_employee);
            $doc = new DOMDocument();
            $doc->loadXML($data_set_to_send['xml']);
    
            //                $string_non_visible = "91eb5e00-abcd-2016-0002-69fada001111,d0e0b2aff0c6303ecb869059ccfa5b9d029cdfcbdc7de29a3bf8d5583889b336";
            $string_non_visible = $data_set_to_send['uuid'].','.hash('sha256', $doc->C14N());
            
            $string_data = base64_encode($string_data);
            $string_non_visible = base64_encode($string_non_visible);
            //echo "<pre>".  print_r($_SERVER,1)."</pre>";
            //echo $_SERVER['HTTP_REFERER'];
            //$url_send ="https://api.diglias.com/rp-sapi-auth/v1.1/rest/signRP/time2view";
              //$url_send ="https://test.diglias.com/doc-rp/sapi/resource_RestSigningsRP#GET";
            //$url_send ="https://time2view.se/cirrus-r/testshaju.php";
            $url_send = $bank_id['url'];
                        
            $data = array(
                        "toBeSigned" =>
                        array(
                            "data" => $string_data,
                            "hiddenData" => $string_non_visible
                        )
                    );
            $str_data = json_encode($data);

            $headers =  sendPostData($url_send, $str_data);

            //echo "<pre>".  print_r($headers,1)."</pre>";
            if($headers[1]['X-Diglias-Location']){
              //http://192.168.0.234/works/app/t2v/cirrus-r/report/work/employee/detail/2016/9/diks001/ipix001/
                //$_SESSION['url_back_back'] = $_SERVER['HTTP_REFERER'];
                $_SESSION['url_back_back'] = 'app/'.$year.'/'.$mon.'/'.$employee->username.'/'.$employee->rpt_customer.'/';
                
                echo '<script>window.location.href="'.$headers[1]['X-Diglias-Location'].'&sign_returnurl='.$smarty->url.'api/api_sign_back_url.php"</script>';
            }
            else{
                $signing_message =  $smarty->translate['can_not_connect_to_bank_id'];
            }
        

    // }else{
    //     $signing_message = $smarty->translate['invalid_username_or_password'];
    //     $transaction_flag = 'FALSE';
    // }
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
  //curl_setopt($ch, CURLOPT_USERPWD, "time2view:dtNi2Yv67Wf7R2mDXJvZCg==");
  curl_setopt($ch, CURLOPT_USERPWD, $bank_id['userpaswd']);//test server
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