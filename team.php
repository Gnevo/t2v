<?php
require_once('class/setup.php');
$smarty = new smartySetup();
require_once('class/team.php');
$team = new team();
require_once('plugins/message.class.php');
$messages = new message();
$smarty->assign('message', $messages->show_message());
//setting the menu
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 2));
$team_detail = $team->get_team_detail();
//getting team leader and members
for($i=0;$i<count($team_detail);$i++)
{//getting team leader
	
		$team_detail[$i]['tl'] = "'".$team_detail[$i]['tl']."'";
		$employee_detail = $team->employee_detail($team_detail[$i]['tl']);
		$team_detail[$i]['tl'] = $employee_detail[0]['first_name'].' '.$employee_detail[0]['last_name'];
	

//getting team members
$team_members = explode(",",$team_detail[$i]['members']);

	for($j = 0;$j < count($team_members);$j++)
	{ 
		 $team_members[$j] = "'".$team_members[$j]."'";
		 $employee_detail = $team->employee_detail($team_members[$j]);
		 $team_members[$j] = $employee_detail[0]['first_name'].' '.$employee_detail[0]['last_name'];
		
	}

$all_members = implode(",",$team_members);
$team_detail[$i]['members'] = $all_members;
}
$smarty->assign('team_detail', $team_detail);

//print_r($team_detail);
$smarty->display('extends:layouts/dashboard.tpl|team.tpl');

?>