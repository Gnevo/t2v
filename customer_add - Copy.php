<?php
require_once('class/setup.php');
$smarty = new smartySetup(array("user.xml","messages.xml"));
require_once('class/customer.php');
$customer = new customer();
require_once('plugins/message.class.php');
$messages = new message();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 3));
$smarty->assign('message', $messages->show_message());
$smarty->assign('available_works', $customer->get_available_works());

$cstr = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM12345678901234567890_#?%&*-+";
$pass = "";
for ($i = 0; $i < 9; $i++) {
    $rnd = mt_rand(0, 73);
    $pass .= $cstr[$rnd];
}
$smarty->assign('pass', $pass);


if(!empty($_POST['first_name']))
{
  $customer->first_name = strip_tags($_POST['first_name']);
  $customer->last_name = strip_tags($_POST['last_name']);
  $customer->password = strip_tags($_POST['password']);
  $customer->username = $_POST['username'];
 // $customer->username = $customer->get_username(strtolower(substr($customer->first_name,0,2)).strtolower(substr($customer->last_name,0,2)));
  $customer->code = strip_tags($_POST['code']);
  $customer->ch = $_POST['ch'];
  $customer->social_security = strip_tags($_POST['social_security']);
  $customer->address = strip_tags($_POST['address']);
  $customer->city = strip_tags($_POST['city']);
  $customer->post = strip_tags($_POST['post']); 
  $customer->phone = strip_tags($_POST['phone']);  
  $customer->mobile = strip_tags($_POST['mobile']); 
  $customer->email = strip_tags($_POST['email']); 
  $customer->date = $_POST['date']; 
  $customer->status = $_POST['status'];
  $customer->works = substr($_POST['work'], 0, -1);
  $customer->company_name =  strip_tags($_POST['company_name']);
  $customer->company_address =  strip_tags($_POST['company_address']);
  $customer->company_city =  strip_tags($_POST['company_city']);
  $customer->company_post =  strip_tags($_POST['company_post']); 
  $customer->company_phone =  strip_tags($_POST['company_phone']);
  $customer->company_mobile =  strip_tags($_POST['company_mobile']);
  $customer->company_email =  strip_tags($_POST['company_email']);
  
  $customer->begin_transaction();
   if ($customer->login_add()) 
   { 
	   if ($customer->customer_add())
	    {
		    if($_POST['ch'] == '1')
			 { 
					if ($customer->company_add()) 
					{
					  $customer->commit_transaction();
					  $message = $smarty->localise->contents['customer_adding_success'];
		              $type="success";
		              $messages->set_message($type,$message);
					}
				    else
					{
					   $customer->rollback_transaction();
					   $message = $smarty->localise->contents['customer_adding_failed'];
		               $type="fail";
		               $messages->set_message($type,$message);
					}
             }
			 else
			 {
			     $customer->commit_transaction();
				 $message = $smarty->localise->contents['customer_adding_success'];
		         $type="success";
		         $messages->set_message($type,$message);
			 }
		}
	   else
	   {
		  $customer->rollback_transaction();
		  $message = $smarty->localise->contents['customer_adding_failed'];
		  $type="fail";
		  $messages->set_message($type,$message);
	   }
   }
  else
   {
	   $customer->rollback_transaction();
	   $message = $smarty->localise->contents['customer_adding_failed'];
	   $type="fail";
	   $messages->set_message($type,$message);
   }
 header("Location: ".$smarty->url . "customer/add/"); 
}

$smarty->display('extends:layouts/dashboard.tpl|customer_add.tpl');


?>