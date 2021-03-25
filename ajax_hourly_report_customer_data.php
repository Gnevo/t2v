<?php

require_once('class/setup.php');
require_once('class/newcustomer.php');
require_once('class/equipment.php');
require_once ('plugins/date_calc.class.php');

$smarty = new smartySetup(array("user.xml", "month.xml", "messages.xml", "button.xml", "forms.xml", "reports.xml"), FALSE);

$customer = new newcustomer();
$equipment = new equipment();
$date = new datecalc();

$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 6));
$uri = substr($_SERVER['REQUEST_URI'], 0, -1);
$pram = explode('/', $uri);
$totparam = count($pram);
$todate = $pram[$totparam - 1];
$fromdate = $pram[$totparam - 2];
$name = str_replace('_', ' ', $pram[$totparam - 3]);

$Cust_Details = $customer->getcustomer($name);
$social_security = $Cust_Details[0]['social_security'];
$Cust_Social_No =  $Cust_Details[0]['century'] . substr($social_security, 0, 6) . "-" . substr($social_security, 6);
$Cust_Username = $Cust_Details[0]['username'];
$Cust_Address = $Cust_Details[0]['address'];
$Cust_City = $Cust_Details[0]['city'];
$Cust_PostCode = $Cust_Details[0]['post'];
if ($Cust_City != '') {
    $Cust_City = ',' . $Cust_City;
}
if ($Cust_PostCode != '') {
    $Cust_PostCode = ',' . $Cust_PostCode;
}



echo $ssnhtml = ' <div class="row-fluid"><div class="pagention span12">            
<span style="margin:7px; float:left;"><b>' . $smarty->localise->contents['SSN'] . ' : </b>' . $Cust_Social_No . ' <b>' . $smarty->localise->contents['address'] . ' : </b> ' . $Cust_Address . ' ' . $Cust_City . ' ' . $Cust_PostCode . '</span>
</div></div>';

$year = date('o', strtotime($fromdate));

$chunk_fromdate = explode('-', $fromdate);
$fromday = $chunk_fromdate[2];
$frommonth = $chunk_fromdate[1];
//$fromyear = $chunk_fromdate[0];
$fromyear = date('o',strtotime($fromdate));

$chunk_todate = explode('-', $todate);
$today = $chunk_todate[2];
$tomonth = $chunk_todate[1];
$toyear = $chunk_todate[0];

$YearDiff = $toyear - $fromyear;
$years = $year;
if ($YearDiff > 0) {
    for ($y = 0; $y <= $YearDiff; $y++) {
        $YearArr[] = $years;
        $years++;
    }
} else {
    $YearArr[] = $years;
    if (date('W', strtotime($todate)) == "01" && date('m', strtotime($todate)) == "12") {
        $YearArr[] = $years + 1;
    }
}
$datas = array();

echo $htmlcontent = '
<div class="row-fluid"><div style="overflow-x:scroll; overflow-y:hidden;" class="span12"><table class="table_list tbl_padding_fix" style="width:100%"> 
                <tr>
					<th align="center">' . $smarty->localise->contents['week'] . '</th>
                    <th align="center" colspan="3">' . $smarty->localise->contents['mon'] . '</th>
                    <th align="center" colspan="3">' . $smarty->localise->contents['tue'] . '</th>
                    <th align="center" colspan="3">' . $smarty->localise->contents['wed'] . '</th>
                    <th align="center" colspan="3">' . $smarty->localise->contents['thu'] . '</th>
                    <th align="center" colspan="3">' . $smarty->localise->contents['fri'] . '</th>
                    <th align="center" colspan="3">' . $smarty->localise->contents['sat'] . '</th>
                    <th align="center" colspan="3">' . $smarty->localise->contents['sun'] . '</th>
					<th align="center" colspan="3">' . $smarty->localise->contents['total'] . '</th>
                </tr>
				<tr class="odd">
					<th>&nbsp;</th>
					<th>' . $smarty->localise->contents['regular'] . '</th>
					<th>' . $smarty->localise->contents['oncall_report_short'] . '</th>
                    <th>' . $smarty->localise->contents['unalloc_report_short'] . '</th>
					<th>' . $smarty->localise->contents['regular'] . '</th>
					<th>' . $smarty->localise->contents['oncall_report_short'] . '</th>
                    <th>' . $smarty->localise->contents['unalloc_report_short'] . '</th>
					<th>' . $smarty->localise->contents['regular'] . '</th>
					<th>' . $smarty->localise->contents['oncall_report_short'] . '</th>
                    <th>' . $smarty->localise->contents['unalloc_report_short'] . '</th>
					<th>' . $smarty->localise->contents['regular'] . '</th>
					<th>' . $smarty->localise->contents['oncall_report_short'] . '</th>
                    <th>' . $smarty->localise->contents['unalloc_report_short'] . '</th>
					<th>' . $smarty->localise->contents['regular'] . '</th>
					<th>' . $smarty->localise->contents['oncall_report_short'] . '</th>
                    <th>' . $smarty->localise->contents['unalloc_report_short'] . '</th>
					<th>' . $smarty->localise->contents['regular'] . '</th>
					<th>' . $smarty->localise->contents['oncall_report_short'] . '</th>
                    <th>' . $smarty->localise->contents['unalloc_report_short'] . '</th>
					<th>' . $smarty->localise->contents['regular'] . '</th>
					<th>' . $smarty->localise->contents['oncall_report_short'] . '</th>
                    <th>' . $smarty->localise->contents['unalloc_report_short'] . '</th>
					<th>' . $smarty->localise->contents['regular'] . '</th>
					<th>' . $smarty->localise->contents['oncall_report_short'] . '</th>
                    <th>' . $smarty->localise->contents['unalloc_report_short'] . '</th>
				</tr>';

