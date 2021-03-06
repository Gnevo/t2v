<?php
require_once('plugins/MPDF54/mpdf.php');
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
    $customers[$customer_username]['employees'][$customer_data['employee_username']] = utf8_decode($customer_data['employee_name']);
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
                $relarray .= '<br>'.$relatives[$e]["name"].' ('.$relatives[$e]["relation"].')'.' '.$mynumber.' '.$relatives[$e]['email'];
        }
    } else {
        $relarray = '--';
    }
    $customers[$customer_username]['relatives'] = $relarray;
    
    if(count($gardians)>0) {
        $guardianstr = $gardians[0]['first_name'].'  '.$gardians[0]['last_name'].'  '.$gardians[0]['mobile'].' '.$gardians[0]['email'];
    } else {
        $guardianstr =  '--';
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
        <th>'.utf8_decode($smarty->localise->contents['number']).'</th>
        <th>'.utf8_decode($smarty->localise->contents['SSN']).'</th>
        <th>'.utf8_decode($smarty->localise->contents['customer']).'</th>
        <th>'.utf8_decode($smarty->localise->contents['address']).'</th>
        <th>'.utf8_decode($smarty->localise->contents['city']).'</th>
        <th>'.utf8_decode($smarty->localise->contents['zipcode']).'</th>
        <th>'.utf8_decode($smarty->localise->contents['employee']).'</th>
        <th>'.utf8_decode($smarty->localise->contents['mobile']).'</th>
        <th>'.utf8_decode($smarty->localise->contents['email']).'</th>
        <th>'.utf8_decode($smarty->localise->contents['relatives']).'</th>
        <th>'.utf8_decode($smarty->localise->contents['guardian']).'</th>
    <tr>

';


if($tot > 0){
	$falg = 0;
	$username = '';
	$Grandtotworkinghrs = 0;
	for($i=0;$i<$tot;$i++)	 {
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
        $post = $customers[$falg]['post'];
        $relatives = $customers[$falg]['relatives'];
        $gardians = $customers[$falg]['gardians'];
	
		if($status == 0) {
			$style = 'class="myclass"';				
		}
		else {
			$style = '';
		}
				
		
                    $html .= '<tr '.$style.'>
			<td>'.utf8_decode($code).'</td>
			<td>'.$ssn.'</td>	
			<td>'.utf8_decode($fullname).'</td>
			<td>'.utf8_decode($address).'</td>
			<td>'.utf8_decode($city).'</td>
			<td>'.utf8_decode($post).'</td>
			<td>';
            foreach ($employees as $employee_name) {
            	$html .=  $employee_name .'<br>';
            }
            $html .= '
			<td>'.$mobile.'</td>
			<td>'.utf8_decode($email).'</td>
			<td>'.utf8_decode($relatives).'</td>
			<td>'.utf8_decode($gardians).'</td>
                    </tr>';	
					
				
		$falg++;
		$Grandtotworkinghrs = 0;
	}
	$html .= '</table></body>';
	
// The function header by sending raw excel
header("Content-type: application/vnd-ms-excel");
 
// Defines the name of the export file "employee-report-export.xls"
header("Content-Disposition: attachment; filename=customer-report-export.xls");
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