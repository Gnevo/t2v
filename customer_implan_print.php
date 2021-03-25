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
$user_detail = $customer->customer_detail($username);
$implans = $customer->get_all_implan_print($username,$search_type,$month,$year,$date_from,$date_to,$search_text);
$new_text = '<span style="color: #ff0000;">'.$search_text.'</span>';
//$new_text = strtoupper($search_text);
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
if($implans){
    echo $tables;
?>
    <br><br>
<?php
    foreach($implans AS $implan){
        $travel = explode(",",$implan['travel']);
        $travels = '';
        $travel_types = $smarty->travel_type;
        $travel_types_keys = array_keys($smarty->travel_type);
        for($i=0;$i<count($travel);$i++){
            for($j=1;$j<count($travel_types_keys);$j++){
                if($travel[$i] == $travel_types_keys[$j]){
                    if($travels == ''){
                       $travels = $travel_types[$j]; 
                    }else{
                        $travels = $travels.",".$travel_types[$j];
                    }
                }
            }
        }
        echo "<table  border='1' bordercolor='#000000' cellpadding='0' cellspacing='0' style='font-family:Arial, Helvetica, sans-serif; font-size:14px; width: 21cm'>
  <tr style='background-color: #DCDCDC'>
    <td height='40' align='left' valign='top'><table align='left' cellpadding='0' cellspacing='0'>
        <tr>
          <td height='30' style=' font-size:16px;'>Datum</td>
        </tr>
        <tr>
          <td height='30' style=' font-size:16px;'><strong>".str_replace($search_text,$new_text,$implan['date'])."</strong></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height='40' align='left' valign='top'><table align='left' cellpadding='0' cellspacing='0'>
        <tr>
          <td height='30' style=' font-size:16px;'>Bakgrund, historik</td>
        </tr>
        <tr>
          <td height='30' style=' font-size:16px;'><strong>".str_replace($search_text,$new_text,$implan['history'])."</strong></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height='40' align='left' valign='top'><table align='left' cellpadding='0' cellspacing='0'>
        <tr>
          <td height='30' style=' font-size:16px;'>Diagnos</td>
        </tr>
        <tr>
          <td height='30' style=' font-size:16px;'><strong>".str_replace($search_text,$new_text,$implan['diagnosis'])."</strong></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height='40' align='left' valign='top'><table align='left' cellpadding='0' cellspacing='0'>
        <tr>
          <td height='30' style=' font-size:16px;'>Beskrivning av uppdraget</td>
        </tr>
        <tr>
          <td height='30' style=' font-size:16px;'><strong>".str_replace($search_text,$new_text,$implan['mission'])."</strong></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height='40' align='left' valign='top'><table align='left' cellpadding='0' cellspacing='0'>
        <tr>
          <td height='30' style=' font-size:16px;'>Syfte med insatsen</td>
        </tr>
        <tr>
          <td height='30' style=' font-size:16px;'>".str_replace($search_text,$new_text,$implan['email'])."</strong></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height='40' align='left' valign='top'><table align='left' cellpadding='0' cellspacing='0'>
        <tr>
          <td height='30' style=' font-size:16px;'>När och hur insatsen skall genomföras</td>
        </tr>
        <tr>
          <td height='30' style=' font-size:16px;'><strong>".str_replace($search_text,$new_text,$implan['intervention'])."</strong></td>
        </tr>
    </table></td>
  </tr>
</table>
    
<table  border='1' cellpadding='0' cellspacing='0' style='font-family:Arial, Helvetica, sans-serif; font-size:14px; width: 21cm'>
  <tr>
    <td height='40' align='left' valign='top'><table align='left' cellpadding='0' cellspacing='0'>
        <tr>
          <td height='30' style=' font-size:16px;'>Arbete</td>
        </tr>
        <tr>
          <td height='30' style=' font-size:16px;'><strong>".str_replace($search_text,$new_text,$implan['work'])."</strong></td>
        </tr>
    </table></td>
    <td height='40' align='left' valign='top'><table align='left' cellpadding='0' cellspacing='0'>
        <tr>
          <td height='30' style=' font-size:16px;'>Telefon</td>
        </tr>
        <tr>
          <td height='30' style=' font-size:16px;'><strong>".str_replace($search_text,$new_text,$implan['phone'])."</strong></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height='40' colspan='2' align='left' valign='top'><table align='left' cellpadding='0' cellspacing='0'>
        <tr>
          <td height='30' style=' font-size:16px;'>Kommentar</td>
        </tr>
        <tr>
          <td height='30' style=' font-size:16px;'><strong>".str_replace($search_text,$new_text,$implan['work_comment'])."</strong></td>
        </tr>
    </table></td>
  </tr>
</table>
          
<table  border='1' cellpadding='0' cellspacing='0' style='font-family:Arial, Helvetica, sans-serif; font-size:14px; width: 21cm'>
  <tr>
    <td height='40' align='left' valign='top'><table align='left' cellpadding='0' cellspacing='0'>
        <tr>
          <td height='30' style=' font-size:16px;'>Resor</td>
        </tr>
        <tr>
          <td height='30' style=' font-size:16px;'><strong>".$travels."</strong></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height='40' align='left' valign='top'><table align='left' cellpadding='0' cellspacing='0'>
        <tr>
          <td height='30' style=' font-size:16px;'>Kommentar</td>
        </tr>
        <tr>
          <td height='30' style=' font-size:16px;'><strong>".str_replace($search_text,$new_text, $implan['travel_comment'])."</strong></td>
        </tr>
    </table></td>
  </tr>
</table>";
        echo "<br><br>";
    }
}else{
    echo $smarty->translate[no_data_available];
}
?>
   
</body>
</html>