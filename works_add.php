<?php
require_once('class/setup.php');
$smarty = new smartySetup(array("work.xml","messages.xml","button.xml"), FALSE);
require_once('class/work.php');
$work = new work();
require_once('plugins/message.class.php');
$messages = new message();

$smarty->assign('message', $messages->show_message());
//$smarty->assign('works', $work->work_list());
$root_works = $work->get_sub_works();
$smarty->assign('works', $work->get_work_options($root_works));
if(!empty($_REQUEST['name']))
{
//echo $_REQUEST['image']; 
//return false;
  $work->name = strip_tags($_REQUEST['name']);
  $work->root_id = $_REQUEST['root_id'];
  $work->description = strip_tags($_REQUEST['description']);
  $image = $_REQUEST['image'];
 // $_FILES['image']['type']
  if(!empty($_FILES['image']['name'])) 
  {
		$img_type = $_FILES['image']['type'];
		if($img_type == 'image/gif' || $img_type == 'image/jpeg' || $img_type == 'image/png'|| $img_type == 'image/jpg')	
		{
				$file_name = $_FILES['image']['name'];
				$file_temp = $_FILES['image']['tmp_name'];
				if(file_exists("uploads/"))
				{
					if(move_uploaded_file($file_temp, "uploads/$file_name")) 
					{
						list($w,$h) = getimagesize("uploads/$file_name");
						if($w > 64 && $h > 64)
						{
						  $work->resize_image("uploads/$file_name", "uploads/$file_name");
						}
						 $image = addslashes(file_get_contents("uploads/$file_name"));
						 unlink("uploads/$file_name");
								
					}
								
		       }
	   }
  }
  $work->icon = $image;  
  if ($work->works_add()) 
   {
	   $message = $smarty->localise->contents['works_adding_success'];
	   $type="success";
	   $messages->set_message($type,$message);
  }
  else
  {
	  $message = $smarty->localise->contents['works_adding_failed'];
	  $type="fail";
	  $messages->set_message($type,$message);
  }
 header("Location: ".$smarty->url . "works/add/");
}

$smarty->display('extends:layouts/ajax_popup.tpl|works_add.tpl');

?>