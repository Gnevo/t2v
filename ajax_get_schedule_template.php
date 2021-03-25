<?php

//Rahul : ajax_auto_scheduler.php
require_once('class/setup.php');
require_once('class/newcustomer.php');
require_once('class/newemployee.php');
require_once('class/customer.php');
require_once ('plugins/date_calc.class.php');
$smarty = new smartySetup(array("gdschema.xml", "month.xml", "button.xml", "messages.xml", "user.xml"), FALSE);
$dateobj = new datecalc();
$obj_customer = new customer();
$newcustomer = new newcustomer();
$newemployee = new newemployee();

$uri = substr($_SERVER['REQUEST_URI'], 0, -1);
$pram = explode('/', $uri);
$tot = sizeof($pram);
$customer = $pram[$tot - 3];
$start_date = $pram[$tot - 2];
$end_date = $pram[$tot - 1];

$sdate = $start_date;
$edate = $end_date;

$ResultArray = array();
$ResultArray = $newcustomer->getCustomerSchedule($customer, $start_date, $end_date);


$fromdate = $start_date;
$MaxDate = $end_date;
$todate = $end_date;
if ($fromdate == '0000-00-00') {
    $fromdate = date('Y-m-d');
    $chunk_fromdate = explode('-', $fromdate);
    $FromDay = $chunk_fromdate[2];
    $FromMonth = $chunk_fromdate[1];
    $FromYear = $chunk_fromdate[0];
    $date = mktime(0, 0, 0, $FromMonth, $FromDay, $FromYear);
    $week = (int) date('W', $date);
} else {
    $chunk_fromdate = explode('-', $fromdate);
    $FromDay = $chunk_fromdate[2];
    $FromMonth = $chunk_fromdate[1];
    $FromYear = $chunk_fromdate[0];
    $date = mktime(0, 0, 0, $FromMonth, $FromDay, $FromYear);
    $week = (int) date('W', $date);
}


//$fromdate = $CheckYeardate;
$chunk_todate = explode('-', $MaxDate);
$today = $chunk_todate[2];
$tomonth = $chunk_todate[1];
$toyear = $chunk_todate[0];
$YearDiff = $MaxDate - $fromdate;
$years = $FromYear;
if ($YearDiff > 0) {
    for ($y = 0; $y <= $YearDiff; $y++) {
        $YearArr[] = $years;
        $years++;
    }
} else {
    $YearArr[] = $FromYear;
}

$YearsString = implode('|', $YearArr);

$diff = $dateobj->get_days($fromdate, $MaxDate);
$totWeeks = ceil(count($diff) / 7) + 1;

$year_week = $YearsString . '|' . $week;
$week_position = 1;

//$week_numbers = $dateobj->get_weeks_moreyears_new($year_week, $totWeeks, $week_position);
$week_numbers = $dateobj->get_weeks_moreyears_new($year_week, $totWeeks, $week_position, $start_date);

//Add Dates in week array
$cnt = 0;
$flag = 0;
$emp_assign_array = array();
foreach ($week_numbers as $week_number) {
    if ($week_number['date'] > $MaxDate) {
        break;
    }

    $ts = strtotime($week_number['date']);
    $dow = date('w', $week_number['date']);
    $offset = $dow - 1;
    if ($offset < 0) {
        $offset = 6;
    }
    for ($i = 0; $i < 7; $i++, $ts += 86400) {
        //$week_numbers[$cnt]['week'][] = date("Y-m-d l", $ts);
        $week_numbers[$cnt]['week'][] = date("Y-m-d", $ts);
        $myday = date("d", $ts);
        $mymonth = date("m", $ts);
        if ($myday == 30 || $myday == 31 && $mymonth != 2) {
            $flag = 1;
        } else if ($myday == 29 && $mymonth == 2) {
            $flag = 1;
        }
        if ($week_number['value'] == 'V02') {
            $flag = 0;
        }
    }
    $cnt++;
}

$listr .= '<ul class="weeks">';
$showhidecounter = 0;
$week_date = array();
$l = 0;
foreach ($week_numbers as $week_number) {

    if ($showhidecounter > 14) {
        $MyStyle = 'style="display:none;width:52px;"';
    } else {
        $MyStyle = 'style="width:54px;"';
    }

    if (@in_array($sdate, $week_number["week"])) {
        $l = 1;
        $listr .= '<li ' . $MyStyle . ' id="' . $customer . 'class' . $showhidecounter . '" class="active" onclick="showhide(' . $cnt . ',' . $showhidecounter . ',\'' . $customer . '\')"><a href="javascript:void(0);">' . $week_number["value"] . '</a></li>';
        $showhidecounter++;

        if (@in_array($edate, $week_number["week"])) {
            $l = 0;
        }
    } else {

        if ($l == 1) {
            $listr .= '<li ' . $MyStyle . ' id="' . $customer . 'class' . $showhidecounter . '" onclick="showhide(' . $cnt . ',' . $showhidecounter . ',\'' . $customer . '\')"><a href="javascript:void(0);">' . $week_number["value"] . '</a></li>';
            $showhidecounter++;
        }

        if (@in_array($edate, $week_number["week"])) {
            $l = 0;
        }
    }
    if ($week_number["week"] != "") {
        $week_date[] = $week_number["week"];
    }
}
$listr .= '</ul>';

