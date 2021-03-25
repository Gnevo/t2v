<?php
    require_once('class/setup.php');
    require_once('class/timetable.php');
    $timetablee_obj = new timetable();
    $smarty = new smartySetup(array("reports.xml"), FALSE);
    $customers = $timetablee_obj->get_overlapping_customers($_REQUEST['year'], $_REQUEST['month']);
    echo json_encode($customers);
?>