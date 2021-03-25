<?php
session_start();
//require_once "google-api-php-client/src/apiClient.php";
//require_once "google-api-php-client/src/contrib/apiCalendarService.php";
require_once 'google-api-php-client/src/Google_Client.php';
require_once 'google-api-php-client/src/contrib/Google_CalendarService.php';


$client = new Google_Client();
$client->setApplicationName("Google Calendar PHP Starter Application");

 
//$client->setClientId('652323924032.apps.googleusercontent.com');
//$client->setClientSecret('5wg0tyFONd5MEiiP7i8i-Ul8');
//
//$client->setRedirectUri('https://www.ucm.es/system/libs/google/google-api-php-client/src/auth/Google_OAuth2.php');
//$client->setDeveloperKey('AI39si4z7x9seyZlePUH7zk0Il-U71rihOkXyM1to18ea_G2xzmm7SMvtGzol4FeiQuDqDX_7mMIDpm8SHbzvi9cHZCW78wSwA');

$client->setClientId('361312406079.apps.googleusercontent.com');
$client->setClientSecret('RO81JNNksvw6LHn8kdTrgFiO');
//$client->setRedirectUri('https://www.time2view.se/cirrus-demo/index.php');
$client->setRedirectUri('http://192.168.0.234/works/app/t2v/cirrus/testing_page.php');
$client->setDeveloperKey('AIzaSyBazvM3N82St5YLKpjMlT55hBUeAIZS-48');



 $cal = new Google_CalendarService($client);
if (isset($_GET['logout'])) {
  unset($_SESSION['token']);
}

if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['token'] = $client->getAccessToken();
  header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
}

if (isset($_SESSION['token'])) {
  $client->setAccessToken($_SESSION['token']);
}

if ($client->getAccessToken()) {
  $calList = $cal->calendarList->listCalendarList();
  print "<h1>Calendar List</h1><pre>" . print_r($calList, true) . "</pre>";

$_SESSION['token'] = $client->getAccessToken();
} else {
  $authUrl = $client->createAuthUrl();
  print "<a class='login' href='$authUrl'>Connect Me!</a>";
}
    
    

//session_start();
//
//require_once "google-api-php-client/src/apiClient.php";
//require_once "google-api-php-client/src/contrib/apiCalendarService.php";
//
//$apiClient = new apiClient();
//$apiClient->setUseObjects(true);
//$service = new apiCalendarService($apiClient);
//
//if (isset($_SESSION['oauth_access_token'])) {
//  $apiClient->setAccessToken($_SESSION['oauth_access_token']);
//} else {
//  $token = $apiClient->authenticate();
//  $_SESSION['oauth_access_token'] = $token;
//}
//
//$events = $service->events->listEvents('primary');
//
//while(true) {
//  foreach ($events->getItems() as $event) {
//    echo $event->getSummary();
//  }
//  $pageToken = $events->getNextPageToken();
//  if ($pageToken) {
//    $optParams = array('pageToken' => $pageToken);
//    $events = $service->events->listEvents('primary', $optParams);
//  } else {
//    break;
//  }
//}
    
   

?>
