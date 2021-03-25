<?php
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

require_once('api_common_functions.php');
$session_check = check_user_session();

require_once('class/setup.php');
require_once('class/user.php');
require_once('class/employee.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
$obj_user = new user();
$obj_employee = new employee();

$i = 0;

$search_condition = isset($_REQUEST['search_cont']) ? trim($_REQUEST['search_cont']) : NULL;
$get_mode = isset($_REQUEST['get_mode']) ? trim($_REQUEST['get_mode']) : NULL;	//This used for Employee search Module only
if($get_mode == 'SEARCH')
	$datas = $obj_employee->employee_list_exact($_REQUEST['user'], $search_condition);
else
	$datas = $obj_employee->employees_list_for_right_click($_REQUEST['user']);

// echo "<pre>".print_r($datas, 1)."</pre>";
$obj = array();
if(!empty($datas)){
	foreach($datas as $data) {
	    $obj[$i] 			= new stdClass();
		$obj[$i]->username 	= $data['username'];
		$obj[$i]->code 		= $data['code'];
		$obj[$i]->social_security = $data['social_security'];
		$obj[$i]->first_name= $data['first_name'];
		$obj[$i]->last_name = $data['last_name'];
		$obj[$i]->full_name = $_SESSION['company_sort_by'] == 1 ? $data['first_name'].' '.$data['last_name'] : $data['last_name'].' '.$data['first_name'];
        $obj[$i]->mobile 	= $data['mobile'];
        $obj[$i]->email 	= $data['email'];
        $picture 			= $data['picture'];
	    $picture__ 			= "";
	    if ($picture && $picture != NULL) {
	        $upload_path = $obj_user->get_folder_name($_SESSION['company_id']) . '/profile/';
	        if(file_exists(getcwd()  . '/' . $upload_path . $picture))
	            $picture__ = $smarty->url.$upload_path . $picture;
	    }
        $obj[$i]->picture 	= $picture__;
		$i++;
	}
}

$main_obj = new stdClass();
$main_obj->session_status = $session_check;
$main_obj->data_set = $obj;
echo json_encode($main_obj);
?>