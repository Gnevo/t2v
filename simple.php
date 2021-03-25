<?php
error_reporting(E_ALL);
$app_dir = getcwd();
require_once ($app_dir . '/class/setup.php');
require_once ($app_dir . '/class/equipment.php');
require_once ($app_dir . '/class/employee.php');
require_once ($app_dir . '/class/customer.php');
require_once ($app_dir . '/class/dona.php');
require_once($app_dir . '/configs/config.inc.php');
require_once 'google-api-php-client/src/Google_Client.php';
require_once 'google-api-php-client/src/contrib/Google_CalendarService.php';
//session_start();

$equipment = new equipment();
$employee = new employee();
$customer = new customer();
$dona = new dona();

$client = new Google_Client(array('use_objects' => true));
$client->setApplicationName("Google Calendar PHP Starter Application");
$client->setClientId('653503781465-ibigaci7f0ckbp41793bbshvij31mrim.apps.googleusercontent.com');
$client->setClientSecret('9A3ZJ1vuUeYcOOW46ZIDtLs3');
//$client->setRedirectUri('https://cirrus-r.time2view.se/simple.php');
$client->setRedirectUri('https://cirrus-r.time2view.se/cirrus-r-new/simple.php');

$client->setDeveloperKey('AIzaSyD4Kd3ZYUH6e-Z3pqkubXVgPJBDrunPeSU');

//$client = new Google_Client(array('use_objects' => true));
//$client->setApplicationName("Google Calendar PHP Starter Application");
//$client->setClientId('361312406079.apps.googleusercontent.com');
//$client->setClientSecret('RO81JNNksvw6LHn8kdTrgFiO');
//$client->setRedirectUri('https://www.time2view.se/cirrus/simple.php');

//$client->setDeveloperKey('AIzaSyBazvM3N82St5YLKpjMlT55hBUeAIZS-48');

$service = new Google_CalendarService($client);

if (isset($_GET['logout'])) {
    unset($_SESSION['token']);
}

if (isset($_GET['code'])) {

    $client->authenticate($_GET['code']);
    $_SESSION['token'] = $client->getAccessToken();
}

if (isset($_SESSION['token'])) {

    $client->setAccessToken($_SESSION['token']);
}
if (isset($_GET['start_date'])) {
    $_SESSION['start_to_calender'] = $_REQUEST['start_date'];
}
if (isset($_GET['end_date'])) {
    $_SESSION['end_to_calender'] = $_REQUEST['end_date'];
}
if (isset($_GET['emp'])) {
    $_SESSION['emp_to_calender'] = $_REQUEST['emp'];
}
if (isset($_GET['time_zone'])) {
    $_SESSION['time_zone'] = $_REQUEST['time_zone'];
}

