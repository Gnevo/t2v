<?php

function wl_log_write($data) {

    $dtz = new DateTime;
    $dtz->setTimestamp(time());
    $dtz->setTimezone(new DateTimeZone('Europe/Stockholm'));
    $datetime = $dtz->format('H:i:s');
    $user_details = $_SESSION['user_id'] . ' ' . $_SESSION['user_name'];
    $data = $datetime . ' ' . $user_details . ' ' . $data .
        (isset($_SESSION['login_via']) && $_SESSION['login_via'] == 'MOBILE-APP' ? ' #Mobile-App: Log-id='.$_SESSION['log_id'] : '') . PHP_EOL;
    $file = fopen('./log/request.log', 'a');
    if($file !== FALSE){
        fwrite($file, $data);
        fclose($file);
    }
}