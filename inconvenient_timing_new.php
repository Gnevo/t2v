<?php
require_once('class/setup.php');
require_once('class/user.php');
require_once('class/inconvenient_timing.php');
$smarty = new smartySetup(array("month.xml", "messages.xml", "button.xml", "inconvenient_timing.xml"));
$inc_timing = new inconvenient_timing();
$user = new user();

$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 7));
$smarty->assign('user_role', $user->user_role($_SESSION['user_id']));
$w_days = array("mon", "tue", "wed", "thu", "fri", "sat", "sun");  // checkbox name

/* * ****to check new entry or not******************** */
$test = explode('&', $_SERVER['QUERY_STRING']);
$flag = ($test[0] == 'newentry') ? 1 : 0;
$smarty->assign('flag', $flag);
/* * ****to check new entry or not***********end********* */
if (($_POST['name'] || $_POST['new_name']) && $_POST['date_from']) {
    $inc_timing->name = !empty($_POST['new_name']) ? $_POST['new_name'] : $_POST['name'];
    $inc_timing->effect_from = $_POST['date_from'];
    $range = explode("-", $_POST['range']);
    $inc_timing->time_from = $inc_timing->format_time_part($range[0]);
    $inc_timing->time_to = $inc_timing->format_time_part($range[1]);

    for ($i = 0; $i < count($w_days); $i++) {
        if (!empty($_POST[$w_days[$i]])) {
            $days .= $_POST[$w_days[$i]] . ',';
        }
    }
    $days = eregi_replace(',$', '', $days);
    $inc_timing->days = $days;

    $inc_timing->inconvenient_timing_add();
}

if ($_SERVER['QUERY_STRING']) {
    $timing = $inc_timing->inconvenient_timing($_SERVER['QUERY_STRING']);
    $timing[0]['effect_from'] = $timing[0]['effect_from'];
    $timing[0]['time_from'] = $inc_timing->convert_time_part($timing[0]['time_from']);
    $timing[0]['time_to'] = $inc_timing->convert_time_part($timing[0]['time_to']);

    $days = explode(",", $timing[0]['days']);
    //array_pop($days);
    for ($j = 0; $j < count($w_days); $j++) {
        if (($n = array_search($j + 1, $days)) !== FALSE)
            $d[$w_days[$j]] = 1;
        else
            $d[$w_days[$j]] = 0;
    }//print_r($d);
    $smarty->assign('days', $d);
}


$names = $inc_timing->timing_name_get_all(); //print_r($names);
$smarty->assign('timing', $timing[0]); //print_r($timing[0]);
$smarty->assign('timing_names', $names);
$smarty->display('extends:layouts/dashboard.tpl|inconvenient_timing_new.tpl');
?>