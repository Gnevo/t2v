<?php
/*
 * Author : Shaju
 * description: to get all the accessible customers
 * 
 */
require_once('api_common_functions.php');
$session_check = check_user_session();

require_once('class/setup.php');
require_once('class/user.php');
require_once('class/customer.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
$obj_cust = new customer();
$obj_user = new user();

$search_condition = isset($_REQUEST['search_cont']) ? trim($_REQUEST['search_cont']) : NULL;
$cust_data = $obj_cust->customers_list_for_employee_report(1, $_REQUEST['user'], $search_condition);
$i = 0;
$obj = array();
// echo "<pre>".print_r($cust_data, 1)."</pre>";

if(!empty($cust_data)){
	foreach($cust_data as $data) {
	    $obj[$i] 			= new stdClass();
		$obj[$i]->username 	= $data['username'];
		$obj[$i]->first_name= $data['first_name'];
		$obj[$i]->last_name = $data['last_name'];
		$obj[$i]->full_name = $_SESSION['company_sort_by'] == 1 ? $data['first_name'].' '.$data['last_name'] : $data['last_name'].' '.$data['first_name'];
	    $obj[$i]->mobile 	= $data['mobile'];
	    $obj[$i]->email 	= $data['email'];
	    $obj[$i]->phone 	= $data['phone'];
	    $obj[$i]->fkkn 		= $data['fkkn'];
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