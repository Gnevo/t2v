<?php

//base configuration for this application

$app_dir = getcwd();

$path = array(
    'template_dir' => $app_dir . '/templates/',
    'compile_dir' => $app_dir . '/templates_c/',
    'config_dir' => $app_dir . '/configs/',
    'cache_dir' => $app_dir . '/cache/',
    'class_dir' => $app_dir . '/class/',
    'plugins_dir' => $app_dir . '/libs/plugins/',
	'uploads' => $app_dir . '/uploads/'
);

// Setting the DB configuration
$db = array(
    'driver' => 'mysql',
    'database_master' => 'time2vie_cirruscommon',
    'database' => 'time2vie_cirruscommon',
    'username' => 'time2vie_cirrusr',
    'password' => 'aDmuWIehQRnP',
    'host' => 'localhost',
    'prefix' => ''
);




// Application Configuration
$preference = array(
    'caching' => false,
    'app_name' => 't2v Cirrus',
    'hash' => 'k92kgjDdkQv8Ck9091kTcdWaklBaO5jhMgg4kaljkmzlJ',
    'lang' => 'se',
    'admin_email' => 'gilad.nevo@time2view.se',
    'url' => 'https://cirrus.time2view.se/',
    'chat_session' => 'off',     //values: on|off
    'days_in_week' => '7',
    'app_version' => 'Cirrus version 3.0',
    'chat_service_url' => 'https://time2view.se:3011'
);

//config for mobile notifications
$crdm = array(
    'username' => 'azltoolbox@gmail.com',
    'password' => 'hereiam_',
    'source' => 'Arion-Cirrus-2.0',
    'service' => 'ac2dm'
);

//config details for sms
$sms = array(
    'username' => '1100946304',
    'password' => 'YEye3erA',
    'sender' => '4560991000'
);

//test
/*$bank_id = array(
    'url' => 'https://test.egreement-id.com/rp-sapi-auth/v1.1/rest/signRP/time2view',
    'userpaswd' => 'time2view:iFDAY7FM+7mZsLhzfBjBSA=='
);*/

$bank_id = array(
    'url' => 'https://api.egreement-id.com/rp-sapi-auth/v1.1/rest/signRP/time2view',
    'userpaswd' => 'time2view:dtNi2Yv67Wf7R2mDXJvZCg=='
);

//Company Basic Information
$company = array(
    'name' => 'UTV Cirrus',
    'orgno' => '556872-7324',
    'address' => 'Eriksbergsvägen 10',
    'city' => '69232 Kumla',
    'contact_person1' => 'Gilad Nevo',
    'contact_person2' => '',
    'email' => 'gn.nevo@gmail.com',
    'mail_server' => 'mc@time2view.se',
    'phone' => '019-332112',
    'mobile' => '0704-434964',
    'website' => 'https://www.time2view.se/',
    'subdomain' => 'https://cirrus.time2view.se/',
    'uploads' => 'uploads/',
    'export_format' => 'visma',
    'accounts_manager_name' => 'Gilad Nevo',
    'accounts_manager_email' => 'shajukt@arioninfotech.com'	
);

//User Roles
$role = array(
    '1' => 'admin',
    '2' => 'tl',
    '3' => 'employee',
    '4' => 'customer',
    '6' => 'economy',
    '7' => 'super_tl'
);

//Leave Types
$leave_type = array(
    '1' => 'Sjuk',
    '2' => 'Sem',
    '3' => 'VAB',
    '4' => 'FP',
    '5' => 'Frnv u bet.',
    //'6' => 'Utbild',
    '7' => 'Övrigt',
    //'8' => 'Byte',
    '9' => 'Permision',
    '10' => 'FPu bet'
   
);

$leave_type_short = array(
    '1' => 'Sj',
    '2' => 'Sm',
    '3' => 'V',
    '4' => 'FP',
    '5' => 'F',
    //'6' => 'Utbild',
    '7' => 'Öv',
    //'8' => 'Byte',
    '9' => 'P',
    '10' => 'L'
    
);

$contracts = array('weekly' => 40);

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

//$customer_kollektivavtal_labels used in sick form
$customer_kollektivavtal_labels = array(
    '1' => 'KFO',
    '2' => 'KFS',
    '3' => 'HÖK/AB (SKL)',
    '4' => 'PAN (SKL)',
    '5' => 'Vårdföretagarna, bransch G',
    '6' => 'Annat',
    '7' => 'Assistenten omfattas inte av något kollektivavtal'
);

$support_priority = array(
    '1' => 'Låg',
    '2' => 'Normal',
    '3' => 'Mellan',
    '4' => 'Hög'
);

$support_status = array(
    '1' => 'Nytt',
    '2' => 'Schemalagt',
    '3' => 'Startat',
    '4' => 'Löst',
    '5' => 'Stängt',
    '6' => 'Inväntar svar'
);

$support_ticket_type = array(
    '1' => 'Incident',
    '2' => 'Begäran om ändring',
    '3' => 'Förfråga'
    
);

$support_category_type = array(
    '1' => 'Interna ärenden',
    '2' => 'Cirrus ärenden'
);

$languages = array(
    '1' => array('name' => 'Svenska','short'=>'se'),
    '2' => array('name' => 'English','short'=>'en')
);

$cirrus_admins = array('gine001', 'dodo001');

$cirrus_support = array('email' => 'gn.nevo@gmail.com', 'first_name' => 'Time2view', 'last_name' => 'AB', 'phone' => '', 'mobile' => '');
$cirrus_password_expiry = array("expire" => 7, "show_expiry" => 31);

$firebase_settings = array(
    'api_key'   => 'AAAArULB60U:APA91bFxb9nlCI4sZw5gUHzgdKL1t6FMUY3rVD1SXeVsL0NKNz6hLDXt587caNuuCv9IUylXf4HdvnqKt9pProqKJ_q-qtmiC1wu4r2xAf-0WhxNJ_IbvRnvIBW6VMoR4jhh15HIK5fpwtewWAj-zvWJoYFNtkxJXQ',
    'sender_id' => 744149347141
);

$customer_location_settings = array(
    'default_lat'   => '59.1253382',    //KUMLA
    'default_lon'   => '15.1052793',
    'max_radius'    => 1000  //meter
);
?>
