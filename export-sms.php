<?php
require_once('class/setup.php');
require_once('class/sms.php');
require_once('class/export.php');
$obj_sms = new sms('hai');
$export = new export();
$smarty = new smartySetup(array("export.xml"),FALSE);
if($_POST['sms_num']){
   $sms_numbers = explode(",",$_POST['sms_num']);
   $month = $_POST['sms_month'];
   $year = $_POST['sms_year'];
  for($i=0;$i<count($sms_numbers);$i++){
      $obj_sms->addRecipient($sms_numbers[$i]);
  }
  $export->employees_sms = $obj_sms->recipients;
  $obj_sms->message = $smarty->translate['sms_export_message'];
  $obj_sms->send_export();
  $datas = $export->send_sms_export($month,$year);
//  if($datas){
//      
//      $message = 'sms_send_sucess';
//      $type = "success";
//      $messages->set_message($type, $message);
//      $smarty->assign('message', $messages->show_message());
//  }
  header("location:".$smarty->url."lon/export/1/");
 
}

?>