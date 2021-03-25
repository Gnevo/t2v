<?php
require_once('api_common_functions.php');
$session_check = check_user_session();

require_once('class/setup.php');
require_once('class/user.php');

$smarty = new smartySetup(array("user.xml"), FALSE);
$user = new user();

$_REQUEST['company_ids'] = rawurldecode($_REQUEST['company_ids']);
$company_ids = explode(",",substr($_REQUEST['company_ids'], 0, -1));

$i = 0;
$obj = array();
foreach($company_ids as $id) {
	$data = $user->get_company($id);
        if($data === FALSE) continue;
        
        $obj[$i] = new stdClass();
	$obj[$i]->company_id = $data['id'];
	$obj[$i]->company_db = $data['db_name'];
	$obj[$i]->company_name= $data['name'];
        $obj[$i]->candg= $data['candg'];
        $obj[$i]->candg_break= $data['candg_break'];
        $obj[$i]->sort_name_by= $data['sort_name_by'];
        $obj[$i]->company_logo= $data['logo'] != '' ? $smarty->url.'/company_logo/'.$data['logo'] : NULL; //https://time2view.se/cirrus/company_logo/foveo_logo.png
	$i++;
}
$main_obj = new stdClass();
$main_obj->session_status = $session_check;
$main_obj->data_set = $obj;
echo json_encode($main_obj);
?>