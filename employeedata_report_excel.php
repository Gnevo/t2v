<?php

//This file is for creating excel based on criteria
require_once('class/setup.php');
require_once('class/equipment.php');
require_once('class/customer.php');
require_once('class/employee.php');


$smarty = new smartySetup(array("user.xml","month.xml","messages.xml","button.xml","forms.xml","reports.xml"),FALSE);
$equipment = new equipment();
$customer = new customer();
$employee = new employee();

$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 6));
$uri = substr($_SERVER['REQUEST_URI'],0,-1);
$pram = explode('/',$uri);
$totparam = count($pram);
$order = $pram[$totparam-1];
$status = $pram[$totparam-2];
$name = $pram[$totparam-3];

$employees_array = $employee->employee_activeinactive_data($name,$status,$order);
foreach ($employees_array as $employee_data) {
	$employee_username = $employee_data['username'];
	$formatted_mobile = '';
    if($employee_data['mobile'] != ''){
        $length_mobile_display = (strlen($employee_data['mobile'])-5)/2;
        $temp_mobile = '';
        $pos = 5;
        for($m=0;$m<$length_mobile_display;$m++){
            $temp_mobile = $temp_mobile." ".substr($employee_data['mobile'], $pos,2);
            $pos = $pos +2;
        }
        $formatted_mobile = "+46".substr($employee_data['mobile'], 0,3) . " " . substr($employee_data['mobile'], 3,2)." ".$temp_mobile;
    }
    $employees[$employee_username]['username'] =  $employee_username;
	$employees[$employee_username]['code'] =  $employee_data['code'];
	if($_SESSION['company_sort_by'] == 1)
		$employees[$employee_username]['name'] =  $employee_data['first_name'] . ' ' . $employee_data['last_name'];
	else {
		$employees[$employee_username]['name'] =  $employee_data['last_name'] . ' ' . $employee_data['first_name'];
	}
	$employees[$employee_username]['social_security'] =  $employee_data['century'] . substr($employee_data['social_security'], 0, 6) . "-" . substr($employee_data['social_security'], 6);
	$employees[$employee_username]['city'] =  $employee_data['city'];
	$employees[$employee_username]['phone'] =  $employee_data['phone'];
	$employees[$employee_username]['mobile'] =  $formatted_mobile;
	$employees[$employee_username]['status'] =  $employee_data['status'];
	$employees[$employee_username]['email'] =  $employee_data['email'];
	$employees[$employee_username]['address'] =  $employee_data['address'];
	$employees[$employee_username]['post'] =  $employee_data['post'];
	$customer_name = $employees[$falg]['customer_name'];
	if($employee_data['customer_name']) {
		$employees[$employee_username]['customers'][] = $employee_data['customer_name'];
	}

}
$employees = fix_keys($employees, true);
$page = 10;
$tot = count($employees);
$div = ceil($tot/$page);

$html = '
<body><table border="1" cellpadding="0" cellspacing="0"   >
	<tr style="background:#DAF2F7; color:#666;">
					<th >'.utf8_decode($smarty->localise->contents['employeenumber']).'</th>
					<th>'.utf8_decode($smarty->localise->contents['SSN']).'</th>
					<th>'.utf8_decode($smarty->localise->contents['name']).'</th>
					<th>'.utf8_decode($smarty->localise->contents['address']).'</th>
					<th>'.utf8_decode($smarty->localise->contents['zipcode']).'</th>
					<th>'.utf8_decode($smarty->localise->contents['city']).'</th>					
					<th>'.utf8_decode($smarty->localise->contents['customer']).'</th>					
					<th>'.utf8_decode($smarty->localise->contents['mobile']).'</th>
					<th>'.utf8_decode($smarty->localise->contents['email']).'</th>
				<tr>';	

if($tot > 0){
	$falg = 0;
	$username = '';
	for($i=0;$i<$div;$i++){
		for($j=0;$j<10;$j++){
			$username = $employees[$falg]['username'];
			$fullname = $employees[$falg]['name'];
			$ssn = $employees[$falg]['social_security'];
			$city = $employees[$falg]['city'];
			$phone = $employees[$falg]['phone'];
			$customers = $employees[$falg]['customers'];
			$mobile = $employees[$falg]['mobile'];
			$status = $employees[$falg]['status'];
			$email = $employees[$falg]['email'];
			$address = $employees[$falg]['address'];
			$code = $employees[$falg]['code'];
			$posts = $employees[$falg]['post'];
			if($tot >= $falg+1){
				if($status == 0){
					$style = 'style="color:#ff0000"';				
				}
				else{
					$style = '';
				}
                $html .= '<tr '.$style.'>
                        <td>'.$code.'</td>
                        <td>'.$ssn.'</td>	
                        <td>'.utf8_decode($fullname).'</td>
                        <td>'.utf8_decode($address).'</td>
                        <td>'.utf8_decode($post).'</td>
                        <td>'.utf8_decode($city).'</td>
                        <td>';
						foreach ($customers as $customer_name) {
	                    	$html .= utf8_decode($customer_name). '<br/>';
	                    }
	                    $html .= '</td>
                        <td>'.$mobile.'</td>
                        <td>'.utf8_decode($email).'</td>
                    </tr>';	

			}
			$falg++;
		}
		/*$pdf->Output();
		exit;*/
	}
	
	$html .= '</table>';
	
	
// The function header by sending raw excel
header("Content-type: application/vnd-ms-excel");
 
// Defines the name of the export file "employee-report-export.xls"
header("Content-Disposition: attachment; filename=employee-report-export.xls");
echo $html;

?>
<script type="application/javascript">
window.close();
</script>
<?php
exit;
}
else{
	?>
	<script type="application/javascript">
		window.close();
	</script>
	<?php			
	exit;
}
exit;

function fix_keys($array, $numberCheck = false) {
    foreach ($array as $k => $val) {
        if (is_array($val)) $array[$k] = fix_keys($val, flase); //recurse
        if (is_numeric($k)) $numberCheck = true;
    }
    if ($numberCheck === true) {
        return array_values($array);
    } else {
        return $array;
    }
}
?>