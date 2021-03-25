<?php
require_once('class/setup.php');
//require_once('class/equipment.php');
require_once('class/newcustomer.php');
require_once('class/newemployee.php');
$smarty = new smartySetup(array("user.xml","month.xml","messages.xml","button.xml","forms.xml","reports.xml"), FALSE);
//$equipment = new equipment();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 6));
//$customer = new newcustomer();
$employee = new newemployee();


$check_employee_in_table = $employee->validate_preferred_time($_POST["employee"],$_POST["fromdate"],$_POST["todate"]);
if($check_employee_in_table)
{
	echo '<div style="color:red;" align="center">'.$smarty->localise->contents["date_for_preferred_time_is_already_there"].'</div>';	
	exit;
}


$WeekDays = array('monday','tuesday','wednesday','thursday','friday','saturday','sunday');
//echo count($WeekDays);

	echo '
	<form method="post" action=""  id="week_form" >
	<table class="table_list tbl_padding_fix" id="addform">
	<tr>
		<th colspan="8" align="left">'.$smarty->localise->contents["from_date"].' : '.$_POST["fromdate"].'  '.$smarty->localise->contents["to_date"].' : '.$_POST["todate"].'</th>
	</tr>
	<tr>
		<th align="center" width="100">'.$smarty->localise->contents["day"].'</th>
		<th align="center" colspan="6" width="700">'.$smarty->localise->contents["preferred_time"].'<br>'.$smarty->localise->contents["message_for_preferred_time_format"].'</th>
		<th align="center" width="71">'.$smarty->localise->contents["book_overtime"].'</th>
	</tr>';
for($WeekCounter = 0 ; $WeekCounter < count($WeekDays); $WeekCounter++)
{
	echo '<tr class="odd">
		<th align="left" width="100">'.$smarty->localise->contents[$WeekDays[$WeekCounter]].'</th>
		<th align="center" colspan="6" width="700">
		<input type="text" name="txtday'.$WeekCounter.'" id="txtday'.$WeekCounter.'" value="" style="width:633px !important;" tabindex="'.($WeekCounter+1).'" />
		 <input type="text" name="error'.$WeekCounter.'" value="'.$smarty->localise->contents["invalid_time_slot"].'" style="width:633px !important; color:red; border:none; display:none; background:#DAF2F7;" disabled="disabled" />
		</th>
		<th align="center" width="71"><input type="checkbox" name="chkday'.$WeekCounter.'" id="chkday'.$WeekCounter.'" value="1" /></th>
	</tr>
	';
}
	echo '
	<tr class="odd">
		<th colspan="8" align="center">
		<input type="submit" name="save" id="save" value="'.$smarty->localise->contents["save"].'" onclick="validaddform(); return false;"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="button" name="cancel"  value="'.$smarty->localise->contents["cancel"].'" onclick="document.getElementById(\'addform\').style.display = \'none\';"/>
		</th>
	</tr>
	</table>
	<input type="hidden" name="hdn_employee" id="hdn_employee" value="'.$_POST["employee"].'" / >
	<input type="hidden" name="hdn_fromdate" id="hdn_fromdate" value="'.$_POST["fromdate"].'" / >
	<input type="hidden" name="hdn_todate" id="hdn_todate" value="'.$_POST["todate"].'" / >
	<input type="hidden" name="hdn_ajax_submit" id="hdn_ajax_submit" value="1"/>
	</form>';
exit;

/*if(isset($_POST) && $_POST != '')
{
	
	echo <table class="table_list tbl_padding_fix">
                <tr>
                    <th colspan="8" align="left">{$translate.from_date} :  {$translate.to_date} :</th>
                </tr>
                <tr>
                    <th align="center" width="100">Day</th>
                    <th align="center" colspan="6" width="700">Preferred Time</th>
                    <th align="center" width="71">Book Overtime</th>
                </tr>
                <tr class="odd">
                    <td align="center">Monday</td>
                    <td align="center" colspan="6">&nbsp;</td>
                    <td align="center">Book Overtime</td>
                </tr>
                 <tr class="odd">
                    <td align="center">Tuesday</td>
                    <td align="center" colspan="6">&nbsp;</td>
                    <td align="center">Book Overtime</td>
                </tr>
                 <tr class="odd">
                    <td align="center">wednesday</td>
                    <td align="center" colspan="6">&nbsp;</td>
                    <td align="center">Book Overtime</td>
                </tr>
                 <tr class="odd">
                    <td align="center">Thrusday</td>
                    <td align="center" colspan="6">&nbsp;</td>
                    <td align="center">Book Overtime</td>
                </tr>
                 <tr class="odd">
                 	<td align="center">Friday</td>
                    <td align="center" colspan="6">&nbsp;</td>
                    <td align="center">Book Overtime</td>
                </tr>
                 <tr class="odd">
                 	<td align="center">Saturday</td>
                    <td align="center" colspan="6">&nbsp;</td>
                    <td align="center">Book Overtime</td>
                </tr>
                 <tr class="odd">
                 	<td align="center">Sunday</td>
                    <td align="center" colspan="6">&nbsp;</td>
                    <td align="center">Book Overtime</td>
                </tr>
            </table>
	
}*/
?>