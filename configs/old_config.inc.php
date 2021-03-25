<?php

//base configuration for this application

$app_dir = getcwd();

$path = array(
    'template_dir' => $app_dir . '/templates/',
    'compile_dir' => $app_dir . '/templates_c/',
    'config_dir' => $app_dir . '/configs/',
    'cache_dir' => $app_dir . '/cache/',
    'class_dir' => $app_dir . '/class/',
    'plugins_dir' => $app_dir . '/libs/plugins/'
);

// Setting the DB configuration
$db = array(
    'driver' => 'mysql',
    'database_master' => 'cumulus2',
    'database' => 'cumulus1',
    'username' => '1000000587',
    'password' => 'l9hn9DwV1N',
    'host' => 'localhost',
    'prefix' => ''
);


// Application Configuration
$preference = array(
    'caching' => false,
    'app_name' => 't2v Cirrus',
    'hash' => 'k92kgjDdkQv8Ck9091kTcdWaklBaO5jhMgg4kaljkmzlJ',
    'lang' => 'se',
    'url' => 'http://time2view.se/cirrus-demo/'
);

//config for mobile notifications
$crdm = array(
    'username' => 'azltoolbox@gmail.com',
    'password' => 'hereiam_',
    'source' => 'Arion-Cirrus-2.0',
    'service' => 'ac2dm'
);

//Company Basic Information
$company = array(
    'name' => 'UTV Cirrus',
    'orgno' => '556872-7324',
    'address' => 'Eriksbergsvägen 10',
    'city' => '69232 Kumla',
    'contact_person1' => 'Gilad Nevo',
    'contact_person2' => 'Ingemar Johansson',
    'email' => 'gilad.nevo@time2view.se',
    'mail_server' => 'mc@time2view.se',
    'phone' => '019-332112',
    'mobile' => '0704-434964',
    'website' => 'http://www.time2view.se/',
    'subdomain' => 'http://cirrus_utv.tidsredovisning.net/',
    'uploads' => 'uploads/',
    'export_format' => 'visma'
);

//User Roles
$role = array(
    '1' => 'Admin',
    '2' => 'TL',
    '3' => 'Employee',
    '4' => 'Customer'
);

//Leave Types
$leave_type = array(
    '1' => 'Sjuk',
    '2' => 'Sem',
    '3' => 'VAB',
    '4' => 'FP',
    '5' => 'P-möte',
    '6' => 'Utbild',
    '7' => 'Övrigt',
    '8' => 'Byte'
);

//Work Slot Types
$slot_type = array(
    '0' => 'normal',
    '1' => 'travel',
    '2' => 'break'
);

$travel_type = array(
    '1' => 'transportation_service',
    '2' => 'own_car',
    '3' => 'other'
);

$month = array(
    array('id' => 1, 'month' => 'january', 'label' => 'jan'),
    array('id' => 2, 'month' => 'february', 'label' => 'feb'),
    array('id' => 3, 'month' => 'march', 'label' => 'mar'),
    array('id' => 4, 'month' => 'april', 'label' => 'apr'),
    array('id' => 5, 'month' => 'may', 'label' => 'may'),
    array('id' => 6, 'month' => 'june', 'label' => 'jun'),
    array('id' => 7, 'month' => 'july', 'label' => 'jul'),
    array('id' => 8, 'month' => 'august', 'label' => 'aug'),
    array('id' => 9, 'month' => 'september', 'label' => 'sep'),
    array('id' => 10, 'month' => 'october', 'label' => 'oct'),
    array('id' => 11, 'month' => 'november', 'label' => 'nov'),
    array('id' => 12, 'month' => 'december', 'label' => 'dec')
);

$week = array(
    array('id' => 1, 'day' => 'monday', 'label' => 'mon'),
    array('id' => 2, 'day' => 'tuesday', 'label' => 'tue'),
    array('id' => 3, 'day' => 'wednesday', 'label' => 'wed'),
    array('id' => 4, 'day' => 'thursday', 'label' => 'thu'),
    array('id' => 5, 'day' => 'friday', 'label' => 'fri'),
    array('id' => 6, 'day' => 'saturday', 'label' => 'sat'),
    array('id' => 7, 'day' => 'sunday', 'label' => 'sun')
);
?>
