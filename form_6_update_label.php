<?php  
require_once('class/setup.php');
require_once('class/customer_forms.php');
require_once('plugins/message.class.php');
$smarty = new smartySetup(array("forms.xml", "messages.xml"));
$messages = new message();
$customer_forms = new customer_forms();
$pk = $_POST['pk'];
$value = $_POST['value'];
if($_REQUEST['opk'] == 1) {
	$opk = ($_POST['name'] ? $_POST['name'] : 0);
	$options = $customer_forms->form_6_field_options($pk);
	$options[$opk] = $value;
	$str_options = implode('|', $options);
	$customer_forms->form_6_field_option_update($pk, $str_options);
} else {
	$customer_forms->form_6_field_update($pk, $value);
}
?>