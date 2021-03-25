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

$report_employee = trim($_REQUEST['emp']);
$employees = explode(',',$report_employee);

$report_customer = trim($_REQUEST['customer']);
$customer_name = trim($_REQUEST['customer_name']);
$security_no = trim($_REQUEST['security_no']);
$from_page = $_REQUEST['from_page'];
$bank_id_flag = $_REQUEST['bank_id_flag'];
$current_day = date('Y').'-'.date('m').'-'.date('d');
$smarty->assign('now_month', date('m'));
$smarty->assign('now_year', date('Y'));
$smarty->assign('now_day', date('d'));
$hour_min = date('H:i');

$year=date('Y');
$mon=date('m');

$signing_message = '';
$transaction_flag = 'TRUE';

$_SESSION['url_back_back'] = '';
unset($_SESSION['url_back_back']);

//print_r($_SESSION);exit();

$user->company_id = strip_tags($_SESSION['company_id']);
//echo $employee->username;exit();
$employee->rpt_customer = $report_customer;
$employee->report_date = $current_day;
$_SESSION['username'] = $report_employee;
$str_data='';
if($bank_id_flag == 1){
    $data_obj_array = json_decode($_REQUEST['consolidated']);
    
    $i = 1;
    $string_data = '';
    $string_non_visible = [];
    foreach($employees as $emp){
        
        //$employee->username = $report_employee;
        //$_SESSION['emp_detail']['emp'.$i] = $emp;
        $emp_data_set = $employee->get_employee_detail($emp);
        //echo"<pre>";print_r($emp_data_set);exit();
        $em_name = $emp_data_set['first_name']." ".$emp_data_set['last_name'];
        $em_na = $emp_data_set['century'].$emp_data_set['social_security'];
        $em_na = substr_replace($em_na, '-', 8, 0);
        $string_data.= $i.". Jag intygar idag ".$current_day." vid: ".$hour_min." att informationen om personlig assistent för ".$em_name." ".$em_na."  är korrekt.";
        $string_data.="\n\n";
        //$data_set_to_send = $dona->make_3066_export_xml($year, $mon, $report_customer, $report_employee);
        $data_set_to_send = $dona->make_3066_export_xml($year, $mon, $report_customer, $emp);
        
        //echo "<pre>";print_r($data_set_to_send);
        
        //$_SESSION['emp_detail']['xml'.$i] = $data_set_to_send['xml'];
        //$employee->signing_xml = $data_set_to_send;
    
        $doc = new DOMDocument();
        $doc->loadXML($data_set_to_send['xml']);
        //$string_non_visible = $data_set_to_send['uuid'].','.hash('sha256', $doc->C14N());
                
        //$string_data = base64_encode($string_data);
        //$string_non_visible = base64_encode($string_non_visible);
        $string_non_visible_dt = $data_set_to_send['uuid'].','.hash('sha256', $doc->C14N());
        
        //$string_non_visible[] = base64_encode($string_non_visible_dt);
        $string_non_visible[] = $data_set_to_send['uuid'].','.hash('sha256', $doc->C14N());
        $i++;
    }
    //echo "<pre>";print_r($string_data);
    //print_r($string_non_visible);
    $url_send = $bank_id['url']; 
    $hidden_dt = implode(";",$string_non_visible);
    $string_data = base64_encode($string_data);
    $hidden_dt = base64_encode($hidden_dt);
    //echo $hidden_dt;
    $data = array(
                    "toBeSigned" =>
                    array(
                        "data" => $string_data,
                        //"hiddenData" => base64_encode(json_encode($string_non_visible))
                        "hiddenData" => $hidden_dt
                    )
                );
                //print_r($string_data);exit();
    /*$data = array(
                    "toBeSigned" =>
                    array(
                        "userVisibleData" => base64_encode($string_data),
                        //"hiddenData" => base64_encode(json_encode($string_non_visible))
                        "userNonVisibleData" => base64_encode($hidden_dt)
                    )
                );*/
    $str_data = json_encode($data);
    
    //print_r($str_data);exit();
    file_put_contents('sign_3066.txt', $url_send.$str_data);
 
    $headers =  sendPostData($url_send, $str_data);
                
    if($headers[1]['X-Diglias-Location']){
        $_SESSION['url_back_back'] = $_SERVER['HTTP_REFERER'];
        //$_SESSION['username'] = $report_employee;
        echo '<script>window.location.href="'.$headers[1]['X-Diglias-Location'].'&sign_returnurl='.$smarty->url.'sign_back_url_3066.php"</script>';
    }
    else{
        echo $smarty->translate['can_not_connect_to_bank_id'];
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