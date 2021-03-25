<?php
require_once('class/setup.php');
require_once('class/customer.php');
$smarty = new smartySetup(array('user.xml','messages.xml'),FALSE);
$customer = new customer();
$search_type = $_GET['search_val'];
$month = $_GET['month'];
$year = $_GET['year'];
$date_from = $_GET['date_from'];
$date_to = $_GET['date_to'];
$username = $_GET['username'];
$search_text = $_GET['search_text'];
$type = $_GET['type'];
$user_detail = $customer->customer_detail($username);
$documents = $customer->get_all_documentation_print($username,$search_type,$month,$year,$date_from,$date_to,$search_text,$type);
$new_text = '<span style="color: #ff0000;">'.$search_text.'</span>';
?>

<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Untitled Document</title>
</head>

<body onload="javascript:window.print();">
<?php
$tables = "<table border='1' bordercolor='#000000' cellpadding='0' cellspacing='0' style='font-family:Arial, Helvetica, sans-serif; font-size:14px; width: 21cm'>
  <tr>
    <td height='30' colspan='3' align='left' valign='top'><h4>Personuppgifter</h4></td>
  </tr>
  <tr>
    <td  align='left' valign='top'><table align='left' cellpadding='0' cellspacing='0'>
      <tr>
        <td height='30' style=' font-size:16px;'>Personnummer</td>
      </tr>
      <tr>
        <td height='30' style=' font-size:16px;'><strong>".$user_detail['social_security']."</strong></td>
      </tr>
    </table></td>
    <td height='40' align='left' valign='top'><table align='left' cellpadding='0' cellspacing='0'>
        <tr>
          <td height='30' style=' font-size:16px;'>Anst.nr</td>
        </tr>
        <tr>
          <td height='30' style=' font-size:16px;'><strong>".$user_detail['code']."</strong></td>
        </tr>
    </table></td>
    <td height='40' align='left' valign='top'><table align='left' cellpadding='0' cellspacing='0'>
        <tr>
          <td height='30' style=' font-size:16px;'>Användarnamn</td>
        </tr>
        <tr>
          <td height='30' style=' font-size:16px;'><strong>".$user_detail['username']."</strong></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height='30' align='left' valign='top'><table align='left' cellpadding='0' cellspacing='0'>
      <tr>
        <td height='30' style=' font-size:16px;'>Förnamn</td>
      </tr>
      <tr>
        <td height='30' style=' font-size:16px;'><strong>".$user_detail['first_name']."</strong></td>
      </tr>
    </table></td>
    <td height='30' align='left' valign='top'><table align='left' cellpadding='0' cellspacing='0'>
        <tr>
          <td height='30' style=' font-size:16px;'>Efternamn</td>
        </tr>
        <tr>
          <td height='30' style=' font-size:16px;'><strong>".$user_detail['last_name']."</strong></td>
        </tr>
    </table></td>
    <td height='30' align='left' valign='top'><table align='left' cellpadding='0' cellspacing='0'>
        <tr>
          <td height='30' style=' font-size:16px;'>Adress</td>
        </tr>
        <tr>
          <td height='30' style=' font-size:16px;'><strong>".$user_detail['address']."</strong></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height='30' align='left' valign='top'><table align='left' cellpadding='0' cellspacing='0'>
        <tr>
          <td height='30' style=' font-size:16px;'>Ort</td>
        </tr>
        <tr>
          <td height='30' style=' font-size:16px;'><strong>".$user_detail['city']."</strong></td>
        </tr>
    </table></td>
    <td height='30' align='left' valign='top'><table align='left' cellpadding='0' cellspacing='0'>
        <tr>
          <td height='30' style=' font-size:16px;'>Postnr</td>
        </tr>
        <tr>
          <td height='30' style=' font-size:16px;'><strong>".$user_detail['post']."</strong></td>
        </tr>
    </table></td>
    <td height='30' align='left' valign='top'><table align='left' cellpadding='0' cellspacing='0'>
        <tr>
          <td height='30' style=' font-size:16px;'>Telefon</td>
        </tr>
        <tr>
          <td height='30' style=' font-size:16px;'><strong>".$user_detail['phone']."</strong></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height='30' align='left' valign='top'><table align='left' cellpadding='0' cellspacing='0'>
        <tr>
          <td height='30' style=' font-size:16px;'>Mobil</td>
        </tr>
        <tr>
          <td height='30' style=' font-size:16px;'><strong>".$user_detail['mobile']."</strong></td>
        </tr>
    </table></td>
    <td height='30' align='left' valign='top'><table align='left' cellpadding='0' cellspacing='0'>
        <tr>
          <td height='30' style=' font-size:16px;'>E-post</td>
        </tr>
        <tr>
          <td height='30' style=' font-size:16px;'><strong>".$user_detail['email']."</strong></td>
        </tr>
    </table></td>
    <td height='30' align='left' valign='top'><table align='left' cellpadding='0' cellspacing='0'>
      <tr>
        <td height='30' style=' font-size:16px;'>Tillträdes dag</td>
      </tr>
      <tr>
        <td height='30' style=' font-size:16px;'><strong>".$user_detail['date']." </strong></td>
      </tr>
  </table></td>
  </tr>