if (!empty($ResultArray)) {   //$smarty->localise->contents[$DaysName[$daycounter]]
    $DaysName = array("Mon" => 'monday', "Tue" => 'tuesday', "Wed" => 'wednesday', "Thu" => 'thursday', "Fri" => 'friday', "Sat" => 'saturday', "Sun" => 'sunday');
    $WeekHtml .= '
					<input type="hidden" name="hdn_total" id="hdn_total" value="' . $cnt . '" />
					<input id="hdn_start" type="hidden" value="0" name="hdn_start">
					<input id="hdn_end" type="hidden" value="14" name="hdn_end">';
    $f = 0;
    foreach ($week_date as $curweek) {
        $show = "";
        if (!in_array($sdate, $curweek)) {
            $show = 'style="float:left;margin-left:8px;;border:1px solid #C6C6C6;display:none;"';
        } else {
            $show = 'style="float:left;margin-left:8px;;border:1px solid #C6C6C6;"';
        }

        $ResultArray = $newcustomer->getCustomerSchedule($customer, $curweek[0], $curweek[6]);

        if (empty($ResultArray)) {
            /* 	$WeekHtml .= '<div id="'.$customer.$f.'" style="display:none;border:none;"  ><a class="time_slot_btn_add"  href="javascript:void(0);">'.$smarty->localise->contents['no_slot'].'</a></div>';	 */
            $WeekHtml .= '<div id="' . $customer . $f . '" class="fixedArea" ' . $show . ' >
									<div id="slot_list_week">';
            foreach ($curweek as $cedate) {
                $get_slote_per_date = $newcustomer->get_slote_per_date($cedate, $customer);
                if (empty($get_slote_per_date)) {
                    $WeekHtml .= '<div id="myid0" class="customer_week" style="width:120px;" >
										<a class="customer_week_days" style="width:120px;">' .
                            $smarty->localise->contents[$DaysName[date("D", strtotime($cedate))]] . '<br>' . $cedate . '</a><a class="time_slot_btn_add"  >' . $smarty->localise->contents['no_slot'] . '</a></div>';
                }
            }
            $WeekHtml .= '</div></div>';
        }
        if (!empty($ResultArray)) {
            $WeekHtml .= '<div id="' . $customer . $f . '" class="fixedArea" ' . $show . ' >
									<div id="slot_list_week">';
            $curr_date = '1';

            //foreach($ResultArray as $timeTableData){	
            foreach ($curweek as $timeTableData) {

                if (($curr_date != $timeTableData) || $curr_date == 1) {
                    $WeekHtml .= '<div id="myid0" class="cstmr_wk_main customer_week" style="width:120px;" >
									<a class="customer_week_days" style="width:120px;" >' . $smarty->localise->contents[$DaysName[date("D", strtotime($timeTableData))]] . '<br>' . $timeTableData . '</a>';
                }
                $get_slote_per_date = $newcustomer->get_slote_per_date($timeTableData, $customer);
                if (sizeof($get_slote_per_date) > 0) {
                    foreach ($get_slote_per_date as $slote) {
//										$s_diff = $slote['time_to'] - $slote['time_from'];
                        $s_diff = $obj_customer->time_difference($slote['time_from'], $slote['time_to'], 100);

                        $EmpUname = '';
                        $EmpFname = '';
                        $EmplName = '';
                        $hex = "";
                        $class = "time_slot_incomplete";
                        $type_class = '<span class="work"></span>';
                        if ($slote['type'] == 3)
                            $type_class = '<span class="oncall"></span>';
                        if ($slote['employee'] != '') {
                            $err1 = $newcustomer->check_employee_leave_customer($slote['employee'], $customer);
                            $err2 = $newcustomer->check_leave_employee_to_template_set($slote['employee'], $NewDate, $slote['time_to']);
                            $err3 = $newcustomer->check_employee_schedule_to_other_customer($slote['employee'], $slote['customer'], $NewDate, $slote['time_from'], $slote['time_to']);
                            $err_sum = $err1 + $err2 + $err3;

                            if ($err_sum == 0) {
                                $class = "time_slot_btn";
                                $AvlEmpDetails = $newemployee->get_employee_detail($slote['employee'], "");
                                $EmpUname = $AvlEmpDetails['username'];
                                $EmpFname = $AvlEmpDetails['first_name'];
                                $EmplName = $AvlEmpDetails['last_name'];

                                $hex = "#";
                                $hex .= str_pad(dechex($AvlEmpDetails['color']['r']), 2, "0", STR_PAD_LEFT);
                                $hex .= str_pad(dechex($AvlEmpDetails['color']['g']), 2, "0", STR_PAD_LEFT);
                                $hex .= str_pad(dechex($AvlEmpDetails['color']['b']), 2, "0", STR_PAD_LEFT);
                            }
                        }
                        if ($slote["fkkn"] == 1) {
                            $fkkn = '<img src="' . $smarty->url . 'images/icon_fk.gif">';
                        } else {
                            $fkkn = '<img src="' . $smarty->url . 'images/icon_kn.gif">';
                        }
                        $WeekHtml .= '<a class="' . $class . '" style="width:106px;" >
										<div class="block_left_color">
										<span class="fkkn_type">
											' . $fkkn . '
										</span>
										<span class="color_code" style="background-color: ' . $hex . ';"></span>
										</div>
										<div class="single_sloat_detail" style="width:87px;" >
										<span class="customer_week_time">' . $slote['time_from'] . '-' . $slote['time_to'] . ' (' . $s_diff . ')</span>' .
                                $type_class .
                                '<span class="customer_used_item">';
                        if ($_SESSION['company_sort_by'] == 1)
                            $WeekHtml .= '<span>' . (strlen($EmpFname . ' ' . $EmplName) > 10 ? substr($EmpFname . ' ' . $EmplName, 0, 7) . '...' : $EmpFname . ' ' . $EmplName) . '</span>';
                        elseif ($_SESSION['company_sort_by'] == 2)
                            $WeekHtml .= '<span>' . (strlen($EmpFname . ' ' . $EmplName) > 10 ? substr($EmplName . ' ' . $EmpFname, 0, 7) . '...' : $EmplName . ' ' . $EmpFname) . '</span>';
                        $WeekHtml .= '</span>
										</div>
										</a>';
                    }
                }else {
                    $WeekHtml .= '<a class="time_slot_btn_add"  >' . $smarty->localise->contents['no_slot'] . '</a>';
                }

                if (($curr_date != $timeTableData) || $curr_date == 1) {
                    $WeekHtml .= '</div>';
                }
                $curr_date = $timeTableData;
            }
            $WeekHtml .= '</div>
							
					</div>';
            $WeekHtml .='</div>
				 </div>';
        }
        $f++;
    }

    $newCode = '<div style="float: left; clear: both; margin-left: 287px; width: 445px;" >
					<a onclick="popup_template(\'save/schedule/' . $customer . '/' . $start_date . '/' . $end_date . '/\')" ><div style="cursor: pointer; float: left; clear: both;" class="week_num">
					' . $smarty->localise->contents['save_template'] . '</div></a>
					<a href="javascript:void(0)" onclick="popup(\'copy/schedule/' . $customer . '/' . $start_date . '/' . $end_date . '/\')"
					 ><div style="cursor: pointer; text-align: center; width: 169px;" class="week_num">
					' . $smarty->localise->contents['copy_to_another_customer'] . '</div></a>
				</div>';


    echo '<div id="tble_list" class="scroll_fix" style="width:866px;border:none;" >
		<input type="hidden" name="' . $customer . 'showdiv" id="' . $customer . 'showdiv" value="1" />
		<div id="tableDiv_General" class="tableDiv scroll_fix" style="padding-left:5px;width:867px;" >
			<div class="week_strip clearfix">
				<div class="arrow_left">
					<a href="javascript:void(0);" onclick="nextprev(\'prev\',\'' . $customer . '\');"></a>
				</div>' . $listr . '<div class="arrow_right"><a href="javascript:void(0);" onclick="nextprev(\'next\',\'' . $customer . '\');" ></a></div>
			</div>
			' . $WeekHtml . $newCode . '               
		</div>
	</div>';

    exit;
} else {
    $html = '<div id="timetable_assign" style="background:none repeat scroll 0 0 #FFFFFF;border:3px solid #D8D8D8; !important;!important; margin-left:8px !important; width:847px !important;height:14px;position:relative; ">							
	<div id="options" class="clearfix" style="border:none !important;position:relative;	">
	<span style="float:right; left:0px !important;  z-index:999999 !important; margin-left:-20px; margin-top:-7px; height:17px; width:19px; background:#daf2f7; color:red; cursor:pointer;vertical-align:middle;padding:1px 0px 0px 5px;" align="center" onclick="closeit();">&nbsp;X&nbsp;</span>	
		<div id="assigned_slots" style="position: absolute;border:none; top: 0px;text-align:center;font-weight:bold;width:90%;">
			' . $smarty->localise->contents['no_schedule_available'] . '</div>
		</div>							
	</div>';
//End - Create Edit employee for slot POPUP	
    echo $html;
    exit;
}
exit;
?>