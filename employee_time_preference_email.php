<?php
require_once('plugins/MPDF54/mpdf.php');
require_once('class/setup.php');
require_once('class/equipment.php');
require_once('class/newcustomer.php');
require_once('class/newemployee.php');
$smarty = new smartySetup(array("user.xml","month.xml","messages.xml","button.xml","forms.xml","reports.xml"),FALSE);
$equipment = new equipment();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 2));
$newcustomer = new newcustomer();
$newemployee = new newemployee();
/*$uri = substr($_SERVER['REQUEST_URI'],0,-1);
$pram = explode('/',$uri);
$totparam = count($pram);
$Employee_username = $pram[$totparam-1];*/

$Employee_username = $_POST['employee'];
$Employee_Email = $_POST['email'];

$EmployeeDetails = $newemployee->get_employee_detail($Employee_username);
$EmployeeName	= $EmployeeDetails['first_name'].' '.$EmployeeDetails['last_name'];

//Create array for employee preferred time 
$DaysArray = array('monday','tuesday','wednesday','thursday','friday','saturday','sunday');
$emp_preferred_times = $newemployee->get_employee_preferredtime($Employee_username);
$emp_count = count($emp_preferred_times);
$mailhtml = '';
if($emp_count > 0)
{
		$mailhtml = '<div>'.$smarty->localise->contents["employee"].' :'.$EmployeeName.' </div><br>';
	for($EmpCounter = 0 ; $EmpCounter < $emp_count ; $EmpCounter++)
	{		
		$EmpFromDate 	=	$emp_preferred_times[$EmpCounter]['fromdate'];		
		$EmpToDate		=	$emp_preferred_times[$EmpCounter]['todate'];		
		$EmpSlot		=	$emp_preferred_times[$EmpCounter]['slotid'];
			
		 $mailhtml .= '<table class="table_list tbl_padding_fix" border="1" >
                <tr>
                    <th colspan="8" align="left">
                    '.$smarty->localise->contents["from_date"].' : '.$EmpFromDate.' '.$smarty->localise->contents["to_date"].' : '.$EmpToDate.'
                    </th>
                </tr>
                <tr>
                    <th align="center" width="100">'.$smarty->localise->contents["day"].'</th>
                    <th align="center" colspan="6" width="700">'.$smarty->localise->contents["preferred_time"].'</th>
                    <th align="center" width="71">'.$smarty->localise->contents["book_overtime"].'</th>
                </tr>';
		
		$SlotArray = $newemployee->get_employee_preferredtime_slot($EmpSlot);	
		
		for($SlotCounter = 0 ; $SlotCounter < count($SlotArray) ; $SlotCounter++)
		{
			$Day = $SlotArray[$SlotCounter]['day'];
			$PreferredTime = $SlotArray[$SlotCounter]['preferredtime'];
			$ovetimevalue	= $SlotArray[$SlotCounter]['overtime'];
			if($ovetimevalue == 1)
			{
				$ovetime = $smarty->localise->contents["yes"];
			}
			else
			{
				$ovetime = $smarty->localise->contents["no"];
			}			
			 $mailhtml .= '<tr class="odd">
                    <td align="center">'.$smarty->localise->contents[$DaysArray[$SlotCounter]].'</td>
                    <td align="center" colspan="6">'.$PreferredTime.'</td>
                    <td align="center">'.$ovetime.'</td>
                </tr>';			
		}
		$mailhtml .= ' </table><br>';
	}
	
	$mpdf = new mPDF('c','A4','','',32,25,27,25,16,13); 
	$mpdf->SetDisplayMode('fullpage');
	$mpdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list
	$mpdf->WriteHTML($mailhtml,2);
	//$mpdf->Output('Employee_preferred_time_data.pdf','D');
	
	
	$pdfdoc = $mpdf->Output('Employee_preferred_time_data.pdf','S');
	$attachment = chunk_split(base64_encode($pdfdoc));
	$filename = 'Employee_preferred_time_data.pdf';
	
	// email stuff (change data below)
	$to = $Employee_Email;
	$from = $Employee_Email;
	$subject = "send email with pdf attachment";
	$message = "<p>Please see the attachment.</p>";
	
	// a random hash will be necessary to send mixed content
	$separator = md5(time());
	
	// carriage return type (we use a PHP end of line constant)
	$eol = PHP_EOL;
	
	// main header (multipart mandatory)
	$headers = "From: ".$from.$eol;
	$headers .= "MIME-Version: 1.0".$eol;
	$headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"".$eol.$eol;
	$headers .= "Content-Transfer-Encoding: 7bit".$eol;
	$headers .= "This is a MIME encoded message.".$eol.$eol;
	
	// message
	$headers .= "--".$separator.$eol;
	$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
	$headers .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
	$headers .= $message.$eol.$eol;
	
	// attachment
	$headers .= "--".$separator.$eol;
	$headers .= "Content-Type: application/octet-stream; name=\"".$filename."\"".$eol;
	$headers .= "Content-Transfer-Encoding: base64".$eol;
	$headers .= "Content-Disposition: attachment".$eol.$eol;
	$headers .= $attachment.$eol.$eol;
	$headers .= "--".$separator."--";
	
	// send message
	$mailsend = mail($to, $subject, $message, $headers);
	if($mailsend)
	{
		echo "Mail Sent Succcessfully";	
	}
	else
	{
		echo "Mail Failed";
	}
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
?>
