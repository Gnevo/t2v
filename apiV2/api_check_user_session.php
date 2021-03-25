<?php
	require_once('api_common_functions.php');
	$session_check = check_user_session();

	$obj = new stdClass();
	$obj->session_status = $session_check;
	/*if (isset($_SESSION['user_id']) && isset($_SESSION['company_id']) && $_SESSION['user_id'] != '' && $_SESSION['company_id'] != '' && count($_SESSION) > 5) {
		$obj->status = true;
	}else{
	    $obj->status = false;
	}*/
	$obj->session_check = $_SESSION;
	echo json_encode($obj);
?>