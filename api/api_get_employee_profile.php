<?php
session_name('t2v-cirrus');
session_start('t2v-cirrus');
$app_dir = dirname(dirname( realpath( __FILE__ ) )) ;
chdir ($app_dir);
require_once('class/setup.php');
require_once('class/employee.php');
//require_once('class/user.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
$employee = new employee();
//$user = new user();

$data = $employee->get_employee_detail($_REQUEST['user']);
if ($data['mobile'] != "") {
    $length_mobile_display = (strlen($data['mobile']) - 5) / 2;
    //$data['mobile'] = "0".substr($data['mobile'], 0,2) . "-" . substr($data['mobile'], 2,3)." ".substr($data['mobile'], 5,2)." ".substr($data['mobile'], 7,2)." ".substr($data['mobile'],9,2);
    $temp_mobile = '';
    $pos = 5;
    for ($i = 0; $i < $length_mobile_display; $i++) {
        $temp_mobile = $temp_mobile . " " . substr($data['mobile'], $pos, 2);
        $pos = $pos + 2;
    }
    $data['mobile'] = "+46" . substr($data['mobile'], 0, 3) . " " . substr($data['mobile'], 3, 2) . " " . $temp_mobile;
}
if ($data['phone'] != "") {
    $data['phone'] = "0" . substr($data['phone'], 0, 2) . "-" . substr($data['phone'], 2);
}
$obj = array();
$obj['employee'] = $data;
$obj['customers'] = $employee->customers_list_for_right_click($_REQUEST['user']);
	
//    echo "<pre>". print_r($obj, 1)."</pre>";
//header("content-type: text/javascript");
echo json_encode($obj);
?>