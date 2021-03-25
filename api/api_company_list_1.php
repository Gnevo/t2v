<?php
session_start();

$app_dir = dirname(dirname( realpath( __FILE__ ) )) ;
chdir ($app_dir);
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
        
	$obj[$i]->company_id = $data['id'];
	$obj[$i]->company_db = $data['db_name'];
	$obj[$i]->company_name= $data['name'];
        $obj[$i]->candg= $data['candg'];
        $obj[$i]->candg_break= $data['candg_break'];
        $obj[$i]->company_logo= $data['logo'] != '' ? $smarty->url.'/company_logo/'.$data['logo'] : NULL; //https://time2view.se/cirrus/company_logo/foveo_logo.png
	$i++;
}
//$obj['my_session'] = session_id();
//header("content-type: text/javascript");
echo json_encode($obj);
?>