if($_SESSION['user_id'] == 'dodo001') {
	echo "<pre>".print_r($_SESSION['start_to_calender'],1)."</pre>";
}
if ($client->getAccessToken()) {
    //$days = cal_days_in_month(CAL_GREGORIAN, $_SESSION['month_to_calender'], $_SESSION['year_to_calender']);
      
    $start_date = $_SESSION['start_to_calender'];
    $end_date = $_SESSION['end_to_calender'];
    $smarty = new smartySetup(array("messages.xml"),FALSE);
    $calList = $service->calendarList->listCalendarList();
    $timetable = $equipment->get_timetable_to_add_calender($_SESSION['emp_to_calender'], $_SESSION['start_to_calender'], $_SESSION['end_to_calender']);
    $employee_detail = $employee->employee_detail_main($_SESSION['emp_to_calender']);
    echo "<script>alert('".$calList->items[0]->id."'); </script>";
    echo "<pre>".print_r($calList,1)."</pre>";
    if ($employee_detail[0]['email'] == $calList->items[0]->id) {
        $google_ids = $dona->get_google_ids_deleted();
        for ($i = 0; $i < count($google_ids); $i++) {
            $data_events = $service->events->listEvents('primary', array('timeMin' => $start_date . 'T00:00:00-01:00', 'timeMax' => $end_date . 'T23:59:59-01:00'));
            for ($j = 0; $j < count($data_events->items); $j++) {
                $temp_obj = $data_events->items[$j];
                if ($temp_obj->id == $google_ids[$i]['google_id']) {
                    break;
                }
            }
            if ($j != count($data_events->items)) {

                $service->events->delete('primary', $google_ids[$i]['google_id']);
                $dona->delete_google_id($google_ids[$i]['id']);
            }
        }
        // $data_events = $service->events->get("primary", '');
        $data_events = $service->events->listEvents('primary', array('timeMin' => $start_date . 'T00:00:00-01:00', 'timeMax' => $end_date . 'T23:59:59-01:00'));
        //echo "<pre>\n".print_r($data_events->items, 1)."</pre>";
        for ($i = 0; $i < count($timetable); $i++) {
            if ($timetable[$i]['status'] == 1) {
                $time_from = str_replace(".", ":", $timetable[$i]['time_from']);
                $time_to = str_replace(".", ":", $timetable[$i]['time_to']);
//                echo $theTime = time()."<br>"; // specific date/time we're checking, in epoch seconds. 
                $theTime = strtotime($timetable[$i]['date']." ".$time_from.":00");
                $tz = new DateTimeZone('Europe/Stockholm');
                $date = new DateTime($timetable[$i]['date']." ".$time_from.":00", new DateTimeZone('Europe/Stockholm'));
                $transition = $tz->getTransitions($theTime, $theTime); 
                $offset = $transition[0]['offset'];
                $time_zone = $offset / 60 / 60;
                    
                $hours = str_pad(floor($time_zone), 2, '0', STR_PAD_LEFT);
                $minutes = str_pad(($time_zone - $hours) * 60, 2, '0', STR_PAD_LEFT);
                for ($j = 0; $j < count($data_events->items); $j++) {
                    //echo "<pre>\n".print_r($data_events[0], 1)."</pre>";
                    $temp_obj = $data_events->items[$j];
                    if ($temp_obj->id == $timetable[$i]['google_id']) {
                        break;
                    }
                }

                $customer_detail = $customer->customer_detail($timetable[$i]['customer']);
                if ($j != count($data_events->items)) {

                    //$apiClient = new Google_Client();
                    $client->setUseObjects(true);
                    //$service   = new Google_CalendarService($apiClient);
                    //$events    = $service->events;
                    $currEvent = $service->events->get($calList->items[0]->id, $timetable[$i]['google_id']);
                    $currEvent->setSummary(substr($customer_detail['last_name'], 0, 1) . substr($customer_detail['first_name'], 0, 1));
                    //$currEvent->setDescription($customer_detail['last_name']." ".$customer_detail['first_name']);
                    $start = new Google_EventDateTime();
                    $start->setTimeZone(date_default_timezone_get());
                    $start->setDateTime($timetable[$i]['date'] . 'T' . $time_from . ':00.000+'.$hours.':'.$minutes);
                    $currEvent->setStart($start);
                    $end = new Google_EventDateTime();
                    $end->setTimeZone(date_default_timezone_get());
                    $end->setDateTime($timetable[$i]['date'] . 'T' . $time_to . ':00.000+'.$hours.':'.$minutes);
                    $currEvent->setEnd($end);
                    //    $currEvent->setColorId(2); // One of the available colors ID
                    $recurringEvent = $service->events->update('primary', $timetable[$i]['google_id'], $currEvent);
                } else {
                    $event = new Google_Event();
                    $event->setSummary(substr($customer_detail['last_name'], 0, 1) . substr($customer_detail['first_name'], 0, 1));
                    //$event->setDescription($customer_detail['last_name']." ".$customer_detail['first_name']);
                    $start = new Google_EventDateTime();
                    $start->setTimeZone(date_default_timezone_get());
                    $start->setDateTime($timetable[$i]['date'] . 'T' . $time_from . ':00.000+'.$hours.':'.$minutes);
                    $event->setStart($start);
                    $end = new Google_EventDateTime();
                    $end->setTimeZone(date_default_timezone_get());
                    $end->setDateTime($timetable[$i]['date'] . 'T' . $time_to . ':00.000+'.$hours.':'.$minutes);
                    $event->setEnd($end);
                    $createdEvent = $service->events->insert('primary', $event);
                    $return = $equipment->set_google_id($timetable[$i]['id'], $createdEvent->id);
                }
            } else {
                for ($k = 0; $k < count($data_events->items); $k++) {
                    $temp_obj = $data_events->items[$k];
                    if ($temp_obj->id == $timetable[$i]['google_id']) {
                        break;
                    }
                }
                if ($k != count($data_events->items)) {

                    $service->events->delete('primary', $timetable[$i]['google_id']);
                    $dona->delete_google_id($timetable[$i]['google_id']);
                }
            }
        }
    } else {

     //   echo "<script>alert('" . $smarty->translate['login_mail_id_not_match'] . "'); window.close();</script>";
    }
    unset($_SESSION['token']);
    // header('Location: https://time2view.se/cirrus-demo/report/month/week/employee/');
    /*echo "<script>alert('" . $smarty->translate['completed_adding_google_calendar'] . "'); window.close();
</script>";
    exit;*/
    /* $event = $service->events->get('primary', '3lhjf6edqss8o6a3v4r2udm6o0');

      $event->setSummary('Appointment at Somewhere');
      $end = new Google_EventDateTime();
      $end->setDateTime('2013-11-20T10:55:00.000+05:30');
      $event->setEnd($end);
      $updatedEvent = $service->events->update('primary', $event->getIdneed u to remove all the entries before.. othrewise it will not work properly(), $event);

      // Print the updated date.
      echo $updatedEvent->getUpdated(); */
} else {

    $authUrl = $client->createAuthUrl();
    header('Location: ' . $authUrl);
    exit;
    // print "<a class='login' href='$authUrl'>Connect Me!</a>";
}
?>
