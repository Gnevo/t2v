<?php
//ob_start();
require_once('class/setup.php');
require_once('class/user.php');
require_once('class/employee.php');
require_once('class/customer.php');
require_once('class/dona.php');
require_once('plugins/message.class.php');
require_once('configs/config.inc.php');
$smarty = new smartySetup(array('messages.xml',"reports.xml","button.xml"), FALSE);
$user = new user();
$employee = new employee();
$customer = new customer();
$msg = new message();
$url_back = '';

global $bank_id;

//print_r($_SESSION);exit();

//$_SESSION['url_back_back'] = 'https://cirrus-r.time2view.se/customer/add/anel004/';
$debug = TRUE; 
if($_SESSION['url_back_back']){
    $url_back = $_SESSION['url_back_back'];
    $url_array = explode("/", $url_back); 
    //$_SESSION['url_back_back'] = '';
    //unset($_SESSION['url_back_back']);
    //echo "<pre>".print_r($url_array, 1)."</pre>";
    $month  = date('m');
    $year   = date('Y');
    //$report_employee = $url_array[count($url_array)-3];
    $report_customer = $url_array[count($url_array)-2];
    //cho $report_customer;exit();
    //$mod = $url_array[count($url_array)-6];
    //1$report_employee = $_SESSION['username'];
    //unset($_SESSION['username']);
    $signing_message = '';
    $transaction_flag = 'TRUE';



    //2$employee->username = $report_employee;
    $employee->rpt_customer = $report_customer;
    $employee->signing_report_date = $year.'-'.$month.'-1';
    //echo $report_customer;exit();

    $transaction_id = $_REQUEST['txid'];
    //$transaction_id="918e022998c66c54";
    //$url = "https://api.diglias.com/rp-sapi-auth/v1.1/rest/signRP/time2view/".$transaction_id;
    $url = $bank_id['url']."/".$transaction_id;
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    $output = curl_exec($ch); 
    curl_close($ch);
    $sign_array = json_decode($output);
    //echo "with session<pre>".print_r($sign_array,1)."</pre>";
    
/*    $sign_array = (object)array(
   'id' => '1a0af4820d1f9932',
   'toBeSigned' => (object)array(
     'data' => 'SSBjZXJ0aWZ5IHRvZGF5IDIwMjEtMDEtMjggYXQ6IDA4OjIxIHRoYXQgdGhlIGluZm9ybWF0aW9uIGFib3V0IHBlcnNvbmFsIGFzc2lzdGFudCBmb3IgQ2FtaWxsYSBKb2hhbnNzb24gYW5kIDg3MDYwOS03MTYyIGFyZSBjb3JyZWN0',
     'charset' => 'UTF8',
  ),
   'preferences' => (object)array(
     'signMethod' => NULL,
     'userid' => NULL,
  ),
   'signInfo' => (object)array(
     'startTime' => 1611822359837,
     'application' => 'time2view',
     'userData' => (object)array(
       'userId' => '197112122929',
       'signMethod' => 'bankid-otherunit',
       'userCertificate' => NULL,
       'userAttributes' => (object)array(
         'givenname' => 'Ann-Christine',
         'surname' => 'Ulander',
      ),
    ),
  ),
   'signResult' => (object)array(
     'status' => 'SUCCESS',
     'code' => 0,
     'message' => NULL,
     'ocspResponse' => 'MIIHggoBAKCCB3swggd3BgkrBgEFBQcwAQEEggdoMIIHZDCCATChgYgwgYUxCzAJBgNVBAYTAlNFMR0wGwYDVQQKDBRUZXN0YmFuayBBIEFCIChwdWJsKTEVMBMGA1UEBRMMMTExMTExMTExMTExMUAwPgYDVQQDDDdUZXN0YmFuayBBIEN1c3RvbWVyIENBMyB2MSBmb3IgQmFua0lEIFRlc3QgT0NTUCBTaWduaW5nGA8yMDIxMDEyODA4MjMwMFowXDBaMEEwCQYFKw4DAhoFAAQUAv8YE7kGUAat76CEc6cK1kIKTd0EFFKSDiFu6iKl2pXHN+eKTPrzEK77AghFLWzjbZC9P4AAGA8yMDIxMDEyODA4MjMwMFqhAjAAoTQwMjAwBgkrBgEFBQcwAQIBAf8EIGm6Y+QWW8vcuo2h5z+QpfHNOGnS5SLXHZS+bs5wGM/OMA0GCSqGSIb3DQEBBQUAA4IBAQAAHiimoLBf1DOoeoDvXd7zyMVev7WeeVxgTXvB9NdFW18J5y271B8hRRxUUrdGBm1leQn8qjB4aMqWAdBK5tnYCqm72XXs+qJbI8fDBjxy25VPHeXDTOfitKJb9xYbslp71c865Z01ND8vlEJkLtBz7DDaGOXPc9F6AgzMe0+8+ROgYxb0oPnzEGrGi4tj73cIZLa8tsWe4UKMVX7nL9qSMnMWi4Q0soOXR/Xe6qEtfwp3OoklC0ZtwrRxA7ofgVdP+cpvJtjRUQY0if4oi7H2pQDA2yglva52UZf4ypxWa/mvq2VP65nH61J45BHAm7hlgXLn2rfM0xD4BGDJiKqIoIIFGDCCBRQwggUQMIIC+KADAgECAghq7vCILD9w6TANBgkqhkiG9w0BAQsFADB4MQswCQYDVQQGEwJTRTEdMBsGA1UECgwUVGVzdGJhbmsgQSBBQiAocHVibCkxFTATBgNVBAUTDDExMTExMTExMTExMTEzMDEGA1UEAwwqVGVzdGJhbmsgQSBDdXN0b21lciBDQTMgdjEgZm9yIEJhbmtJRCBUZXN0MB4XDTIwMDkyODIyMDAwMFoXDTIxMDMyOTIxNTk1OVowgYUxCzAJBgNVBAYTAlNFMR0wGwYDVQQKDBRUZXN0YmFuayBBIEFCIChwdWJsKTEVMBMGA1UEBRMMMTExMTExMTExMTExMUAwPgYDVQQDDDdUZXN0YmFuayBBIEN1c3RvbWVyIENBMyB2MSBmb3IgQmFua0lEIFRlc3QgT0NTUCBTaWduaW5nMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAs+f1QgMxBsIKBV7j7lSQz2ABq9N/HU2pOy21dGALixjsbXbdtyA5ERcgfbFubrtZTS02KdMcd3ABQBzmQk6oFi/yw8+SPpEE/YVBe5vG6OJLXiWrK/hMXcrKVtI9ZKiH4Ag8WtX24oUg2i1PNVc9qeN1EYwJOzSt7YirApAk4gUytUlMCvdyBafuRUpLc2xQ+xjXPux18thn9SwjOUb4+buzYCOkf3SFsvn9qDxN7iWufRhAdIJKS69Ch1RqOtKn7IYaQ36pTT9T1sLtIbUQlU21MieB69iPpsBygyS1gkeSjC/uoYdFfnbEXlfZgGnkzDswLG8vacLyjTr4zI49jwIDAQABo4GPMIGMMBEGA1UdIAQKMAgwBgYEKgMEBTAWBgNVHSUBAf8EDDAKBggrBgEFBQcDCTAOBgNVHQ8BAf8EBAMCBkAwDwYJKwYBBQUHMAEFBAIFADAfBgNVHSMEGDAWgBRSkg4hbuoipdqVxzfnikz68xCu+zAdBgNVHQ4EFgQUNeOHg0nDcoL14mN5akrbErzOu2gwDQYJKoZIhvcNAQELBQADggIBAEw1LAwBC32iMzWCmRupB5m6ih9LZTPSUvWuhLJjLpSWO0zIBNun9qzgGi3FHn5vvVDjn6IYZW/5WwyHJx97ZOpSAKWXP35xI36nLaLuuZ2Bn7jLN/E/Yxeixt6XJFmq0/wunVku6jer6ZV4tBe1D6vr5tFJntSw8bL0LQKwaK0sRm1bXvXJm2bLqmiJUQD9OjxnaYYq218eBxBOeWJf0SHm9+hGKSgWkhYH2Gle5Q9oGvtgqOuoaW4TVPmkT+ZAcGrSuN6Uc3sjwglp3UCnPr6sFNSSS7fMTUS2DHsOtoafkB5z8xJeGl4u9K2IJjmH7xLRB+LGl9lkqeGgea4oofzoTj4hqkp9x1IZiQErhwclk0QZVvi9VWdqWs0XB451LyKZ2vraK59b0nIpYc9qiThRnm6s31gKHQ9elmWDTfMrfvnG429S/3yei7o/RgoFZqRTBlTz1MNZKxlKPtyLuB9f91XJ+1tilojk6O2/rG6+3h3+YtKxVlp8+1HJrhxWEq1nr8LkL06B1ubDHZRPhJ8q6FQv9IGaitlBXA2dxjvPN59LSiUfuq0G/W6hzu1/oQjAniYq8ABkEwGQ5agRlutCQ94dH4se/r3GBH7xJyT8nBQRknFLILGOkZF3MAoawBn1ziqc45pJdyWzAeJf5IJGWT9w/HHE3ZQOr1Xr/+aT',
     'signature' => 'PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+PFNpZ25hdHVyZSB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC8wOS94bWxkc2lnIyI+PFNpZ25lZEluZm8geG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvMDkveG1sZHNpZyMiPjxDYW5vbmljYWxpemF0aW9uTWV0aG9kIEFsZ29yaXRobT0iaHR0cDovL3d3dy53My5vcmcvVFIvMjAwMS9SRUMteG1sLWMxNG4tMjAwMTAzMTUiPjwvQ2Fub25pY2FsaXphdGlvbk1ldGhvZD48U2lnbmF0dXJlTWV0aG9kIEFsZ29yaXRobT0iaHR0cDovL3d3dy53My5vcmcvMjAwMS8wNC94bWxkc2lnLW1vcmUjcnNhLXNoYTI1NiI+PC9TaWduYXR1cmVNZXRob2Q+PFJlZmVyZW5jZSBUeXBlPSJodHRwOi8vd3d3LmJhbmtpZC5jb20vc2lnbmF0dXJlL3YxLjAuMC90eXBlcyIgVVJJPSIjYmlkU2lnbmVkRGF0YSI+PFRyYW5zZm9ybXM+PFRyYW5zZm9ybSBBbGdvcml0aG09Imh0dHA6Ly93d3cudzMub3JnL1RSLzIwMDEvUkVDLXhtbC1jMTRuLTIwMDEwMzE1Ij48L1RyYW5zZm9ybT48L1RyYW5zZm9ybXM+PERpZ2VzdE1ldGhvZCBBbGdvcml0aG09Imh0dHA6Ly93d3cudzMub3JnLzIwMDEvMDQveG1sZW5jI3NoYTI1NiI+PC9EaWdlc3RNZXRob2Q+PERpZ2VzdFZhbHVlPjloaUhlWWpKZjRNZEwvRHVLbTNKY1g0RkVOL3RydEJwd1hUSFlDRW9IM009PC9EaWdlc3RWYWx1ZT48L1JlZmVyZW5jZT48UmVmZXJlbmNlIFVSST0iI2JpZEtleUluZm8iPjxUcmFuc2Zvcm1zPjxUcmFuc2Zvcm0gQWxnb3JpdGhtPSJodHRwOi8vd3d3LnczLm9yZy9UUi8yMDAxL1JFQy14bWwtYzE0bi0yMDAxMDMxNSI+PC9UcmFuc2Zvcm0+PC9UcmFuc2Zvcm1zPjxEaWdlc3RNZXRob2QgQWxnb3JpdGhtPSJodHRwOi8vd3d3LnczLm9yZy8yMDAxLzA0L3htbGVuYyNzaGEyNTYiPjwvRGlnZXN0TWV0aG9kPjxEaWdlc3RWYWx1ZT5aKzVGVWNPaVVoU2Q3SFkxK2tvcm9sWVhYNGlzZDJFWTVEeElWYWI3Y293PTwvRGlnZXN0VmFsdWU+PC9SZWZlcmVuY2U+PC9TaWduZWRJbmZvPjxTaWduYXR1cmVWYWx1ZT5jc2FTQmpOUjR1NitQR2x1cXBKaG1ZWXlVeTcrUTlqQm9UWVRxdjdtOEtrN0FMQ0N6WXRvTzJDL2wxK0pTajBtS2NDV0xRM0lLM1BYTEpRaTFvREVwa2w3cFdSZE5sVTNHaE5oenpqK2VHQ1hPZlFnS3JEc1NLRFNKNjhHSGdtWi96bW5abE9JWkZFY1FJK0hLZVlkTlRLbVNIYmVFZHRuUnF5aE4vblBGUldiV3dBcWMzbndQckJqd1UwM1RXY0M3MnVBdGYvdE9wNHoyZnpoaFhtZ2UvbklIRm5NSVpyam8xMjY5WE1zRVBEaEU2UVZabm83RXY4QWN1T0ZkSS9TdEYxN1VST2ZyeDVCcVJRcDVRQ1ZPTmhzZ3JnS1dLM0lKS1ZiN0hsTW9QdFJvbXluNGJaOW92MExqSGNCT3NNOGFvdGNIV2lPZkJnemdpWG4xRnJhR2c9PTwvU2lnbmF0dXJlVmFsdWU+PEtleUluZm8geG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvMDkveG1sZHNpZyMiIElkPSJiaWRLZXlJbmZvIj48WDUwOURhdGE+PFg1MDlDZXJ0aWZpY2F0ZT5NSUlGYXpDQ0ExT2dBd0lCQWdJSVJTMXM0MjJRdlQ4d0RRWUpLb1pJaHZjTkFRRUxCUUF3ZURFTE1Ba0dBMVVFQmhNQ1UwVXhIVEFiQmdOVkJBb01GRlJsYzNSaVlXNXJJRUVnUVVJZ0tIQjFZbXdwTVJVd0V3WURWUVFGRXd3eE1URXhNVEV4TVRFeE1URXhNekF4QmdOVkJBTU1LbFJsYzNSaVlXNXJJRUVnUTNWemRHOXRaWElnUTBFeklIWXhJR1p2Y2lCQ1lXNXJTVVFnVkdWemREQWVGdzB5TURBNU1UWXlNakF3TURCYUZ3MHlNakE1TVRjeU1UVTVOVGxhTUlITU1Rc3dDUVlEVlFRR0V3SlRSVEVkTUJzR0ExVUVDZ3dVVkdWemRHSmhibXNnUVNCQlFpQW9jSFZpYkNreEVEQU9CZ05WQkFRTUIxVnNZVzVrWlhJeEZqQVVCZ05WQkNvTURVRnViaTFEYUhKcGMzUnBibVV4RlRBVEJnTlZCQVVURERFNU56RXhNakV5TWpreU9URTlNRHNHQTFVRUtRdzBLREl3TURreE55QXhNeTR4TXlrZ1FXNXVMVU5vY21semRHbHVaU0JWYkdGdVpHVnlJQzBnVFc5aWFXeDBJRUpoYm10SlJERWVNQndHQTFVRUF3d1ZRVzV1TFVOb2NtbHpkR2x1WlNCVmJHRnVaR1Z5TUlJQklqQU5CZ2txaGtpRzl3MEJBUUVGQUFPQ0FROEFNSUlCQ2dLQ0FRRUF4cFpGNFFxclBPSCs1b0JrUUIwdFExT0l6U3FVdDE0S1c2dG82R3k3RTdHWnptM0JSOEZPbGRTcmNrYndHTk5HVzhrSHNFOWtDM0RhOXV4S2lPQkoraHpZT29KbndWVGJXMGg0dE1wYzFyRzBXK1orZ2R5cVI4dFJtQiszdnVkN0NaTE1lbE1jUkdaS3liL095Qy9JRE40d0ZlczRNSmYzNHhYUTNEd2lGbE82dlJQaHA2MElsdEZGTGwyQXBKQlFWRm9YbjVpRjlINk1lWlJDTjhLVXpuSGRBeDBKcmp6WWVob2twU2J5dkJxMGxnY0RtUm5DTFYveEl3STJZZlhYMFhKLzFWQTVSa3RJazNjL3ZIWFpYTVFKaTRwbmlQTC9iRkdBcFhMeUtFZS94RUtPTEgxMkFCdXlWdE1JUTM4N1kyd3JzQXZQZWRQeGlOdXhucE1KdlFJREFRQUJvNEdqTUlHZ01Ec0dDQ3NHQVFVRkJ3RUJCQzh3TFRBckJnZ3JCZ0VGQlFjd0FZWWZhSFIwY0RvdkwzUmxjM1F1Y21WMmIyTmhkR2x2Ym5OMFlYUjFjeTV6WlRBUkJnTlZIU0FFQ2pBSU1BWUdCQ29EQkJrd0RnWURWUjBQQVFIL0JBUURBZ1pBTUI4R0ExVWRJd1FZTUJhQUZGS1NEaUZ1NmlLbDJwWEhOK2VLVFByekVLNzdNQjBHQTFVZERnUVdCQlIyN01NUU9QTTNRUkRxaGFTa2Fnazd0UDQyK2pBTkJna3Foa2lHOXcwQkFRc0ZBQU9DQWdFQUJQRnRwSEs3M3AxV2lYMzVzdi9wMHQvTkd4SnhCMCswZ2hpWHVaYzE3RkZrRmwzbE1icGFvV0JQNFRnbWlxdk1LUmpIajVPUmhoVUtZbWpRa3lIY2pmWlB3by9BRG5SdXFQTGluUklEaGdxTDBlY2xQV2MwQlAybUdhVk5XR3RqemhwUG4wUW9zK2N3SG03aDhlUDlJdFU1b0FWWnV3eUk1M05UbHJUT0Q5eFd5R203R3JVelVIVGIyWGQ3Zkt0M2JCZ3hyY2N2ZXNyTjdEcC9CL0pLZFZuUlUzSzNzcTRHaDYrSzZiS3BZK1lUZEIwSXp0VGNWS200dW5NNnBOczZxK25zWVV5ZEVrbm9xSk9jT2ZDMTVoL2dTZmhPTDVScU8wQ1A4UHh3Q1hldGNIUFp1cGNEV21wRktUUHNsUm5SYVpLV01lbmZtdDhuUG5CT0xvNXFMMldGU2NSRG5uZlJJeE9XL3d3aEsxamtQMjgvWi9qT0owTVM4dHhkN29KeTM3T0FyMTdnZ2lyME1YOE03RlgxZXJDVjdmQng2RmF4d2xSNzcyU3NoSm5RZ3QyOG9nTUdIOTUzOVZIUlJRQW1kanMzZWUyWnJmM2VyTlNVMU9VNmFaem5uWkZOWG51dnBHOUdFbFpRN0YzOWx6VllPdXltOVRiUmdqS1hyUGQ2S0tqU1RKczdvZlpPcUNSZDdrQm9BSCsxRHREck5ZT2V1Wnp0NnR5Z0cva3R0M1k5YlBmeittWm5qYkJuamx3OUs1RUZxZ2dMZFVyK1BkWnp4WTZEUVhJcWhkL0ozclVCRXVQS0xoOFFnVlM0d2ZUWC9jQTJaK3h3SDFhQm9zcVhDK05hNnM1YSt0THMwaEZEY3I1ZERoUjRVd0NRL1pjRE9lbmJZRWU1SXp3PTwvWDUwOUNlcnRpZmljYXRlPjxYNTA5Q2VydGlmaWNhdGU+TUlJRjNqQ0NBOGFnQXdJQkFnSUlEbkI0MkdVbEd2RXdEUVlKS29aSWh2Y05BUUVOQlFBd2JqRUxNQWtHQTFVRUJoTUNVMFV4SFRBYkJnTlZCQW9NRkZSbGMzUmlZVzVySUVFZ1FVSWdLSEIxWW13cE1SVXdFd1lEVlFRRkV3d3hNVEV4TVRFeE1URXhNVEV4S1RBbkJnTlZCQU1NSUZSbGMzUmlZVzVySUVFZ1EwRWdkakVnWm05eUlFSmhibXRKUkNCVVpYTjBNQjRYRFRFeE1Ea3lNakUwTXpNeU0xb1hEVE0wTVRJd01URTBNek15TTFvd2VERUxNQWtHQTFVRUJoTUNVMFV4SFRBYkJnTlZCQW9NRkZSbGMzUmlZVzVySUVFZ1FVSWdLSEIxWW13cE1SVXdFd1lEVlFRRkV3d3hNVEV4TVRFeE1URXhNVEV4TXpBeEJnTlZCQU1NS2xSbGMzUmlZVzVySUVFZ1EzVnpkRzl0WlhJZ1EwRXpJSFl4SUdadmNpQkNZVzVyU1VRZ1ZHVnpkRENDQWlJd0RRWUpLb1pJaHZjTkFRRUJCUUFEZ2dJUEFEQ0NBZ29DZ2dJQkFKbzAzS01KMS9meDk0T3NPYm9PeE1CcW43cGdqY3B2dFI3WEZkM0hjdzh6M0ZHZWFSNUVyc1lLaEx5MHB5QlRqMTU4dHM2ck8rLzBWMm9Od1VEdmY2aDBaQ3VwYmVQWExiZTlnNENwNm55QWx6OHNEV1lkb2hMV21aV2RmdDRCS2VMbDgxRWMyRVpoY1NoM0wxcm0vOEh1VzE5V1lveDZVcGU2TzZqeDVQOFUyTUE5VUN6MXlkMXFma1luZUdVd2hMNkwrZDdvQ3d4Uk5MbTJOZzNwT29jV1lpbXoxS3NvT2l4Ulc1QzJYcWpSV3VVYWw4YWh4dHArL25sOUNxcE1tSjRYOTh1SWR0SDhQT1hqbzBxYXREbVFhNkRBSGhFQTFYbzB1UUxzaURWS1dhS1o0cm1QM05vM09KYkxpV0RjL0F5V1I5VnZqQWQ3bU9QK2dTYkRTYlQrRWFnQ20yVmF3VjNmQUNGTldPaXVaOUNDOGgxa3Y5SEJyWThnOHN0TEEybFU3M05qcUtXU2VPYzhuUnV6RVNQUlM2aEM2SjEzYWJCdDkyd2xQWHBRN01CUXlVaVlPbFZ5OGZra01nWWFGYUdSY0pPTFFYMElINTFQUGRvY3FudVR3cWRNOU14M2VkOWI0V0h2eTZFT0tleHhxL04rT0JCL21iVll0MTh3K3A3SlppZUxrRWROc1FxZUVDVWxMOGxmNjlvN2ZwZ2QyZ3JMaTYyS1BlU0VmUjIrSVZNSHhRTitVcEhpakUwVlBZWWNDWTlsbVVkRVZzeGtzd01OQzd5RklwNEozdFhqdzk0Mi82NW55alJheW1YZHNiOWlhL0JkUGlnbTN3OWFyY2g0UlA4S0pKRjZ1eldNNHJqcGtsaHAxNEc5Y3lLVGQyY1RETE5ycVlueEFnTUJBQUdqZGpCME1CMEdBMVVkRGdRV0JCUlNrZzRoYnVvaXBkcVZ4emZuaWt6Njh4Q3UrekFQQmdOVkhSTUJBZjhFQlRBREFRSC9NQjhHQTFVZEl3UVlNQmFBRktQeWVIa2RLMFdLeWVIS2xRbmxubS9PeTA3Rk1CRUdBMVVkSUFRS01BZ3dCZ1lFS2dNRUdUQU9CZ05WSFE4QkFmOEVCQU1DQVFZd0RRWUpLb1pJaHZjTkFRRU5CUUFEZ2dJQkFESEhVUGtuTGtWVnlEV3dONC90bXNkcDdWazBLaitNRjRqYy91MnNVRVpiSFJqbW1rSU9xUFI2bDlBcFBwQ1JhV3V1dlpGdGJDdXBlNVh2a0NuL1FFREtGSkxjdG1WOFFlSVk1dlZzQjRsOW9LbE0rbHp6b3VwWEliY1hmN0ZVdHZOV1E2Z3A0eTRicGVuYzRoNWpKNGJQOXVveFZ2Q3JqSkJwQU5ITWU0ekxhYjBZS3BOU2FZcGpmWTgxSHVycVl2c2xWSkhxZmUwbFdMMWlIbzNyd1d3TzUrL2lmUEE0Z0w2dGhTSERGcTNzbGs4VFlORGRhNkRGcjZsTTE5cDBuMVAxeUdpSHcybmZoOFlCWGo1Z0J1dEFqSUl5NzB3N1M2ODRpenNLL1l5QlUwaGxxaWhsZXdWYVpYMkVFY1NkMHFlZDRJOEd5TmtpYzVPbExUcnE3NkJ1RWk1TlNhUjRXdHRCOVZKSW1TZGZiVTIrNFpNeXU1SW9mYlYreFljR1g4T0xpQTQ2MjkxRGdsOGxYVVlxOWFBeGZiNkc1WHhXNkNEODMxWk9Fcyt2b3NWZ3Q1TEIxdk9GdFFxUjhxOWZkcGM1b0kvVnZISkhya1VmNEZCakJ3OWNWTElrQ2E0K2svV2ErUEdWTWF4ekJsaEd1Rjdudk9KS3F6MGtFMkVyWTRJWE1tTTNnOUxHRFBIc3pwa25hWEVldG9Rdk45TnJTdU1wUk9SQ1dVN2dTaWQzYzdYenZZMG5OQmx3NSs0WFhhalVSbC8wY0NyRG9EVVc4NSszRUU5ZnduYVp6eGRrNk1zd05VNkRVVk51dWdwM1ptdFBnUHRCMGI4V3FhbngzaDkraTZ1UTA0Q1ZIVmV5anNRbUNncHhzbDFOWWNLdlA3S0ZzOVJNZENIRjwvWDUwOUNlcnRpZmljYXRlPjxYNTA5Q2VydGlmaWNhdGU+TUlJRjB6Q0NBN3VnQXdJQkFnSUlVWW1mZHRxdHk4MHdEUVlKS29aSWh2Y05BUUVOQlFBd2JURWtNQ0lHQTFVRUNnd2JSbWx1WVc1emFXVnNiQ0JKUkMxVVpXdHVhV3NnUWtsRUlFRkNNUjh3SFFZRFZRUUxEQlpDWVc1clNVUWdUV1Z0WW1WeUlFSmhibXR6SUVOQk1TUXdJZ1lEVlFRRERCdFVaWE4wSUVKaGJtdEpSQ0JTYjI5MElFTkJJSFl4SUZSbGMzUXdIaGNOTVRFd09USXlNVFF4TlRBeldoY05NelF4TWpNeE1UUXdNVE16V2pCdU1Rc3dDUVlEVlFRR0V3SlRSVEVkTUJzR0ExVUVDZ3dVVkdWemRHSmhibXNnUVNCQlFpQW9jSFZpYkNreEZUQVRCZ05WQkFVVERERXhNVEV4TVRFeE1URXhNVEVwTUNjR0ExVUVBd3dnVkdWemRHSmhibXNnUVNCRFFTQjJNU0JtYjNJZ1FtRnVhMGxFSUZSbGMzUXdnZ0lpTUEwR0NTcUdTSWIzRFFFQkFRVUFBNElDRHdBd2dnSUtBb0lDQVFDVHFVN3V4azVRemJYUzZBclhJR1RXTmVaWHo2NWJ6ZGdveGI3OUx2WWgvcDdrY0syNW1BMnR6R3BPM1FTMWVLSkp1ODRHOVVOem00bU1sNmNuZ25YY2p4RVRZaUVxdGlqckE1bWZ6ODY1L1g2VWdPcFg3RGtvdVE4ZDVlRHloSjQ5VXJEcWxyZ29WTXgzMjJrTTBTWjRoZVZlWDgzZTFJU0ZpeXhxWkJLeGgyNXlLWUVaQTRFeklyRGoydGk4Q1JyV1BIQ1RXYUlGcGNkNVR5TWhwVVRQbjREendQaFBHV01STnhnT0FlUDRCU0RCN1I2YXo0cm94N1RQa2Qyc1dHMU9Eai8wSVJQaEpTMWRRMUI3UWlOSFk1OFJqbk5UaEVRS3dkV1dNUE1LUHRoU2QrR0VqTDlHRGFmWXhPc0lyS0ZZd2xZTkJXM0M1bWJlM1QrM2orQXhqNlcySGJnbUpYUEdJdEx1Y3hZMWtQd1Q5TDd1NW5JeGFST21oMXVUd1lxcjlwdUdxNnNvSm5nZ0VTM0s0UEloTTZrYW12bkNDUFhvcVdDQ3J1U0VQVmd5RVpFaTBzaHkrODFRc2ViMWdjOXJZZ1ZyRW5MQk9JeU1xYVR0RXhhRnByWWJ2MWYvQXdXdGpGVWkyWGlTZE44YU1wK2txYmkrMXRLSlVVUExDK0NyZHU5ZkZvLzhsc2xTZGV3K1NuUFZGZVZ6NUNPS2J0NkdURTR4Y0plUnpXNXdRMHc3YityR0xXaEp2d1JKc1M1R1h2cWEzTGc4RXlXaUxKc3d1VEZhRXdQVUR2WkJ2eUZaRVplcnRLZ1piUll2ZXpvOS9ncnd5Qittb3JWckxyeXU5Y2hZRVl3RTU1MHV6eUt0elhVenlnVjhGcFhlOURwbXBPU2ZHTUFVUlFJREFRQUJvM1l3ZERBZEJnTlZIUTRFRmdRVW8vSjRlUjByUllySjRjcVZDZVdlYjg3TFRzVXdEd1lEVlIwVEFRSC9CQVV3QXdFQi96QWZCZ05WSFNNRUdEQVdnQlJLOTZOcUNOb0lPQmNaVXlqSTJxYldOTmhhdWpBUkJnTlZIU0FFQ2pBSU1BWUdCQ29EQkFVd0RnWURWUjBQQVFIL0JBUURBZ0VHTUEwR0NTcUdTSWIzRFFFQkRRVUFBNElDQVFEUDFEb3hqRWpleUcyN3hlYWkrbXB4eEpvcUIxUkRWVEVZODZSZE55bHVVS1FPSWJmS0pNbVgrRFg0dlR1VVFTMzUzOXh6SEt3cGo2Z2sraVpWakYxVW9KdEdwK3F1cmpqYXJPaDQ0cysrczB5V0tpS3JKQkVsb0puOG8rWVhGVDhDN2UxV3RxSlZvYUZkREJDdm9oSnlLMjBQS1M3L25VRzViN0o2aXEzNTE3WXZqYjREOTRMdDBkSE5TZ0QyQklJSG1Oa3BTWVdneWkxc2VhdmhONUFqdGZKcjRwMTAxdTJTc05jTEFyNDJBNWZyYW45dkwyOUhqYU0yTVRVOEwwT3hvSVg4bGdjcFV5OXdjaTdsSFFLT2l3YU9jSUtmQ0MxcU03bE81ejBjNFArbzB6VDYxODN4SlYzcm13MjJHR1lkNDBFQnFXOTdvcUJLMElqK0tsNXN1eWNaNEoycUsxYVZjaVlCWnNCTmxidG16L2s4SHVCeHk5V2JFZVBzWS82MUk1MGZCTFNBa1ZrL1RlYTRqK05OSEoxaW1wN0JvMThhTG84cGxiOWUyaVplSUR6SDF1NjZvMFJGWWJIZG5KRDhDblBlQkxWZ1N2RXFtQlMxMWZnSHI4MS90azVsSnhjS2VqZHNFZnR6R1F4d3VIdy9wamtqb2JJa3hycm9YcGE2aVhva1Z5SDRiZTE2K2YvZERhRWtoOVJmOExoMVVFUVB4eHBDeUlTTWlmSDVwTDc4REtoR25oOFZmaTdFZXNVVjFrNlkzZVZDRncyQ0NLV2N2WHNKYjlRcUxGc0RxSWxXUGg2YkJnTTRhWGZwZTBhckRyZ1lSYmJ4OEw2b3VoeXhBSHdqdHo5aTBsWGV6V01YNWY3UVlSRU1UQzV5QlBOVFRQMmZDTnNvelE9PTwvWDUwOUNlcnRpZmljYXRlPjwvWDUwOURhdGE+PC9LZXlJbmZvPjxPYmplY3Q+PGJhbmtJZFNpZ25lZERhdGEgeG1sbnM9Imh0dHA6Ly93d3cuYmFua2lkLmNvbS9zaWduYXR1cmUvdjEuMC4wL3R5cGVzIiBJZD0iYmlkU2lnbmVkRGF0YSI+PHVzclZpc2libGVEYXRhIGNoYXJzZXQ9IlVURi04IiB2aXNpYmxlPSJ3eXNpd3lzIj5TU0JqWlhKMGFXWjVJSFJ2WkdGNUlESXdNakV0TURFdE1qZ2dZWFE2SURBNE9qSXhJSFJvWVhRZ2RHaGxJR2x1Wm05eWJXRjBhVzl1SUdGaWIzVjBJSEJsY25OdmJtRnNJR0Z6YzJsemRHRnVkQ0JtYjNJZ1EyRnRhV3hzWVNCS2IyaGhibk56YjI0Z1lXNWtJRGczTURZd09TMDNNVFl5SUdGeVpTQmpiM0p5WldOMDwvdXNyVmlzaWJsZURhdGE+PHVzck5vblZpc2libGVEYXRhPk56RmhPR1U0TURBdE1EQXlNQzB3TURBd0xUQXdNREF0TnpGaE9UVmxNREF4TURBeExHTmhabUkwWm1aaE5EUm1NR1F3TVdNMk5tTmhaR1EwT1RCalpHRTBPVEl5TkRka1ltTmxNamRsWVRRek9ERXhZek5sTmpjNU5XUmtZV1UwTUdJM01Eaz08L3Vzck5vblZpc2libGVEYXRhPjxzcnZJbmZvPjxuYW1lPlkyNDlSbEFnVkdWemRHTmxjblFnTXl4dVlXMWxQVlJsYzNRZ1lYWWdRbUZ1YTBsRUxITmxjbWxoYkU1MWJXSmxjajAxTlRZMk16QTBPVEk0TEc4OVZHVnpkR0poYm1zZ1FTQkJRaUFvY0hWaWJDa3NZejFUUlE9PTwvbmFtZT48bm9uY2U+L2hSMjlucUZOMzhhUkhNVDhoNk5CQkxNY1h3PTwvbm9uY2U+PGRpc3BsYXlOYW1lPlZHVnpkQ0JoZGlCQ1lXNXJTVVE9PC9kaXNwbGF5TmFtZT48L3NydkluZm8+PGNsaWVudEluZm8+PGZ1bmNJZD5TaWduaW5nPC9mdW5jSWQ+PHZlcnNpb24+Tnk0eU1TNHc8L3ZlcnNpb24+PGVudj48YWk+PHR5cGU+U1U5VDwvdHlwZT48ZGV2aWNlSW5mbz5NVFF1TXc9PTwvZGV2aWNlSW5mbz48dWhpPmdVc2hMU3A2a2hrVDBJMlZHaEtib1NhRVU5WT08L3VoaT48ZnNpYj4wPC9mc2liPjx1dGI+Y3MxPC91dGI+PHJlcXVpcmVtZW50Pjxjb25kaXRpb24+PHR5cGU+Q2VydGlmaWNhdGVQb2xpY2llczwvdHlwZT48dmFsdWU+MS4yLjMuNC4yNTwvdmFsdWU+PC9jb25kaXRpb24+PC9yZXF1aXJlbWVudD48dWF1dGg+cHc8L3VhdXRoPjx0b2tlbj50b2tlbi1ub3QtdXNlZDwvdG9rZW4+PC9haT48L2Vudj48L2NsaWVudEluZm8+PC9iYW5rSWRTaWduZWREYXRhPjwvT2JqZWN0PjwvU2lnbmF0dXJlPg==',
  ),
);*/
    
    //file_put_contents('sign_back_3066.txt', print_r($sign_array, true));

    //echo "<pre>".$sign_array->signInfo->userData->userId."</pre>";exit();
    if($sign_array->signResult->status == 'SUCCESS'){
        //echo "here";
        ///$employee->signauture = $sign_array->signResult->signature;
        $cust_data_set = $customer->customer_detail($report_customer);
        $employee_details = $employee->get_employee_detail($_SESSION['user_id']);
        if($debug || $employee_details['century'] == substr($sign_array->signInfo->userData->userId, 0, 2) && $employee_details['social_security'] == substr($sign_array->signInfo->userData->userId, 2)){
            //$employee->signauture = "PQRST78878787TYTY";

                $obj_dona = new dona();
                $employee->signauture = $sign_array->signResult->signature;
                $employee->ocs = $sign_array->signResult->ocspResponse;
                $employee->userId = $sign_array->signInfo->userData->userId;
                $employee->signing_xml_storage = TRUE;
                
                if(isset($_SESSION['username'])){
                    $employees = explode(',',$_SESSION['username']);
                    //print_r($employees);
                    $i = 1;
                    $sucs = 0;
                    $fail = 0;
                    foreach($employees as $emp){
                        $report_employee = $emp;
                        $emp_data_set = $employee->get_employee_detail($emp);
                        $employee->username = $_SESSION['user_id'];
                        $employee->empname = $report_employee;
                        $data_set_to_send = $obj_dona->make_3066_export_xml($year, $month, $report_customer, $report_employee);
                        $employee->signing_xml = $data_set_to_send['xml'];
                        $employee->transaction_id = $transaction_id;
                        $employee->emp_social_security_number = $emp_data_set['century'].$emp_data_set['social_security'];
                        $employee->cust_social_security_number = $cust_data_set['century'].$cust_data_set['social_security'];
                        if($employee->employee_signing_Transaction_3066()){
                            $sucs++;
                        }else{
                            $fail++;
                        }
                        $i++;
                    }
                    
                    if($fail > 0){
                        $msg->set_message('fail', 'error_occured_in_signing_try_again');
                    }else{
                        $msg->set_message('success', 'signing_done_sucessfully');
                        unset($_SESSION['username']);
                    }
                }
                //3$data_set_to_send = $obj_dona->make_3066_export_xml($year, $month, $report_customer, $report_employee);
                //4$employee->signing_xml = $data_set_to_send['xml'];
                
                /*if($employee->employee_signing_Transaction_3066()){
                    $msg->set_message('success', 'signing_done_sucessfully');
                }else{
                    $msg->set_message('fail', 'error_occured_in_signing_try_again');
    //                $msg->set_message_exact('fail', "<pre>".print_r($employee->query_error_details, 1)."</pre>");
                      //echo "<pre>".print_r($employee->query_error_details, 1)."</pre>";exit();
                    
                }*/
        }else{
            $msg->set_message('fail', 'user_missmatch_at_bank_id');
        }
        
    }else{
        $msg->set_message('fail', 'error_occured_in_signing_try_again');
    //    echo 'error_occured_in_signing_try_again'; exit();
    }
    //echo "<pre>";print_r($msg);
    //$url = "https://api.diglias.com/rp-sapi-auth/v1.1/rest/signRP/time2view/".$transaction_id;
    /*$url = $bank_id['url']."/".$transaction_id;
    //echo "<pre>";print_r($employee);
    //    exit();
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    $result = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);*/
    
    header('Location:'. $url_back);
}else{
    //from employer
    $transaction_id = $_REQUEST['txid'];
    $url = $bank_id['url']."/".$transaction_id;
    //$url = "https://test.diglias.com/rp-sapi-auth/v1.1/rest/signRP/time2view/".$transaction_id;
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    $output = curl_exec($ch); 
    curl_close($ch);
       
            
    $sign_array = json_decode($output);
    //echo "without SESSION<pre>".print_r($sign_array,1)."</pre>";
    file_put_contents('sign_back_3066.txt', print_r($sign_array, true));
    
    if($sign_array->signResult->status == 'SUCCESS'){
        $employee_details = $employee->get_employee_detail($_SESSION['user_id']);
        if($debug || $employee_details['century'] == substr($sign_array->signInfo->userData->userId, 0, 2) && $employee_details['social_security'] == substr($sign_array->signInfo->userData->userId, 2)){
            //$employee->signauture = "PQRST78878787TYTY";
                
                $_SESSION['url_back_back'] = $sign_array->signResult->signature;
                $_SESSION['url_back_back_ocs'] = $sign_array->signResult->ocspResponse;
                //$_SESSION['url_back_back'] = "test ok";
                

        }else{
            $_SESSION['url_back_back'] = 1;
        }

    }else{
        $_SESSION['url_back_back'] = 2;
    }
    
    
    $url = $bank_id['url']."/".$transaction_id;
    //$url = "https://test.diglias.com/rp-sapi-auth/v1.1/rest/signRP/time2view/".$transaction_id;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    $result = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
     
    echo "<script>parent.window.close()</script>";
}

?>

<script>

</script>