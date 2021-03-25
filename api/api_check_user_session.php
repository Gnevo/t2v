<?php
	if(isset($_REQUEST['my_session'])){
		session_id($_REQUEST['my_session']);
	}
	session_name('t2v-cirrus');
	session_start('t2v-cirrus');
	$app_dir = dirname(dirname( realpath( __FILE__ ) )) ;
	chdir ($app_dir);
	$obj = new stdClass();
	if (isset($_SESSION['user_id']) && isset($_SESSION['company_id']) && $_SESSION['user_id'] != '' && $_SESSION['company_id'] != '' && count($_SESSION) > 5) {
		$obj->status = true;
	}else{
	    $obj->status = false;
	}
	$obj->session_check = $_SESSION;
	echo json_encode($obj);
?>