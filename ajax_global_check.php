<?php
require_once('class/setup.php');
require_once('class/customer.php');
$smarty = new smartySetup(array('messages.xml'), FALSE);
$customer = new customer();
$val = $customer->employee_social_security_check($_REQUEST['ssno']);
if($val) {
	$val = explode(",",$val);
	$data = $customer->get_employee_detail($customer->get_company_db($val[0]),$_REQUEST['ssno']);
    echo('<script>
		$("#dialog_hidden").dialog({
			title: "'.$smarty->translate['dialog_alert'].'",
			resizable: false,
			height:140,
			buttons: {
				"Yes": function() {
					$("#username").val("'.$data['username'].'");  
					$("#first_name").val("'.$data['first_name'].'");
					$("#last_name").val("'.$data['last_name'].'");
					$("#code").val("'.$data['code'].'");
					$("#adress").val("'.$data['address'].'");
					$("#city").val("'.$data['city'].'");
					$("#post").val("'.$data['post'].'");
					$("#phone").val("'.$data['phone'].'");
					$("#mobile").val("'.$data['mobile'].'");
					$("#email").val("'.$data['email'].'");
					$("#date").val("'.$data['date'].'");
					$("#global_check").val("1");
					$( this ).dialog( "close" );
				},
				Cancel: function() {
					$("#username").val("");
					$("#first_name").val("");
					$("#last_name").val("");
					$("#social_security").val("");
					$("#code").val("");
					$("#adress").val("");
					$("#city").val("");
					$("#post").val("");
					$("#phone").val("");
					$("#mobile").val("");
					$("#email").val("");
					$("#date").val("");
					$("#global_check").val("0");
					$( this ).dialog( "close" );
				}
			}
		});
		$("#dialog_hidden").html("'.$smarty->translate['dialog_message'].'")
		</script>');
}
?>