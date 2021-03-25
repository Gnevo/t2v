<?php
require_once '../../src/Google_Client.php';
require_once '../../src/contrib/Google_CalendarService.php';

session_start();

$client = new Google_Client();
$client->setApplicationName("Google Calendar PHP Starter Application");

$client->setClientId('361312406079.apps.googleusercontent.com');
$client->setClientSecret('RO81JNNksvw6LHn8kdTrgFiO');
$client->setRedirectUri('https://www.time2view.se/cirrus-demo/simple.php');
$client->setDeveloperKey('AIzaSyBazvM3N82St5YLKpjMlT55hBUeAIZS-48');



 $service = new Google_CalendarService($client);
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
echo "1";
if ($client->getAccessToken()) {
    echo "2";
  //$calList = $cal->calendarList->listCalendarList();
  //print "<h1>Calendar List</h1><pre>" . print_r($calList, true) . "</pre>";
    $events = $service->events->listEvents('primary');
print "<h1>Calendar List</h1><pre>" . print_r($events, true) . "</pre>";
while(true) {
  foreach ($events->getItems() as $event) {
    echo $event->getSummary();
  }
  $pageToken = $events->getNextPageToken();
  if ($pageToken) {
    $optParams = array('pageToken' => $pageToken);
    $events = $service->events->listEvents('primary', $optParams);
  } else {
    break;
  }
}

$_SESSION['token'] = $client->getAccessToken();
} else {
  $authUrl = $client->createAuthUrl();
  print "<a class='login' href='$authUrl'>Connect Me!</a>";
}
?>