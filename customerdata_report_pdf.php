<?php
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

$customers_array = $customer->customer_activeinactive_data($name,$status,$order);
foreach ($customers_array as $customer_data) {
	$customer_username = $customer_data['username'];
	$formatted_mobile = '';
    if($customer_data['mobile'] != ''){
        $length_mobile_display = (strlen($customer_data['mobile'])-5)/2;
        $temp_mobile = '';
        $pos = 5;
        for($m=0;$m<$length_mobile_display;$m++){
            $temp_mobile = $temp_mobile." ".substr($customer_data['mobile'], $pos,2);
            $pos = $pos +2;
        }
        $formatted_mobile = "+46".substr($customer_data['mobile'], 0,3) . " " . substr($customer_data['mobile'], 3,2)." ".$temp_mobile;
    }
    $customers[$customer_username]['username'] =  $customer_username;
	$customers[$customer_username]['code'] =  $customer_data['code'];
	if($_SESSION['company_sort_by'] == 1)
		$customers[$customer_username]['name'] =  $customer_data['first_name'] . ' ' . $customer_data['last_name'];
	else {
		$customers[$customer_username]['name'] =  $customer_data['last_name'] . ' ' . $customer_data['first_name'];
	}
	$customers[$customer_username]['social_security'] =  $customer_data['century'] . substr($customer_data['social_security'], 0, 6) . "-" . substr($customer_data['social_security'], 6);
	$customers[$customer_username]['city'] =  $customer_data['city'];
	$customers[$customer_username]['phone'] =  $customer_data['phone'];
	$customers[$customer_username]['mobile'] =  $formatted_mobile;
	$customers[$customer_username]['status'] =  $customer_data['status'];
	$customers[$customer_username]['email'] =  $customer_data['email'];
	$customers[$customer_username]['address'] =  $customer_data['address'];
	$customers[$customer_username]['post'] =  $customer_data['post'];
	$customers[$customer_username]['employees'][$customer_data['employee_username']] = $customer_data['employee_name'];
	$relatives = $customer->customer_getrelatives($customer_username);
	$gardians = $customer->customer_getgardins($customer_username);		
	$relcnt = count($relatives);
	$relarray = '';
	if(count($relatives)){
		for($e=0;$e<count($relatives);$e++){
			if($relatives[$e]['mobile'] != '')
				$mynumber = $relatives[$e]['mobile'];
			elseif($relatives[$e]['phone'] != '')
				$mynumber = $relatives[$e]['phone'];
			else
				$mynumber = '';	
			if($e == 0)
				$relarray .= $relatives[$e]["name"].' ('.$relatives[$e]["relation"].')'.' '.$mynumber.' '.$relatives[$e]['email'];
			else
				$relarray .= '<hr style="color:#ccc;">'.$relatives[$e]["name"].' ('.$relatives[$e]["relation"].')'.' '.$mynumber.' '.$relatives[$e]['email'];
		}
	} else {
		$relarray = '--';
	}
	$customers[$customer_username]['relatives'] = $relarray;
	
	if(count($gardians)>0) {
		$guardianstr = $gardians[0]['first_name'].'  '.$gardians[0]['last_name'].'  '.$gardians[0]['mobile'].' '.$gardians[0]['email'];
	} else {
		$guardianstr = 	'--';
	}
	$customers[$customer_username]['gardians'] = $guardianstr;
}
$customers = fix_keys($customers, true);
$tot = count($customers);

$html = '
<style>
.myclass td{
	color:red;	
}
</style>
<body>
<table border="1" cellpadding="0" cellspacing="0"   >
<tr style="background:#DAF2F7; color:black; ">
<th>'.$smarty->localise->contents['number'].'</th>
<th>'.$smarty->localise->contents['SSN'].'</th>
<th>'.$smarty->localise->contents['customer'].'</th>
<th>'.$smarty->localise->contents['address'].'</th>
<th>'.$smarty->localise->contents['city'].'</th>
<th>'.$smarty->localise->contents['zipcode'].'</th>
<th>'.$smarty->localise->contents['employee'].'</th>
<th>'.$smarty->localise->contents['mobile'].'</th>
<th>'.$smarty->localise->contents['email'].'</th>
<th>'.$smarty->localise->contents['relatives'].'</th>
<th>'.$smarty->localise->contents['guardian'].'</th>
<tr>';


if($tot > 0){
	$falg = 0;
	$username = '';
	for($i=0;$i<$tot;$i++){
		$username = $customers[$falg]['username'];
		$fullname = $customers[$falg]['name'];
		$ssn = $customers[$falg]['social_security'];
		$city = $customers[$falg]['city'];
		$phone = $customers[$falg]['phone'];
		$employees = $customers[$falg]['employees'];
        $mobile = $formatted_mobile;
		$status = $customers[$falg]['status'];
		$email = $customers[$falg]['email'];
		$address = $customers[$falg]['address'];
		$code = $customers[$falg]['code'];
		$posts = $customers[$falg]['post'];
		$relatives = $customers[$falg]['relatives'];
		$gardians = $customers[$falg]['gardians'];
		//echo $usernm;
	
		if($status == 0)
		{
			$style = 'class="myclass"';				
		}
		else
		{
			$style = '';
		}
				
		
		if($i%2 == 0)
		{
			$html .= '<tr style="background:#E3EDF0;" '.$style.'>
			<td>'.$code.'</td>
			<td>'.$ssn.'</td>	
			<td>'.$fullname.'</td>
			<td>'.$address.'</td>
			<td>'.$city.'</td>
			<td>'.$posts.'</td>
			<td>';
            foreach ($employees as $employee_name) {
            	$html .=  $employee_name;
            	$html .= '<hr style="color:#000;margin:0;">';
            }
            $html .= '
			<td>'.$mobile.'</td>
			<td>'.$email.'</td>
			<td>'.$relatives.'</td>
			<td>'.$gardians.'</td>
			</tr>';	
		} else {
			$html .= '<tr style="background:#FFF;" '.$style.'>
			<td>'.$code.'</td>
			<td>'.$ssn.'</td>	
			<td>'.$lastname.', '.$firstname.'</td>
			<td>'.$address.'</td>
			<td>'.$city.'</td>
			<td>'.$posts.'</td>
			<td>';
            foreach ($employees as $employee_name) {
            	$html .= $employee_name;
            	$html .= '<hr style="color:#000;margin:0;">';
            }
            $html .= '
			<td>'.$mobile.'</td>
			<td>'.$email.'</td>
			<td>'.$relatives.'</td>
			<td>'.$gardians.'</td>
			</tr>';	
		}	
					
				
		$falg++;
		/*$pdf->Output();
		exit;*/
	}
	$html .= '</table></body>';
	
	//==============================================================
$mpdf->WriteHTML($html);
//==============================================================
//==============================================================
// OUTPUT
$mpdf->Output('Customer_Report.pdf','D'); 
?>

<script type="application/javascript">
window.close();
</script>
<?php
exit;
}
else
{
	
	?>
	<script type="application/javascript">
		window.close();
	</script>
	<?php			
	exit;
}
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