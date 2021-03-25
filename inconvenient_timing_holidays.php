<?php
require_once('class/setup.php');
$smarty = new smartySetup(array("month.xml","messages.xml","button.xml","inconvenient_timing.xml"));
require_once('class/inconvenient_timing.php');
$inc_timing = new inconvenient_timing();

require_once('class/user.php');
$user = new user();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' =>7));
$smarty->assign('user_role', $user->user_role($_SESSION['user_id']));


if($_POST['name'] && $_POST['date_from'])
{
	$inc_timing->name = $_POST['name'];
	$inc_timing->effect_from = $_POST['year_from'];
	$inc_timing->time_from = $inc_timing->format_time_part($range[0]);
	$inc_timing->time_to = $inc_timing->format_time_part($range[1]);
	
	$inc_timing->inconvenient_timing_add();
}

/*
	if($_SERVER['QUERY_STRING'])
	{
            $timing = $inc_timing->inconvenient_timing($_SERVER['QUERY_STRING']);
            $timing[0]['effect_from'] = $timing[0]['effect_from'];
            $timing[0]['time_from'] = $inc_timing->convert_time_part($timing[0]['time_from']);
            $timing[0]['time_to'] = $inc_timing->convert_time_part($timing[0]['time_to']);
			
            $days_date = explode("-",$timing[0]['days']);
            $smarty->assign('day', $days_date[1]);
            $smarty->assign('month', $days_date[0]);
	}
      */  
/**********for date combo*****************/
require_once('configs/config.inc.php');
global $month;
$month_num=array();
$month_name=array();

foreach ($month as $m_id)
{
    $month_num[]=$m_id['id'];
    $month_name[]=$smarty->translate[$m_id['month']];
}

$day_nos=array();
for ($i=1; $i<=31 ; $i++)
    $day_nos[]=$i;
$smarty->assign("month_option_values", $month_num);
$smarty->assign("month_option_output", $month_name);
$smarty->assign("day_option_values", $day_nos);

$yr_from=$inc_timing->timing_holiday_year_from_years();
$smarty->assign("Year_option_values", $yr_from);
/**************************************/

$names =  $inc_timing->timing_holiday_names();//print_r($names);

//$smarty->assign('timing', $timing[0]);//print_r($timing[0]);
$smarty->assign('timing_names', $names);
$smarty->display('extends:layouts/dashboard.tpl|inconvenient_timing_holidays.tpl');

?>