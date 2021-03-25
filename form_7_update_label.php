<?php  
require_once('class/setup.php');
require_once('class/customer_forms.php');
require_once('plugins/message.class.php');
$smarty = new smartySetup(array("forms.xml", "messages.xml"));
$messages = new message();
$customer_forms = new customer_forms();
$pk = $_POST['pk'];
$value = $_POST['value'];
$customer_forms->form_7_field_update($pk, $value);
?>