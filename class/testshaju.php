<?php
ini_set('display_errors', true);
ini_set('xdebug.var_display_max_depth', 10);
error_reporting(E_ALL ^ E_NOTICE);
require_once ('class/setup.php');
require_once ('class/employee.php');
require_once ('plugins/message.class.php');
require_once ('plugins/date_calc.class.php');
require_once ('class/customer.php');
require_once ('class/sms.php');
require_once ('class/converter.php');
$obj_convertor = new Converter(array(),array(),2019);
$result = $obj_convertor->get_karens_data('dsds001', null, array(), $date_type='SINGLE_DATE', null, null, '2019-04-10', $time_from=09.00, $time_to=12.00, true);
if($result === FALSE){
	echo "no karens";
}else{
	echo "<pre>".print_r($result,1)."</pre>";
}
?>