</table>";
if($documents){
    echo $tables;
?>
    <br><br>
<?php
    foreach($documents AS $document){
        
        echo '<table border="1" bordercolor="#000000" cellpadding="0" cellspacing="0" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; width: 21cm">
<tr>
<td height="40" colspan="3" align="left" valign="top" style="background-color:#DCDCDC;"><h4>Datum<br />
'.str_replace($search_text,$new_text,$document['created_date']).'</h4></td>
</tr>
<tr>
<td align="left" valign="top"><table align="left" cellpadding="0" cellspacing="0">
<tr>
<td height="30" style=" font-size:16px;">Ämne</td>
</tr>
<tr>
<td height="30" style=" font-size:16px;"><strong>'.str_replace($search_text,$new_text,$document['subject']).'</strong></td>
</tr>
</table></td>
<td height="40" align="left" valign="top"><table align="left" cellpadding="0" cellspacing="0">
<tr>
<td height="30" style=" font-size:16px;">Anställd</td>
</tr>
<tr>
<td height="30" style=" font-size:16px;"><strong>'.str_replace($search_text,$new_text,$document['employee_name']).'</strong></td>
</tr>
</table></td>
<td height="40" align="left" valign="top"><table align="left" cellpadding="0" cellspacing="0">
<tr>
<td height="30" style=" font-size:16px;">&nbsp;</td>
</tr>
<tr>
<td height="30" style=" font-size:16px;"><strong>'.str_replace($search_text,$new_text,$document['note_type']).'</strong></td>
</tr>
</table></td>
</tr>
<tr>
<td height="40" colspan="3" align="left" valign="top"><table align="left" cellpadding="0" cellspacing="0">
<tr>
<td height="30" style=" font-size:16px;">Anteckningar</td>
</tr>
<tr>
<td height="30" style=" font-size:16px;"><strong>'.str_replace($search_text,$new_text,$document['notes']).'</strong></td>
</tr>
</table></td>
</tr>
<tr>
<td align="left" valign="top"><table align="left" cellpadding="0" cellspacing="0">
<tr>
<td height="30" style=" font-size:16px;">Datum skapat</td>
</tr>
<tr>
<td height="30" style=" font-size:16px;"><strong>'.str_replace($search_text,$new_text,$document['created_date']).'</strong></td>
</tr>
</table></td>
<td height="40" colspan="2" align="left" valign="top"><table align="left" cellpadding="0" cellspacing="0">
<tr>
<td height="30" style=" font-size:16px;">Datum avslutat</td>
</tr>
<tr>
<td height="30" style=" font-size:16px;"><strong>'.str_replace($search_text,$new_text,$document['completed_date']).'</strong></td>
</tr>
</table></td>
</tr>
<tr>
<td align="left" valign="top"><table align="left" cellpadding="0" cellspacing="0">
<tr>
<td height="30" style=" font-size:16px;">Prioritet</td>
</tr>
<tr>
<td height="30" style=" font-size:16px;"><strong>'.str_replace($search_text,$new_text,$document['priority']).'</strong></td>
</tr>
</table></td>
<td height="40" colspan="2" align="left" valign="top"><table align="left" cellpadding="0" cellspacing="0">
<tr>
<td height="30" style=" font-size:16px;">Status</td>
</tr>
<tr>
<td height="30" style=" font-size:16px;"><strong>'.str_replace($search_text,$new_text,$document['status']).'</strong></td>
</tr>
</table></td>
</tr>
<tr>
<td align="left" valign="top" height="40" colspan="3" ><table align="left" cellpadding="0" cellspacing="0">

<tr>
<td height="30" style=" font-size:16px;">Anteckningar</td>
</tr>
<tr>
<td height="30" style=" font-size:16px;"><strong>'.str_replace($search_text,$new_text,$document['description']).'</strong></td>
</tr>
</table></td>
</tr>
</table>';
        echo "<br><br>";
    }
}else{
    echo $smarty->translate[no_data_available];
}
?>

  

</body>
</html>
