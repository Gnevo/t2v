<?php
require_once('plugins/MPDF54/mpdf.php');
require_once('class/setup.php');
require_once('class/leave.php');
require_once('class/user.php');
//$obj_user = new user();
$smarty = new smartySetup(array("user.xml","messages.xml","button.xml","reports.xml","month.xml"));
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 6));
$leave = new leave();
$user = new user();
$login_user = $_SESSION['user_id'];
$privileges = $user->get_privileges($login_user, 5);
$login_user_role = $user->user_role($login_user);
$from_date = ($_POST['from_date'] ? $_POST['from_date'] : date('Y-m-d'));
$to_date = ($_POST['to_date'] ? $_POST['to_date'] : date('Y-m-d'));
$year = ($_POST['year'] ? $_POST['year'] : date('Y'));
$month = ($_POST['month'] ? $_POST['month'] : date('n'));
$search_from = $year . '-' . sprintf('%02d', $month) . '-01';
$search_to = $year . '-' . sprintf('%02d', $month) . '-31';
$smarty->assign('from_date', $from_date);
$smarty->assign('to_date', $to_date);
$smarty->assign('year', $year);
$smarty->assign('month', $month);
$absence_datas = array();
$attendance_datas = array();
if($_POST['action'] == 'show' || $_POST['action'] == 'csv' || $_POST['action'] == 'excel' || $_POST['action'] == 'pdf'){
    //getting day absence employee count
    $men_employee_leave_day_count = $leave->get_employees_leave_count($from_date, $to_date, 1);
    $women_employee_leave_day_count = $leave->get_employees_leave_count($from_date, $to_date, 2);
    $men_employee_ill_leave_day_count = $leave->get_employees_leave_count($from_date, $to_date, 1, 1);
    $women_employee_ill_leave_day_count = $leave->get_employees_leave_count($from_date, $to_date, 2, 1);
    $men_employee_vecation_leave_day_count = $leave->get_employees_leave_count($from_date, $to_date, 1, 2);
    $women_employee_vecation_leave_day_count = $leave->get_employees_leave_count($from_date, $to_date, 2, 2);
    $men_employee_other_leave_day_count = $leave->get_employees_leave_count($from_date, $to_date, 1, 3);
    $women_employee_other_leave_day_count = $leave->get_employees_leave_count($from_date, $to_date, 2, 3);
    $men_total_leave_day_count = ($men_employee_ill_leave_day_count + $men_employee_vecation_leave_day_count + $men_employee_other_leave_day_count);
    $women_total_leave_day_count = ($women_employee_ill_leave_day_count + $women_employee_vecation_leave_day_count + $women_employee_other_leave_day_count);
    $men_employee_attendance_day_count = $leave->get_employees_attendance_count($from_date, $to_date, 1);
    $women_employee_attendance_day_count = $leave->get_employees_attendance_count($from_date, $to_date, 2);
    $men_employee_appointed_day_count = $leave->get_employees_appointed_count($from_date, $to_date, 1);
    $women_employee_appointed_day_count = $leave->get_employees_appointed_count($from_date, $to_date, 2);
    $men_employee_quit_day_count = $leave->get_employees_quit_count($from_date, $to_date, 1);
    $women_employee_quit_day_count = $leave->get_employees_quit_count($from_date, $to_date, 2);

    //getting month absence employee count
    $men_employee_leave_month_count = $leave->get_employees_leave_count($search_from, $search_to, 1);
    $women_employee_leave_month_count = $leave->get_employees_leave_count($search_from, $search_to, 2);
    $men_employee_ill_leave_month_count = $leave->get_employees_leave_count($search_from, $search_to, 1, 1);
    $women_employee_ill_leave_month_count = $leave->get_employees_leave_count($search_from, $search_to, 2, 1);
    $men_employee_vecation_leave_month_count = $leave->get_employees_leave_count($search_from, $search_to, 1, 2);
    $women_employee_vecation_leave_month_count = $leave->get_employees_leave_count($search_from, $search_to, 2, 2);
    $men_employee_other_leave_month_count = $leave->get_employees_leave_count($search_from, $search_to, 1, 3);
    $women_employee_other_leave_month_count = $leave->get_employees_leave_count($search_from, $search_to, 2, 3);
    $men_total_leave_month_count = ($men_employee_ill_leave_month_count + $men_employee_vecation_leave_month_count + $men_employee_other_leave_month_count);
    $women_total_leave_month_count = ($women_employee_ill_leave_month_count + $women_employee_vecation_leave_month_count + $women_employee_other_leave_month_count);
    $men_employee_attendance_month_count = $leave->get_employees_attendance_count($search_from, $search_to, 1);
    $women_employee_attendance_month_count = $leave->get_employees_attendance_count($search_from, $search_to, 2);
    $men_employee_appointed_month_count = $leave->get_employees_appointed_count($search_from, $search_to, 1);
    $women_employee_appointed_month_count = $leave->get_employees_appointed_count($search_from, $search_to, 2);
    $men_employee_quit_month_count = $leave->get_employees_quit_count($search_from, $search_to, 1);
    $women_employee_quit_month_count = $leave->get_employees_quit_count($search_from, $search_to, 2);

    $absence_datas[] = array(
        '0' => utf8_decode(utf8_encode($smarty->localise->contents['employee'])),
        '1' => ($men_employee_leave_day_count ? $men_employee_leave_day_count : 0),
        '2' => ($women_employee_leave_day_count ? $women_employee_leave_day_count : 0),
        '3' => ($men_employee_leave_day_count + $women_employee_leave_day_count),
        '4' => utf8_decode(utf8_encode($smarty->localise->contents['employee'])),
        '5' => ($men_employee_leave_month_count ? $men_employee_leave_month_count : 0),
        '6' => ($women_employee_leave_month_count ? $women_employee_leave_month_count : 0),
        '7' => ($men_employee_leave_month_count + $women_employee_leave_month_count)
    );
    $absence_datas[] = array(
        '0' => utf8_decode(utf8_encode($smarty->localise->contents['illness_injury'])),
        '1' => ($men_employee_ill_leave_day_count ? $men_employee_ill_leave_day_count : 0),
        '2' => ($women_employee_ill_leave_day_count ? $women_employee_ill_leave_day_count : 0),
        '3' => ($men_employee_ill_leave_day_count + $women_employee_ill_leave_day_count),
        '4' => utf8_decode(utf8_encode($smarty->localise->contents['illness_injury'])),
        '5' => ($men_employee_ill_leave_month_count ? $men_employee_ill_leave_month_count : 0),
        '6' => ($women_employee_ill_leave_month_count ? $women_employee_ill_leave_month_count : 0),
        '7' => ($men_employee_ill_leave_month_count + $women_employee_ill_leave_month_count)
    );
    $absence_datas[] = array(
        '0' => utf8_decode(utf8_encode($smarty->localise->contents['vecation'])),
        '1' => ($men_employee_vecation_leave_day_count ? $men_employee_vecation_leave_day_count : 0),
        '2' => ($women_employee_vecation_leave_day_count ? $women_employee_vecation_leave_day_count : 0),
        '3' => ($men_employee_vecation_leave_day_count + $women_employee_vecation_leave_day_count),
        '4' => utf8_decode(utf8_encode($smarty->localise->contents['vecation'])),
        '5' => ($men_employee_vecation_leave_month_count ? $men_employee_vecation_leave_month_count : 0),
        '6' => ($women_employee_vecation_leave_month_count ? $women_employee_vecation_leave_month_count : 0),
        '7' => ($men_employee_vecation_leave_month_count + $women_employee_vecation_leave_month_count)
    );
    $absence_datas[] = array(
        '0' => utf8_decode(utf8_encode($smarty->localise->contents['others'])),
        '1' => ($men_employee_other_leave_day_count ? $men_employee_other_leave_day_count : 0),
        '2' => ($women_employee_other_leave_day_count ? $women_employee_other_leave_day_count : 0),
        '3' => ($men_employee_other_leave_day_count + $women_employee_other_leave_day_count),
        '4' => utf8_decode(utf8_encode($smarty->localise->contents['others'])),
        '5' => ($men_employee_other_leave_month_count ? $men_employee_other_leave_month_count : 0),
        '6' => ($women_employee_other_leave_month_count ? $women_employee_other_leave_month_count : 0),
        '7' => ($men_employee_other_leave_month_count + $women_employee_other_leave_month_count)
    );
    $absence_datas[] = array(
        '0' => utf8_decode(utf8_encode($smarty->localise->contents['total_absence'])),
        '1' => $men_total_leave_day_count,
        '2' => $women_total_leave_day_count,
        '3' => ($men_total_leave_day_count + $women_total_leave_day_count),
        '4' => utf8_decode(utf8_encode($smarty->localise->contents['total_absence'])),
        '5' => $men_total_leave_month_count,
        '6' => $women_total_leave_month_count,
        '7' => ($men_total_leave_month_count + $women_total_leave_month_count)
    );

    $attendance_datas[] = array(
        '0' => utf8_decode(utf8_encode($smarty->localise->contents['employee'])),
        '1' => ($men_employee_attendance_day_count ? $men_employee_attendance_day_count : 0),
        '2' => ($women_employee_attendance_day_count ? $women_employee_attendance_day_count : 0),
        '3' => ($men_employee_attendance_day_count + $women_employee_attendance_day_count),
        '4' => utf8_decode(utf8_encode($smarty->localise->contents['employee'])),
        '5' => ($men_employee_attendance_month_count ? $men_employee_attendance_month_count : 0),
        '6' => ($women_employee_attendance_month_count ? $women_employee_attendance_month_count : 0),
        '7' => ($men_employee_attendance_month_count + $women_employee_attendance_month_count) 
    );
    $attendance_datas[] = array(
        '0' => utf8_decode(utf8_encode($smarty->localise->contents['illness_injury'])),
        '1' => ($men_employee_ill_leave_day_count ? $men_employee_ill_leave_day_count : 0),
        '2' => ($women_employee_ill_leave_day_count ? $women_employee_ill_leave_day_count : 0),
        '3' => ($men_employee_ill_leave_day_count + $women_employee_ill_leave_day_count),
        '4' => utf8_decode(utf8_encode($smarty->localise->contents['illness_injury'])),
        '5' => ($men_employee_ill_leave_month_count ? $men_employee_ill_leave_month_count : 0),
        '6' => ($women_employee_ill_leave_month_count ? $women_employee_ill_leave_month_count : 0),
        '7' => ($men_employee_ill_leave_month_count + $women_employee_ill_leave_month_count)
    );
    $attendance_datas[] = array(
        '0' => utf8_decode(utf8_encode($smarty->localise->contents['vecation'])),
        '1' => ($men_employee_vecation_leave_day_count ? $men_employee_vecation_leave_day_count : 0),
        '2' => ($women_employee_vecation_leave_day_count ? $women_employee_vecation_leave_day_count : 0),
        '3' => ($men_employee_vecation_leave_day_count + $women_employee_vecation_leave_day_count),
        '4' => utf8_decode(utf8_encode($smarty->localise->contents['vecation'])),
        '5' => ($men_employee_vecation_leave_month_count ? $men_employee_vecation_leave_month_count : 0),
        '6' => ($women_employee_vecation_leave_month_count ? $women_employee_vecation_leave_month_count : 0),
        '7' => ($men_employee_vecation_leave_month_count + $women_employee_vecation_leave_month_count)
    );
    $attendance_datas[] = array(
        '0' => utf8_decode(utf8_encode($smarty->localise->contents['others'])),
        '1' => ($men_employee_other_leave_day_count ? $men_employee_other_leave_day_count : 0),
        '2' => ($women_employee_other_leave_day_count ? $women_employee_other_leave_day_count : 0),
        '3' => ($men_employee_other_leave_day_count + $women_employee_other_leave_day_count),
        '4' => utf8_decode(utf8_encode($smarty->localise->contents['others'])),
        '5' => ($men_employee_other_leave_month_count ? $men_employee_other_leave_month_count : 0),
        '6' => ($women_employee_other_leave_month_count ? $women_employee_other_leave_month_count : 0),
        '7' => ($men_employee_other_leave_month_count + $women_employee_other_leave_month_count)
    );
    $attendance_datas[] = array(
        '0' => utf8_decode(utf8_encode($smarty->localise->contents['total_absence'])),
        '1' => $men_total_leave_day_count,
        '2' => $women_total_leave_day_count,
        '3' => ($men_total_leave_day_count + $women_total_leave_day_count),
        '4' => utf8_decode(utf8_encode($smarty->localise->contents['total_absence'])),
        '5' => $men_total_leave_month_count,
        '6' => $women_total_leave_month_count,
        '7' => ($men_total_leave_month_count + $women_total_leave_month_count)
    );
    $attendance_datas[] = array(
        '0' => utf8_decode(utf8_encode($smarty->localise->contents['appointed'])),
        '1' => $men_employee_appointed_day_count,
        '2' => $women_employee_appointed_day_count,
        '3' => ($men_employee_appointed_day_count + $women_employee_appointed_day_count),
        '4' => utf8_decode(utf8_encode($smarty->localise->contents['appointed'])),
        '5' => $men_employee_appointed_month_count,
        '6' => $women_employee_appointed_month_count,
        '7' => ($men_employee_appointed_month_count + $women_employee_appointed_month_count)
    );
    $attendance_datas[] = array(
        '0' => utf8_decode(utf8_encode($smarty->localise->contents['quit'])),
        '1' => $men_employee_quit_day_count,
        '2' => $women_employee_quit_day_count,
        '3' => ($men_employee_quit_day_count + $women_employee_quit_day_count),
        '4' => utf8_decode(utf8_encode($smarty->localise->contents['quit'])),
        '5' => $men_employee_quit_month_count,
        '6' => $women_employee_quit_month_count,
        '7' => ($men_employee_quit_month_count + $women_employee_quit_month_count)
    );

    /*$absence_day_datas[] = array(
        '0' => utf8_decode(utf8_encode($smarty->localise->contents['employee'])),
        '1' => ($men_employee_leave_day_count ? $men_employee_leave_day_count : 0),
        '2' => ($women_employee_leave_day_count ? $women_employee_leave_day_count : 0),
        '3' => ($men_employee_leave_day_count + $women_employee_leave_day_count)
    );
    //getting illness employee count
    $absence_day_datas[] = array(
        '0' => utf8_decode(utf8_encode($smarty->localise->contents['illness_injury'])),
        '1' => ($men_employee_ill_leave_day_count ? $men_employee_ill_leave_day_count : 0),
        '2' => ($women_employee_ill_leave_day_count ? $women_employee_ill_leave_day_count : 0),
        '3' => ($men_employee_ill_leave_day_count + $women_employee_ill_leave_day_count)
    );
    //getting vecation employee count
    $absence_day_datas[] = array(
        '0' => utf8_decode(utf8_encode($smarty->localise->contents['vecation'])),
        '1' => ($men_employee_vecation_leave_day_count ? $men_employee_vecation_leave_day_count : 0),
        '2' => ($women_employee_vecation_leave_day_count ? $women_employee_vecation_leave_day_count : 0),
        '3' => ($men_employee_vecation_leave_day_count + $women_employee_vecation_leave_day_count)
    );
    //getting other employee count
    $absence_day_datas[] = array(
        '0' => utf8_decode(utf8_encode($smarty->localise->contents['others'])),
        '1' => ($men_employee_other_leave_day_count ? $men_employee_other_leave_day_count : 0),
        '2' => ($women_employee_other_leave_day_count ? $women_employee_other_leave_day_count : 0),
        '3' => ($men_employee_other_leave_day_count + $women_employee_other_leave_day_count)
    );
    //getting total employee count
    $absence_day_datas[] = array(
        '0' => utf8_decode(utf8_encode($smarty->localise->contents['total_absence'])),
        '1' => $men_total_leave_day_count,
        '2' => $women_total_leave_day_count,
        '3' => ($men_total_leave_day_count + $women_total_leave_day_count)
    );
    //getting attendance data
    $attendance_day_datas[] = array(
        '0' => utf8_decode(utf8_encode($smarty->localise->contents['employee'])),
        '1' => ($men_employee_attendance_day_count ? $men_employee_attendance_day_count : 0),
        '2' => ($women_employee_attendance_day_count ? $women_employee_attendance_day_count : 0),
        '3' => ($men_employee_attendance_day_count + $women_employee_attendance_day_count) 
    );
    //getting illness employee count
    $attendance_day_datas[] = array(
        '0' => utf8_decode(utf8_encode($smarty->localise->contents['illness_injury'])),
        '1' => ($men_employee_ill_leave_day_count ? $men_employee_ill_leave_day_count : 0),
        '2' => ($women_employee_ill_leave_day_count ? $women_employee_ill_leave_day_count : 0),
        '3' => ($men_employee_ill_leave_day_count + $women_employee_ill_leave_day_count)
    );
    //getting vecation employee count
    $attendance_day_datas[] = array(
        '0' => utf8_decode(utf8_encode($smarty->localise->contents['vecation'])),
        '1' => ($men_employee_vecation_leave_day_count ? $men_employee_vecation_leave_day_count : 0),
        '2' => ($women_employee_vecation_leave_day_count ? $women_employee_vecation_leave_day_count : 0),
        '3' => ($men_employee_vecation_leave_day_count + $women_employee_vecation_leave_day_count)
    );
    //getting other employee count
    $attendance_day_datas[] = array(
        '0' => utf8_decode(utf8_encode($smarty->localise->contents['others'])),
        '1' => ($men_employee_other_leave_day_count ? $men_employee_other_leave_day_count : 0),
        '2' => ($women_employee_other_leave_day_count ? $women_employee_other_leave_day_count : 0),
        '3' => ($men_employee_other_leave_day_count + $women_employee_other_leave_day_count)
    );
    //getting total employee count
    $attendance_day_datas[] = array(
        '0' => utf8_decode(utf8_encode($smarty->localise->contents['total_absence'])),
        '1' => $men_total_leave_day_count,
        '2' => $women_total_leave_day_count,
        '3' => ($men_total_leave_day_count + $women_total_leave_day_count)
    );

    
    $absence_month_datas[] = array(
        '0' => utf8_decode(utf8_encode($smarty->localise->contents['employee'])),
        '1' => ($men_employee_leave_month_count ? $men_employee_leave_month_count : 0),
        '2' => ($women_employee_leave_month_count ? $women_employee_leave_month_count : 0),
        '3' => ($men_employee_leave_month_count + $women_employee_leave_month_count)
    );
    //getting illness employee count
    $absence_month_datas[] = array(
        '0' => utf8_decode(utf8_encode($smarty->localise->contents['illness_injury'])),
        '1' => ($men_employee_ill_leave_month_count ? $men_employee_ill_leave_month_count : 0),
        '2' => ($women_employee_ill_leave_month_count ? $women_employee_ill_leave_month_count : 0),
        '3' => ($men_employee_ill_leave_month_count + $women_employee_ill_leave_month_count)
    );
    //getting vecation employee count
    $absence_month_datas[] = array(
        '0' => utf8_decode(utf8_encode($smarty->localise->contents['vecation'])),
        '1' => ($men_employee_vecation_leave_month_count ? $men_employee_vecation_leave_month_count : 0),
        '2' => ($women_employee_vecation_leave_month_count ? $women_employee_vecation_leave_month_count : 0),
        '3' => ($men_employee_vecation_leave_month_count + $women_employee_vecation_leave_month_count)
    );
    //getting other employee count
    $absence_month_datas[] = array(
        '0' => utf8_decode(utf8_encode($smarty->localise->contents['others'])),
        '1' => ($men_employee_other_leave_month_count ? $men_employee_other_leave_month_count : 0),
        '2' => ($women_employee_other_leave_month_count ? $women_employee_other_leave_month_count : 0),
        '3' => ($men_employee_other_leave_month_count + $women_employee_other_leave_month_count)
    );
    //getting total employee count
    $absence_month_datas[] = array(
        '0' => utf8_decode(utf8_encode($smarty->localise->contents['total_absence'])),
        '1' => $men_total_leave_month_count,
        '2' => $women_total_leave_month_count,
        '3' => ($men_total_leave_month_count + $women_total_leave_month_count)
    );
    //getting attendance data
    $attendance_month_datas[] = array(
        '0' => utf8_decode(utf8_encode($smarty->localise->contents['employee'])),
        '1' => ($men_employee_attendance_month_count ? $men_employee_attendance_month_count : 0),
        '2' => ($women_employee_attendance_month_count ? $women_employee_attendance_month_count : 0),
        '3' => ($men_employee_attendance_month_count + $women_employee_attendance_month_count) 
    );
    //getting illness employee count
    $attendance_month_datas[] = array(
        '0' => utf8_decode(utf8_encode($smarty->localise->contents['illness_injury'])),
        '1' => ($men_employee_ill_leave_month_count ? $men_employee_ill_leave_month_count : 0),
        '2' => ($women_employee_ill_leave_month_count ? $women_employee_ill_leave_month_count : 0),
        '3' => ($men_employee_ill_leave_month_count + $women_employee_ill_leave_month_count)
    );
    //getting vecation employee count
    $attendance_month_datas[] = array(
        '0' => utf8_decode(utf8_encode($smarty->localise->contents['vecation'])),
        '1' => ($men_employee_vecation_leave_month_count ? $men_employee_vecation_leave_month_count : 0),
        '2' => ($women_employee_vecation_leave_month_count ? $women_employee_vecation_leave_month_count : 0),
        '3' => ($men_employee_vecation_leave_month_count + $women_employee_vecation_leave_month_count)
    );
    //getting other employee count
    $attendance_month_datas[] = array(
        '0' => utf8_decode(utf8_encode($smarty->localise->contents['others'])),
        '1' => ($men_employee_other_leave_month_count ? $men_employee_other_leave_month_count : 0),
        '2' => ($women_employee_other_leave_month_count ? $women_employee_other_leave_month_count : 0),
        '3' => ($men_employee_other_leave_month_count + $women_employee_other_leave_month_count)
    );
    //getting total employee count
    $attendance_month_datas[] = array(
        '0' => utf8_decode(utf8_encode($smarty->localise->contents['total_absence'])),
        '1' => $men_total_leave_month_count,
        '2' => $women_total_leave_month_count,
        '3' => ($men_total_leave_month_count + $women_total_leave_month_count)
    );*/
}
$smarty->assign('absence_datas', $absence_datas);
$smarty->assign('attendance_datas', $attendance_datas);
$years_report = array(array('year' => $year-1),array( 'year' =>$year), array('year' =>$year+1));
$smarty->assign('years_report',$years_report);
$smarty->assign('search_from', $search_from);
$smarty->assign('search_to', $search_to);

