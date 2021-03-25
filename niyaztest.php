<?php

//function timezoneDoesDST1($tzId) { 
//    $tz = new DateTimeZone($tzId); 
//    $trans = $tz->getTransitions(); 
//    return ((count($trans) && $trans[count($trans) - 1]['ts'] > time())); 
//    
//    }
////or, if you're running PHP 5.3+
//function timezoneDoesDST($tzId) { 
//    $tz = new DateTimeZone($tzId); 
//    return count($tz->getTransitions(time())) > 0; 
//    
//    }

//echo $theTime = time()."<br>"; // specific date/time we're checking, in epoch seconds. 
//echo $theTime = strtotime('2013-09-31 04:10:00');
//$tz = new DateTimeZone('Europe/Stockholm');
//$date = new DateTime("2013-09-31 04:10:00", new DateTimeZone('Europe/Stockholm'));
//$transition = $tz->getTransitions($theTime, $theTime); 
// $offset = $transition[0]['offset'];
//$time_zone = $offset / 60 / 60;
//echo "<br>".$hours = str_pad(floor($time_zone), 2, '0', STR_PAD_LEFT);
//echo "<br>".$minutes = str_pad(($time_zone - $hours) * 60, 2, '0', STR_PAD_LEFT);
//$zone = $date->getTimezone();
//echo $zone->getName();
// $x = $zone->getLocation();
// echo "<pre>". print_r($x, 1)."</pre>";
//echo "<pre>". print_r($transition, 1)."</pre>";
//echo "<pre>". print_r($zone, 1)."</pre>";
//// only one array should be returned into $transition. Now get the data: 
////$offset = $transition[0]['offset']; 
////$abbr = $transition[0]['abbr']; 
require_once('class/setup.php');
require_once('class/equipment.php');
require_once('class/customer.php');
require_once('class/employee.php');
$smarty = new smartySetup(array("user.xml","month.xml","messages.xml","button.xml","forms.xml","reports.xml"));

$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 6));

$smarty->display('extends:layouts/dashboard.tpl|niyastest.tpl');
?>
