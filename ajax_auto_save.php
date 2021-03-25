<?php
// ini_set('error_reporting', E_WARNING);
// ini_set("display_errors", 1);
require_once('class/setup.php');
require_once('class/customer.php');
require_once('class/customer_ai.php');
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml"), FALSE);
$customer = new customer();
$customer_ai = new customer_ai();
switch($_POST['tab']) {
	case '1':
		$customer_ai->username = strip_tags($_POST['username']);
		$customer_ai->implementation_history = $_POST['history'];
		$customer_ai->implementation_diagnosis = $_POST['diagnosis'];
		$customer_ai->implementation_mission = $_POST['mission'];
		$customer_ai->implementation_intervention = $_POST['intervention'];
		$customer_ai->implementation_email = $_POST['email'];
		if($customer_ai->implementation_id == '')
			$customer_ai->implementation_id = $_POST['date'];
		if($customer_ai->implementation_id == '')
			$customer_ai->implementation_id = $_SESSION['autosave'];
		if($customer_ai->implementation_id != '') {
			$customer_ai->customer_implementation_update($_POST['read_write']);
			echo '<div class="success">'.$smarty->translate['auto_saved'].'</div>';
		}
		else {
			if($customer_ai->customer_implementation_add($_POST['read_write'])){
				$_SESSION['autosave'] = $customer_ai->get_id();

				$temp_saved_details = $customer_ai->customer_implementation_details($_SESSION['autosave']);
				// echo '<script>$("#new").val("");$(\'#date\').prepend(new Option(\''.$smarty->translate['select'].'\', \''.$_SESSION['autosave'].'\', true, true));</script>';
				// echo '<script>$("#new").val("");$(\'#date\').prepend(new Option(\''.$temp_saved_details['date'].'\', \''.$_SESSION['autosave'].'\', true, true));</script>';
				echo '<script>$("#new").val("");$(\'#date option:first\').after(new Option(\''.$temp_saved_details['date'].'\', \''.$_SESSION['autosave'].'\', true, true));</script>';
				echo '<div class="success">'.$smarty->translate['auto_saved'].'</div>';
			}
		}
		break;
	case '2':
		$customer->work = $_POST['work'];
		$customer->history = $_POST['history'];
		$customer->clinical_picture = $_POST['clinical_picture'];
		$customer->medications = $_POST['medication'];
		$customer->devolution = $_POST['ja'];
		$customer->customer = $_POST['username'];
		$customer->special_diet = $_POST['special_diet'];
		if($customer->work_id == '')
			$customer->work_id = $_POST['date'];
		if($customer->work_id == '')
			$customer->work_id = $_SESSION['autosave'];
		if($customer->work_id != '') {
			$customer->edit_work_customer($customer->work_id, $_POST['read_write']);
			echo '<div class="success">'.$smarty->translate['auto_saved'].'</div>';
		}
		else {
			if($customer->insert_work_customer($_POST['read_write'])){
				$_SESSION['autosave'] = $customer->get_id();
				$works_data = $customer->get_customer_works_date($_SESSION['autosave']);
				echo '<script>$("#new").val(""); $("#ids").val('.$_SESSION['autosave'].'); $(\'#date option:first\').after(new Option(\''.$works_data[0]['date'].'\', \''.$_SESSION['autosave'].'\', true, true));</script>';
				echo '<div class="success">'.$smarty->translate['auto_saved'].'</div>';
			}
		}
		break;
	case '3':
		$customer->customer = $_POST['username'];
		$customer->employee = $_POST['employed'];
		$customer->issue_date = $_POST['date_created'];
		$customer->return_date = $_POST['date_last'];
		$customer->subject = $_POST['subject'];
		$customer->note_type = $_POST['note_type'];
		$customer->notes = $_POST['notes'];
        $customer->priority = $_POST['priority'];
        $customer->description = $_POST['more_notes'];
        $customer->status = $_POST['status'];
		if($customer->doc_id == '')
			$customer->doc_id = $_POST['date'];
		if($customer->doc_id == '')
			$customer->doc_id = $_SESSION['autosave'];
		if($customer->doc_id != '') {
			$customer->edit_documentation($customer->doc_id, $_POST['read_write']);
			echo '<div class="success">'.$smarty->translate['auto_saved'].'</div>';
		}
		else {
			$customer->insert_documentation($_POST['read_write']);
			$_SESSION['autosave'] = $customer->get_id();
			echo '<script>$("#saves").val("")</script>';
			echo '<script>$("#ids").val('.$_SESSION['autosave'].')</script>';
			echo '<div class="success">'.$smarty->translate['auto_saved'].'</div>';
		}
		break;
}
?>