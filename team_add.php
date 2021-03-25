<?php
require_once('class/setup.php');
$smarty = new smartySetup(array("team.xml","messages.xml","button.xml"),FALSE);
require_once('class/team.php');
$team = new team();
require_once('plugins/message.class.php');
$messages = new message();
// echo $role = $_REQUEST['role'];
 
 
//setting the menu
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 2));

$query_string = $_SERVER['QUERY_STRING'];
/*if(!empty($query_string))
 {
	 $team->id = $query_string;
	 //getting current team details
	 $team_detail = $team->get_one_team_detail();
	 $smarty->assign('team_detail', $team_detail);
	  //getting assigned members of this team
	 $all_members = $team->make_quotes($team_detail['members']);
	 $assigned_members =  $team->get_assigned_employees($all_members);
	 $smarty->assign('assigned_members', $assigned_members);
	 //getting all team leaders except current tl
	 $team_leaders = $team->get_team_leaders();
	 //getting available tl
	 $all_leaders = $team->make_quotes($team_leaders[0]);
     $available_teamleaders = $team->get_available_teamleaders($all_leaders);
     $smarty->assign('available_teamleaders', $available_teamleaders);
}*/
//else 
//{
     //getting  all team leaders
     $team_leaders = $team->get_all_team_leaders();
	 //getting available tl
	 $all_leaders = $team->make_quotes($team_leaders[0]);
	 $available_teamleaders = $team->get_available_teamleaders($all_leaders);
     $smarty->assign('available_teamleaders', $available_teamleaders);
//}

//getting all team members
//$team_members = $team->get_all_team_members();
//getting available team members
//$all_members = $team->make_quotes($team_members[0]);
//$smarty->assign('available_members', $team->get_available_members($all_members));
//if(!empty($_REQUEST['name']) && !empty($_POST['members']))
if(!empty($_REQUEST['name']))
{
//  $team->id = $_REQUEST['team_id'];
  $team->name = strip_tags($_REQUEST['name']);
  $team->tl = $_REQUEST['team_leader'];
 
 // $team->members = substr($_REQUEST['members'], 0, -1);
  
 // if(empty($_REQUEST['team_id']))
 // {
	  if ($team->team_add()) 
	   {
		   $message = $smarty->localise->contents['team_adding_success'];
		   $type="success";
		   $messages->set_message($type,$message);
	  }
	  else
	  {
		  $message = $smarty->localise->contents['team_adding_failed'];
		  $type="fail";
		  $messages->set_message($type,$message);
	  }
 // }
 /* else
  {
	  if ($team->team_update()) 
	   {
		   $message = $smarty->localise->contents['team_updating_success'];
		   $type="success";
		   $messages->set_message($type,$message);
	  }
	  else
	  {
		  $message = $smarty->localise->contents['team_updating_failed'];
		  $type="fail";
		  $messages->set_message($type,$message);
	  }
  }*/
 header("Location: ".$smarty->url . "team/");
}

$smarty->display('extends:layouts/ajax_popup.tpl|team_add.tpl');

?>