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
	<table class="table table-bordered table-condensed table-hover table-responsive table-primary " style="margin: 0px ! important; top: 0px; z-index: 0;" id="addform">
        <thead>
	<tr>
		<th colspan="3" class="table-col-center center">'.$smarty->localise->contents["from_date"].' : '.$_POST["fromdate"].'  '.$smarty->localise->contents["to_date"].' : '.$_POST["todate"].'</th>
	</tr>
	<tr>
		<th class="table-col-center center">'.$smarty->localise->contents["day"].'</th>
		<th class="table-col-center center">'.$smarty->localise->contents["preferred_time"].'<br>'.$smarty->localise->contents["message_for_preferred_time_format"].'</th>
		<th class="table-col-center center">'.$smarty->localise->contents["book_overtime"].'</th>
	</tr>
        </thead><tbody>';
for($WeekCounter = 0 ; $WeekCounter < count($WeekDays); $WeekCounter++)
{
	echo '<tr class="gradeX">
		<td class="center table-column-success ">'.$smarty->localise->contents[$WeekDays[$WeekCounter]].'</td>
		<td class="center table-column-success ">
		<input type="text" name="txtday'.$WeekCounter.'" id="txtday'.$WeekCounter.'" value="" tabindex="'.($WeekCounter+1).'" />
		 <input type="text" name="error'.$WeekCounter.'" value="'.$smarty->localise->contents["invalid_time_slot"].'" style="color:red; border:none; display:none; background:#DAF2F7;" disabled="disabled" />
		</th>
		<th class="center table-column-success "><input type="checkbox" name="chkday'.$WeekCounter.'" id="chkday'.$WeekCounter.'" value="1" /></th>
	</tr>
	';
}
	echo '
	<tr class="gradeX" >
		<th colspan="3" class="center table-column-success ">
		<input type="submit" name="save" id="save" class="btn btn-success btn-normal" style="color:#fff !important; margin:20px 0 20px 0;" value="'.$smarty->localise->contents["save"].'" onclick="validaddform(); return false;"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="button" name="cancel" style="margin:20px 0 20px 0;" class="btn btn-danger btn-normal"  value="'.$smarty->localise->contents["cancel"].'" onclick="document.getElementById(\'addform\').style.display = \'none\';"/>
		</th>
	</tr>
        </tbody>
	</table>
	<input type="hidden" name="hdn_employee" id="hdn_employee" value="'.$_POST["employee"].'" / >
	<input type="hidden" name="hdn_fromdate" id="hdn_fromdate" value="'.$_POST["fromdate"].'" / >
	<input type="hidden" name="hdn_todate" id="hdn_todate" value="'.$_POST["todate"].'" / >
	<input type="hidden" name="hdn_ajax_submit" id="hdn_ajax_submit" value="1"/>
	</form>';
exit;
?>