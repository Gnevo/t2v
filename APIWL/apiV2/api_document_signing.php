<?php
if(isset($_REQUEST['my_session'])){
  session_id($_REQUEST['my_session']);
  session_name('t2v-cirrus');
  session_start('t2v-cirrus');
  $app_dir = dirname(dirname( realpath( __FILE__ ) )) ;
  chdir ($app_dir);
}else{
  require_once('api_common_functions.php');
  $session_check = check_user_session();
}

require_once('configs/config.inc.php');
require_once('class/setup.php');
require_once('class/equipment.php');
require_once('class/employee.php');
$obj_equipment = new equipment();
$obj_employee = new employee();
$smarty        = new smartySetup(array("messages.xml", "button.xml", "month.xml", "common.xml"), FALSE);

global $bank_id;

$string_data = $smarty->translate['document_sign'];
$string_non_visible = $smarty->translate['document_sign'];
//$string_non_visible = "91eb5e00-0010-2016-0001-69fada001002,d0e0b2aff0c6303ecb869059ccfa5b9d029cdfcbdc7de29a3bf8d5583889b336";

$string_data = base64_encode($string_data);
$string_non_visible = base64_encode($string_non_visible);

$url_send = $bank_id['url'];
            
$data = array(
    "toBeSigned" => array(
        "data" => $string_data,
        "hiddenData" => $string_non_visible
    )
);
$str_data = json_encode($data);
//echo '<pre>' . print_r($str_data, 1) . '</pre>';
$headers =  sendPostData($url_send, $str_data);
//echo '<pre>' . print_r($headers, 1) . '</pre>';
//exit();

if($headers[1]['X-Diglias-Location']){
    $_SESSION['url_back_back'] = 'app/';
    echo '<script>window.location.href="'.$headers[1]['X-Diglias-Location'].'&sign_returnurl='.$smarty->url.'apiV2/api_document_sign_back_url.php"</script>';
}
else{
    $signing_message =  $smarty->translate['can_not_connect_to_bank_id'];
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
  curl_close($ch);
  return $headers;
}



function get_headers_from_curl_response($headerContent){
    $headers = array();
    $arrRequests = explode("\r\n\r\n", $headerContent);

  
    for ($index = 0; $index < count($arrRequests) -1; $index++) {

        foreach (explode("\r\n", $arrRequests[$index]) as $i => $line){
            if ($i === 0)
                $headers[$index]['http_code'] = $line;
            else{
                list ($key, $value) = explode(': ', $line);
                $headers[$index][$key] = $value;
            }
        }
    }

    return $headers;
} 


?>