$weeks = array();
$startTime = strtotime($fromdate);
$endTime = strtotime($todate);
if (date('N', $startTime) != 1) {
    $weeks[] = date('W', $startTime);
    $next_week_start_day = 7 - date('N', $startTime) + 1;
    $startTime = strtotime($fromdate . "+" . $next_week_start_day . " days");
}
while ($startTime < $endTime) {
    $weeks[] = date('W', $startTime);
    $startTime += strtotime('+1 week', 0);
}
$TotalWeek = count($weeks);
global $week;
$yearcnt = 0;
//echo 'N: '.date('N', $startTime);
//echo $fromdate;
//echo 'start date: '.date('Y-m-d', $startTime);
//echo 'end date: '.date('Y-m-d', $endTime);
for ($weekcounter = 0; $weekcounter < $TotalWeek; $weekcounter++) {
    $weekNo = $weeks[$weekcounter];
    $Total_schedule_Final = '';
    $week_no = sprintf("%02d", $weekNo);
    $i = 0;
    //Find OUT total hours for all employee in a week
    $Regular_Minutes_Total = '';
    $Oncall_Minutes_Total = '';
    $Unalloc_Minutes_Total = '';
    foreach ($week as $day) {

        $Total_schedule_Final = '';
        $datas[$weekcounter][$i]['day'] = $day;
        $date = date("Y-m-d", strtotime($YearArr[$yearcnt] . 'W' . $week_no . $day['id']));
        $datas[$weekcounter][$i]['date'] = $date;
        if ( strtotime($fromdate) <= strtotime($date) && strtotime($date) <= $endTime) {
            $Schedule_Regular_Hours = $equipment->time_user_format($customer->get_Regular_schedule_Hours_of_cust($Cust_Username, $date), 60);

            //$Schedule_Regular_leave_Hours = $customer->get_employee_Leave_hours_based_on_customer($Cust_Username,$date);//commented by shaju
            //calculation For slot 1 for regular hours Start		
            $Schedule_Regular_Hours = number_format((float) $Schedule_Regular_Hours, 2, '.', '');
            $Schedule_Regular_Hours_base = substr($Schedule_Regular_Hours, 0, -3);
            $Schedule_Regular_Hours_division = substr(strstr($Schedule_Regular_Hours, '.'), 1);
            $Schedule_Regular_Hours_Minutes = ($Schedule_Regular_Hours_base * 60) + $Schedule_Regular_Hours_division;

            //$Deducted_Regular_Minutes = ($Schedule_Regular_Hours_Minutes - $Schedule_Regular_leave_Hours);//commented this line and added next line by shaju
            $Deducted_Regular_Minutes = $Schedule_Regular_Hours_Minutes;

            if ($Deducted_Regular_Minutes > 0) {
                $Customer_Regular_Hours_with_deduction = floor($Deducted_Regular_Minutes / 60);
                $Customer_Regular_Minutes_with_deduction = $Deducted_Regular_Minutes % 60;
                $Customer_Regular_Total_Hours_Minutes = number_format($Customer_Regular_Hours_with_deduction . '.' . $Customer_Regular_Minutes_with_deduction, 2, '.', '');
            } else {
                $Customer_Regular_Total_Hours_Minutes = '--';
            }
            //calculation For slot 1 for regular hours End

            $Schedule_Unalloc_Hours = $equipment->time_user_format($customer->get_Unalloc_schedule_Hours_of_cust($Cust_Username, $date), 60);

            $Schedule_Unalloc_Hours = number_format((float) $Schedule_Unalloc_Hours, 2, '.', '');
            $Schedule_Unalloc_Hours_base = substr($Schedule_Unalloc_Hours, 0, -3);
            $Schedule_Unalloc_Hours_division = substr(strstr($Schedule_Unalloc_Hours, '.'), 1);
            $Schedule_Unalloc_Hours_Minutes = ($Schedule_Unalloc_Hours_base * 60) + $Schedule_Unalloc_Hours_division;

            $Deducted_Unalloc_Minutes = $Schedule_Unalloc_Hours_Minutes;

            if ($Deducted_Unalloc_Minutes > 0) {
                $Customer_Unalloc_Hours_with_deduction = floor($Deducted_Unalloc_Minutes / 60);
                $Customer_Unalloc_Minutes_with_deduction = $Deducted_Unalloc_Minutes % 60;
                $Customer_Unalloc_Total_Hours_Minutes = number_format($Customer_Unalloc_Hours_with_deduction . '.' . $Customer_Unalloc_Minutes_with_deduction, 2, '.', '');
            } else {
                $Customer_Unalloc_Total_Hours_Minutes = '--';
            }

            $Schedule_Oncall_Hours = $equipment->time_user_format($customer->get_Oncall_schedule_Hours_of_cust($Cust_Username, $date));
//                echo "<pre>". print_r($Schedule_Oncall_Hours, 1)."</pre>";
            //$Schedule_Oncall_leave_Hours = $customer->get_employee_Leave_hours_based_on_customer_type3($Cust_Username,$date);//commented by shaju
            //calculation For slot 2 for regular hours Start
            $Schedule_Oncall_Hours = number_format((float) $Schedule_Oncall_Hours, 2, '.', '');
            $Schedule_Oncall_Hours_base = substr($Schedule_Oncall_Hours, 0, -3);
            $Schedule_Oncall_Hours_division = substr(strstr($Schedule_Oncall_Hours, '.'), 1);
            $Schedule_Oncall_Hours_Minutes = ($Schedule_Oncall_Hours_base * 60) + $Schedule_Oncall_Hours_division;

            //$Deducted_Oncall_Minutes = ($Schedule_Oncall_Hours_Minutes - $Schedule_Oncall_leave_Hours);// commented and added new line by shaju
            $Deducted_Oncall_Minutes = $Schedule_Oncall_Hours_Minutes;
            if ($Deducted_Oncall_Minutes > 0) {
                $Customer_Oncall_Hours_with_deduction = floor($Deducted_Oncall_Minutes / 60);
                $Customer_Oncall_Minutes_with_deduction = $Deducted_Oncall_Minutes % 60;
                $Customer_Oncall_Total_Hours_Minutes = number_format($Customer_Oncall_Hours_with_deduction . '.' . $Customer_Oncall_Minutes_with_deduction, 2, '.', '');
            } else {
                $Customer_Oncall_Total_Hours_Minutes = '--';
            }
            //Total for regular and on call
            if ($Deducted_Regular_Minutes > 0) {
                $Regular_Minutes_Total += $Deducted_Regular_Minutes;
            }
            if ($Deducted_Oncall_Minutes > 0) {
                $Oncall_Minutes_Total += $Deducted_Oncall_Minutes;
            }
            if ($Deducted_Unalloc_Minutes > 0) {
                $Unalloc_Minutes_Total += $Deducted_Unalloc_Minutes;
            }

            $datas[$weekcounter][$i]['slots1'] = $Customer_Regular_Total_Hours_Minutes;
            $datas[$weekcounter][$i]['slots2'] = $Customer_Oncall_Total_Hours_Minutes;
            $datas[$weekcounter][$i]['slots3'] = $Customer_Unalloc_Total_Hours_Minutes;
        } else {
            if (date('N', $endTime) != 7) {
                $datas[$weekcounter][$i]['slots1'] = '--';
                $datas[$weekcounter][$i]['slots2'] = '--';
                $datas[$weekcounter][$i]['slots3'] = '--';
            }
        }
        $i++;
    }
    if(in_array(53, $weeks))
    {
        if ($weekNo == 53) {
            $yearcnt++;
        }
    }else{
        if ($weekNo == 52) {
            $yearcnt++;
        }
    }

    $Regular_Minutes_Total_arr[$weekcounter] = $Regular_Minutes_Total;
    $Oncall_Minutes_Total_arr[$weekcounter] = $Oncall_Minutes_Total;
    $Unalloc_Minutes_Total_arr[$weekcounter] = $Unalloc_Minutes_Total;
}
//echo "<pre>".print_r($datas, 1)."</pre>";
for ($WeekCounter = 0; $WeekCounter < count($datas); $WeekCounter++) {
    echo "<tr class='odd'>";
    echo "<td align='center'>" . $weeks[$WeekCounter] . "</td>";
    for ($DayCounter = 0; $DayCounter < count($datas[$WeekCounter]); $DayCounter++) {
        if ($datas[$WeekCounter][$DayCounter]['slots1'] != "--")
            echo "<td align='center'>" . $equipment->time_user_format($datas[$WeekCounter][$DayCounter]['slots1'], 100) . "</td>";
        else
            echo "<td align='center'>" . $datas[$WeekCounter][$DayCounter]['slots1'] . "</td>";
        if ($datas[$WeekCounter][$DayCounter]['slots2'] != "--")
            echo "<td align='center'>" . $equipment->time_user_format($datas[$WeekCounter][$DayCounter]['slots2'], 100) . "</td>";
        else
            echo "<td align='center'>" . $datas[$WeekCounter][$DayCounter]['slots2'] . "</td>";
        if ($datas[$WeekCounter][$DayCounter]['slots3'] != "--")
            echo "<td align='center'>" . $equipment->time_user_format($datas[$WeekCounter][$DayCounter]['slots3'], 100) . "</td>";
        else
            echo "<td align='center'>" . $datas[$WeekCounter][$DayCounter]['slots3'] . "</td>";
    }

    if ($Regular_Minutes_Total_arr[$WeekCounter] > 0) {
        $Reguar_Total_Count_Hours = floor($Regular_Minutes_Total_arr[$WeekCounter] / 60);
        $Reguar_Total_Count_Minutes = $Regular_Minutes_Total_arr[$WeekCounter] % 60;
        $Reguar_Total_Count_Hrs_Minutes = number_format($Reguar_Total_Count_Hours . '.' . $Reguar_Total_Count_Minutes, 2, '.', '');
    } else {
        $Reguar_Total_Count_Hrs_Minutes = '--';
    }

    if ($Oncall_Minutes_Total_arr[$WeekCounter] > 0) {
        $Oncall_Total_Count_Hours = floor($Oncall_Minutes_Total_arr[$WeekCounter] / 60);
        $Oncall_Total_Count_Minutes = $Oncall_Minutes_Total_arr[$WeekCounter] % 60;
        $Oncall_Total_Count_Hrs_Minutes = number_format($Oncall_Total_Count_Hours . '.' . $Oncall_Total_Count_Minutes, 2, '.', '');
    } else {
        $Oncall_Total_Count_Hrs_Minutes = '--';
    }

    if ($Unalloc_Minutes_Total_arr[$WeekCounter] > 0) {
        $Unalloc_Total_Count_Hours = floor($Unalloc_Minutes_Total_arr[$WeekCounter] / 60);
        $Unalloc_Total_Count_Minutes = $Unalloc_Minutes_Total_arr[$WeekCounter] % 60;
        $Unalloc_Total_Count_Hrs_Minutes = number_format($Unalloc_Total_Count_Hours . '.' . $Unalloc_Total_Count_Minutes, 2, '.', '');
    } else {
        $Unalloc_Total_Count_Hrs_Minutes = '--';
    }

    if ($Reguar_Total_Count_Hrs_Minutes != '--')
        echo "<td align='center'>" . $equipment->time_user_format($Reguar_Total_Count_Hrs_Minutes, 100) . "</td>";
    else
        echo "<td align='center'>" . $Reguar_Total_Count_Hrs_Minutes . "</td>";
    if ($Oncall_Total_Count_Hrs_Minutes != "--")
        echo "<td align='center'>" . $equipment->time_user_format($Oncall_Total_Count_Hrs_Minutes, 100) . "</td>";
    else
        echo "<td align='center'>" . $Oncall_Total_Count_Hrs_Minutes . "</td>";
    if ($Unalloc_Total_Count_Hrs_Minutes != "--")
        echo "<td align='center'>" . $equipment->time_user_format($Unalloc_Total_Count_Hrs_Minutes, 100) . "</td>";
    else
        echo "<td align='center'>" . $Unalloc_Total_Count_Hrs_Minutes . "</td>";
    echo "</tr>";
}
echo '</table></div></div>';
exit;
?>