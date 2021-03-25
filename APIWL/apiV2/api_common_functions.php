<?php
if(isset($_COOKIE['t2v-cirrus'])){
    session_id($_COOKIE['t2v-cirrus']);
}
session_name('t2v-cirrus');
session_start('t2v-cirrus');
$app_dir = dirname(dirname( realpath( __FILE__ ) )) ;
chdir ($app_dir);

if (isset($_SESSION['last_activity']) && $_SESSION['last_activity']) {

    if ($_SESSION['last_activity'] < time() -  8 * 60 * 60) {	// 8 Hours
    // if ($_SESSION['last_activity'] < time() -  180) {

            unset($_SESSION['user_id']);
            unset($_SESSION['user_role']); 
            unset($_SESSION['company_id']); 
            session_destroy();
    }
}
// $_SESSION['last_activity'] = time();

function check_user_session($check_user_id = TRUE, $check_company = TRUE, $check_total_session_count = 5){
	// echo "<pre>".print_r(array($check_user_id , $check_company , $check_total_session_count), 1)."</pre>";
	$return_flag = TRUE;
	if($check_user_id && (!isset($_SESSION['user_id']) || $_SESSION['user_id'] == '')){
		$return_flag = FALSE;
	}
	if($return_flag && $check_company && (!isset($_SESSION['company_id']) || $_SESSION['company_id'] == '')){
		$return_flag = FALSE;
	}
	if($return_flag && $check_total_session_count !== NULL && count($_SESSION) <= $check_total_session_count){
		$return_flag = FALSE;
	}
	if($return_flag == TRUE)
		return $return_flag;
	else{
		$return_obj = new stdClass();		
		$return_obj->session_status = $return_flag;
		echo json_encode($return_obj);
		exit();	
	}
}
?>