if($_POST['action'] == 'csv') {
    header('Content-Type: text/csv; charset=utf-8');
    header("Content-Disposition: attachment;filename=employee-attendance-export.csv");
    $df = fopen("php://output", 'w');
    fputcsv($df, array(
        utf8_decode(utf8_encode($smarty->localise->contents['employee_attendance'])), '', '', ''
    ));
    fputcsv($df, array(
        utf8_decode(utf8_encode($smarty->localise->contents['employee_attendance_heading_day'])), '', '', ''
    ));
    fputcsv($df, array(
        utf8_decode(utf8_encode($smarty->localise->contents['absence_day'] . ':' . $from_date . "-" . $to_date)), '', '', '', utf8_decode(utf8_encode($smarty->localise->contents['absence_month'] . ':' . $smarty->localise->contents[strtolower(date('M', strtotime($search_from)))] . "-" . $year)), '', '', ''
    ));
    fputcsv($df, array(
        utf8_decode(utf8_encode($smarty->localise->contents[''])),
        utf8_decode(utf8_encode($smarty->localise->contents['men'])),
        utf8_decode(utf8_encode($smarty->localise->contents['women'])),
        utf8_decode(utf8_encode($smarty->localise->contents['total'])),
        utf8_decode(utf8_encode($smarty->localise->contents[''])),
        utf8_decode(utf8_encode($smarty->localise->contents['men'])),
        utf8_decode(utf8_encode($smarty->localise->contents['women'])),
        utf8_decode(utf8_encode($smarty->localise->contents['total']))
    ));
    foreach ($absence_datas as $absence_data) {
       fputcsv($df, $absence_data);
    }
    fputcsv($df, array(
        utf8_decode(utf8_encode($smarty->localise->contents['attendance_day'] . ':' . $from_date . "-" . $to_date)), '', '', '',utf8_decode(utf8_encode($smarty->localise->contents['attendance_month'] . ':' . $smarty->localise->contents[strtolower(date('M', strtotime($search_from)))] . "-" . $year)), '', '', ''
    ));
    fputcsv($df, array(
        utf8_decode(utf8_encode($smarty->localise->contents[''])),
        utf8_decode(utf8_encode($smarty->localise->contents['men'])),
        utf8_decode(utf8_encode($smarty->localise->contents['women'])),
        utf8_decode(utf8_encode($smarty->localise->contents['total'])),
        utf8_decode(utf8_encode($smarty->localise->contents[''])),
        utf8_decode(utf8_encode($smarty->localise->contents['men'])),
        utf8_decode(utf8_encode($smarty->localise->contents['women'])),
        utf8_decode(utf8_encode($smarty->localise->contents['total']))
    ));
    foreach ($attendance_datas as $attendance_data) {
       fputcsv($df, $attendance_data);
    }
    fclose($df);
} else if($_POST['action'] == 'excel') {
    $html = '<body><table border="1" cellpadding="0" cellspacing="0">
        <tr style="background:#DAF2F7; color:#666;">
            <th colspan="8">'.utf8_decode(utf8_encode($smarty->localise->contents['employee_attendance'])).'</th>
        </tr>
        <tr style="background:#DAF2F7; color:#666;">
            <th colspan="8">'.utf8_decode(utf8_encode($smarty->localise->contents['employee_attendance_heading_day'])).'</th>
        </tr>
        <tr style="background:#DAF2F7; color:#666;">
            <th colspan="4">'.utf8_decode(utf8_encode($smarty->localise->contents['absence_day'] . ':' . $from_date . "-" . $to_date)) . '</th>
            <th colspan="4">'.utf8_decode(utf8_encode($smarty->localise->contents['absence_month'] . ':' . $smarty->localise->contents[strtolower(date('M', strtotime($search_from)))] . "-" . $year)) . '</th>
        </tr>
        <tr style="background:#DAF2F7; color:#666;">
            <th></th>
            <th>'.utf8_decode(utf8_encode($smarty->localise->contents['men'])).'</th>
            <th>'.utf8_decode(utf8_encode($smarty->localise->contents['women'])).'</th>
            <th>'.utf8_decode(utf8_encode($smarty->localise->contents['total'])).'</th>
            <th></th>
            <th>'.utf8_decode(utf8_encode($smarty->localise->contents['men'])).'</th>
            <th>'.utf8_decode(utf8_encode($smarty->localise->contents['women'])).'</th>
            <th>'.utf8_decode(utf8_encode($smarty->localise->contents['total'])).'</th>
        </tr>';
        foreach ($absence_datas as $absence_data) {
            $html .= '<tr>';
            foreach($absence_data as $absence) {
                $html .= '<td>' . utf8_decode(utf8_encode($absence)) . '</td>';
            }
            $html .= '</tr>';
        }
        $html .= '<tr style="background:#DAF2F7; color:#666;">
            <th colspan="4">'.utf8_decode(utf8_encode($smarty->localise->contents['attendance_day'] . ':' . $from_date . "-" . $to_date)) . '</th>
            <th colspan="4">'.utf8_decode(utf8_encode($smarty->localise->contents['attendance_month'] . ':' . $smarty->localise->contents[strtolower(date('M', strtotime($search_from)))] . "-" . $year)) . '</th>
        </tr>
        <tr style="background:#DAF2F7; color:#666;">
            <th></th>
            <th>'.utf8_decode(utf8_encode($smarty->localise->contents['men'])).'</th>
            <th>'.utf8_decode(utf8_encode($smarty->localise->contents['women'])).'</th>
            <th>'.utf8_decode(utf8_encode($smarty->localise->contents['total'])).'</th>
            <th></th>
            <th>'.utf8_decode(utf8_encode($smarty->localise->contents['men'])).'</th>
            <th>'.utf8_decode(utf8_encode($smarty->localise->contents['women'])).'</th>
            <th>'.utf8_decode(utf8_encode($smarty->localise->contents['total'])).'</th>
        </tr>';
        foreach ($attendance_datas as $attendance_data) {
            $html .= '<tr>';
            foreach($attendance_data as $attendance) {
                $html .= '<td>' . utf8_decode(utf8_encode($attendance)) . '</td>';
            }
            $html .= '</tr>';
        }
    $html .= '</table></body>';
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=employee-attendance-export.xls");
    echo $html;
} else if($_POST['action'] == 'pdf') {
    $mpdf = new mPDF('');
    $mpdf->useKerning=true;
    $mpdf->restrictColorSpace=3;
    $mpdf->AddSpotColor('PANTONE 534 EC',85,65,47,9);
    $html = '<table border="1" cellpadding="0" cellspacing="0" width="100%" style="width:100%;">
        <tr style="background:#DAF2F7; color:#666;">
            <th colspan="8">'.utf8_decode(utf8_encode($smarty->localise->contents['employee_attendance'])).'</th>
        </tr>
        <tr style="background:#DAF2F7; color:#666;">
            <th colspan="8">'.utf8_decode(utf8_encode($smarty->localise->contents['employee_attendance_heading_day'])).'</th>
        </tr>
        <tr style="background:#DAF2F7; color:#666;">
            <th colspan="4" style="text-align:left;">'.utf8_decode(utf8_encode($smarty->localise->contents['absence_day'] . ':' . $from_date . "-" . $to_date)) . '</th>
            <th colspan="4" style="text-align:left;">'.utf8_decode(utf8_encode($smarty->localise->contents['absence_month'] . ':' . $smarty->localise->contents[strtolower(date('M', strtotime($search_from)))] . "-" . $year)) . '</th>
        </tr>
        <tr style="background:#DAF2F7; color:#666;">
            <th></th>
            <th>'.utf8_decode(utf8_encode($smarty->localise->contents['men'])).'</th>
            <th>'.utf8_decode(utf8_encode($smarty->localise->contents['women'])).'</th>
            <th>'.utf8_decode(utf8_encode($smarty->localise->contents['total'])).'</th>
            <th></th>
            <th>'.utf8_decode(utf8_encode($smarty->localise->contents['men'])).'</th>
            <th>'.utf8_decode(utf8_encode($smarty->localise->contents['women'])).'</th>
            <th>'.utf8_decode(utf8_encode($smarty->localise->contents['total'])).'</th>
        </tr>';
        foreach ($absence_datas as $absence_data) {
            $html .= '<tr>';
            foreach($absence_data as $absence) {
                $html .= '<td>' . utf8_decode(utf8_encode($absence)) . '</td>';
            }
            $html .= '</tr>';
        }
        $html .= '<tr style="background:#DAF2F7; color:#666;">
            <th colspan="4" style="text-align:left;">'.utf8_decode(utf8_encode($smarty->localise->contents['attendance_day'] . ':' . $from_date . "-" . $to_date)) . '</th>
            <th colspan="4" style="text-align:left;">'.utf8_decode(utf8_encode($smarty->localise->contents['attendance_month'] . ':' . $smarty->localise->contents[strtolower(date('M', strtotime($search_from)))] . "-" . $year)) . '</th>
        </tr>
        <tr style="background:#DAF2F7; color:#666;">
            <th></th>
            <th>'.utf8_decode(utf8_encode($smarty->localise->contents['men'])).'</th>
            <th>'.utf8_decode(utf8_encode($smarty->localise->contents['women'])).'</th>
            <th>'.utf8_decode(utf8_encode($smarty->localise->contents['total'])).'</th>
            <th></th>
            <th>'.utf8_decode(utf8_encode($smarty->localise->contents['men'])).'</th>
            <th>'.utf8_decode(utf8_encode($smarty->localise->contents['women'])).'</th>
            <th>'.utf8_decode(utf8_encode($smarty->localise->contents['total'])).'</th>
        </tr>';
        foreach ($attendance_datas as $attendance_data) {
            $html .= '<tr>';
            foreach($attendance_data as $attendance) {
                $html .= '<td>' . utf8_decode(utf8_encode($attendance)) . '</td>';
            }
            $html .= '</tr>';
        }
    $html .= '</table>';
    $mpdf->WriteHTML($html);
    $mpdf->Output('employee-attendance-export.pdf','D'); 
} else {
    $smarty->display('extends:layouts/dashboard.tpl|employee_attendance_day.tpl');
}
?>
