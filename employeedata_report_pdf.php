<?php

//This file is for creating pdf based on criteria
require_once('plugins/MPDF54/mpdf.php');
require_once('class/setup.php');
require_once('class/equipment.php');
require_once('class/customer.php');
require_once('class/employee.php');

$mpdf=new mPDF('');
//$mpdf->_setPageSize('A4-L');
$mpdf->useKerning=true;
$mpdf->restrictColorSpace=3; // forces everything to convert to CMYK colors
$mpdf->AddSpotColor('PANTONE 534 EC',85,65,47,9);
//==============================================================

$smarty = new smartySetup(array("user.xml","month.xml","messages.xml","button.xml","forms.xml","reports.xml"),FALSE);
$equipment = new equipment();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 6));
$customer = new customer();
$employee = new employee();
$uri = substr($_SERVER['REQUEST_URI'],0,-1);
$pram = explode('/',$uri);
$totparam = count($pram);
$order = $pram[$totparam-1];
$status = $pram[$totparam-2];
$name = $pram[$totparam-3];

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

$html= '';


$html .= '<style>
.myclass td{
	color:red;	
}
</style>
<body><table border="1" cellpadding="0" cellspacing="0"   >
	<tr style="background:#DAF2F7; color:#666;">
					<th >'.$smarty->localise->contents['employeenumber'].'</th>
					<th>'.$smarty->localise->contents['SSN'].'</th>
					<th>'.$smarty->localise->contents['name'].'</th>
					<th>'.$smarty->localise->contents['address'].'</th>
					<th>'.$smarty->localise->contents['zipcode'].'</th>
					<th>'.$smarty->localise->contents['city'].'</th>
					<th>'.$smarty->localise->contents['customer'].'</th>		
					<th>'.$smarty->localise->contents['mobile'].'</th>
					<th>'.$smarty->localise->contents['email'].'</th>
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
		
			//echo $usernm;
			if($tot >= $falg+1)
			{
				
				if($status == 0)
				{
					$style = 'class="myclass"';				
				}
				else
				{
					$style = '';
				}
				
				
				if($j%2 == 0){
					$html .= '<tr style="background:#E3EDF0;" '.$style.'>
					<td>'.$code.'</td>
					<td>'.$ssn.'</td>	
					<td>'.$fullname.'</td>
					<td>'.$address.'</td>
					<td>'.$post.'</td>
					<td>'.$city.'</td>
					<td>';
					foreach ($customers as $customer_name) {
                    	$html .= $customer_name;
                    	$html .= '<hr style="color:#000;margin:0;">';
                    }
                    $html .= '</td>
					<td>'.$mobile.'</td>
					<td>'.$email.'</td>
					</tr>';	
				} else {
					$html .= '<tr style="background:#FFF;" '.$style.'>
					<td>'.$code.'</td>
					<td>'.$ssn.'</td>	
					<td>'.$fullname.'</td>
					<td>'.$address.'</td>
					<td>'.$post.'</td>
					<td>'.$city.'</td>
					<td>';
					foreach ($customers as $customer_name) {
                    	$html .= $customer_name;
                    	$html .= '<hr style="color:#000;margin:0;">';
                    }
                    $html .= '</td>
					<td>'.$mobile.'</td>
					<td>'.$email.'</td>
					</tr>';	
				}	
			}
			$falg++;
		}
		/*$pdf->Output();
		exit;*/
	}
	$html .= '</table>';
	
//==============================================================
$mpdf->WriteHTML($html);
//==============================================================
//==============================================================
// OUTPUT
$mpdf->Output('Employee_Report.pdf','D'); 

/*$mpdf = new mPDF('c','A4','','',32,25,27,25,16,13); 
$mpdf->SetDisplayMode('fullpage');
$mpdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list
$mpdf->WriteHTML($html,2);
$mpdf->Output('Employee_Report.pdf','D');*/
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